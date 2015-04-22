
<?php 

require_once('Action.php');
require_once(dirname(__FILE__) . '/../Controller.php');

class adminoutAction extends Action {
	public function takeAction() {
	    unset($_SESSION['username']);
		//unset($_COOKIE['phonenumber']);
	}
}
