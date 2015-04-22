
<?php

require_once('Command.php');
require_once(dirname(__FILE__) . '/../DBManager.php');

class AdminCommand extends Command {
	private function login($username,$password) {
		$db = new DBManager();
		$password = md5($username.$password);

		$result = $db->query( "SELECT * FROM `admin` WHERE username='$username' and password='$password'" );

		if( empty($result) ) {
			return null;
		} else {
			//session_start();
			$_SESSION['username'] = $result[0]->username;
			//$_COOKIE['phonenumber'] = $result[0]->phonenumber;
			return $result[0];
		}
	}

	function excute(CommandContext $context) {
		$username = $context->get('username');
		$password = $context->get('password');
		$user_obj = $this->login($username,$password);

		if( is_null($user_obj) ) {
			$context->addParam("message", "0");

			return true;
		} else {
			$context->addParam("message", "1");

			return true;
		}	
	}
}

?>
