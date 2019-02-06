<?php

header("Content-Type: text/html;charset=gb18030");
require_once "framePHP/libs/db/mysql.class.php";
$mysql=new mysql(array());
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