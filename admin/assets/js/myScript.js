jQuery(document).ready(function($) {

$(".wp-heading-inline").before('<a id="heyaa" href="#45" class="button button-primary button-large">HELLO WORLD BUTTON</a>');
$(".wp-heading-inline").before('<div id="responser"></div>');
	$("#heyaa").click(function(e){

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
				$("#responser").html(response['data']);
			}
			else {
				// console.log("Request could not be sent Successfully");
			}
		});
	}) 
});