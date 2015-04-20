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
	//<head></head>
	include('../includes/header.inc');
		if(!is_olm_session_active())
			header('Location: /m140163cs/olm/index.php');
	?>
<script>
function check() {
	if ($("#n").val() != $('#c').val()) {
	$("#status").html("<span style='color:red'>New Passwords do not match</span>");
return false;
}
}
</script>
<style>
.form-container input, div {
width: 100%;
color: #556677;
}
</style>
	<div class="backlinks"><a href="/m140163cs/olm">Back to dashboard</a></div>

	<div class="form-container">
<div class="page-title">Change Password</div>
		<form action="change_pwd.php" method="POST" onsubmit="return check();">
		<div>Old Password</div>
		<div><input style="float:right;font-size:1.2em" type="password" required="required" name="old" placeholder="Old Password" /></div>
		<div>New Password</div><div><input style="float:right;font-size:1.2em" type="password" required="required" name="new" id="n" placeholder="New Password" /></div>
		<div>Confirm Password</div><div><input style="float:right;font-size:1.2em" type="password" required="required" name="confirm" id="c" placeholder="Confirm New Password" /></div>
		<div id="status"></div>
		<div><input type="submit" style="width:50%;font-size: 1.2em;" value="Change Password" /></div>
		</form>
	
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		require_once("../includes/authenticate.inc");
		$uid = olm_session_get_user();
		$pwd = $_POST['old'];
		if(authenticate($uid,$pwd)&&($_POST['new'] == $_POST['confirm'])) {
			$dbcon = new DBConnection;
			$dbcon->connect();
			$pwd = md5('salt'.trim($_POST['new']));
			if($dbcon->dquery('UPDATE user SET password="'.$pwd.'" WHERE uid="'.$uid.'"'))
				echo set_status('Password reset succesfully','info');
			else 
				echo set_status('Password reset failed','error');
			$dbcon->disconnect();

	}
	else {
		echo set_status('Current password is incorrect','warning');
	}

	}
?>
	</div>
	<div class="footer">
		<?php include('../includes/footer.inc'); ?>
	</div>	
</body>
</html>
