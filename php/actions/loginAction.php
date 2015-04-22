
<?php 

require_once('Action.php');
require_once(dirname(__FILE__) . '/../Controller.php');

class loginAction extends Action {
	public function takeAction() {
		$controller = new Controller();
		$context = $controller->getContext();

	    $context->addParam("action", "login");
	    $context->addParam("phonenumber", $_REQUEST['phonenumber']);
	    $context->addParam("mobile_code", $_REQUEST['mobile_code']);
	    $controller->process();
	    $message = $context->get("message");
	    
	    return $message;
	}
}