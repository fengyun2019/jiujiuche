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
    echo "���ݿ����ӳɹ�<br>";
} else {
    echo "error";
}
/*$sql="insert into che_admin values ('','��ΰ','18512544100','','�Ͼ�')";
$result=$con->query($sql);
if($result){
    echo "���ݲ���ɹ�";
}else{
    echo "���ݲ���ʧ��";
}*/
$select="select * from che_admin limit 5";
$result=$con->query($select);
$arra=$result->fetch_assoc();
print_r($arra);