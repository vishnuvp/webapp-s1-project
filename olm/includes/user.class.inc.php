<?php
require_once("db.class.inc");
require_once("book.class.inc");
require_once('search.inc');
require_once('utilities.inc');

class Abstract_User {
	public $uid;
	public $name;
	public $email;
	public $password;
	public $phoneno;
	public $type;
	public $info;

	public function set_values($array) {
		$this->uid = $array['uid'];
		$this->name = $array['name'];
		$this->email = $array['email'];
		$this->password = $array['password'];
		$this->phoneno = $array['phoneno'];
		$this->type = $array['type'];
		$this->info = $array['info'];
	}

	public function get_values_array() {
		
		$array = array('"'.$this->uid.'"', '"'.$this->name.'"', '"'.$this->password.'"', '"'.$this->email.'"', '"'.$this->phoneno.'"','"'. $this->type.'"','"'. $this->info.'"');
		return $array;
	}


}

class User extends Abstract_User {


	public function createUser($array) {

	//	parent::
 		$this->set_values($array);
	}

	public function reserve_book($bid, $uid){
		$book = new Book(search('b','book.bid = '.$bid)[0]);
				//print_r($book);

		$book_val = $book->get_key_value();
		$flag = array();
		
		$db_connection = new DBConnection;
		$db_connection->connect();
			
		if($book_val['status'] == 1) {

			$today = get_today();
			$end_date = add_days($today, '7 days');
			//echo $end_date;
			$fail_status = $db_connection->insert_values('reserve',array('bid','uid','reserve_date','end_date'),array($bid,'"'.$uid.'"',"'$today'","'$end_date'"));
			
			if($fail_status) {
				$fail_status = $db_connection->dquery('UPDATE book_status SET status=3 WHERE bid='.$bid);
				if(!$fail_status) {
					$db_connection->dquery('DELETE FROM reserve WHERE bid='.$bid);
				}

			}
			
			if($fail_status) {
				$flag['msg'] = 'Book is on shelf and has been reserved. Reservation will expire on '.date('jS M Y',strtotime($end_date));
				$flag['status'] = 'info';
			}
			else {
				$flag['msg'] = 'Book reservation failed. Please try again <a href="/m140163cs/olm/control/reserve.php?bid='.$bid.'" class="inline-click-link">here</a>';
				$flag['status'] = 'error';
			}
		}
		else if($book_val['status'] == 0) {
			$flag['msg'] = 'Book is temporarily unavailable.';
			$flag['status'] = 'warning';
		}
		else if($book_val['status'] == 2) {
			//print_r($book_val);
			$return_date = $db_connection->query('issue','uid,return_date','bid='.$bid,null,null);
			if($return_date[0]['uid'] == $uid) {
				$flag['msg'] = 'Reservation is not permitted as book is issued to the same person.';
				$flag['status'] = 'warning';
			}
			else {
				$today = get_today();
				
				$fail_status = $db_connection->insert_values('reserve',array('bid','uid','reserve_date'),array($bid,'"'.$uid.'"',"'$today'"));
				
				if($fail_status) {
					$fail_status = $db_connection->dquery('UPDATE book_status SET status=4 WHERE bid='.$bid);
					if(!$fail_status) {
						$db_connection->dquery('DELETE FROM reserve WHERE bid='.$bid);
					}

				}
				
				if($fail_status) {

					$flag['msg'] = 'Book is on loan and has been reserved. Expected return date: '.date('jS M Y',strtotime($return_date[0]['return_date']));
					$flag['status'] = 'info';
				}
				else {
					$flag['msg'] = 'Book reservation failed. Please try again <a href="/m140163cs/olm/control/reserve.php?bid='.$bid.'" class="inline-click-link">here</a>';
					$flag['status'] = 'error';
				}
			}
		}
		
		else if($book_val['status'] == 3) {
			$flag['msg'] = 'Book is reserved by another user.';
			$flag['status'] = 'warning';
		}
		else if($book_val['status'] == 4) {
			$flag['msg'] = 'Book is on loan. Unable to reserve as another reservation has also been made on it.';
			$flag['status'] = 'warning';
		}
		$db_connection->disconnect();
		return $flag;

	}

	
}

class Admin extends Abstract_User {

	

	public function add_admin($admin_array) {
		$this->set_values($admin_array);
		if(!$this->save_user($this))
			return false;
		else
			return $this;
	}

	public function save_user($user_object = null) {
		
		if(!is_null($user_object)) {
			
		$db_connection = new DBConnection;
		$db_connection->connect();
		$flag = $db_connection->insert_values('user',array('uid','name','password','email','phoneno','type','info'), $user_object->get_values_array());
		$db_connection->disconnect();
		return $flag;		
		}
	}

	public function add_user($user_array) {
		$new_user = new User;
		$new_user->createUser($user_array);
		if(!$this->save_user($new_user))
			return false;
		else
			return $new_user;

		
	}

