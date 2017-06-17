jQuery(document).ready(function($) {


	$("#play_button").click(function(e){

		e.preventDefault();

		var userData = 'I am working';

		var data = {
			action: 'builder_admin_layout',
			data: userData
		};

		$.post(ajaxurl, data, function(response) {

			if (response.success == true) {
				// console.log("Successfully request sent");
				// console.log(response);
				$("#heyn").html(response['data']);
			}
			else {
				// console.log("Request could not be sent Successfully");
			}
		});
	}) 

});