<?php
	header("Content-type: text/html; charset=gb18030");
	//url?����һ�������ļ� index.php?controller=��������&method=������
	$templale_dir="admin";
        require_once('config.php');
       	require_once('framePHP/app.php');
	app::run($config,$templale_dir);
