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
	if(olm_session_get_role() != 'Admin')
		header('Location: /m140163cs/olm/index.php');
?>
	<div class="backlinks"><a href="/m140163cs/olm">Back to dashboard</a></div>
<?php	// to do: form authentication using random string; store in form and session variable


	if($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			//do form validation, input sanitization
			$empty_flag = false;
			foreach ($_POST as $key => $value) {
				if(empty($value))
					$empty_flag = true;
			}
			
			if(($_POST['password'] != $_POST['confirm'])||($empty_flag))
			{	
				?>
				<div class="form-container" id="user-add-form-container">
				<div class="form-title">Add new user<span style="float:right;margin-right:1em"><a href="user_add.php" title="Add another user"><i class="plus-sign"></i></a></span></div>
				<form name="user-add-form" method="post" action="user_add.php">
				<?php
				if ($_POST['password'] != $_POST['confirm']) {
					echo set_status('Passwords do not match. Try again','error');
				}

				else if($empty_flag) {
					echo set_status('All fields are mandatory','error');
				}
				?>
				
						<div class="input-container block">
							<label for="uid">User ID/Roll No<sup><span class="req-mark">*</span></sup></label><input required="required" name="uid" type="text" value="<?php echo $_POST['uid']; ?>"/>
						</div>
						<div class="input-container block">
							<label for="type">User Type<sup><span class="req-mark">*</span></sup></label><select name="type">
							<option value="Faculty" <?php echo $_POST['type'] == "Faculty"?"selected":""; ?>>Faculty</option>
							<option value="Student" <?php echo $_POST['type'] == "Student"?"selected":""; ?>>Student</option>
							<option value="Admin"	<?php echo $_POST['type'] == "Admin"?"selected":""; ?>>Admin</option>
						</select>
						</div>
						<div class="input-container block">
							<label for="name">Name<sup><span class="req-mark">*</span></sup></label><input name="name" required="required" type="text" value="<?php echo $_POST['name']; ?>"/>
						</div>
						<div class="input-container block">
							<label for="email">Email ID<sup><span class="req-mark">*</span></sup></label><input name="email" required="required" type="email" value="<?php echo $_POST['email']; ?>"/>
						</div>
						<div class="input-container block">
							<label for="phoneno">Phone No<sup><span class="req-mark">*</span></sup></label><input name="phoneno" required="required" type="text" value="<?php echo $_POST['phoneno']; ?>"/>
						</div>
						<div class="input-container block">
							<label for="info">Faculty Type/Student Semester</label><input name="info" type="text" value="<?php echo $_POST['info']; ?>"/>
						</div>
						<div class="input-container block">
							<label for="password">Password<sup><span class="req-mark">*</span></sup></label><input name="password" required="required" type="password"/>
						</div>
						<div class="input-container block">
							<label for="confirm">Confirm Password<sup><span class="req-mark">*</span></sup></label><input name="confirm" required="required" type="password"/>
						</div>
						<div class="input-container submit-btn">
							<input name="submit" type="submit" value="Add User"/>
						</div>
					</form>
				</div>


				<?php
			
			}
			else {
				echo '<div class="result-container"><div class="result-title">New User<span style="float:right;margin-right:1em"><a href="user_add.php" title="Add another user"><i class="plus-sign"></i></a></span></div><div class="result-body">';
				$array = array();
				$array['uid'] = $_POST['uid'];
				$array['name'] = $_POST['name'];
				$array['email'] = $_POST['email'];
				$array['phoneno'] = $_POST['phoneno'];
				$array['type'] = $_POST['type']; //validate; if possible change ids in select box and replace with ids here
				$array['info'] = $_POST['info'];
				$array['password'] = md5('salt'.trim($_POST['password']));
				
				//echo '<br />Add user array:'.print_r($array);	
				$admin = new Admin or die("unable to create admin object");
				

				if ($array['type'] == 'Admin') {
					$user = $admin->add_admin($array);
					if($user) {
						echo set_status('User Added! '.$array['uid'].' '.$array['name'], 'info');
					}
					else {
						echo set_status('User is already registered','warning');
					}
				}
				else {
					$user = $admin->add_user($array);
					if($user) {

						echo set_status('User Added! '.$array['uid'].' '.$array['name'], 'info');
						echo '<div class="input-container block"><label>User ID: '. $array['uid'].'</label></div>';
						echo '<div class="input-container block"><label>Name: ' . $array['name'].'</label></div>';
						echo '<div class="input-container block"><label>Email: ' . $array['email'].'</label></div>';
						echo '<div class="input-container block"><label>Phone No: ' . $array['phoneno'].'</label></div>';
						echo '<div class="input-container block"><label>User Type: ' . $array['type'].'</label></div>';

					}
					else {
						echo set_status('Duplicate User: User registration failed.', 'warning');
					}
				}
				echo '</div></div></div>';
			}
			
		}

	else {

?>
	<div class="form-container" id="user-add-form-container">
		<div class="form-title">Add new user<span style="float:right;margin-right:1em"><a href="user_add.php" title="Add another user"><i class="plus-sign"></i></a></span></div>
		<form name="user-add-form" method="post" action="user_add.php">
			<div class="input-container block">
				<label for="uid">User ID/Roll No<sup><span class="req-mark">*</span></sup></label><input name="uid" type="text"/>
			</div>
			<div class="input-container block">
				<label for="type">User Type</label><select name="type">
				<option value="Faculty">Faculty</option>
				<option value="Student">Student</option>
				<option value="Admin">Admin</option>
			</select>
			</div>
			<div class="input-container block">
				<label for="name">Name<sup><span class="req-mark">*</span></sup></label><input name="name" required="required" type="text"/>
			</div>
			<div class="input-container block">
				<label for="email">Email ID<sup><span class="req-mark">*</span></sup></label><input name="email" required="required" type="email"/>
			</div>
			<div class="input-container block">
				<label for="phoneno">Phone No<sup><span class="req-mark">*</span></sup></label><input name="phoneno" required="required" type="text"/>
			</div>
			<div class="input-container block">
							<label for="info">Faculty Type/Student Semester</label><input name="info" type="text"/>
			</div>
			<div class="input-container block">
				<label for="password">Password<sup><span class="req-mark">*</span></sup></label><input name="password" required="required" type="password"/>
			</div>
			<div class="input-container block">
				<label for="confirm">Confirm Password<sup><span class="req-mark">*</span></sup></label><input name="confirm" required="required" type="password"/>
			</div>
			<div class="input-container submit-btn">
				<input name="submit" type="submit" value="Add User"/>
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
