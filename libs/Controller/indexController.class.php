<?php
	class indexController{
		function index(){
			VIEW::assign(array('title'=>'���ֵ�һ��', 'author'=>'���ĵ�һ��'));
			VIEW::display('test.html');
		}
	}
?>