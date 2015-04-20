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
	//<head></head>
	include('../includes/header.inc');
	// to do: form authentication using random string; store in form and session variable
	if(olm_session_get_role() != 'Admin')
		header('Location: /m140163cs/olm/index.php');
	?>
	<div class="backlinks"><a href="/m140163cs/olm">Back to dashboard</a></div>

		<?php
		$post_flag = false;
		$empty_flag = false;
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			if (empty($_POST['title']) || empty($_POST['author']) || empty($_POST['edition'])) {
					$empty_flag = true;
			}
		}
		if($_SERVER['REQUEST_METHOD'] == 'POST' && (!$empty_flag)) {
			$post_flag = true;
			$copy_flag = false;

		//do form validation, input sanitization
			$array = array();
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
			$book = $admin->add_book($array);
		if(is_numeric($_POST['copies'])&&$_POST['copies'] > 1) {
			for($i=1;$i<$_POST['copies'];$i++)	{
				$book = $admin->add_book($array);
				$copy_flag = $i;
				if(!$book) {
					break;
				}
			}
		}
			if($book) {

				?>
			<div class="result-container">
				<div class="result-title">New Book<span style="float:right;margin-right:1em"><a href="book_add.php" title="Add another book"><i class="plus-book-sign"></i></a></span></div>
				<div class="result-body">
				<?php	if($copy_flag) {
					
							echo set_status(($copy_flag+1).' copies of '.$book->get_title().' Added!. ', 'info');
						}
						else 
							echo set_status('CSED'.convert_4digits($book->get_bid()) . ' '.$book->get_title().' Added!. ', 'info'); ?>
				
				<div class="input-container block">
					<label for="name">Title: <?php echo $_POST['title'] ?> </label>
				</div>
				<div class="input-container block">
					<label for="name">Author: <?php echo $_POST['author'] ?> </label>
				</div>
				<div class="input-container block">
					<label for="name">Publisher: <?php echo $_POST['publisher'] ?> </label>
				</div>
				<div class="input-container block">
					<label for="name">Edition: <?php echo $_POST['edition'] ?> </label>
				</div>
				<div class="input-container block">
					<label for="name">Subject: <?php echo $_POST['subject'] ?></label>
				</div>
				<div class="input-container block">
					<label for="name">Rack No: <?php echo $_POST['rack_no'] ?> </label>
				</div>
				<div class="input-container block">
					<label for="name">Category: <?php echo $_POST['category'] ?> </label>
				</div>
				<div class="input-container block">
					<label for="name">Comments: <?php echo $_POST['comments'] ?> </label>
				</div>
				<div class="input-container block">
					<label for="name">Status: <?php if($_POST['status']==1) echo 'On shelf'; else if($_POST['status']==0) echo 'Temporarily Unavailable';  ?> </label>
				</div>
			</div>
	</div>			
				<?php
				}
			else {
				echo '<div class="result-container"><div class="result-title">New Book</div><div class="result-body">';
				if($copy_flag) {
					echo set_status('Created'.($copy_flag+1).' copies.Further book creation failed. Please try again.', 'error'); 
				}
				else {
				echo set_status('Book creation failed. Please try again.', 'error'); 
				}
				echo '</div></div></div>';
			}
		}	
		else {
			
?>
	<div class="form-container" id="book-add-form-container">
			<div class="form-title">Add new book<span style="float:right;margin-right:1em"><a href="book_add.php" title="Add another book"><i class="plus-book-sign"></i></a></span></div>
			
			<form name="book-add-form" method="post" action="i_add_book.php">
			
			<?php
			if($empty_flag)
				echo set_status('Please fill in all mandatory fields marked in <span style="color:white">*</span>', "error");
			?>
			<div class="input-container block">
				<label for="name">Title<sup><span class="req-mark">*</span></sup></label><input name="title" required="required" type="text" value="<?php echo $post_flag?$_POST['title']:'' ?>"/>
			</div>
			<div class="input-container block">
				<label for="author">Author<sup><span class="req-mark">*</span></sup></label><input name="author" required="required" type="text" value="<?php echo $post_flag?$_POST['author']:'' ?>"/>
			</div>
			<div class="input-container block">
				<label for="publisher">Publisher</label><input name="publisher" type="text" value="<?php echo $post_flag?$_POST['publisher']:'' ?>"/>
			</div>
			<div class="input-container block">
				<label for="edition">Edition<sup><span class="req-mark">*</span></sup></label><input name="edition" required="required" type="text" value="<?php echo $post_flag?$_POST['edition']:'' ?>"/>
			</div>
			<div class="input-container block">
				<label for="subject">Subject</label><input name="subject" type="text" value="<?php echo $post_flag?$_POST['subject']:'' ?>"/>
			</div>
			<div class="input-container block">
				<label for="rack_no">Rack No</label>
				<select name="rack_no">
					<?php
						$db_connection = new DBConnection;
        				$db_connection->connect();
        				$racks =  $db_connection->query('rack_no','rack_no',null,null,null);
        				$cats = $db_connection->query('category','category_name',null,null,null);
        				//print_r($racks);
        				//print_r($cats);
        				$db_connection->disconnect();
        				foreach ($racks as $value) {
        					?>
        					<option value="<?php $value['rack_no']?>"><?php echo $value['rack_no']?></option>
        					<?php
             				}
					?>
				</select>

				<!--input name="rack_no" type="text"/ -->
			</div>
			<div class="input-container block">
				<label for="category">Category</label>
				<select name="rack_no">
					<?php
						
        				foreach ($cats as $value) {
        					?>
        					<option value="<?php $value['category_name']?>"><?php echo $value['category_name']?></option>
        					<?php
             				}
					?>
				</select>
			</div>
			<div class="input-container block">
				<label for="comments">Comments</label>
				<textarea name="comments" type="text"><?php echo $post_flag?$_POST['comments']:'' ?></textarea>
			</div>
			<div class="input-container block">
				<label for="status">Status<sup><span class="req-mark">*</span></sup></label>
				<select name="status" value="<?php  echo $post_flag?$_POST['status']:'' ?>">
					<option value="1">On Shelf</option>
					<option value="0">Temporarily Unavailable</option>
				</select>
			</div>
			<div class="input-container block">
				<label for="comments">No of copies</label>
				<input name="copies" type="number" value="<?php echo $post_flag?$_POST['copies']:'0'  ?>"/>
			</div>
			<div class="input-container submit-btn">
				<input name="submit" type="submit" value="Add Book"/>
			</div>
		</form>
	</div>
	<?php
	}
?>
<div class="footer">
			<?php include('../includes/footer.inc'); ?>
	</div>	
</body>
</html>
