<?php
session_start();
$mysql_conf = array('host'=>'127.0.0.1:3306','db'=>'finalproject','db_user'=>'root','db_pwd'=>'123');
$tag = $_REQUEST['tag'];
$message = $_REQUEST['message'];
$random = uniqid();
$mysqli = mysqli_connect($mysql_conf['host'], $mysql_conf['db_user'], $mysql_conf['db_pwd'],$mysql_conf['db']);
if (!$mysqli) 
{die("could not connect to the database:n" . $mysqli->connect_error);}
$userNow = $_SESSION['userId'];
$newsId = $_SESSION['newsId'];
$sql = "INSERT INTO commentInfo (commentId,newsId, commentContent, userName, tag)VALUES ("."'$random'".","."'$newsId'".","."'$message'".","."'$userNow'".","."'$tag')";

if ($mysqli->query($sql) === TRUE) {
    header("Location:single-post.php?id=".$newsId);
        exit();
} else {
    echo "Error: ".$sql."<br>".$mysqli->error;
}
?>