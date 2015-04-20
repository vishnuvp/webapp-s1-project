<?php
require_once("db.class.inc");

function authenticate($user_name, $pwd) {


	$db_connection = new DBConnection;
	$db_connection->connect();
	$query = 'uid = "'.$user_name.'" AND password = "'.md5('salt'.trim($pwd)).'"';
	$result = $db_connection->limited_query('user', 'uid,name,type', $query,null,null,1);
	$db_connection->disconnect();
	if($result&&$result[0]['uid']==$user_name)
		return $result[0];
	return false;
}

function get_role($user_name) {
	$db_connection = new DBConnection;
	$db_connection->connect();
	$query = 'uid = "'.$user_name.'"';
	$result = $db_connection->limited_query('user', 'type', $query,null,null,1);
	$db_connection->disconnect();
	return $result[0]['type'];
}

?>