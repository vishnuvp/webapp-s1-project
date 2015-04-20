<?php

include_once('../includes/require_include.inc');
require_once('../includes/search.inc');
if(isset($_GET['t'])&&isset($_GET['f'])&&isset($_GET['q'])) {
	if($_GET['t'] == 'u') {
		$query = $_GET['f'].' LIKE "%'.$_GET['q'].'%" AND type!="Admin"';
		$result_array = search('u',$query);
		echo '<table class="edit-table" id="user-edit-table-id"><thead><td>User ID</td><td>Name</td><td>Email</td><td>Phone No</td><td>Type</td><td colspan="2">Manage</td></thead>';
		foreach ($result_array as $value) {
			echo '<tr id="'.$value['uid'].'">';
			echo '<td class="uid">'.$value['uid'].'</td>';
			echo '<td class="name">'.$value['name'].'</td>';
			echo '<td class="email">'.$value['email'].'</td>';
			echo '<td class="phoneno">'.$value['phoneno'].'</td>';
			echo '<td class="type">'.$value['type'].'</td>';
			echo '<td><a href="#" class="inline-manage-links edit-user-link" id="edit-'.$value['uid'].'">Edit</a> | ';
			echo '<a href="#" class="inline-manage-links delete-user-link" id="delete-'.$value['uid'].'">Delete</a></td>';
			echo '</tr>';
			}	
	}
	if($_GET['t'] == 'b') {
		if($_GET['f'] == 'bid')
			$query = 'book.'.$_GET['f'].' = '.substr($_GET['q'],5);
		else 	
			$query = $_GET['f'].' LIKE "%'.$_GET['q'].'%"';
		$result_array = search('b',$query);
		echo '<table class="edit-table" id="book-edit-table-id"><thead><td>Book ID</td><td>Title</td><td>Author</td><td>Edition</td><td>Publisher</td><td>Subject</td><td>Rack No</td><td>Category</td><td>Comments</td><td>Status</td><td colspan="2">Manage</td></thead>';
		$status_array = array('TU','TEMPORARILY UNAVAILABLE','OS','ON SHELF','OL','ON LOAN','OSR','ON SHELF RESERVED','OLR', 'ON LOAN RESERVED');
		if($result_array) {
		foreach ($result_array as $value) {
			echo '<tr id="'.$value['bid'].'">';
			echo '<td class="bid">CSED-'.convert_4digits($value['bid']).'</td>';
			echo '<td class="title" style="width:2em;">'.$value['title'].'</td>';
			echo '<td class="author">'.$value['author'].'</td>';
			echo '<td class="edition">'.$value['edition'].'</td>';
			echo '<td class="publisher">'.$value['publisher'].'</td>';
			echo '<td class="subject">'.$value['subject'].'</td>';
			echo '<td class="rackno">'.$value['rack_no'].'</td>';
			echo '<td class="category">'.$value['category'].'</td>';
			echo '<td class="comments" style="overflow:scroll">'.$value['comments'].'</td>';
			echo '<td class="status"><span title="'.$status_array[$value['status']*2 + 1].'">'.$status_array[$value['status']*2].'</span></td>';
			echo '<td><a href="#" class="inline-manage-links edit-book-link" id="edit-'.$value['bid'].'">Edit</a> | ';
			echo '<a href="#" class="inline-manage-links delete-book-link" id="delete-'.$value['bid'].'">Delete</a></td>';
			echo '</tr>';
			}	
		}
	}
		
}
 

?>
