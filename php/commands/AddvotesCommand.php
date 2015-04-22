
<?php

require_once('Command.php');
require_once(dirname(__FILE__) . '/../DBManager.php');

class AddvotesCommand extends Command {
	private function addvotes($phonenumber,$votes) {
		$identify = $_SESSION['identify'];
		$db = new DBManager();
		if($identify){    //专家评审
			$result = $db->query( "SELECT id FROM `voteresult` where phonenumber='$phonenumber'");
		}
		else{           //大众评审
			$result = $db->query( "SELECT id FROM `voteresult1` where phonenumber='$phonenumber'");
		}

		if(empty($result)){
					if($identify){
						$db->excute("INSERT INTO `voteresult` VALUES (NULL,'$phonenumber','$votes','0');");
					}
					else{
						$db->excute("INSERT INTO `voteresult1` VALUES (NULL,'$phonenumber','$votes','0');");
					}
					$users_mes = "1";
		}else{
			$users_mes = "0";
		}

		return $users_mes;
	}
	
	function excute(CommandContext $context) {
		$phonenumber = $context->get('phonenumber');
		$votes = $context->get('myvotes');
		
		$users_mes = $this->addvotes($phonenumber,$votes);
		$context->addParam("results", $users_mes);
			
		return true;
	}
}

?>
