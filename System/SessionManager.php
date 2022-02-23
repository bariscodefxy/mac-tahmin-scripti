<?php

class SessionManager {

	public function has(string $sess) : bool {
		if(isset($_SESSION[$sess])) return true;
		return false;
	}

	public function set(string $sess, mixed $val) : bool {
		$_SESSION[$sess] = $val;
		return true;
	}

	public function get(string $sess) : mixed {
		if(!$this->has($sess)) return false;
		return $_SESSION[$sess];
	}

}