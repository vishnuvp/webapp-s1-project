$(document).ready(function() {
	$('#header-search-op2').change(function(){
		if($('#header-search-op2').val() == 'bid')
			$('#header-search-box-id').val('CSED-').focus();
		else 
			$('#header-search-box-id').val('').focus();

	});
$('#header-search-box-id').keyup(function(){
	
	$.ajax({
	url: '/m140163cs/olm/control/user_ajax_search.php?f='+$('#header-search-op2').val()+'&q='+ $('#header-search-box-id').val(),
	success: function(data) {	
		$("#header-search-listing-id").html(data);
	console.log(data);
	}
});
});


});
