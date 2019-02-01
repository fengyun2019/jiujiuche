<?php
	header("Content-type: text/html; charset=utf-8");
	//url��ʽ  index.php?controller=��������&method=������
	require_once('config.php');
        $templale_dir="admin";
	require_once('framePHP/app.php');
	app::run($config);
?>