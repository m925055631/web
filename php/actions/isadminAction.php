
<?php 

require_once('Action.php');
require_once(dirname(__FILE__) . '/../Controller.php');

class isadminAction extends Action {
	public function takeAction() {
		if( isset($_SESSION['username']) ) {
		//if( isset($_COOKIE['phonenumber']) ) {
		    return "1";

		} else {
			return "0";
		}
	}
}
