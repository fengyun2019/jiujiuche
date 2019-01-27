<?php
	$config = array(
		'adminconfig' => array(
			  'cache_dir' => 'data/cache',  'compile_dir' => 'data/template_c','template_dir'=>'tpl/admin'),
		'dbconfig' => array(
			'dbhost' => 'localhost', 'dbuser'=>'jjch', 'dbpsw' => 'jjch' , 'dbname' => 'JJCHdata', 'dbcharset' => 'utf8'),
                'appconfig'=>array(
                        'cache_dir' => 'data/cache',  'compile_dir' => 'data/template_c','template_dir'=>'tpl/app' )
	);
/*$smarty->template_dir = '/WWW/testSmarty/test/tpl';
//模板文件编译后得到的文件的路径
$smarty->compile_dir = '/WWW/testSmarty/test/template_c';
//缓冲文件的路径
$smarty->cache_dir = '/WWW/testSmarty/test/cache';
//开启缓冲，缓冲默认是关闭的
$smarty->caching = true;
//缓冲的保留时间
$smarty->cache_lifetime = 120;*/
?>