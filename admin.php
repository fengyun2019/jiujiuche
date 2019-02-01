<?php
<<<<<<< HEAD
	header("Content-type: text/html; charset=utf-8");
	//url形式  index.php?controller=控制器名&method=方法名
	require_once('config.php');
        $templale_dir="admin";
	require_once('framePHP/JJch.php');
	JJch::run($config);
?>
=======
	header("Content-type: text/html; charset=gb18030");
	//url?这是一个引用文件 index.php?controller=controller&method=index
	require_once('config.php');
        $templale_dir="admin";
	require_once('framePHP/app.php');
	app::run($config);
?>
>>>>>>> 4b4fea9b66dcddedcfb0a3482a437820ca142422
