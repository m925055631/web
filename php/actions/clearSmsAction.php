
<?php 

require_once('Action.php');
require_once(dirname(__FILE__) . '/../Controller.php');

class clearSmsAction extends Action {
	public function takeAction() {
	    unset($_SESSION['time']);
		//unset($_COOKIE['phonenumber']);
	}
}
