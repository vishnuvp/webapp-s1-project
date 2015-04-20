<?php
include_once('../includes/require_include.inc');
	if(olm_session_get_role() != 'Admin')
		header('Location: /m140163cs/olm/index.php');
if($_GET['t'] == 'b') {
	$array = array();
	$array['bid'] = substr($_POST['bid'], 5);
	if($_GET['a'] == 'm') {
		$array['title'] = $_POST['title'];
		$array['author'] = $_POST['author'];
		$array['publisher'] = $_POST['publisher'];
		$array['edition'] = $_POST['edition']; 
		$array['subject'] = $_POST['subject'];
		$array['rack_no'] = $_POST['rack_no'];
		$array['category'] = $_POST['category'];
		$array['comments'] = $_POST['comments'];
		$array['status'] = $_POST['status']; //validate; if possible change ids in select box and replace with ids here
			
		$admin = new Admin or die("unable to create admin object");
		$book = $admin->modify_book($array);
		if($book) 
			echo 'success';
		else
			echo 'fail';
	}
	elseif ($_GET['a'] == 'd') {
		$admin = new Admin or die("unable to create admin object");
		$book = $admin->delete_book($array);
		if($book) 
			echo 'success';
		else
			echo 'fail';
	}
}

else if($_GET['t'] == 'u') {
	$array = array();
	$array['uid'] = $_POST['uid'];
	
	
		
	$admin = new Admin or die("unable to create admin object");
	
	if($_GET['a'] == 'm') {
		$array['name'] = $_POST['name'];
		$array['email'] = $_POST['email'];
		$array['phoneno'] = $_POST['phoneno'];
		$array['password'] = $_POST['password']; 
		$array['type'] = $_POST['type'];
		$user = $admin->modify_user($array);
	}
	else if($_GET['a'] == 'd') {
		$user = $admin->delete_user($array);

	}
	if($user) 
		return 'success';
	else
		return 'fail';
}
?>
