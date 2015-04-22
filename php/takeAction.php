
<?php

require_once("ActionHelper.php");

	if( !isset($_SESSION) ) {
		session_start() ;
	}

	$actionStr = $_REQUEST['action'];
	$action_obj = ActionHelper::getAction($actionStr);
	$result = $action_obj->takeAction();

	if( isset($result) ) {
		echo $result;
	}
?>