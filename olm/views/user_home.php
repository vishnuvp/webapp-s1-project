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
	<div class="Banner">
		<?php
		$dbconnection = new DBConnection;
		$dbconnection->connect();
		$banner_data = $dbconnection->get_banner(olm_session_get_role(), get_today());
		//print_r($banner_data);
		$dbconnection->disconnect();	
		if($banner_data) {
			echo '<div class="banner-title"> Dear '. olm_session_get_name().'</div>';
		foreach ($banner_data as $value) {

			echo '<div class="banner-list"><marquee>'.$value['message'].'</marquee></div>';
		}
	}

		?>
		</div>
	<div class="backlinks check-status-link">
		<a href="control/check_status.php?" class="">Check Status Of Your Transactions</a>
	</div>
	<div class="user-section col-3">
		<div class="user-section-title">Search books</div>
		<div class="user-section-body">
			<a href="/m140163cs/olm/control/user_search.php?by=title">
				<div class="user-sub-section">
				<div class="thumbnail searchby"><img src="/m140163cs/olm/assets/images/Books-1-icon.png" /></div>
				<div class="thumbnail-caption">Search by Title</div>
			</div></a>
			<a href="/m140163cs/olm/control/user_search.php?by=author">
			<div class="user-sub-section">
				<div class="thumbnail searchby"><img src="/m140163cs/olm/assets/images/author-icon.png" /></div>
				<div class="thumbnail-caption">Search by Author</div>
			</div>
			</a>
			<a href="/m140163cs/olm/control/user_search.php?by=category">
			<div class="user-sub-section">
				<div class="thumbnail searchby"><img src="/m140163cs/olm/assets/images/Books-2-icon.png" /></div>
				<div class="thumbnail-caption">Search by Category</div>
			</div>
			</a>
		</div>
	</div>

	
	<div class="backlinks check-status-link" style="margin-bottom: 50px;"><a href="/m140163cs/olm/control/change_pwd.php">Change Password</a></div>
	<div class="footer">
		<?php include('includes/footer.inc'); ?>
	</div>	
</body>
</html>
