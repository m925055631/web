<?php 

require_once('Action.php');
require_once(dirname(__FILE__) . '/../Controller.php');

class getVoteResultAction extends Action {

	public function takeAction() {
		$controller = new Controller();

		$context = $controller->getContext();

		$context->addParam("action", "getVoteResult");
	    $controller->process();
	    $users_comment = $context->get("voted_result");

	    $users = array();
	    $tmp = array();
	    for( $i = 0; $i < count($users_comment); $i++ ) {
	    	$message = array();
	    	$message["countid"] = $users_comment[$i]['countid']; 
	    	$message["programid"] = $users_comment[$i]['programid']; 
	    	$message["programname"] = $users_comment[$i]['programname']; 
	    	$message["votednum"] = $users_comment[$i]['votednum']; 
	    	$users[$i] = $message;
	    }
	    foreach ($users as $key => $row) {  
		  $tmp[$key] = $row['votednum'];  
		}  
		array_multisort($tmp,SORT_DESC,$users);
	    return json_encode($users);
	}
}

?>