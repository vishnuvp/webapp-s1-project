<!DOCTYPE html>
<html>
<head>
	<?php
	//<head></head>
	include('../includes/head.inc');
	?>
<style>
input, select {
font-size: 1.2em;
}
</style>
</head>
<body>
<?php
include('../includes/header.inc');
?>
	<div class="backlinks"><a href="/m140163cs/olm">Back to dashboard</a></div>
<div class="user-section col-3">
		<div class="user-section-title">Search books</div>
		<div class="user-section-body">
			<a href="/m140163cs/olm/control/user_search.php?by=title">
				<div class="user-sub-section">
				<div class="thumbnail searchby"><img src="/m140163cs/olm/assets/images/Books-1-icon.png" /></div>
				<div class="thumbnail-caption">Search by Title</div>
			</div></a>
			<a href="/m140163cs/olm/control/user_search.php?by=author">
			<div class="user-sub-section">
				<div class="thumbnail searchby"><img src="/m140163cs/olm/assets/images/author-icon.png" /></div>
				<div class="thumbnail-caption">Search by Author</div>
			</div>
			</a>
			<a href="/m140163cs/olm/control/user_search.php?by=category">
			<div class="user-sub-section">
				<div class="thumbnail searchby"><img src="/m140163cs/olm/assets/images/Books-2-icon.png" /></div>
				<div class="thumbnail-caption">Search by Category</div>
			</div>
			</a>
		</div>
	</div>

<?php if(isset($_GET['by']) && $_GET['by']=='title') {?>
<div class="page-title">Search by Title</div>
<div class="search-section" id="by-title">
	<form method="get" action="user_search.php">
		<input type="text" placeholder="Search by title" name="title"/>
		<input type="submit" value="Submit" />
	</form>
</div>

<?php
}
if(isset($_GET['by']) && $_GET['by']=='category') { ?>
<div class="search-section" id="bycategory">
	<form method="get" action="user_search.php">
		<select name="category">
			<?php
			$dbcon = new DBConnection;
			$dbcon->connect();
			$categories=$dbcon->query('book','DISTINCT category');
			$dbcon->disconnect();
			foreach ($categories as $value) {
				echo '<option value="'.$value['category'].'">'.$value['category'].'</option>';
			}
			?>
		</select>
		<input type="submit" value="Submit" />
	</form>
</div>
<?php 
}
if(isset($_GET['by']) && $_GET['by']=='author') {
?>

<div class="search-section" id="byauthor">
	<form method="get" action="user_search.php">
		<select name="author">
			<?php
			$dbcon = new DBConnection;
			$dbcon->connect();
			$categories=$dbcon->query('book','DISTINCT author');
			$dbcon->disconnect();
			foreach ($categories as $value) {
				echo '<option value="'.$value['author'].'">'.$value['author'].'</option>';
			}
			?>
		</select>
		<input type="submit" value="Submit" />
	</form>
</div>
<?php } ?>
<div class="search-list" id="searchlisting">
	<?php
	if(isset($_GET['title']) || isset($_GET['author'])||isset($_GET['category'])) {
		$db_connection = new DBConnection;
		$db_connection->connect();
		$cols = 'book.bid,book.title,book.edition,book.author,book.publisher,book.rack_no,book.subject,book.category,book_status.status'; 	
		$on = 'book.bid=book_status.bid';
		$where = '';

		if(isset($_GET['title'])) {
			$where = 'title LIKE "%'.$_GET['title'].'%"';
		}
		else if (isset($_GET['author'])) {
			$where = 'author LIKE "%'.$_GET['author'].'%"';
		}
		else if (isset($_GET['category'])) {
			$where = 'category LIKE "%'.$_GET['category'].'%"';
		}

		$result = $db_connection->join_query('book','book_status',$cols,$on,$where);
		if($result) {
		echo '<table class="user-search-listing"><tr>';
		$ctr = 0;
	foreach($result as $value) {
		if($ctr%2==0 && $ctr!=0)
			echo '</tr><tr>';
		echo '<td class="user-search-list-item">';
		echo '<div class="result-row">'.'CSED-'.convert_4digits($value['bid']).'   '.$value['title'].'</div>';
		echo '<div class="result-row">Author:'.$value['author'].'</div>';
		echo '<div class="result-row">Edition: '.$value['edition'].'</div>';
		echo '<div class="result-row">Publisher: '.$value['publisher'].'</div>';
		echo '<div class="result-row">Category: '.$value['category'].'</div>';
		echo '<div class="result-row">Subject : '.$value['subject'].'</div>';
		echo '<div class="result-row">Rack: '.$value['rack_no'].'</div>';
		if($value['status'] == 2 || $value['status'] == 1){
		echo '<div class="result-row">
			<a href="/m140163cs/olm/control/reserve.php?bid='.$value['bid'].'">Reserve</a></div>';
		}
		else {
		echo '<div class="result-row">Reservation unavailable</div>';
		}

		echo '</td>';

		$ctr++;

		}
		echo '</tr></table>';
	}
	else {
				echo '<div class="search-miss">Your search returned 0 results. Try using alternate search terms or start a new search</div>';
	}

	
	}
	
	?>
</div>
<div class="footer">
		<?php include('../includes/footer.inc'); ?>
</div>
</body>
</html>
