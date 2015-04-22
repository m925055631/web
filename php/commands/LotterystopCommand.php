
<?php

require_once('Command.php');
require_once(dirname(__FILE__) . '/../DBManager.php');

class LotterystopCommand extends Command {

	function excute(CommandContext $context) {
		$db = new DBManager();
				
				$phonenumber = $context->get('phonenumber');
				$db->excute( "update `users` set status=1 WHERE phonenumber=$phonenumber" );
			 	
                	return true;	
	
	}
}

?>
