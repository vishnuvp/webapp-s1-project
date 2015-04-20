<!DOCTYPE html>
<html>
<head>
	<?php
	//<head></head>
	include('../includes/head.inc');
	?>
	<script>
	function toggleHelpTable() {
		$('.format-help-table').fadeOut('fast',function(){
			$('#fht-' + $('#imp-chooser').val()).fadeIn();
	});
}
		
	</script>
</head>
<body>
<?php
include '../Classes/PHPExcel/IOFactory.php';
include('../includes/header.inc');
	if(olm_session_get_role() != 'Admin')
		header('Location: /m140163cs/olm/index.php');
?>
<div class="backlinks"><a href="/m140163cs/olm">Back to dashboard</a></div>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	echo '<div class="result-container">';
	//print_r($_FILES);
	if($_FILES['file']['type'] != 'application/vnd.oasis.opendocument.spreadsheet' && $_FILES['file']['type'] != 'application/vnd.ms-excel') {
		echo set_status("Invalid file format. Please upload a xls or ods file.", "error");
		//exit;
	}
	else {
			move_uploaded_file($_FILES['file']['tmp_name'],$_FILES['file']['name']);
			$inputFileName = $_FILES['file']['name'];
			$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
			$sheet_data = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			echo '<div style="color:#005387">Importing..</div>';
			unlink($inputFileName);
			foreach ($sheet_data as $key => $value) {
				
				
				if($key > 1) {
					if($_POST['type'] == 'u') {
					$array = array();
					$array['uid'] = $value['A'];
					$array['name'] = $value['B'];
					if(!filter_var($value['C'], FILTER_VALIDATE_EMAIL)) {
						echo set_status('Invalid Email ID.','error');
						continue;
					}					
					else
						$array['email'] = $value['C'];
					
					$array['phoneno'] = $value['E'];
					$array['type'] = $value['F']; 
					$array['password'] = md5('salt'.trim($value['D']));
					$admin = new Admin or die("unable to create admin object");
					if (trim($array['type']) == 'Admin') {
						$flag = $admin->add_admin($array);
					}
					else if(trim($array['type']) == 'Student' || trim($array['type']) == 'Faculty' ){
						$flag = $admin->add_user($array);
					}	
					else {
						echo set_status('Invalid User Type','error');
					}
					if($flag) {
						echo set_status('User Added! '.$array['uid'].' '.$array['name'], 'info');
					}
					else {
						echo set_status('Duplicate User: User registration failed.','error');
					}
				}
					else if($_POST['type'] == 'b') {
					//	print_r($value);
					$array = array();
					$array['title'] = $value['A'];
					$array['author'] = $value['B'];
					$array['publisher'] = $value['C'];
					$array['edition'] = $value['D']; 
					$array['subject'] = $value['E'];
					$array['rack_no'] = $value['F'];
					$array['category'] = $value['G'];
					$array['comments'] = $value['H'];
					if($value['I'] == 'On Shelf') {
						$array['status'] = 1;
					}
					else if($value['I'] == 'Unavailable') {
						$array['status'] = 0;
					}
					
					else {
						echo set_status("Invalid status flag. Specify either <i>Unavailable</i> or <i>On Shelf</i>", "error");
						continue;
					}
					// print_r($array);
						
					$admin = new Admin or die("unable to create admin object");
					$book = $admin->add_book($array);

					if($book) {
						echo set_status($_CONF['book_prefix'].convert_4digits($book->get_bid()) . ' '.$book->get_title().' Added!. ', 'info');
					
					}
					else {
						echo set_status('Failed to add book. Please try again','error');

					}
						
				}
				flush_buff();
				sleep(1);
			}
		
}
	}
	echo '</div>';
	

}
	
else {
?>
<div class="form-container" id="import-form-container">
		<form name="import-form" method="post" action="import.php" enctype="multipart/form-data">
			
			<div class="input-container inline-label">
				<label for="type">Import</label>:
				<select id="imp-chooser" name="type" onchange="toggleHelpTable();">
					<option>--Choose--</option>
					<option value="b">Books</option>
					<option value="u">Users</option>
				</select>
			</div>
			<div class="input-container">
				<div style="position:relative;height: 70px;">
				<table style="display: none;position: absolute;" class="format-help-table" id="fht-u">
					<tr><td colspan="6" style="text-align:center">Expected Excel Sheet Format<br />First row of the sheet will be skipped. It may include column names</td></tr>
					<tr><td>User ID</td><td>Name</td><td>Email</td><td>Phone No</td><td>Type</td><td>Password</td></tr>
				</table>
				<table style="display: none;position: absolute;" class="format-help-table" id="fht-b">
					<tr><td colspan="9" style="text-align:center">Expected Excel Sheet Format<br />First row of the sheet will be skipped. It may include column names</td></tr>
					<tr><td>Title</td><td>Author</td><td>Publisher</td><td>Edition</td><td>Subject</td><td>Rack No</td><td>Category</td><td>Comments</td><td>Status</td></tr>
				</table>
			</div>
			</div>
			<div class="input-container inline-label">
				<label for="file">Upload excel file(Supports .xls or .ods files only)</label>:<input name="file" id="file" style="color:#550000" type="file"/>
			</div>
			<div class="input-container submit-btn">
				<input name="submit" type="submit" value="Import"/>
			</div>
		</form>
	</div>
<?php
}

function flush_buff() {
    echo(str_repeat(' ', 256));
    if (@ob_get_contents()) {
        @ob_end_flush();
    }
    flush();
}
?>
<div class="footer">
			<?php include('../includes/footer.inc'); ?>
	</div>	
</body>
</html>
