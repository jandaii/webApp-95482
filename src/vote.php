<?php
session_start();
$mysql_conf = array('host'=>'127.0.0.1:3306','db'=>'finalproject','db_user'=>'root','db_pwd'=>'123');
$choise = $_REQUEST['choise'];
// echo "".$choise;
$mysqli = mysqli_connect($mysql_conf['host'], $mysql_conf['db_user'], $mysql_conf['db_pwd'],$mysql_conf['db']);
if (!$mysqli) 
{die("could not connect to the database:n" . $mysqli->connect_error);}
$id = $_SESSION["newsId"];
$userId = $_SESSION["userId"];
$sql = "SELECT * FROM newsinfo WHERE newsId = "."'$id'"."";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc() ;
    echo "".$row[$choise];
    $numNow = $row[$choise];    
  } else {
    echo '<script>alert("Your password might be fault")</script>';
  }
  $numNow = $numNow + 1;
$sqlUpdate = "UPDATE newsinfo set ".$choise." = ".$numNow;
$mysqli->query($sqlUpdate);
header("Location:single-post.php?id=".$id);
exit();
// //$sql = "INSERT INTO userinfo VALUES ('username', 'useremail', 'password')";
// $result = $mysqli->query($sql);
// // if ($mysqli->query($sql) === TRUE) {
// //     echo "Inserted successfully";
// // } else {
// //     echo "Error: ".$sql."<br>".$mysqli->error;
// // }
// if ($result->num_rows > 0) {
//     // output data of each row
//     while($row = $result->fetch_assoc()) {
//       session_start();

//       $_SESSION['userId'] = $row['userName'];
//       header("Location:index.php");
//         exit();    }
//   } else {
//     echo '<script>alert("Your password might be fault")</script>';
//   }
  
  
  ?>