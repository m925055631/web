<?php 

require_once('Action.php');
require_once(dirname(__FILE__) . '/../Controller.php');

class lotteryclearAction extends Action {
	public function takeAction() {
		$controller = new Controller();
		$context = $controller->getContext();

	    $context->addParam("action", "lotteryclear");
		$controller->process();
	}
}
?>
