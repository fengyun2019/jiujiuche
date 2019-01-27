<?php
	$currentdir = dirname(__FILE__);
	include_once($currentdir.'/include.list.php');
	foreach($paths as $path){
		include_once($currentdir.'/'.$path);
	}
	class JJch{
		public static $controller;
		public static $method;
		private static $config;
		private static function init_db($database="mysql"){
			DB::init($database, self::$config['dbconfig']);
		}
		private static function init_view($dir='app'){
                    if($dir=="app"){
                        VIEW::init('Smarty', self::$config['appconfig']);                       
                    }elseif($dir=="admin"){
                       VIEW::init('Smarty', self::$config['adminconfig']); 
                    }else{
                        echo "ÅäÖÃÄ£°åÂ·¾¶´íÎó";
                    }                     
		
		}
		private static function init_controllor(){                    
			self::$controller = isset($_GET['controller'])?daddslashes($_GET['controller']):'index';
		}
		private static function init_method(){
			self::$method = isset($_GET['method'])?daddslashes($_GET['method']):'index';
		}
		public static function run($config,$template_dir=''){
			self::$config = $config;
			self::init_db();
			self::init_view($template_dir);
			self::init_controllor();
			self::init_method();
			C(self::$controller, self::$method);
		}
	}
?>