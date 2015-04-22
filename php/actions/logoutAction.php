
<?php 

require_once('Action.php');
require_once(dirname(__FILE__) . '/../Controller.php');

class logoutAction extends Action {
	public function takeAction() {
	    unset($_SESSION['phonenumber']);
	    unset($_SESSION['section']);
		//unset($_COOKIE['phonenumber']);
	}
}
