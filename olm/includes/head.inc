<?php
require_once(__DIR__. "/../includes/session.inc");
if(!is_olm_session_active())
	{
	//	echo 'redirecting to home';
		header("Location:/m140163cs/olm/index.php");
	}
?>
<script src="/m140163cs/olm/scripts/jquery-1.11.1.min.js"></script>
<script src="/m140163cs/olm/scripts/script.js"></script>
<link rel="stylesheet" href="/m140163cs/olm/css/styles.css" />

