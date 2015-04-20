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
<div class="backlinks"><a href="/m140163cs/olm">Back to dashboard</a></div>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {

	$to = check_input($_POST['utype']);
	$date = $_POST['date'];
	$msg = substr(check_input($_POST['message']), 0, 1024);
	
	$dbconnection = new DBConnection;
	$dbconnection->connect();
	$dbconnection->insert_values('banner', array("who","display_date",'message'), array('"'.$to.'"','"'.$date.'"', '"'.$msg.'"'));
	$dbconnection->disconnect();

?>
<div class="form-container" id="import-form-container">
		<div class="page-title">Post Banner</div>

<?php echo set_status("Message posted succesfully", "info"); ?>	
</div>
<?php
}

else {
?>
<div class="form-container" id="create-banner-container">
		<div class="page-title">Post Banner</div>

		<form name="create-banner-form" method="post" action="create_banner.php">
			
			<div class="input-container inline-label">
				<label for="uid">Recepients</label>:
				<select name="utype">
					<option value="Student">Student</option>
					<option value="Faculty">Faculty</option>
					<option value="Both">Both</option>
				</select>
			</div>
			<div class="input-container">
				<label for="date">Date</label>:
				<input type="date" name="date"/>
			</div>
			<div class="input-container inline-label">
				<label for="message">Message(Maximum: 1024 characters)</label>:<textarea name="message" max-length="1024"></textarea>
			</div>
			<div class="input-container submit-btn">
				<input name="submit" type="submit" value="Post"/>
			</div>
		</form>
	</div>
<?php
}
?>
<div class="footer">
			<?php include('../includes/footer.inc'); ?>
	</div>	
</body>
</html>
