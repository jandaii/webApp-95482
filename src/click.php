<?php
session_start();
$mysql_conf = array('host'=>'127.0.0.1:3306','db'=>'finalproject','db_user'=>'root','db_pwd'=>'123');
  $mysqli = mysqli_connect($mysql_conf['host'], $mysql_conf['db_user'], $mysql_conf['db_pwd'],$mysql_conf['db']);
  if (!$mysqli) 
  {die("could not connect to the database:n" . $mysqli->connect_error);} 
$userid = $_SESSION["userId"];
$random = uniqid();

$id = $_SESSION["newsId"];
$searchLike = "SELECT * from userlike where newsId = "."'$id'"."and userId = "."'$userid'";
// echo "".$searchLike;
$resultlike = $mysqli->query($searchLike);
if ($resultlike->num_rows > 0) {
    $sql = "DELETE FROM userlike where newsId = "."'$id'"." and userId = "."'$userid'"." and Action = 'like'";
    $mysqli->query($sql);
} else {
    
    $sql = "INSERT INTO userlike VALUES ("."'$random'".","."'$id'".", "."'$userid'".",'like')";
    $mysqli->query($sql);
}
header("Location:single-post.php?id=".$id);
exit();


?>