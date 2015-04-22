
<?php

require_once('Command.php');
require_once(dirname(__FILE__) . '/../DBManager.php');

class LotterystartCommand extends Command {

	function excute(CommandContext $context) {
		$db = new DBManager();
	
				$users_mes = array();
				$users_mes = $db->query( "SELECT user_id,phonenumber FROM `users` WHERE status=0" );
			 	
				$users_mes =  json_decode( json_encode($users_mes),true);
                		$results = array();
            		for( $i = 0; $i < count($users_mes); $i ++ ) {
                        	$tmp = array();
                        	$tmp['user_id']=$users_mes[$i]['user_id'];
                        	$tmp['phonenumber']=$users_mes[$i]['phonenumber'];
                        	$results[$i]=$tmp;
        
	        	}
			$context->addParam("results", $results);
                	return true;	
	
	}
}

?>
