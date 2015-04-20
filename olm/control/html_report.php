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
	if(olm_session_get_role() != 'Admin')
		header('Location: /m140163cs/olm/index.php');
	?>
	<div class="backlinks"><a href="/m140163cs/olm">Back to dashboard</a></div>

	<div class="report-container">
	<?php
		if($_GET['r']=='bs') { 
		echo '<div class="page-title">BOOK STATUS REPORT</div>';
		$data = search('b','1=1');
		if($data) {
		echo '<table class="edit-table">';
		echo '<thead><td>Book ID</td><td>Title</td><td>Status</td></thead>';
		foreach($data as $row)
	    {
	    	echo '<tr>';
	        echo '<td>CSED-'.convert_4digits($row['bid']).'</td>';
	        echo '<td>'.$row['title'].'</td>';
	        echo '<td>';
	        if($row['status'] == 0)
	            echo 'Temporarily Unavailable';
	        else if($row['status'] == 1)
	            echo 'On Shelf';
	        else if($row['status'] == 2)
	            echo 'On Loan';
	        else if($row['status'] == 3)
	            echo 'On Shelf Reserved';
	        else if($row['status'] == 4)
	            echo 'On Loan Reserved';
	        echo '</td></tr>';
	    }
	    echo'</table>';
	}
	else {
			echo set_status('No books found', 'warning');    	
	}
	}
	?>
	<?php
	if($_GET['r']=='ur') { 
		echo '<div class="page-title">USERS LIST</div>';
		$db_connection = new DBConnection;
		$db_connection->connect();
		$data = $db_connection->query('user', 'uid,name,email,type', null,null,null);
		//print_r($result);
		$db_connection->disconnect();
		if($data) {
		echo '<table class="edit-table">';
		echo '<thead><td>User ID</td><td>Name</td><td>Email</td><td>User Type</td></thead>';
		foreach($data as $row)
	    {
	    	echo '<tr>';
	        echo '<td>'.$row['uid'].'</td>';
	        echo '<td>'.$row['name'].'</td>';
	        echo '<td>'.$row['email'].'</td>';
	        echo '<td>'.$row['type'].'</td>';
	        echo '</tr>';
	    }
	    echo'</table>';
	}
	else {
			echo set_status('No user accounts found', 'warning');
    		exit();
    	
	}
	}
	?>
	<?php
	if($_GET['r']=='or') { 
		echo '<div class="page-title">OVERDUE REPORT</div>';
		$db_connection = new DBConnection;
		$db_connection->connect();
		$result = $db_connection->dquery('SELECT book.bid, book.title, issue.return_date, issue.issue_date,user.uid,user.name FROM book,issue,user where (book.bid=issue.bid AND user.uid=issue.uid AND issue.return_date<CURRENT_DATE())');

			$data = array();
			$i = 0;
			if(!$result) {
	    	
			while($row = mysql_fetch_assoc($result)) {
	    		$data[$i++] = $row;
			}
			if($data) {
			echo '<table class="edit-table">';
			echo '<thead><td>User ID</td><td>Name</td><td>Email</td><td>User Type</td></thead>';
			foreach($data as $row) {
		    	echo '<tr>';
		        echo '<td>'.$row['bid'].'</td>';
		        echo '<td>'.$row['name'].'</td>';
		        echo '<td>'.$row['email'].'</td>';
		        echo '<td>'.$row['type'].'</td>';
		        echo '</tr>';
		    }
		    echo'</table>';
		}
		else {
				echo set_status('No overdue records', 'warning');
    		exit();
    	
		}
	}
	else {
			echo set_status('No overdue records', 'warning');
    		exit();
    	
	}
	}
	?>
	</div>
	
	<div class="footer">
		<?php include('../includes/footer.inc'); ?>
	</div>	
</body>
</html>
