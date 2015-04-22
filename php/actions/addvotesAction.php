
<?php 

require_once('Action.php');
require_once(dirname(__FILE__) . '/../Controller.php');

class addvotesAction extends Action {
	public function takeAction() {
		$controller = new Controller();
		$context = $controller->getContext();

		$context->addParam("action", "addvotes");
		$context->addParam("phonenumber", $_SESSION['phonenumber']);
		$context->addParam("myvotes", $_REQUEST['myvotes']);
		

	    $controller->process();
	    $users_msg = $context->get("results");
	/*
	    $users = array();
	    for( $i = 0; $i < count($users_comment); $i ++ ) {
	    	$message = array();
	    	$message["programid"] = $users_comment[$i]->programid; 
	    	$message["programname"] = $users_comment[$i]->programname; 
	    	$users[$i] = $message;
	    }
	*/
	    return $users_msg;
	}
}