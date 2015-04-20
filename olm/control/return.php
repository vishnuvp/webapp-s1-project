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
<div class="form-container" id="return-add-form-container">
<?php 
if(isset($_GET['bid']))
	$bid = strip_tags($_GET['bid']);

if($_SERVER['REQUEST_METHOD'] == 'POST') {

	$user = new Admin;
	$bid = substr(strip_tags($_POST['bid']), 5);
	$flag = $user->return_book($bid); 
	
	echo set_status($flag['msg'],$flag['status']);
	

}
else {
?>

		<form name="return-add-form" method="post" action="return.php">
	
			<div class="input-container inline-label">
				<label for="name">Book ID</label>:<input name="bid" type="text" value="<?php echo $_CONF['book_prefix'].convert_4digits($bid); ?>"/>
			</div>
			
			<div class="input-container submit-btn">
				<input name="submit" type="submit" value="Return"/>
			</div>
		</form>

<?php }

?>
</div>
<div class="footer">
			<?php include('../includes/footer.inc'); ?>
	</div>	
</body>
</html>
