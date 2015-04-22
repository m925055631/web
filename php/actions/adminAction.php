
<?php 

require_once('Action.php');
require_once(dirname(__FILE__) . '/../Controller.php');

class adminAction extends Action {
	public function takeAction() {
		$controller = new Controller();
		$context = $controller->getContext();

	    $context->addParam("action", "admin");
	    $context->addParam("username", $_REQUEST['username']);
	   $context->addParam("password", $_REQUEST['password']);
	    $controller->process();
	    $message = $context->get("message");
	    
	    return $message;
	}
}
