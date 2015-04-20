<!DOCTYPE html>
<html>
<head>
	<?php
	//<head></head>
	include('includes/head.inc');
	?>
</head>
<body>
	<?php
	//<head></head>
	include('includes/header.inc');
	
	?>
	<div class="welcome-bar"><div class="welcome-msg">Welcome <?php echo olm_session_get_name(); ?></div></div>
	<div class="backlinks check-status-link">
		<a href="#" onclick="$('#header-search-box-id').focus();">Issue or Return Book</a>
	</div>
	<div class="admin-sections">
		<div class="admin-section">
			<div class="admin-section-title">User Management</div>
			<div class="admin-section-body">
				<ul>
					<a href="control/manage.php?q=add_user"><li>Add new user</li></a>
					<a href="control/manage.php?q=manage_user"><li>Manage existing users</li></a>
					<a href="control/manage.php?q=banner"><li>Post Banner</li></a>

				</ul>
			</div>
		</div>
		
		<div class="admin-section">
			<div class="admin-section-title">Books Management</div>
			<div class="admin-section-body">
				<ul>
					<a href="control/manage.php?q=add_book"><li>Add new book</li></a>
					<a href="control/manage.php?q=manage_book"><li>Manage books</li></a>
				</ul>
			</div>
		</div>
		<div class="admin-section">
			<div class="admin-section-title">Imports & Reports</div>
			<div class="admin-section-body">
				<ul>
					<a href="control/import.php"><li>Import from excel sheet</li></a>
					<a href="control/report.php"><li>Generate reports</li></a>
				</ul>
			</div>
		</div>
		
	</div>	
	<div class="backlinks check-status-link"><a href="/m140163cs/olm/control/change_pwd.php">Change Password</a></div>
	<div class="footer">
			<?php include('includes/footer.inc'); ?>
	</div>	
</body>
</html>
