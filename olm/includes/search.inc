<?php
include_once('require_include.inc');

//type='u' or t='b'

//by='field' or b='field'

//query=''

function search($type, $query) {

$db_connection = new DBConnection;
$db_connection->connect();

if($type == 'b') {


	$result = $db_connection->join_query('book','book_status', 'book.bid,book.title,book.author,book.publisher,book.edition,book.subject,book.rack_no,book.category,book.comments,book_status.status', 'book.bid=book_status.bid',$query);
	//print_r($result);
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

	//$query = $field.' LIKE "%'.$query.'%"';

	$result = $db_connection->query('user', 'uid,name,email,phoneno,type', $query,null,null);
	return $result;

}

$db_connection->disconnect();

}
?>