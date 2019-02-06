<?php
	header("Content-type: text/html; charset=gb18030");
	//url?这是一个引用文件 index.php?controller=控制器名&method=方法名
	$templale_dir="admin";
        require_once('config.php');
       	require_once('framePHP/app.php');
	app::run($config,$templale_dir);
