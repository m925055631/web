
<?php 

require_once('Action.php');
require_once(dirname(__FILE__) . '/../Controller.php');

class getProgramAction extends Action {
	public function takeAction() {
		$controller = new Controller();
		$context = $controller->getContext();

		$context->addParam("action", "getProgram");
	    $controller->process();	 
	    $section =  $_SESSION['section'];
	    $users_comment = $context->get("Program");
	    $users = array();
	    for( $i = 0; $i < count($users_comment); $i ++ ) {
	    	$message = array();
	    	$message["programid"] = $users_comment[$i]->programid; 
	    	$message["programname"] = $users_comment[$i]->programname; 	
	    	if($section==$users_comment[$i]->section){
				$message["enable"] = '0';
	    	}else{
				$message["enable"] = '1';
	    	}
						
	    	$users[$i] = $message;
	    }

	    return json_encode($users);
	}
}
