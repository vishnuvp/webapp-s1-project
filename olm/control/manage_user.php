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
	function ajaxify() {
		$.ajax({
			url: '/m140163cs/olm/control/admin_ajax_search.php?t=u&f='+$('#by_field').val()+'&q='+ $('#name_query').val(),
			success: function(data) {	
				$("#edit-search-results").html(data);
		}
		});	
	}
	$("#user-edit-form-container").submit(function(e) {
		e.preventDefault();	
		ajaxify();
	});
	$("#name_query").keyup(function(){
		ajaxify();
	});
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
			scrollTop: $('#user-edit-form-container').offset().top - 300}, 1000); 
		//alert(id);
	});
});

function save() {
	if(!confirm("Do you really want to update?(Click cancel if don't)"))
		return;
	dataString = 'uid='+$('#edit-uid').val()+'&name='+$('#edit-name').val()+'&email='+$('#edit-email').val()+'&';
	dataString += 'phoneno='+$('#edit-phoneno').val()+'&password='+$('#edit-password').val()+'&type='+$('#edit-type').val();

	
	$.ajax({
		type: "POST",
		url: "modify.php?t=u&a=m",
		data: dataString,
		cache: false,
		success: function(result){
		if(result!='fail') {
			$('#edit-container').hide();
			$('#op-update-id').html('<span style="color:red">User details modified!</span>').fadeIn('slow',function(){
				setTimeout(function(){}, 5000);
				});
			$('#target-user-edit-form').submit();
		}
		else {
			$('#op-update-id').html('<span style="color:red">User details updation failed! Please try again.</span>').fadeIn('slow');
		}
			
		}
	});
}
function deleteUser() {
	if(!confirm("Do you really want to delte?(Click cancel if don't)"))
		return;
	dataString = 'uid='+$('#edit-uid').val();
	$.ajax({
		type: "POST",
		url: "modify.php?t=u&a=d",
		data: dataString,
		cache: false,
		success: function(result){
		if(result!='fail') {
			$('#edit-container').hide();
			$('#op-update-id').html('<span style="color:red">User account deleted!</span>').fadeIn('slow',function(){
				setTimeout(function(){}, 5000);
				});
			$('#target-user-edit-form').submit();
		}
		else {
			$('#op-update-id').html('<span style="color:red">User account deletion failed! Please try again.</span>').fadeIn('slow');
		}
			
		}
	});
}
</script>
	<div class="backlinks"><a href="/m140163cs/olm">Back to dashboard</a></div>

<div class="form-container" id="user-edit-form-container">
		<form name="user-edit-form" id="target-user-edit-form" method="post" action="manage_user.php">
	
			<div class="input-container inline-label">
				<label for="name">Search</label>:<input name="query" id="name_query" placeholder="Search user to modify" type="text" value=""/>
			</div>
			<div class="input-container inline-label">
				<label for="name">Search in</label>:
				<select name="field" id="by_field">
					<option value="name">Name</option>
					<option value="uid">User ID</option>
					<option value="email">Email ID</option>
					<option value="phoneno">Phone No</option>
				</select>
			</div>
			<div class="input-container submit-btn">
				<input name="submit" type="submit" value="Search"/>
			</div>
		</form>
</div>
<div id="edit-container" style="display:none;">
<table class="editable-table">
	<thead><td>User ID</td><td>Name</td><td>Email ID</td><td>Phone</td><td>New Password</td><td>Type</td></thead>
	<tr>
		<td><input type="text" id="edit-uid" /></td>
		<td><input type="text" id="edit-name" /></td>
		<td><input type="text" id="edit-email" /></td>
		<td><input type="text" id="edit-phoneno" /></td>
		<td><input type="text" id="edit-password" /></td>
		<td><select id="edit-type" />
			<option value="Admin">Admin</option>
			<option value="Faculty">Faculty</option>
			<option value="Student">Student</option>
		</select></td>
	</tr>
	<tr>
		<td colspan="10"><button id="update-btn" onclick="save()">Update</button><button id="delete-btn" onclick="deleteUser()">Delete</button></td>
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
