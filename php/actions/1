
<?php 

require_once('Action.php');
require_once(dirname(__FILE__) . '/../Controller.php');

class lotterystopAction extends Action {
	public function takeAction() {
		$controller = new Controller();
		$context = $controller->getContext();

	    	$context->addParam("action", "lotterystop");
		$context->addParam("phonenumber",$_REQUEST['phonenumber']);
		$controller->process();
	}
}
