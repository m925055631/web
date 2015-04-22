
<?php
//调试地址：   http://localhost/cook/php/takeAction.php?phonenumber=13302338567&action=sendSms
 date_default_timezone_set("PRC"); 
require_once('Command.php');
require_once(dirname(__FILE__) . '/../DBManager.php');
require_once(dirname(__FILE__) . '/../AES.php');

class sendSmsCommand extends Command {
	private function check($phonenumber) {
		$db = new DBManager();

		$result = $db->query( "SELECT * FROM `users` WHERE phonenumber='$phonenumber'" );

		if( empty($result) ) {
			return null;
		} else {
			//session_start();
			//$_SESSION['phonenumber'] = $result[0]->phonenumber;
			//$_SESSION['section'] = $result[0]->section;
			//$_COOKIE['phonenumber'] = $result[0]->phonenumber;
			return $result[0];
		}
	}
	private function random($length = 6 , $numeric = 0) {
		PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
		if($numeric) {
			$hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
		} else {
			$hash = '';
			$chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
			$max = strlen($chars) - 1;
			for($i = 0; $i < $length; $i++) {
				$hash .= $chars[mt_rand(0, $max)];
			}
		}
		return $hash;
	}
	private function Post($curlPost,$url){
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array(  
	            'Content-Type: application/json; charset=utf-8',  
	            'Content-Length: ' . strlen($curlPost))  
	             ); 
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_NOBODY, true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
			$return_str = curl_exec($curl);
			curl_close($curl);
			return $return_str;
	}

	/**
     * 把string转成byte
     * @param str
     * @return
     * @throws UnsupportedEncodingException
     */
    public  function getBytes($string) {  
        $bytes = array();  
        $pieces = explode(" ",$string);
        for($i = 0; $i < 16; $i++){  
             $bytes[] =chr(hexdec($pieces[$i]));  
        }  
        foreach($bytes as $key=>$value)
         echo $key."=>".$value."<br/>";
        
        return implode($bytes);  
    }  
    public function pad2Length($text,$padlen){
        $len = strlen($text) % $padlen;    
    
	    $res = $text;    
	    $span = $padlen-$len;    
	    for($i=0; $i<$span; $i++){    
	        $res = " ".$res;    
	    }    
	    return $res;    
	} 
	/*private function xml_to_array($xml){
		$arr = array();
		$reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
		if(preg_match_all($reg, $xml, $matches)){
			$count = count($matches[0]);
			for($i = 0; $i < $count; $i++){
			$subxml= $matches[2][$i];
			$key = $matches[1][$i];
				if(preg_match( $reg, $subxml )){
					$arr[$key] = $this->xml_to_array( $subxml );
				}else{
					$arr[$key] = $subxml;
				}
			}
		}
		return $arr;
	}*/


	function excute(CommandContext $context) {
		if (isset($_SESSION['timecount']))//判断缓存时间
	    {
	        session_id();
	        $_SESSION['time'];
	    }
	    else
	    {
	        $_SESSION['time'] = date("Y-m-d H:i:s");   
	        $_SESSION['timecount']=1;   
	    }

		$phonenumber = $context->get('phonenumber');
		$user_obj = $this->check($phonenumber);
		$mobile_code = $this->random(6,1);
		$target = "http://14.146.224.151:9999/PscService/sms/sendSMS/index";			
		$imputTel = $this->pad2Length($phonenumber,16);
		$content = "【PSC投票】您的验证码为：".$mobile_code;
		$content=iconv("UTF-8","gbk//TRANSLIT",$content);
		$contents = $this->pad2Length($content,16);
		$p = array('1722',$imputTel ,$contents,'chang','chang@12345' );
		$imputKey = pack('H*', "30911453F1ECF385DD055794DBDCF090");	
	
		for($i=0;$i<5;$i++)
		{
			$aes = new AES($p[$i], $imputKey, 128);
			$p[$i] = $aes->encrypt();
		}
		//foreach($p as $key=>$value)
        // echo $key."=>".$value."<br/>".$content."<br>";
		//echo "After encryption: ".$enc."<br/>".strlen($imputText);

		$post_data =array("p0"=>$p[0],"p1"=>$p[1],"p2"=>$p[2],"p3"=>$p[3],"p4"=>$p[4]);
		$post_data =json_encode($post_data);
		
		if( is_null($user_obj) ) { //数据库里没有这个号码
			$context->addParam("message", "numwrong");  //号码错误
		} 
		else {  //数据库里有号码
			 if((strtotime($_SESSION['time'])+60)<time()) {//将获取的缓存时间转换成时间戳加上60秒后与当前时间比较，小于当前时间即为过
					//session_destroy();
					unset($_SESSION['time']);
					$_SESSION['time'] = date("Y-m-d H:i:s");   
	        		$_SESSION['timecount']=1;  
		     }	
	        
        	if($_SESSION['timecount']){
        		$gets = $this->Post($post_data, $target); //发送验证码
        		$gets_arr = json_decode($gets,true);
				if ($gets_arr['code']==0) {
					$_SESSION['mobile_code'] = $mobile_code;
					$context->addParam("message", "sendsucceed"); //发送成功
				}
				elseif($gets_arr['code']==1){
					$context->addParam("message", "sendwrong");//发送失败
					echo "用户不存在";
				}
				elseif ($gets_arr['code']==2) {
					$context->addParam("message", "sendwrong");//发送失败
					echo "请求超时或者格式错误";
				}
				if ($gets_arr['error']) {
					$context->addParam("message", "sendwrong");//发送失败
					echo "发送失败";
				}
				$_SESSION['timecount']=0;
        	}	        	
        	else{
        		$context->addParam("message", "timein");
        	}	    		
		}			
		return true;	
	}
}

?>
