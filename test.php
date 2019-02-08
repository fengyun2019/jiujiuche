<?php

header("Content-Type: text/html;charset=gb18030");
require_once "framePHP/libs/db/mysql.class.php";
require_once 'framePHP/libs/core/validate.class.php';
/*$mysql=new mysql(array());
$query="select * from che_admin";
$exe=$mysql->findAll($query);
$exe2=$mysql->findOne($query);
$exe3=$mysql->findResult($query,2,2);
var_dump("<p>".$query."</p>");
var_dump($exe);
echo "<hr>";
var_dump($exe2);
echo "<hr>";
var_dump($exe3);
//$exe4=$mysql->insert("che_admin",array('name'=>'风云','tel'=>'13281007262','city'=>'成都',"time"=>"now()"));
//print_r($exe4);
//$exe5=$mysql->update("che_admin", array('tel'=>"18512544100"), "id>13");
//print_r($exe5);
$exe6=$mysql->del("che_admin", "id>15");
print_r($exe6);
class dbname  {

    function __construct() {
        echo "<h1>我已经被执行了</h1>";
        
    }
    public function direct($param="5") {
        $bbj=3*$param;
        echo "<h2>".$bbj."</h2>";
        
    }

}
$obj=new dbname();
$s=3;
$obj->direct($s);
echo '<hr>';*/
$validate=new Validate();
$validate->doimg();
var_dump($validate->getCode());