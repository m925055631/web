
<?php
date_default_timezone_set("PRC"); 
require_once('Command.php');
require_once(dirname(__FILE__) . '/../DBManager.php');

class LoginCommand extends Command {
	private function login($phonenumber) {
		$db = new DBManager();

		$result = $db->query( "SELECT * FROM `review` WHERE phonenumber='$phonenumber'" );

		if( empty($result) ) {
			return null;
		} else {
			//session_start();
			$_SESSION['phonenumber'] = $result[0]->phonenumber;
			$_SESSION['identify'] = $result[0]->identify;
			$_SESSION['section'] = $result[0]->section;
			//$_COOKIE['phonenumber'] = $result[0]->phonenumber;
			return $result[0];
		}
	}

	function excute(CommandContext $context) {
		if (isset($_SESSION['timecount']))//判断缓存时间
	    {
	    	session_id();
	        $_SESSION['time'];
	    }
	    else
	    {
	        $context->addParam("message", "getcode"); 	
	        return true;        
	    }
	    if (isset($_SESSION['mobile_code']))//判断缓存时间
	    {
	    	//session_id();
	        $_SESSION['mobile_code'];
	    }
	    else
	    {
	        $context->addParam("message", "codewrong"); 
	        return true;		        
	    }
		$phonenumber = $context->get('phonenumber');
		$mobile_code = $context->get('mobile_code');
		$user_obj = $this->login($phonenumber);
		
		if( is_null($user_obj) ) {   //手机号码不正确
			$context->addParam("message", "numwrong");
		} else {     //手机号正确
			if((strtotime($_SESSION['time'])+180)<time()) {//将获取的缓存时间转换成时间戳加上60秒后与当前时间比较，小于当前时间即为过期
		         session_destroy();
		         unset($_SESSION['time']);
		         $context->addParam("message", "timeout"); 
			}	
			else{
				if($mobile_code==$_SESSION['mobile_code']){    //验证码正确
				$context->addParam("message", "codesucceed");
				}
				else{     //验证码错误
					$context->addParam("message", "codewrong");
				}	
			}
					
		}	
		return true;
	}
}

?>
