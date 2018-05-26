$('#register-form').submit(function(e){
	e.preventDefault();
    console.log($(this).serialize());
	$.ajax({
		type: "POST",
		url: "api/v1/vehicles",
        data: $(this).serialize() ,
        success: function(response) {
        	$("#name").val('');
        	$("#ep_value").val('');
        	$("#ed_value").val('');
        	$("#price").val('');
        	$("#location").val('');
        	reload_table();
        },
        error: function(response) {
            alert(response);

        }
	});
});

$(".decimal").on("input", function(evt) {
   var self = $(this);
   self.val(self.val().replace(/[^0-9\.]/g, ''));
   if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
   {
     evt.preventDefault();
   }
});

$('#filter-unit').change(function(){
	reload_table();
});

function reload_table() {
	$.get({
		url: "api/v1/vehicles",
        contentType: 'application/json',
        dataType: 'json',
        data: {unit: $('#filter-unit').val()},
        beforeSend: function() {
        	$('#vehicles-table tbody').html('');
        },
        success: function(response) {
    		var html = "";
    		console.log(response);
    		$.each(response.data, function(index, value) {
    			html += 
    				"<tr>" +
    					"<td>" + value.name + "</td>" + 
    					"<td>" + value.ed_value + " " + value.ed_unit + "</td>" + 
    					"<td>" + value.ep_value + " " + value.ep_unit + "</td>" + 
    					"<td>" + value.price + "</td>" + 
    					"<td>" + value.location +"</td>" + 
    				"</tr>";
    		});
    		$('#vehicles-table tbody').html(html);
        },
        error: function(response) {
            $('#vehicles-table > tbody').html('<tr><td colspan="5">No Records Found</td></tr>');
        }
	});
}