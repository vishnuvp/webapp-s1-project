<?php
include_once('../includes/require_include.inc');

$db_connection = new DBConnection;
$db_connection->connect();

if(isset($_GET['f'])) {
		$field = trim($_GET['f']);
}
if(isset($_GET['q'])) {
		$query = trim($_GET['q']);

}
else {
	echo '<div class="search-miss">Your search returned 0 results. Try using alternate search terms or start a new search</div>';
	$db_connection->disconnect();
	exit();
}
	if($field == 'bid') {
		$query = $field.'='.substr($query, 5);

	}
	else {
				$query = $field.' LIKE "%'.$query .'%"';

	}
	$result = $db_connection->limited_query('book', 'bid,title,edition', $query,null,null,8);
	if(!$result) {
		echo '<div class="search-miss">Your search returned 0 results. Try using alternate search terms or start a new search</div>';
	}
	else {
		echo '<table class="ajax-search-listing"><tr>';
		$ctr = 0;
		
		
	foreach($result as $value) {
		if($ctr%2==0 && $ctr!=0)
			echo '</tr><tr>';
		echo '<td class="ajax-search-list-item">';
		echo '<div class="result-row">'.'CSED-'.convert_4digits($value['bid']).'   '.$value['title'].'</div>';
		echo '<div class="result-row"> Edition '.$value['edition'].'</div>';
		if(olm_session_get_role() == 'Admin') {
			echo '<div class="result-row">
				<a class="ir-class" href="/m140163cs/olm/control/issue.php?bid='.$value['bid'].'">Issue</a> | 
				<a class="ir-class" href="/m140163cs/olm/control/return.php?bid='.$value['bid'].'">Return</a> |
				</div>';
		}
		else {
			echo '<div class="result-row">
				<a class="ir-class" href="/m140163cs/olm/control/reserve.php?bid='.$value['bid'].'">Reserve</a>
				</div>';
		}
		echo '</td>';

		$ctr++;

		}
	}
	echo '</tr></table>';
	echo '<div style="margin:0 auto;width:0"><a class="button" id="search-result-close-btn" onclick="$(\'#header-search-listing-id\').slideUp(\'slow\');" href="#">Close</a></div>';

$db_connection->disconnect();
?>