	public function modify_user($user_array) {
		$db_connection = new DBConnection;
		$db_connection->connect();
		if(empty($user_array['password']))
			$query = 'UPDATE user SET name="'.$user_array['name'].'",email="'.$user_array['email'].'",phoneno="'.$user_array['phoneno'].'",type="'.$user_array['type'].'" WHERE uid="'.$user_array['uid'].'"';
		else {
			$user_array['password'] = md5('salt'.trim($user_array['password']));
			$query = 'UPDATE user SET password="'.$user_array['password'].'",name="'.$user_array['name'].'",email="'.$user_array['email'].'",phoneno="'.$user_array['phoneno'].'",type="'.$user_array['type'].'" WHERE uid="'.$user_array['uid'].'"';
		}
		$flag = $db_connection->dquery($query);
		$db_connection->disconnect();
		if ($flag) {
			return true;
		}
		else
			return false;
	}

	public function delete_user($user_array) {
		$db_connection = new DBConnection;
		$db_connection->connect();
		$flag = $db_connection->dquery('DELETE FROM user WHERE uid="'.$user_array['uid'].'"');
		$db_connection->disconnect();
		if ($flag) {
			return true;
		}
		else
			return false;

	}
	public function add_book($array) {
		$new_book = new Book($array);
		if($new_book->save_book())
			return $new_book;
		else 
			return false;
	}

	public function modify_book($array) {
		$new_book = new Book($array);
		if($new_book->update_book('update'))
			return true;
		else 
			return false;
	}

	public function delete_book($array) {
		$new_book = new Book;
		$new_book->set_bid($array['bid']);
		if($new_book->update_book('delete'))
			return true;
		else return false;
	}
 	public function issue_book($bid, $uid){
		$book = new Book(search('b','book.bid = '.$bid)[0]);
				//print_r($book);
		$user = search('u','uid="'.$uid.'"')[0];
		//print_r($user);
		$book_val = $book->get_key_value();
		$today = get_today();
		$flag = array();
		$ret_date = 30;
		if($user['type'] == 'Student')
				$ret_date = add_days($today, '30 days');
		else if($user['type'] == 'Faculty')
				$ret_date = add_days($today,'180 days');
		else {
				$flag['msg'] = 'Invalid User ID';
				$flag['status'] = 'error';
				return $flag;
		}
		$db_connection = new DBConnection;
		$db_connection->connect();
			
		if($book_val['status'] == 1) {

			

			$fail_status = $db_connection->insert_values('issue',array('bid','uid','issue_date','return_date'),array($bid,'"'.$uid.'"',"'$today'","'$ret_date'"));
			
			if($fail_status) {
				//$fail_status = $book->change_status(2);
				$fail_status = $db_connection->dquery('UPDATE book_status SET status=2 WHERE bid='.$bid);
				if(!$fail_status) {
					echo set_status("Book status update failed. Please contact support team to set status of Book:$bid to 2 manually");
					//$db_connection->dquery('DELETE FROM issue WHERE bid='.$bid);
				}

			}
			
			if($fail_status) {
				$flag['msg'] = 'Book '.$bid.' '.$book_val['title'].' has been issued to '.$uid.' '.$user['name'].'. Due date is '.date('jS M Y',strtotime($ret_date));
				$flag['status'] = 'info';
			}
			else {
				$flag['msg'] = 'Book issue failed. Please try again <a href="/m140163cs/olm/control/issue.php?bid='.$bid.'" class="inline-click-link">here</a>';
				$flag['status'] = 'error';
			}
		}
		else if($book_val['status'] == 0) {
			$flag['msg'] = 'Book is temporarily unavailable.';
			$flag['status'] = 'warning';
		}
		else if($book_val['status'] == 2) {
			//print_r($book_val);
			$return_date = $db_connection->query('issue','return_date','bid='.$bid,null,null);
			$flag['msg'] = 'Book is unavailable at the moment as it is on loan. Expected return date:'.date('jS M Y',strtotime($return_date[0]['return_date']));
			$flag['status'] = 'warning';
		}
		else if($book_val['status'] == 3) {
			// todo:done user is who reserved 
			$dates = $db_connection->query('reserve','reserve_date,end_date','bid='.$bid.' AND uid="'.$uid.'"',null,null);
			//print_r($dates);
			if ($dates) {
				$today = get_today();
				//echo $dates[0]['end_date'];
				if(get_date_diff($today,$dates[0]['end_date']) < 7) {
					
					$ret_date = add_days($today, 30);
					$fail_status = $db_connection->insert_values('issue',array('bid','uid','issue_date','return_date'),array($bid,'"'.$uid.'"',"'$today'","'$ret_date'"));
			
					if($fail_status) {
						$fail_status = $db_connection->dquery('UPDATE book_status SET status=2 WHERE bid='.$bid);
		 				//$fail_status = $book->change_status(2);
						if(!$fail_status) {
							//$db_connection->dquery('DELETE FROM issue WHERE bid='.$bid);
							echo set_status("Book status update failed. Please contact support team to set status of Book:$bid to 2 manually");
						}
					}
			
					if($fail_status) {
						if($db_connection->transaction_archive('reserve',"reserve_id,bid,uid,reserve_date,end_date","bid=$bid AND uid='$uid'")) {
							$flag['msg'] = 'Book was reserved by this user('.$uid.') on '.$dates[0]['reserve_date'].'.The book '.$bid.' '.$book_val['title'].' has been issued to '.$uid.' '.$user['name'].'. Due date is '.date('jS M Y',strtotime($ret_date));
							$flag['status'] = 'info';
						}
						else {
							$flag['msg'] = 'Book was reserved by this user('.$uid.') on '.date('jS M Y',strtotime($dates[0]['reserve_date'])).'.The book '.$bid.' '.$book_val['title'].' has been issued to '.$uid.' '.$user['name'].'. Due date is '.date('jS M Y',strtotime($ret_date)).'<div style="color:red;">Archiving failed. Please archive reservation table for bid:'.$bid.' and uid:'.$uid.'</div>';
							$flag['status'] = 'warning';	
						}
							
												
					}
					else {
						$flag['msg'] = 'Book issue failed. Please try again <a href="/m140163cs/olm/control/issue.php?bid='.$bid.'" class="inline-click-link">here</a>';
						$flag['status'] = 'error';
					}

				}
			}
			else {
				$flag['msg'] = 'Book is reserved by another user.';
				$flag['status'] = 'warning';
			}
		}
		else if($book_val['status'] == 4) {
			$flag['msg'] = 'Book is on loan. It cannot be reserved as another reservation is already made on it.';
			$flag['status'] = 'warning';
		}
		$db_connection->disconnect();
		return $flag;

	}

