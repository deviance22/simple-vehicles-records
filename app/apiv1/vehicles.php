<?php

/**
 *
 * Retrieve registered vehicles
 * 
 */

$app->get('/api/v1/vehicles', function($request, $response){
	$units       = ['CC', 'CID', 'L'];
	$ep_units    = ['HP', 'KW'];
	$search_data = $request->getQueryParams();
	$result      = $this->db->query("SELECT * FROM vehicles ORDER BY id");

	while ($row = $result->fetch_assoc()) {
		if ($search_data['unit'] >= 0) {
			$convert_result  = convert($row['id'], $search_data['unit'], $this->db);
			$row['ed_value'] = $convert_result['value'];
			$row['ed_unit']  = $units[$convert_result['unit']];
			$row['ep_unit']  = $ep_units[$row['ep_unit']];
		} else {
			$row['ed_unit']  = $units[$row['ed_unit']];
			$row['ep_unit']  = $ep_units[$row['ep_unit']];
		}
		$data[]          = $row;
	}
	if (isset($data) && $data[0] != null) {
		echo json_encode(['data' => $data]);
	} else {
		echo $response->withJson(['code' => '404', 'msg' => 'No records found'], 200);
	}
});

$app->post('/api/v1/vehicles', function($request, $response) {
	$insert_data  = $request->getParsedBody();
	$name         = $insert_data['name'];
	$ed_value     = $insert_data['ed_value'];
	$ed_unit      = $insert_data['ed_unit'];
	$ep_value     = $insert_data['ep_value'];
	$ep_unit      = $insert_data['ep_unit'];
	$price        = $insert_data['price'];
	$location     = $insert_data['location'];

	$insert_query = "INSERT INTO vehicles (name, ed_value, ed_unit, ep_value, ep_unit, price, location) VALUES (?, ?, ?, ?, ?, ?, ?)";
	$stmt         = $this->db->prepare($insert_query);

	$stmt->bind_param("sdidids", $name, $ed_value, $ed_unit, $ep_value, $ep_unit, $price, $location);
	if ($stmt->execute()) {
		echo $response->withJson(['msg' => "Successfully added a vehicle"], 200);
	} else {
		echo $response->withJson(['msg' => "Unable to add vehicle. There was a server error."], 500);
	}
});

function convert($id, $unit, $db) {
	$result = $db->query("SELECT * FROM vehicles WHERE id = $id");
	$row    = $result->fetch_assoc();

	$result_unit      = $row['ed_unit'];
	$result_value     = $row['ed_value'];
	$converted_result = 0;

	if ($unit == $result_unit || $unit == -1) {
		return ['unit' => $result_unit, 'value' => $result_value];
	} else {
		if ($result_unit == 0 && $unit == 1) { // cc -> cid
			$converted_result = $result_value/16.387;
		} elseif ($result_unit == 0 && $unit == 2) { // cc -> L
			$converted_result = $result_value/1000;
		} elseif ($result_unit == 1 && $unit == 0) { // cid -> cc
			$converted_result = $result_value*16.387;
		} elseif ($result_unit == 1 && $unit == 2) { // cid -> L
			$converted_result = $result_value/61.0237;
		} elseif ($result_unit == 2 && $unit == 0) { // L -> cc
			$converted_result = $result_value*1000;
		} elseif ($result_unit == 2 && $unit == 1) { // L -> cid
			$converted_result = $result_value*61.0237;
		} 

		return ['unit' => $unit, 'value' => round($converted_result, 2)];
	}

}