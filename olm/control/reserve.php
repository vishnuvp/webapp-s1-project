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
?>
	<div class="backlinks"><a href="/m140163cs/olm">Back to dashboard</a></div>
<div class="form-container" id="reserve-add-form-container">

<?php 
if(isset($_GET['bid']))
{	$bid = strip_tags($_GET['bid']);
	
	$book = search('b','book.bid = '.$bid)[0];
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {

	$user = new User;
	$bid = substr(strip_tags($_POST['bid']), 5);
	$flag = $user->reserve_book($bid, strip_tags($_POST['uid'])); 
	
	echo set_status($flag['msg'],$flag['status']);
	

}
else {
	if($book['status'] == '1' || $book['status']=='2') {
?>

		<form name="reserve-add-form" method="post" action="reserve.php">
	
			<div class="input-container inline-label">
				<label for="name">Book ID</label>:<input name="bid" type="text" readonly="readonly" required="required" value="<?php echo $_CONF['book_prefix'].convert_4digits($_GET['bid']); ?>"/>
			</div>
			<div class="input-container inline-label">
				<label for="name">User ID</label>:<input name="uid" type="text" readonly="readonly" required="required" value="<?php echo olm_session_get_user(); ?>"/>
			</div>
			<div class="input-container submit-btn">
				<input name="submit" type="submit" value="Reserve"/>
			</div>
		</form>

<?php }

else {
		if($book['status'] == '0') 
			echo set_status("Book ".$_CONF['book_prefix'].convert_4digits($bid)." ".$book['title']. " cannot be reserved as it is temporarily unavailable.",'warning');
		else
			echo set_status("Book ".$_CONF['book_prefix'].convert_4digits($bid)." ".$book['title']. " cannot be reserved as it is already reserved by another user.",'warning');
}
}
?>
</div>
<div class="footer">
			<?php include('../includes/footer.inc'); ?>
	</div>	
</body>
</html>