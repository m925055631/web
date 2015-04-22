<?php
require_once('Action.php');
require_once(dirname(__FILE__) . '/../Controller.php');



class sendSmsAction extends Action {

	
	public function takeAction() {
		
		$controller = new Controller();
		$context = $controller->getContext();

	    $context->addParam("action", "sendSms");
	    $context->addParam("phonenumber", $_REQUEST['phonenumber']);
	    $controller->process();
	    $message = $context->get("message");
	    
	    return $message;	
	}
}

?>