<?php
	header("Content-type: text/html; charset=utf-8");
	//url�1�7�1�7�0�4  index.php?controller=�1�7�1�7�1�7�1�7�1�7�1�7�1�7�1�7&method=�1�7�1�7�1�7�1�7�1�7�1�7
	require_once('config.php');
        $templale_dir="admin";
	require_once('framePHP/app.php');
	app::run($config);
?>