
<?php
	/****************************************************************************************
	 * 作          者：Sakya
	 * 创建日期：	2014.12.20
	 * 描    述：	一个数据库管理封装类
	 * 注意事项：	引用文件sys_conf.inc, 并要求在sys_conf完成配置以及初始化接口init()的定义
	 * 遗留  BUG：	无
	 * 修改日期：	2014.12.29
	 ****************************************************************************************/

	require_once( "sys_conf.inc" );
	
	header("Content-type: text/html; charset=utf-8");
	
	class DBManager
	{
		private $host;				//服务器名
		private $user;				//用户名
		private $pwd;				//密码
		private $name;				//数据库名
		private $connecttion;		//连接标识
		
		
		function __construct()
		{
			//使用sys_conf类的静态属性
			$this->host = sys_conf::$DBHOST;
			$this->user = sys_conf::$DBUSER;
			$this->pwd = sys_conf::$DBPWD;
			$this->name = sys_conf::$DBNAME;
			
			$this->connecttion = mysql_connect( $this->host, $this->user, $this->pwd );
			
			//检查数据库连接错误
			if(!$this->connecttion)
			{
				die('Could not connect: ' . mysql_error());
			}
			mysql_query("SET NAMES utf8", $this->connecttion);
			$db_exist = mysql_query( "USE $this->name", $this->connecttion );
			
			//如果数据库不存在，实行初始化
			if ( !$db_exist )
			{
				mysql_query( "CREATE DATABASE $this->name DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci" );
				mysql_query( "USE $this->name", $this->connecttion );
				
				sys_conf::init();	
			}
		}
		
		function __destruct()
		{
			mysql_close ( $this->connecttion );
		}
		
		function __get( $property_name )
		{
			if ( isset( $this->$property_name ) )
				return ( $this->$property_name );
			else
				return ( NULL );
		}
		
		function __set( $property_name, $value )
		{
			$this->$property_name = $value;
		}
		
		//增删改
		function excute( $sql )
		{
			return mysql_query( $sql );
		} 
		
		//查询，返回值是一个stdClass Object类型的数组
		function query( $sql )
		{
			$result_array = array();
			$i = 0;
			$query_result = mysql_query( $sql,  $this->connecttion );
			while ( $row = mysql_fetch_object( $query_result ) )
			{
				$result_array[$i++] = $row;
			}
			return $result_array;
		}	
	}
?>