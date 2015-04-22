
<?php 

require_once('Action.php');
require_once(dirname(__FILE__) . '/../Controller.php');

class lotterystartAction extends Action {
	public function takeAction() {
		$controller = new Controller();
		$context = $controller->getContext();

	    	$context->addParam("action", "lotterystart");
		$controller->process();
		$message = $context->get("results");
		return json_encode($message);
	}
}
?>
