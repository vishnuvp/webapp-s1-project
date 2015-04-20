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
//type='u' or t='b'

//by='field' or b='field'

//query=''
$db_connection = new DBConnection;
$db_connection->connect();
if(isset($_GET['t'])) {
	$type = trim($_GET['t']);
}
if(isset($_GET['f'])) {
		$field = trim($_GET['f']);
}
if(isset($_GET['q'])) {
		$query = trim($_GET['q']);

}
else {
	page_not_found();
}
if($type == 'b') {

	if($field == 'bid') {
		$query = $field.'='.$query;
	}
	else {
				$query = $field.' LIKE "%'.$query .'%"';

	}
	$result = $db_connection->query('book', 'bid,title,edition', $query,null,null);
	return $result;
	/*Move code to search_listing.php*/
	/*if(!$result) {
		echo '<div class="search-miss">Your search returned 0 results. Try using alternate search terms or start a new search</div>';
	}
	else {
	foreach($result as $value) {
		echo '<div class="result-container">';
		echo '<div class="resulr-row">'.'CSED'.convert_4digits($value['bid']).'   '.$value['title'].'</div>';
		echo '<div class="resulr-row"> Edition:'.$value['edition'].'</div>';
		echo '</div>';
		}
	}*/

}


if($type == 'u') {

//	if($field == 'uid') {
//		$query = $field.'='.$query;
//	}
//	else {
				$query = $field.' LIKE "%'.$query.'%"';

//	}
	$result = $db_connection->query('user', 'uid,name,email,phoneno,type', $query,null,null);

	/*
	if(!$result) {
		echo '<div class="search-miss">Your search returned 0 results. Try using alternate search terms or start a new search</div>';
	}
	else {
	foreach($result as $value) {
		echo '<div class="result-container">';
		echo '<div class="resulr-row">'.$value['uid'].'   '.$value['name'].'</div>';
		echo '<div class="resulr-row">';
		if($value['type'] == 1)
			echo 'Faculty';
		else if($value['type'] == 2)
			echo 'Student';
		else if ($value['type'] == 0) {
			echo 'Administrator';
		}
		echo '</div>';
		echo '<div class="resulr-row"> Email:'.$value['email'].'</div>';
		echo '<div class="resulr-row"> Phone No:'.$value['phoneno'].'</div>';
		echo '</div>';
		}
	}*/

}

$db_connection->disconnect();
?>
<div class="footer">
			<?php include('../includes/footer.inc'); ?>
	</div>	

</body>
</html>
