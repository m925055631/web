
<?php
//命令与消息处理
class CommandContext {
	private $params = array();
	private $error = "";
	private $message = "";

	function __construct() {
		$this->params = array();
	}

	function addParam($key, $val) {
		$this->params[$key] = $val;
	}

	function get($key) {
		if( isset($this->params[$key]) ) {
			return $this->params[$key];
		} else {
			return NULL;
		}
	}

	function setMessage($message) {
		$this->message = $message;
	}

	function getMessage() {
		return $this->message;
	}

	function setError($error) {
		$this->error = $error;
	}

	function getError() {
		return $this->error;
	}
}

?>