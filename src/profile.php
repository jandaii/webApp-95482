<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Personal Profile</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="style2.css">

    <!-- Responsive CSS -->
    <link href="css/responsive.css" rel="stylesheet">

</head>

<body>
    <!-- Header Area Start -->
    <header class="header-area">
        <!-- Middle Header Area -->
        <div class="middle-header">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <!-- Logo Area -->
                    <div class="col-12 col-md-4">
                        <div class="logo-area">
                            <a href="index.php"><img src="img/core-img/logo.png" alt="logo"></a>
                        </div>
                    </div>
                    <!-- Header Advert Area -->
                    <div class="col-12 col-md-8">
                        <div class="header-advert-area">
                            <a href="#"><img src="img/bg-img/top-advert.png" alt="header-add"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bottom Header Area -->
        <div class="bottom-header">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <div class="main-menu">
                            <nav class="navbar navbar-expand-lg">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#gazetteMenu" aria-controls="gazetteMenu" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i> Menu</button>
                                <div class="collapse navbar-collapse" id="gazetteMenu">
                                    <ul class="navbar-nav mr-auto">
                                        <li class="nav-item active">
                                            <a class="nav-link" href="index.php">Today </a>
                                        </li>
                                        <li class = "nav-item dropdown">
                                            <?php 
                                            echo '<a class="nav-link" href="profile.php?id='.$_GET['id'].'">Dashboard <span class="sr-only">(current)</span></a>';
                                            ?>
                                        </li>
                                        <li class = "nav-item dropdown">
                                            <?php 
                                            echo '<a class="nav-link" href="personalGoal.php?id='.$_GET['id'].'">Your Goal <span class="sr-only">(current)</span></a>';
                                            ?>
                                        </li>
                                        <li class = "nav-item dropdown">
                                        <a class="nav-link" href="likednews.php">LikedNews <span class="sr-only">(current)</span></a>
</li>
                                        <li class="nav-item dropdown">
                                            <?php 
                                            if (isset($_SESSION["userId"])) {
                                                $href = "profile.php?id=".$_SESSION['userId'];
                                                $name = ''.$_SESSION["userId"];
                                            } else {
                                                $href = "signin.html";
                                                $name = "LOGIN";
                                            }
                                            echo '<a class="nav-link" href="'.$href.'">'.$name.'</a>';
                                            ?>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Set</a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="signout.php" onclick = "signout.php">Sign out</a>
                                            </div>
                                        </li>
                                    </ul>
                                    <!-- Search Form -->
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Area End -->
    <?php
    $mysql_conf = array('host'=>'127.0.0.1:3306','db'=>'finalproject','db_user'=>'root','db_pwd'=>'123');
    $mysqli = mysqli_connect($mysql_conf['host'], $mysql_conf['db_user'], $mysql_conf['db_pwd'],$mysql_conf['db']);
    if (!$mysqli) 
    {die("could not connect to the database:n" . $mysqli->connect_error);} 
    $id = $_GET['id'];
    $selectSql = "SELECT tagMessage, COUNT(distinct tagId) as count FROM taginfo where userName = "."'$id'"."group by tagMessage ";
    $selectTotal = "SELECT count(distinct tagId) as sum from taginfo where userName = "."'$id'";
    $totalResult = $mysqli->query($selectTotal);
    if ($totalResult->num_rows >0) {
        $totalRow = $totalResult->fetch_assoc();
        $totalR = $totalRow["sum"];
    }
    $tagResult = $mysqli->query($selectSql);
    $dataPoints = array();
    if ($tagResult->num_rows > 0) {
    while ($row = $tagResult->fetch_assoc()) {
        $dataPoints[] = array("label"=>$row['tagMessage'], "y" =>$row['count'] * 100/$totalR);
    }
}
    ?>

<?php
    $selectSql2 = "SELECT tagTime, COUNT(distinct tagId) as count FROM taginfo where userName = "."'$id'"."group by tagTime order by tagTime ";
    $tagResult2 = $mysqli->query($selectSql2);
    $dataPoints2 = array();
    if ($tagResult2->num_rows > 0) {
    while ($rowNow = $tagResult2->fetch_assoc()) {
        $dataPoints2[] = array("label"=>$rowNow['tagTime'], "y" =>$rowNow['count']);
    }
}
    $selectSql3 = "SELECT commentTime, COUNT(distinct commentId) as count FROM commentinfo where userName = "."'$id'"."group by commentTime order by commentTime ";
    $tagResult3 = $mysqli->query($selectSql3);
    $dataPoints3 = array();
    if ($tagResult3->num_rows > 0) {
    while ($rowNow3 = $tagResult3->fetch_assoc()) {
        $dataPoints3[] = array("label"=>$rowNow3['commentTime'], "y" =>$rowNow3['count']);
    }
}
    ?>
