<?php

function set_status($msg, $flag='info') {

	return '<div class="message '.$flag.'">'.$msg.'</div>';
}

function convert_4digits($num) {
	$ctr = 0;
	$str = "";
	while($ctr < 4) {

		$str = $num%10 . $str;
		$num /= 10;
		$ctr++;
	}

	return $str;

}

function get_today() {
	return date('Y-m-d');
}

function add_days($date, $days) {
	$date=date_create($date);
	date_add($date,date_interval_create_from_date_string($days." days"));
	return date_format($date,"Y-m-d");
}

function get_date_diff($from_date,$to_date) {
	$diff = date_diff(date_create($to_date),date_create($from_date));
	
	if($diff->invert > 0)
		return $diff->days*-1;
	return $diff->days;
}
function page_not_found() {

	header("Location:/m140163cs/olm/404.php");
}

function days_first_run() {
	
}

function check_input($data) {

	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>