
<?php

//创建自定义的异常处理程序
class CommandNotFoundException extends Exception {

}
//检查对应Command处理文件是否存在并包含进去
class CommandFactory {
	private static $dir = "commands";

	static function getCommand($action = "Default") {
		// if( preg_match('/\w/', $action) ) {
		// 	throw new Exception("illegal characters in action");
		// }
		
		$class = ucfirst($action)."Command";  //ucfirst() 函数把字符串中的首字符转换为大写
		$file = self::$dir . DIRECTORY_SEPARATOR . $class . ".php"; //创建一个php文件

		if( !file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . $file) ) {   //检查对应Command命令是否存在
			throw new CommandNotFoundException("Could not find '$file'");
		}

		require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . $file); //包含php文件
		
		// if( !class_exists($file) ) {
		// 	throw new CommandNotFoundException("No '$class class located");
		// }

		$cmd = new $class();
		return $cmd;
	}
}	

?>