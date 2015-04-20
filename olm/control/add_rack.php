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
	// to do: form authentication using random string; store in form and session variable
	if(olm_session_get_role() != 'Admin')
		header('Location: /m140163cs/olm/index.php');
	?>
	<div class="backlinks"><a href="/m140163cs/olm">Back to dashboard</a></div>

		<?php
		$post_flag = false;
		$empty_flag = false;
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			if (empty($_POST['rack'])) {
					$empty_flag = true;
			}
		}
		if($_SERVER['REQUEST_METHOD'] == 'POST' && (!$empty_flag)) {

			$new_cat = $_POST['rack'];
			$db_connection = new DBConnection;
        	$db_connection->connect();

			if($db_connection->insert_values('rack_no', array("rack_no"), array('"'.$new_cat.'"')))
			 {

				?>
			<div class="result-container">
				<div class="result-title">New Rack<span style="float:right;margin-right:1em"><a href="add_rack.php" title="Add another rack"><i class="plus-book-sign"></i></a></span></div>
				<div class="result-body">
				<?php	
							echo set_status('Rack: '.$new_cat. ' added!', 'info'); 
				?>
				</div>
			</div>			
				<?php
				}
			else {
				echo '<div class="result-container"><div class="result-title">New Rack<span style="float:right;margin-right:1em"><a href="add_rack.php" title="Add another rack"><i class="plus-book-sign"></i></a></span></div><div class="result-body">';
				echo set_status('Rack exists.', 'error'); 
				
				echo '</div></div>';
			}
		$db_connection->disconnect();
		}	

		else {
			
?>
	<div class="form-container" id="book-add-form-container">
			<div class="form-title">Add new rack<span style="float:right;margin-right:1em"><a href="add_rack.php" title="Add another rack"><i class="plus-book-sign"></i></a></span></div>
			
			<form name="rack-add-form" method="post" action="add_rack.php">
			
			<?php
			if($empty_flag)
				echo set_status('Please fill in all mandatory fields marked in <span style="color:white">*</span>', "error");
			?>
			<div class="input-container block">
				<label for="name">Rack<sup><span class="req-mark">*</span></sup></label><input name="rack" required="required" type="text" value="<?php echo $post_flag?$_POST['rack']:'' ?>"/>
			</div>
			
			<div class="input-container submit-btn">
				<input name="submit" type="submit" value="Add Rack"/>
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
