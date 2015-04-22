
<?php

require_once('Command.php');
require_once(dirname(__FILE__) . '/../DBManager.php');

class GetVoteResultCommand extends Command {
	private function getvoteresults() {
		$identify = $_SESSION['identify'];
		$db = new DBManager();

		$users_mes = array();
		
		$users_mes = $db->query( "SELECT countid,programid,programname FROM `program`" );
		$users_mes =  json_decode( json_encode($users_mes),true);
		$results = array();
	    for( $i = 0; $i < count($users_mes); $i ++ ) {
			$tmp = array();			
			$tmp['countid']=$users_mes[$i]['countid'];
			$tmp['programid']=$users_mes[$i]['programid'];
			$tmp['programname']=$users_mes[$i]['programname'];
			$my_id = $tmp['countid'];
			
			$numOfPro = $db->query( "SELECT COUNT(*) AS amount FROM `voteresult` where votes like '%$my_id%'" );
			
			$numOfCom = $db->query( "SELECT COUNT(*) AS bmount FROM `voteresult1` where votes like '%$my_id%'" );
			
			$tmp['votednum']=$numOfPro[0]->amount;	
			$tmp['votednum']=$tmp['votednum']*2 + ($numOfCom[0]->bmount);	
			$results[$i]=$tmp;
		}
		
		return $results;
	} 
	function excute(CommandContext $context) {
		

		$results = $this->getvoteresults();

		$context->addParam("voted_result", $results);

		return true;
	}
}

?>
