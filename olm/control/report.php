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

	<div class="user-section col-3">
		<div class="user-section-title">Reports</div>
		<div class="user-section-body">
			<a href="/m140163cs/olm/control/user_report.php" target="_blank">
				<div class="user-sub-section">
				<div class="thumbnail searchby"><img src="/m140163cs/olm/assets/images/pdf_icon.png" /></div>
				<div class="thumbnail-caption">User List</div>
			</a>
				<div class="thumbnail-caption"><a href="html_report.php?r=ur">View as HTML</a></div>
			</div>
			<a href="/m140163cs/olm/control/book_report.php" target="_blank">
			<div class="user-sub-section">
				<div class="thumbnail searchby"><img src="/m140163cs/olm/assets/images/pdf_icon.png" /></div>
				<div class="thumbnail-caption">Books Status Report</div>
			</a>
				<div class="thumbnail-caption"><a href="html_report.php?r=bs">View as HTML</a></div>
			</div>

			<a href="/m140163cs/olm/control/overdue_report.php" target="_blank">
			<div class="user-sub-section">
				<div class="thumbnail searchby"><img src="/m140163cs/olm/assets/images/pdf_icon.png" /></div>
				<div class="thumbnail-caption">Overdue Report</div>
			</a>
				<div class="thumbnail-caption"><a href="html_report.php?r=or">View as HTML</a></div>
			</div>

		</div>
	</div>

	
	<div class="footer">
		<?php include('../includes/footer.inc'); ?>
	</div>	
</body>
</html>
