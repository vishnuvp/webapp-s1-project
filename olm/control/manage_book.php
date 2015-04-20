<!DOCTYPE html>
<html>
<head>
	<?php
	//<head></head>
	include('../includes/head.inc');
	?>
</head>
<body>
<?php
include('../includes/header.inc');
	if(olm_session_get_role() != 'Admin')
		header('Location: /m140163cs/olm/index.php');
?>
<script>
$(document).ready(function() {
	function ajaxify(){
		$.ajax({
		url: '/m140163cs/olm/control/admin_ajax_search.php?t=b&f='+$('#by_field').val()+'&q='+ $('#name_query').val(),
		success: function(data) {	
			$("#edit-search-results").html(data);
	}
	});
	}
	$("#book-edit-form-container").submit(function(e) {
		e.preventDefault();	
		ajaxify();

	});
	$("#name_query").keyup(function(){ajaxify();});
	$(document).on('click','.inline-manage-links',function(e){
		e.preventDefault();
		var id = $(this).attr('id');
		id = id.substring(id.indexOf('-')+1);

		$('tr#'+id+' td').each(
			function() {
				//alert('tr#'+id+' td');
				$('#edit-'+$(this).attr('class')).val($(this).text());
			});
		$('#edit-container').fadeIn();
		$('html, body').animate({
			scrollTop: $('#book-edit-form-container').offset().top - 300}, 1000);  
		//alert(id);
	});
});
function save() {
	if(!confirm("Do you really want to modify?(Click cancel if don't)"))
		return;
	dataString = 'bid='+$('#edit-bid').val()+'&title='+$('#edit-title').val()+'&author='+$('#edit-author').val()+'&';
	dataString += 'edition='+$('#edit-edition').val()+'&publisher='+$('#edit-publisher').val()+'&subject='+$('#edit-subject').val()+'&';
	dataString += 'rack_no='+$('#edit-rackno').val()+'&category='+$('#edit-category').val()+'&comments='+$('#edit-comments').val()+'&';
	var status = $('#edit-status').val();
	if(status == 'TU')
		num_status = 0;
	else if(status == 'OS')
		num_status = 1;
	else if(status == 'OL')
		num_status = 2;
	else if(status == 'OSR')
		num_status = 3;	
	else if(status == 'OLR')
		num_status = 4;		 
	dataString += 'status='+num_status;
	$.ajax({
		type: "POST",
		url: "modify.php?t=b&a=m",
		data: dataString,
		cache: false,
		success: function(result){
		if(result!='fail') {
			$('#edit-container').hide();
			$('#op-update-id').html('<span style="color:red">Book modified!</span>').fadeIn('slow',function(){
				setTimeout(function(){}, 5000);
				});
			$('#target-book-edit-form').submit();
		}
		else {
			$('#op-update-id').html('<span style="color:red">Book modification failed! Please try again.</span>').fadeIn('slow');
		}
			
		}
	});
}
function deleteBook() {
	if(!confirm("Do you really want to delete?(Click cancel if don't)"))
		return;
	dataString = 'bid='+$('#edit-bid').val();
	$.ajax({
		type: "POST",
		url: "modify.php?t=b&a=d",
		data: dataString,
		cache: false,
		success: function(result){
		if(result!='fail') {
			$('#edit-container').hide();
			$('#op-update-id').html('<span style="color:red">Book deleted!</span>').fadeIn('slow',function(){
				setTimeout(function(){}, 5000);
				});
			$('#target-book-edit-form').submit();
		}
		else {
			$('#op-update-id').html('<span style="color:red">Deletion failed! Please try again.</span>').fadeIn('slow');
		}
			
		}
	});
}

</script>
	<div class="backlinks"><a href="/m140163cs/olm">Back to dashboard</a></div>

<div class="form-container low-margin" id="book-edit-form-container">
		<form name="book-edit-form" id="target-book-edit-form" method="post" action="manage_book.php">
	
			<div class="input-container inline-label">
				<label for="name">Search</label>:<input name="query" id="name_query" placeholder="Search book to modify" type="text" value=""/>
			</div>
			<div class="input-container inline-label">
				<label for="name">Search in</label>:
				<select name="field" id="by_field">
					<option value="title">Title</option>
					<option value="bid">Book ID</option>
					<option value="author">Author</option>
					<option value="category">Category</option>
				</select>
			</div>
			<div class="input-container submit-btn">
				<input name="submit" type="submit" value="Search"/>
			</div>
		</form>
</div>
<div id="edit-container" style="display:none;">
<table class="editable-table">
	<thead><td>Book ID</td><td>Title</td><td>Author</td><td>Edition</td><td>Publisher</td><td>Subject</td><td>Rack No</td><td>Category</td><td>Comments</td><td>Status</td></thead>
	<tr>
		<td><input type="text" id="edit-bid" disabled="disabled"/></td>
		<td><input type="text" id="edit-title" /></td>
		<td><input type="text" id="edit-author" /></td>
		<td><input type="text" id="edit-edition" /></td>
		<td><input type="text" id="edit-publisher" /></td>
		<td><input type="text" id="edit-subject" /></td>
		<td><input type="text" id="edit-rackno" /></td>
		<td><input type="text" id="edit-category" /></td>
		<td><textarea id="edit-comments" /></textarea></td>
		<td><select id="edit-status" />
			<option value="TU">TU</option>
			<option value="OS">OS</option>
			<option value="OL">OL</option>
			<option value="OSR">OSR</option>
			<option value="OLR">OLR</option>
		</select></td>
	</tr>
	<tr>
		<td colspan="10"><button id="update-btn" onclick="save()">Update</button><button id="delete-btn" onclick="deleteBook()">Delete</button></td>
	</tr>
</table>
</div>
<div id="op-update-id" class="auto-disappear"></div>
<div id="edit-search-results">

</div>
<div class="footer">
		<?php include('../includes/footer.inc'); ?>
</div>
</body>
</html>
