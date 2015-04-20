<?php

	function new_olm_session($user, $name, $time, $role) {
		
		if(isset($_SESSION['user']))
			session_destroy();
		session_start();
		$_SESSION['user'] = $user;
		$_SESSION['timestamp'] = $time;
		$_SESSION['role'] = $role;
		$_SESSION['name'] = $name;
//		echo "New session started for $role $user @ $time";
		
	}

	function revive_olm_session() {
		@session_start();
		//echo 'Session Revived for '. $_SESSION['user'];
	}
	function is_olm_session_active(){
		revive_olm_session();
		if(isset($_SESSION['user']))
			return true;
		return false;
	}
	function olm_session_get_user() {
		@session_start();
		return $_SESSION['user'];
	}

	function olm_session_set_user($user) {
		@session_start();
		$_SESSION['user']= $user;
	}

	function olm_session_get_role() {
		@session_start();

		return $_SESSION['role'];
	}
	function olm_session_get_name() {
		@session_start();

		return $_SESSION['name'];
	}
	function olm_session_set_role($role) {
		@session_start();
		$_SESSION['user']= $role;
	}



	function olm_session_get_timestamp() {
		@session_start();
		return $_SESSION['timestamp'];
	}

	function olm_session_set_timestamp($time) {
		@session_start();
		$_SESSION['timestamp'] = $time;
	}

	function olm_session_out() {
		session_start();

		session_destroy();
	}





?>