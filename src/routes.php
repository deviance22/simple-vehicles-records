<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/', function($request, $response, $args){
	$ed_units = ['cc', 'cid', 'l'];
	$ep_units = ['hp', 'kW'];

	$result = $this->db->query("SELECT * FROM vehicles ORDER BY id");
	$vehicles = [];
	while ($row = $result->fetch_assoc()) {
		$row['ed_unit'] = $ed_units[$row['ed_unit']];
		$row['ep_unit'] = $ep_units[$row['ep_unit']];
		$vehicles[] = $row;
	}
	$data = ['vehicles' => $vehicles ? $vehicles : null];
	return $this->view->render($response, 'index.phtml', $data);
});

require_once(__DIR__ . "/../app/apiv1/vehicles.php");