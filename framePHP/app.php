<?php
	$currentdir = dirname(__FILE__);
        echo "打印文件路径：".$currentdir."/include.list.php<br/>";
	include_once($currentdir.'/include.list.php');
	foreach($paths as $path){
		include_once($currentdir.'/'.$path);
	}
	class app{
		public static $controller;
		public static $method;
		private static $config;
		private static function init_db($database="mysql"){
                    DB::init($database, self::$config['dbconfig']);
		}
		private static function init_view($dir='app'){
                    echo "<h1>dir=".$dir."</h1>";
                    if($dir!=""){
                        VIEW::init('Smarty', self::$config['appconfig']);  
                        echo "配置APP模版路径成功";
                    }elseif($dir=="admin"){
                       VIEW::init('Smarty', self::$config['adminconfig']); 
                       echo "配置admin模版路径成功";
                    }else{
                        echo "配置模板路径错误";
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
                        echo "<hr>";  //var_dump(self::$config);
			self::init_db();
                        echo "template_dir=".$template_dir;
			self::init_view();
                        
			self::init_controllor();
			self::init_method();
                        echo "controller=".self::$controller."<br/>method=".self::$method;
			C(self::$controller, self::$method);
		}
	}
?>