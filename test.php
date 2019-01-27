<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
header("Content-Type: text/html;charset=gb18030");
$dbhost="localhost";
$dbuser="jjch";
$dbpsw="jjch";
$database="jjchdata";
$con=mysqli_connect("localhost",$dbuser,$dbpsw,$database);
if($con){
    echo "数据库连接成功<br>";
} else {
    echo "error";
}
/*$sql="insert into che_admin values ('','陈伟','18512544100','','南京')";
$result=$con->query($sql);
if($result){
    echo "数据插入成功";
}else{
    echo "数据插入失败";
}*/
$select="select * from che_admin limit 5";
$result=$con->query($select);
$arra=$result->fetch_assoc();
print_r($arra);