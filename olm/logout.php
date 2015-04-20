<?php
require_once("includes/session.inc");
if(is_olm_session_active()) {
olm_session_out();
}
header("Location:/m140163cs");
?>