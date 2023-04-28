<?php
session_start();
$_SESSION["userId"] = NULL;
header("Location:index.php");
exit();
?>