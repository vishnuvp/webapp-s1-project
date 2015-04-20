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
?>
	<div class="backlinks"><a href="/m140163cs/olm">Back to dashboard</a></div>
<?php
	
	$user = olm_session_get_user();
	$db_connection = new DBConnection;
	$db_connection->connect();
	$notes = $db_connection->get_notifications($user);
	$db_connection->disconnect();
	?>
	<div class="user-section">
		<?php
					//print_r($notes);
		if(!empty($notes['notification'])) {
		?> 
		<div class="user-sub-section notification-section">
			<div class="user-section-title">Notifications</div>
			<div class="user-section-body">
				<ul>
		<?php					
				foreach ($notes['notification'] as $key => $value) {
						echo '<li>'.$value.'</li>';
				}
				?>
				</ul>
			</div>
		</div>
		<?php } ?>
		<div class="user-sub-section">
			<div class="user-section-title">Due Dates</div>
			<div class="user-section-body">
				<ul>
					<?php
					//print_r($notes);
					if(empty($notes['due']))
						echo '<li>No issue records found</li>';
					else {
						foreach ($notes['due'] as $key => $value) {
							echo '<li>'.$value.'</li>';
						}
					}
					?>
				</ul>
			</div>
			
		</div>
		<div class="user-sub-section">
			<div class="user-section-title">Reservation status</div>
			<div class="user-section-body">
				<ul>
					<?php
					if(empty($notes['resv']))
						echo '<li>No reservation records found</li>';
					else {
						foreach ($notes['resv'] as $key => $value) {
							echo '<li>'.$value.'</li>';
						}
					}
					?>
				</ul>
			</div>
			
		</div>


		<div class="user-sub-section">
			<div class="user-section-title">Fine Paid</div>
			<div class="user-section-body">
				<div class"user-subsub-section">
					<div class="user-fine">
					<?php
						echo '<div class="centered fine">Rs.'.$notes['fine'].'</div>';
					?>
				</div>

				</div>
			</div>
			
		</div>

	</div>

	
	<div class="footer">
		<?php include('../includes/footer.inc'); ?>
	</div>	
</body>
</html>
