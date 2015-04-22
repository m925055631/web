<?php 

require_once("CommandContext.php"); //消息处理
require_once("CommandFactory.php"); //php包含

class Controller {
	private $context;

	function __construct() {
		$this->context = new CommandContext();
	}

	function getContext() {
		return $this->context;
	}

	function process() {
		$cmd = CommandFactory::getCommand( $this->context->get('action') );
		
		if( ! $cmd->excute($this->context) ) {
			echo $this->context->getError();
			exit(0);
		} else {
			//success
			//do something else
			// echo "success to login!";
		}
	}
}

?>