
<?php

require_once('Command.php');
require_once(dirname(__FILE__) . '/../DBManager.php');

class GetProgramCommand extends Command {
	private function getProgram() {
		
		$db = new DBManager();

		$users_mes = array();

		$users_mes = $db->query( "SELECT * FROM `program` " );
	
		return $users_mes;
	}

	function excute(CommandContext $context) {
		
		$users_mes = $this->getProgram($context);

		$context->addParam("Program", $users_mes);
		return true;
	}
}

?>
