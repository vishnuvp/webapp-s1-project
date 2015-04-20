<?php
require_once("../includes/session.inc");
if(!is_olm_session_active())
	{
	//	echo 'redirecting to home';
		header("Location:/m140163cs/olm/index.php");
	}
	if(olm_session_get_role() != 'Admin')
		header('Location: /m140163cs/olm/index.php');

if($_GET['q'] == 'add_user') {
	header("Location:user_add.php");
}

if($_GET['q'] == 'add_book') {
	header("Location:book_add.php");
}


if($_GET['q'] == 'manage_user') {
	header("Location:manage_user.php");

}

if($_GET['q'] == 'manage_book') {
	header("Location:manage_book.php");

}

if($_GET['q'] == 'banner') {
	header("Location:create_banner.php");

}
?>
