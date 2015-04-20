<!DOCTYPE html>
<html>
<head>
	<?php
	//<head></head>
	include('../includes/head.inc');
	?>
	<script>
	$(document).ready(function(){
		$("#chooser").change(function() {
			$(".hider").hide();
			$("#" + $(this).val()).fadeIn();

		});

	});
	</script>
</head>
<body>
<?php

include('../includes/header.inc');
	if(olm_session_get_role() != 'Admin')
		header('Location: /m140163cs/olm/index.php');
?>
<div class="backlinks"><a href="/m140163cs/olm">Back to dashboard</a></div>
<div class="form-container" id="create-banner-container">
		<div class="page-title">Generate Report</div>

		<form name="create-banner-form" method="post" action="advanced_report.php" target="_blank">
			<div class="input-container inline-label">
				<label for="info">Choose Report</label>:
				<select name="report_type" id="chooser">
					<option value="1">Student</option>
					<option value="2">Faculty</option>
				</select>
			</div>
			<div class="input-container inline-label hider" id="1">
				<label for="info">Choose Semester</label>:
				<select name="s_info">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
			</div>
			<div class="input-container inline-label hider" id="2" style="display:none;">
				<label for="info">Choose Faculty Type</label>:
				<select name="f_info">
					<option value="Adhoc">Adhoc </option>
					<option value="Permanent">Permanent</option>
				</select>
			</div>
			<div class="input-container submit-btn">
				<input name="submit" type="submit" value="Post"/>
			</div>
		</form>
	</div>
<div class="footer">
			<?php include('../includes/footer.inc'); ?>
	</div>	
</body>
</html>
