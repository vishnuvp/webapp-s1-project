<!DOCTYPE html>
<html>
<head>
	<script src="/m140163cs/olm/scripts/jquery-1.11.1.min.js"></script>
	<script src="/m140163cs/olm/scripts/script.js"></script>
	<link rel="stylesheet" href="/m140163cs/olm/css/styles.css" />
</head>
<body class="anonymous">
	<?php
	
		
	
	require_once('includes/session.inc');
	
	if(is_olm_session_active())
	{
		echo 'redirecting to home';
		header("Location:main.php");
	}
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		require_once('includes/authenticate.inc');
		require_once('includes/dblog.inc');
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		$result = authenticate($username, $password);		
		if($result) {
				
			new_olm_session($username,$result['name'], mktime(), $result['type']);
			db_log('Login', $username, olm_session_get_timestamp(),'success'); // dblog format: 'log info, user, timestamp, succes/failure
			header("Location:main.php");
		}
		else {

			require_once('includes/utilities.inc');
			
			$error_code = set_status('Invalid Login Credentials. Please try again.', 'error');
		}
	}

		?>
		<div style="width: 30%;" id="login-container">
			<img src="assets/images/logo.png" id="logo"/>
		<h1 id="login-header">CSED LIBRARY</h1>
		<h2>LOGIN</h2>
			<?php
		if(isset($error_code)) {
			echo '<div class="status-container">';
			echo $error_code . '</div>';
		}
		?>
			<form name="loginForm" id="loginForm" method="post" action="index.php">
		 	<table style="width:100%">
		 		<tr><td><label for="username">Username </label></td>
		 			<td><input name="username" type="text"></td>
		 		</tr>
		 		<tr>
		 			<td><label for="password">Password</label></td>
		 			<td><input name="password" type="password"></td>
		 		</tr>
		 		<tr><td colspan="2" style="text-align:center"><input value="Login" type="submit"></td>
		 		</tr>
		 	</table></div>
		 	<div class="input-wrapper"></div>
		 	<div class="input-wrapper"></div>
		 </form>
		</div>
	</div>
<div class="footer">
			<?php include('includes/footer.inc'); ?>
	</div>		
	
</body>
</html>