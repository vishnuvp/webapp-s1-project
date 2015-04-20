<?php
class DBConnection {
	protected $hname = "localhost";
	protected $username = "m140163cs";
	protected $password = "m140163cs";
	protected $database = "db_m140163cs";
	protected $dbhandle;

	/*function __construct($host="localhost", $user="root", $pwd="apple", $db="olm") {
		echo '<br />db connect2:';
		$this->$username = $user;
		$this->password = $pwd;
		$this->$database = $db;
		$this->hname = $host;
	}*/

	function connect() {
		$this->dbhandle = @mysql_connect($this->hname, $this->username, $this->password);
		if($this->dbhandle) {
			@mysql_select_db($this->database,$this->dbhandle);
		}
	}

	function disconnect() {

		mysql_close($this->dbhandle);
	}

	function insert_values($tablename, $cols, $values) {
			$col_names = implode(',', $cols);
			$col_values = implode(',', $values);
			$string = 'INSERT INTO '. $tablename . '('.$col_names.') VALUES ('.$col_values.')';
			print_r($string);
			return mysql_query($string, $this->dbhandle);
			//return @mysql_query($string);
	}

	function get_last_bid() {
		return mysql_insert_id($this->dbhandle);
	}

	function query($tablename, $cols, $where, $having, $group_by) {
		$string = 'SELECT ';
		if(isset($cols))
			$string .= $cols;

		if(isset($tablename))
			$string .= ' FROM ' . $tablename;

		if(isset($where)) 
			$string .= ' WHERE '.$where;

		if(isset($having))
			$string .= ' HAVING '.$having;

		if(isset($group_by))
			$string .= ' GROUP BY '.$group_by;

		/*else {

			db_log('DB Query: Invalid query: table undefined', 'current_user()', mktime(time()), "error");
			return false;
		}*/
		//echo $string;
		$result = mysql_query($string, $this->dbhandle);


		$array = array();
		$i = 0;
		if(!$result)
			return false;
		while($row = mysql_fetch_assoc($result)) {
			//print_r($row);
			$array[$i++] = $row;
		}
		//print_r($array);
		return $array;

	}

	function dquery($query) {
		//print_r($query);
		return mysql_query($query, $this->dbhandle);
	}
	
	function limited_query($tablename, $cols, $where, $having, $group_by, $limit) {
		$string = 'SELECT ';
		if(isset($cols))
			$string .= $cols;

		if(isset($tablename))
			$string .= ' FROM ' . $tablename;

		if(isset($where)) 
			$string .= ' WHERE '.$where;

		if(isset($having))
			$string .= ' HAVING '.$having;

		if(isset($group_by))
			$string .= ' GROUP BY '.$group_by;

		if(isset($limit))
			$string .= ' limit '.$limit;
		

		/*else {

			db_log('DB Query: Invalid query: table undefined', 'current_user()', mktime(time()), "error");
			return false;
		}*/
		//echo set_status($string, 'info');
		
		$result = mysql_query($string, $this->dbhandle);


		$array = array();
		$i = 0;
		if(!$result)
			return false;
		while($row = mysql_fetch_assoc($result)) {
			$array[$i++] = $row;
		}
		//print_r($array);

		return $array;
	}

	function join_query($table1, $table2, $cols, $on, $where) {
		$string = 'SELECT ';
		if(isset($cols))
			$string .= $cols;

			$string .= ' FROM ' . $table1 . ' INNER JOIN '.$table2;

			$string .= ' ON '.$on. ' WHERE '.$where;
		//echo '<br />'.$string;
		$result = mysql_query($string, $this->dbhandle);


		$array = array();
		$i = 0;
		if(!$result)
			return false;
		while($row = mysql_fetch_assoc($result)) {
			$array[$i++] = $row;
		}
		//print_r($array);

		return $array;
	}

	function transaction_archive($source,$cols,$condition) {
		if($this->dquery("INSERT INTO  ".$source."_archive(".$cols.") SELECT * FROM $source WHERE $condition"))
		{
		if($this->dquery("DELETE FROM $source WHERE $condition"))
			return true;
		}
		return false;

	}

	function notify_user($uid,$date,$msg) {
		$this->dquery("INSERT INTO notification(uid,date,msg) VALUES($uid,$date,$msg)");
	}

	function get_banner($role, $date) {

		return $this->query('banner','message','display_date="'.$date.'" AND (who LIKE "'.$role.'" OR who LIKE "Both")',null,null);
	}
	function get_notifications($user) {
		$issue_details = $this->join_query('issue','book','issue.issue_date as issue_date,issue.return_date as return_date,issue.bid as bid,book.title as title','issue.bid=book.bid','issue.uid="'.$user.'"');
		
		$ctr = 0;
		$notes['due'] = array();

		foreach ($issue_details as $value) {
			$notes['due'][$ctr++] = $value['title'].' issued on '.$value['issue_date'].' is due on '.$value['return_date']; 			
		}

		$ctr = 0;
		$notes['resv'] = array();
		$reserve_details = $this->join_query('reserve','book','reserve.reserve_date as reserve_date,reserve.end_date as end_date,reserve.bid as bid,book.title as title','reserve.bid=book.bid','reserve.uid="'.$user.'"');

		foreach ($reserve_details as $value) {
			if(!empty($value['end_date']))
				$notes['resv'][$ctr++] = $value['title'].' reserved on '.$value['reserve_date'].' is available now. Reservation expires on '.$value['end_date'];
			else 
				$notes['resv'][$ctr++] = $value['title'].' reserved on '.$value['reserve_date'].' is yet to be returned.';

		}

		$fine_details = $this->query('db_m140163cs.return','SUM(fine) as total_fine','uid="'.$user.'"',null,null);
		$notes['fine'] = empty($fine_details[0]['total_fine'])?0:$fine_details[0]['total_fine'];

		$notifications = $this->query('notification','nid,msg','uid="'.$user.'"',null,null);
		$ctr = 0;
		$notes['notification'] = array();
		foreach ($notifications as $value) {
			$notes['notification'][$ctr++] = $value['msg'];
			$this->dquery('DELETE FROM notification WHERE nid='.$value['nid']);
		}
		//print_r($notes);
		return $notes;
	}


}
?>