	function return_book ($bid) {

		$book = new Book(search('b','book.bid = '.$bid)[0]);
		$flag = array();
		$book_val = $book->get_key_value();
		/*$user_data = search('u','user.uid='.issue_data['uid'])[0];
		if($user['type'] != 'Student' || $user['type'] != 'Faculty')
		{
			$flag['msg'] = 'Something is wrong! UID from issue table is invalid for this bid';
			$flag['status'] = 'error';
			return $flag;
		}*/
		$db_connection = new DBConnection;
		$db_connection->connect();

		$issue_data = $db_connection->query('issue','uid,issue_date,return_date','bid='.$bid,null,null);
		if(!$issue_data) {
			$flag['msg'] = 'No issue entry found for this book id. Book might have been returned earlier.';
			$flag['status'] = 'warning';
			$db_connection->disconnect();
			return $flag;
		}
		$uid = $issue_data[0]['uid'];
		$today = get_today();
		$no_of_days = get_date_diff($today,$issue_data[0]['return_date']);
		//print_r($no_of_days);
		print_r($no_of_days);
		$fine = ($no_of_days > 0)?2*$no_of_days:0;
				
		$fail_status = $db_connection->insert_values('db_m140163cs.return',array('bid','uid','return_date','fine'),array($bid,'"'.$uid.'"',"'$today'",$fine));
		if($book_val['status'] == 2) {
			$new_status = 1;
		}

		else if($book_val['status'] == 4){
			$new_status = 3;

		}

		if($fail_status) {
			$fail_status = $db_connection->dquery('UPDATE book_status SET status='.$new_status.' WHERE bid='.$bid);
			
			if(!$fail_status) {
				echo set_status("Book status update failed. Please contact support team to set status of Book:$bid to $new_status manually");
			}
			else {
				if($db_connection->transaction_archive('issue',"issue_id,bid,uid,issue_date,return_date","bid=$bid AND uid='$uid'")) {
					$flag['msg'] = 'Book '.$bid.' '.$book_val['title'].' borrowed by user '.$uid.' returned succesfully. <strong>Fine:<i class="rupee-symbol"></i>'.$fine.'</strong>';
					$flag['status'] = 'info';
				}
				else {
					$flag['msg'] = 'Book '.$bid.' '.$book_val['title'].' borrowed by user '.$uid.' returned succesfully. <strong>Fine:<i class="rupee-symbol"></i>'.$fine.'</strong>.<div style="color:red">Archiving failed. Please archive issue entry for bid:'.$bid.' and uid:'.$uid.'</div>';
					$flag['status'] = 'warning';
				}
			}
		}
		else {
				$flag['msg'] = 'Book return failed. Please try again <a href="/m140163cs/olm/control/return.php?bid='.$bid.'" class="inline-click-link">here</a>';
				$flag['status'] = 'warning';
		}	
		//book is not reserved
		// calculate fine, make entry in return table,change book status, archive issue entry
	
		//book is reserved
		//calculate fine, make entry in return table, change book status, archive issue entry, update reservation table, notify about reservation
		if($book_val['status'] == 4) {
			$resv_data = $db_connection->query('reserve','uid','bid='.$bid,null,null);
			$end_date = add_days(get_today(),'7 days');
			$update_status = $db_connection->dquery('UPDATE reserve SET end_date="'.$end_date.'" WHERE bid='.$bid);
			if($update_status) {

				$db_connection->notify_user("'".$resv_data[0]['uid']."'","'".get_today()."'","'The book you reserved is now available. Please collect it before ".$end_date."'");
			}
			else {
				echo set_status("Reservation status update failed for this book(bid:$bid), uid:$uid. Please contact support team to update it manually.",'error');
			}
		}
		$db_connection->disconnect();

		return $flag;
	}





}

?>
