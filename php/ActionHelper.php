
<?php

require_once("Controller.php");

class ActionHelper {
	private static $instance = null;
	private static $dir = "actions";

	private function __construct() {

	}

	public static function getAction($action = "Default") {
		$class = $action . "Action";
		$file = self::$dir . DIRECTORY_SEPARATOR . $class . ".php";

		if( !file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . $file) ) {
			throw new ActionNotFoundException("Could not find '$file'");
		}

		include(dirname(__FILE__) . DIRECTORY_SEPARATOR . $file);

		$cmd = new $class();
		return $cmd;
	}

	public static function getInstance() {
		if( is_null(self::$instance) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}

?>