<?php
	header("Content-type: text/html; charset=gb18030");
	//url?����һ�������ļ� index.php?controller=��������&method=������
	require_once('config.php');
        $templale_dir="admin";
	require_once('framePHP/app.php');
	app::run($config);
