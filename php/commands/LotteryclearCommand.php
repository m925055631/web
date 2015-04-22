<?php

require_once('Command.php');
require_once(dirname(__FILE__) . '/../DBManager.php');

class LotteryclearCommand extends Command {

	function excute(CommandContext $context) {
		$db = new DBManager();

		$db->excute( "update `users` set status=0 WHERE 1" );
	 	
        return true;	
	
	}
}

?>
