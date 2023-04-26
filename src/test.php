<?php
$mysql_conf = array('host'=>'127.0.0.1:3306','db'=>'finalproject','db_user'=>'root','db_pwd'=>'123');
$mysqli = mysqli_connect($mysql_conf['host'], $mysql_conf['db_user'], $mysql_conf['db_pwd'],$mysql_conf['db']);
if (!$mysqli) 
{die("could not connect to the database:n" . $mysqli->connect_error);} 
$selectSql = "SELECT * FROM newsinfo ORDER BY newsTime DESC LIMIT 1 ";
$result = $mysqli->query($selectSql);
if ($result->num_rows > 0) {
    $row = $result ->fetch_assoc();
        echo '<h2 class = "font-pt">'.$row["newsTitle"].'</h2>';
                            echo '<p class="gazette-post-date">'.$row['newsTime'].'</p>';
                            echo '<div class="blog-post-thumbnail my-5">';
                            echo ' <img src="'.$row["newsPic"].'" alt="post-thumb">';
                            echo '</div>';
                         }
?>