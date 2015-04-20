<?php
require_once("includes/session.inc");
require_once("includes/db.class.inc");
require_once("includes/utilities.inc");

$string = file_get_contents('tmp/date');
$today = get_today();
if(empty($string))
	$string = "1970-01-01";
$date2 = $string;
if($today!=$date2)
{
	$dbconnection = new DBConnection;
	$dbconnection->connect();
	$rows = $dbconnection->query('reserve','uid,bid,end_date','end_date <"'.$today.'"',null,null);

	foreach ($rows as $value) {
		$dbconnection->notify_user('"'.$value['uid'].'"','"'.$today.'"','"Reservation on book CSED-'.convert_4digits($value['bid']).' has expired."');
		$dbconnection->transaction_archive('reserve',"reserve_id,bid,uid,reserve_date,end_date","bid=".$value['bid']." AND uid='".$value['uid']."'");
	}
		$dbconnection->disconnect();

	$file = fopen('tmp/date', 'w');
	fwrite($file, $today);
	fclose($file);
}

if(is_olm_session_active()) {

	$role = olm_session_get_role();

	if($role=='Admin') {
		include("views/admin_home.php");
	}
	else {
		include("views/user_home.php");
	}

		 
}

else {
	header("Location: index.php");
}
?>