<head>
<script>
window.onload = function() {
    var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "Favorate tags"
	},
	subtitles: [{
		text: ""
	}],
	data: [{
		type: "pie",
		yValueFormatString: "#,##0.00\"%\"",
		indexLabel: "{label} ({y})",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
var chart2 = new CanvasJS.Chart("chartContainer2", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Tagging Timeline"
	},
	axisY: {
		title: "Tagging number"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## tonnes",
		dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	}]
});
chart2.render();
var chart3 = new CanvasJS.Chart("chartContainer3", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Comment Timeline"
	},
	axisY: {
		title: "Comment number"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## tonnes",
		dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
	}]
});
chart3.render();
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<div id="chartContainer2" style="height: 370px; width: 100%;"></div>
<div id="chartContainer3" style="height: 370px; width: 100%;"></div>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>



    <!-- Footer Area Start -->
    <footer class="footer-area bg-img background-overlay" style="background-image: url(img/bg-img/4.jpg);">
        <!-- Top Footer Area -->
        <div class="top-footer-area section_padding_100_70">
            <div class="container">
                <div class="row">
                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                        <div class="single-footer-widget">
                            <div class="footer-widget-title">
                                <h4 class="font-pt">Regions</h4>
                            </div>
                            <ul class="footer-widget-menu">
                                <li><a href="#">U.S.</a></li>
                                <li><a href="#">Africa</a></li>
                                <li><a href="#">Americas</a></li>
                                <li><a href="#">Asia</a></li>
                                <li><a href="#">China</a></li>
                                <li><a href="#">Europe</a></li>
                                <li><a href="#">Middle</a></li>
                                <li><a href="#">East</a></li>
                                <li><a href="#">Opinion</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                        <div class="single-footer-widget">
                            <div class="footer-widget-title">
                                <h4 class="font-pt">Fashion</h4>
                            </div>
                            <ul class="footer-widget-menu">
                                <li><a href="#">Election 2016</a></li>
                                <li><a href="#">Nation</a></li>
                                <li><a href="#">World</a></li>
                                <li><a href="#">Our Team</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                        <div class="single-footer-widget">
                            <div class="footer-widget-title">
                                <h4 class="font-pt">Politics</h4>
                            </div>
                            <ul class="footer-widget-menu">
                                <li><a href="#">Business</a></li>
                                <li><a href="#">Markets</a></li>
                                <li><a href="#">Tech</a></li>
                                <li><a href="#">Luxury</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                        <div class="single-footer-widget">
                            <div class="footer-widget-title">
                                <h4 class="font-pt">Featured</h4>
                            </div>
                            <ul class="footer-widget-menu">
                                <li><a href="#">Football</a></li>
                                <li><a href="#">Golf</a></li>
                                <li><a href="#">Tennis</a></li>
                                <li><a href="#">Motorsport</a></li>
                                <li><a href="#">Horseracing</a></li>
                                <li><a href="#">Equestrian</a></li>
                                <li><a href="#">Sailing</a></li>
                                <li><a href="#">Skiing</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                        <div class="single-footer-widget">
                            <div class="footer-widget-title">
                                <h4 class="font-pt">FAQ</h4>
                            </div>
                            <ul class="footer-widget-menu">
                                <li><a href="#">Aviation</a></li>
                                <li><a href="#">Business</a></li>
                                <li><a href="#">Traveller</a></li>
                                <li><a href="#">Destinations</a></li>
                                <li><a href="#">Features</a></li>
                                <li><a href="#">Food/Drink</a></li>
                                <li><a href="#">Hotels</a></li>
                                <li><a href="#">Partner Hotels</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                        <div class="single-footer-widget">
                            <div class="footer-widget-title">
                                <h4 class="font-pt">+More</h4>
                            </div>
                            <ul class="footer-widget-menu">
                                <li><a href="#">Fashion</a></li>
                                <li><a href="#">Design</a></li>
                                <li><a href="#">Architecture</a></li>
                                <li><a href="#">Arts</a></li>
                                <li><a href="#">Autos</a></li>
                                <li><a href="#">Luxury</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Footer Area -->
        <div class="bottom-footer-area">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center">
                    <div class="col-12">
                        <div class="copywrite-text">
                            <p>
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | by Colorlib- More Templates <a href="http://www.mobancss.com/" target="_blank" title="模板在线">模板在线</a> - Collect from <a href="http://www.mobancss.com/" title="网页模板" target="_blank">网页模板</a>

</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Area End -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>

</body>

</html>