<?php
	$config = array(
		'adminconfig' => array(
			  'cache_dir' => 'data/cache',  'compile_dir' => 'data/template_c','template_dir'=>'tpl/admin'),
		'dbconfig' => array(
			'dbms'=>'mysql','dbhost' => 'localhost', 'dbuser'=>'jjch', 'dbpsw' => 'jjch' , 'dbname' => 'JJCHdata', 'dbcharset' => 'gb18030'),
                'appconfig'=>array(
                        'cache_dir' => 'data/cache',  'compile_dir' => 'data/template_c','template_dir'=>'tpl/app' )
	);
/*$smarty->template_dir = '/WWW/testSmarty/test/tpl';
//ģ���ļ������õ����ļ���·��
$smarty->compile_dir = '/WWW/testSmarty/test/template_c';
//�����ļ���·��
$smarty->cache_dir = '/WWW/testSmarty/test/cache';
//�������壬����Ĭ���ǹرյ�
$smarty->caching = true;
//����ı���ʱ��
$smarty->cache_lifetime = 120;*/
?>