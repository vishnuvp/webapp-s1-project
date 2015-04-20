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
?>
	<div class="backlinks"><a href="/m140163cs/olm">Back to dashboard</a></div>
<div class="form-container" id="issue-add-form-container">

<?php 
if(isset($_GET['bid']))
	$bid = @strip_tags($_GET['bid']);
if(!empty($bid)) {
	$book = search('b','book.bid = '.$bid)[0];
}
else {
	$book['status'] = '1';
}
if($_SERVER['REQUEST_METHOD'] == 'POST') {

	$admin = new Admin;
	$bid = substr(strip_tags($_POST['bid']), 5);
	$flag = $admin->issue_book($bid, strip_tags($_POST['uid'])); 
	
	echo set_status($flag['msg'],$flag['status']);
	

}
else {
	if($book['status'] == '1' || $book['status']=='3') {
?>

		<form name="issue-add-form" method="post" action="issue.php">
	
			<div class="input-container inline-label">
				<label for="name">Book ID</label>:<input readonly="readonly" name="bid" type="text" value="<?php echo $_CONF['book_prefix'].convert_4digits($bid); ?>"/>
			</div>
			<div class="input-container inline-label">
				<label for="name">User ID</label>:<input name="uid" type="text" />
			</div>
			<div class="input-container submit-btn">
				<input name="submit" type="submit" value="Issue"/>
			</div>
		</form>
<?php
	}
	else {
		if($book['status'] == '0') 
			echo set_status("Book ".$_CONF['book_prefix'].convert_4digits($bid)." ".$book['title']. " cannot be borrowed as it is temporarily unavailable.",'warning');
		else
			echo set_status("Book ".$_CONF['book_prefix'].convert_4digits($bid)." ".$book['title']. " cannot be borrowed as it is already borrowed by another user.",'warning');
	}
 }

?>
</div>
<div class="footer">
			<?php include('../includes/footer.inc'); ?>
	</div>	
</body>
</html>
