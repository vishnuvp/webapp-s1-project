<?php
class Book {
	private $bid;
	private $title;
	private $subject;
	private $author;
	private $publisher;
	private $edition;
	private $rack_no;
	private $status;

	public function __construct($array) {
		if(isset($array['bid']))
			$this->bid = $array['bid'];
		$this->title = $array['title'];
		$this->subject = $array['subject'];
		$this->author = $array['author'];
		$this->publisher = $array['publisher'];
		$this->edition = $array['edition'];
		$this->rack_no = $array['rack_no'];
		$this->status = $array['status'];
		$this->category = $array['category'];
		$this->comments = $array['comments'];

	}
	public function get_bid() {
		return $this->bid;
	}
	public function set_bid($bid) {
		$this->bid = $bid;
	}
	public function get_title() {
		return $this->title;
	}
	public function get_key_value() {
		$array = array(
			'bid' => $this->bid,
			'title' => $this->title,
			'subject' => $this->subject,
			'author' => $this->author,
			'publisher' => $this->publisher,
			'edition' =>  $this->edition,
			'rack_no' => $this->rack_no,
			'status' => $this->status,
			'category' => $this->category,
			'comments' => $this->comments);
		return $array;
	}
	public function get_values_array() {
		$array = array('"'.$this->title.'"', '"'.$this->author.'"', '"'.$this->publisher.'"', '"'.$this->edition.'"', '"'.$this->subject.'"', '"'.$this->rack_no.'"', '"'.$this->category.'"', '"'.$this->comments.'"');
		
		return $array;

	}
	public function save_book() {

		$db_connection = new DBConnection;
		$db_connection->connect();
		$flag = $db_connection->insert_values('book',array('title','author','publisher','edition','subject','rack_no','category','comments'), $this->get_values_array());
		if($flag != false) { 
			$this->bid = $db_connection->get_last_bid();
			$db_connection->insert_values('book_status', array('bid','status'), array($this->bid,$this->status));	
			$db_connection->disconnect();			
			return true;
		}
		else {
			$db_connection->disconnect();
			return false;
		}
			
		
	}	
	public function update_book($op) {
		if($op == 'update') {
			$db_connection = new DBConnection;
			$db_connection->connect();
			$flag = $db_connection->dquery('UPDATE book SET title="'.$this->title.'",author="'.$this->author.'",publisher="'.$this->publisher.'",edition="'.$this->edition.'",subject="'.$this->subject.'",rack_no="'.$this->rack_no.'",category="'.$this->category.'",comments="'.$this->comments.'" WHERE bid='.$this->bid);
			if($flag!=false)
				$flag = $db_connection->dquery('UPDATE book_status SET status="'.$this->status.'" WHERE bid='.$this->bid);
			if($flag!=false)
				return true;
			else return false;
		}
		else if($op == 'delete'){
			$db_connection = new DBConnection;
			$db_connection->connect();
			$flag = $db_connection->dquery('DELETE FROM book WHERE bid='.$this->bid);
			if(flag)
				return true;
			else return false;
		}

	}
	
	/*public function change_status($status) {
		$db_connection = new DBConnection;
		$db_connection->connect();
		if($db_connection->dquery('UPDATE book_status SET status='.$status.' WHERE bid='.$this->bid)) {
			$db_connection->disconnect();
			return true;
		}
		$db_connection->disconnect();
		return false;
	}*/


}

?>