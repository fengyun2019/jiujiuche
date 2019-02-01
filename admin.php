<?php
	header("Content-type: text/html; charset=gb18030");
	//url?这是一个引用文件 index.php?controller=controller&method=index
	require_once('config.php');
        $templale_dir="admin";
	require_once('framePHP/app.php');
	app::run($config);
?>
