+ function($) {
	
	jQuery(function($) {


		$('#filter').submit(function() {
			// Start

var filterValueText = document.getElementById("keyword").value;
var filterValue1 = document.getElementById("cfilter_1").value;
var filterValue2 = document.getElementById("cfilter_2").value;   
var filterValue3 = document.getElementById("cfilter_3").value;
var filterValue4 = document.getElementById("cfilter_4").value;
if (filterValueText == '' && filterValue1 == '' && filterValue2 == '' && filterValue3 == '' && filterValue4 == '') {
    
	Swal.fire({
		icon: 'error',
		title: 'Oops...',
		text: 'Please Enter Atlest One Value!',
		confirmButtonColor: "#d14034",
	  })

} else {



	
	var filter = $('#filter');
	$.ajax({
		url: filter.attr('action'),
		data: filter.serialize(), // form data
		type: filter.attr('method'), // POST
		beforeSend: function(xhr) {
			filter.find('button').text('Processing...'); // changing the button label
		},
		success: function(data) {
			filter.find('button').text('Apply filter'); // changing the button label back
			$('#response').html(data);

		}
	});
	
	

}
		
return false;

		});
	});
	 


}(jQuery);