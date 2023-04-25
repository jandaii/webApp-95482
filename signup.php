<?php
$mysql_conf = array('host'=>'127.0.0.1:3306','db'=>'finalproject','db_user'=>'root','db_pwd'=>'123');
$username = $_REQUEST['username'];
$useremail = $_REQUEST['email'];
$password = $_REQUEST['password'];
$mysqli = mysqli_connect($mysql_conf['host'], $mysql_conf['db_user'], $mysql_conf['db_pwd'],$mysql_conf['db']);
if (!$mysqli) 
{die("could not connect to the database:n" . $mysqli->connect_error);}

 $sql = "INSERT INTO userinfo VALUES ("."'$username'".", "."'$useremail'".","."'$password')";
//$sql = "INSERT INTO userinfo VALUES ('username', 'useremail', 'password')";

if ($mysqli->query($sql) === TRUE) {
    echo "Inserted successfully";
} else {
    echo "Error: ".$sql."<br>".$mysqli->error;
}
?>