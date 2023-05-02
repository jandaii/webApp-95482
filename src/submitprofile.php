<?php
session_start();
$dob = $_REQUEST["DOB"];
$phoneNum = $_REQUEST["phoneNum"];
$userId = $_SESSION["userId"];
$mysql_conf = array('host'=>'127.0.0.1:3306','db'=>'finalproject','db_user'=>'root','db_pwd'=>'123');
$mysqli = mysqli_connect($mysql_conf['host'], $mysql_conf['db_user'], $mysql_conf['db_pwd'],$mysql_conf['db']);
if (!$mysqli) 
{die("could not connect to the database:n" . $mysqli->connect_error);}
$sql = "UPDATE userInfo SET DOB  = "."'$dob'".", phoneNum  = "."'$phoneNum'"." WHERE userName = "."'$userId'"."";
//$sql = "INSERT INTO userinfo VALUES ('username', 'useremail', 'password')";
$result = $mysqli->query($sql);
header("Location:personalGoal.php?id=".$userId);
exit();
?>