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
<div class="form-container" id="create-banner-container">
		<div class="page-title">Generate No Dues Certificate</div>

		<form name="create-banner-form" method="post" action="no_dues_report.php" target="_blank">
			<div class="input-container inline-label">
				<label for="info">Roll No</label>:
				<select name="roll_no">
				<?php
						$db_connection = new DBConnection;
        				$db_connection->connect();
        				$ids =  $db_connection->query('user','uid','type="Student"',null,null);
        				
        				$db_connection->disconnect();
        				foreach ($ids as $value) {
        					?>
        					<option value="<?php echo $value['uid']?>"><?php echo $value['uid']?></option>
        					<?php
             				}
					?>
				</select>
			</div>
			
			<div class="input-container submit-btn">
				<input name="submit" type="submit" value="Generate"/>
			</div>
		</form>
	</div>
<div class="footer">
			<?php include('../includes/footer.inc'); ?>
	</div>	
</body>
</html>
