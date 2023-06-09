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
    <title>TheGazette - News Magazine HTML5 Template | Single Post</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>


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
                                            <a class="nav-link" href="index.php">Today <span class="sr-only">(current)</span></a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <?php
                                            if (isset($_SESSION["userId"])) {
                                                $suggestionhref = "suggestion.php?id=".$_SESSION['userId'];
                                                $name = ''.$_SESSION["userId"];
                                            } else {
                                                $suggestionhref = "suggestion.html";
                                                $name = "LOGIN";
                                            }
                                            echo '<a class="nav-link" href="'.$suggestionhref.'">What\' for Me</a';
                                            ?>
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
                                            echo '<a class="nav-link" href="'.$href.'">'.$name.'</a';
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
                                    <div class="header-search-form mr-auto">
                                        <form action="search.php">
                                            <input type="search" placeholder="Input your keyword then press enter..." id="search" name="search">
                                            <input class="d-none" type="submit" value="submit">
                                        </form>
                                    </div>
                                    <!-- Search btn -->
                                    <div id="searchbtn">
                                        Search
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </div>
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
  $_SESSION['newsId'] = $id;
  $sql = "SELECT * FROM newsInfo WHERE newsId = ".$id;
  $selectResult = $mysqli->query($sql);
  if ($selectResult->num_rows > 0) {
    $selectRow = $selectResult ->fetch_assoc();
  }
?>
    <section class="single-post-area">
        <!-- Single Post Title -->
        <div class="single-post-title bg-img background-overlay" style="background-image: url(img/bg-img/1.jpg);">
            <div class="container h-100">
                <div class="row h-100 align-items-end">
                    <div class="col-12">
                        <div class="single-post-title-content">
                            <!-- Post Tag -->
                            <?php
                              $sqltag = "SELECT DISTINCT tagMessage FROM taginfo WHERE newsId = ".$id;
                              $tagResult = $mysqli->query($sqltag);
                              if ($tagResult->num_rows>0) {
                                while ($rowNow = $tagResult->fetch_assoc()) {
                                    if (!empty($rowNow['tagMessage'])){
                                        echo '<div class="gazette-post-tag">';
                                        echo '<a href="#" >'.$rowNow["tagMessage"].'</a>';
                                        echo ' </div>';
                                    }

                                }
                               
                              }
                            ?>

                            
                                
                            <h2 class="font-pt"><?php echo ''.$selectRow['newsTitle']; ?></h2>
                            <p><?php echo ''.$selectRow['newsTime']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="single-post-contents">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
                        <div class="single-post-text">
                            <?php echo ''.$selectRow['newsMessage']; ?>
                    </div>
                    </div>
                    <div class="col-12">
                        <div class="single-post-thumb">
                            <?php echo '<img src="'.$selectRow["newsPic"].'" alt="">'; ?>
                        </div>
                        
                </div>
                <style>
@import url('https://fonts.googleapis.com/css?family=Montserrat:600&display=swap');
.heart-btn{
  position: inherit;;
  /* top: 50%;
  left: 50%; */
  transform: translate(-50%,-50%);
}
.heartContent{
  padding: 13px 16px;
  display: flex;
  border: 2px solid #eae2e1;
  border-radius: 5px;
  cursor: pointer;
}
.heartContent.heart-active{
  border-color: #f9b9c4;
  background: #fbd0d8;
}
.heart{
  position: absolute;
  background: url("https://code.5g-o.com/wp-content/uploads/2020/03/img.png") no-repeat;
  background-position: left;
  background-size: 2900%;
  height: 90px;
  width: 90px;
  top: 50%;
  left: 21%;
  transform: translate(-50%,-50%);
}
.text{
  font-size: 21px;
  margin-left: 30px;
  color: grey;
  font-family: 'Montserrat',sans-serif;
}
.numb:before{
  font-size: 21px;
  margin-left: 7px;
  font-weight: 600;
  color: #9C9496;
  font-family: sans-serif;
}
.numb.heart-active:before{
  color: #000;
}
.text.heart-active{
  color: #000;
}
.heart.heart-active{
  animation: animate .8s steps(28) 1;
  background-position: right;
}
@keyframes animate {
  0%{
    background-position: left;
  }
  100%{
    background-position: right;
  }
}
                   </style> 
    <?php
$userId = $_SESSION["userId"];
$newsId = $_SESSION["newsId"];
$searchLike = "SELECT * from userlike where newsId = "."'$newsId'"."and userId = "."'$userId'";
$resultlike = $mysqli->query($searchLike);
if ($resultlike->num_rows > 0) {
    $heartclass = "heart heart-active";
    $contentclass = "heartContent heart-active";
    $textclass = "text heart-active";
    $numbclass = "numb heart-active";
} else {
    $heartclass = "heart";
    $contentclass = "heartContent";
    $textclass = "text";
    $numbclass = "numb";
}
    ?>
                <div class="heart-btn">
    <?php echo '<div class="'.$contentclass.'">';?>
    <?php echo '<span class="'.$heartclass.'"></span>' ?>
    <?php echo '<span class="'.$textclass.'">Like</span>' ?>
    <?php echo '<span class="'.$numbclass.'"></span>' ?>
      </div>
    </div>
    <script>
      $(document).ready(function(){
        $('.heartContent').click(function(){
          $('.content').toggleClass("heart-active")
          $('.text').toggleClass("heart-active")
          $('.numb').toggleClass("heart-active")
          $('.heart').toggleClass("heart-active")
          window.location = "click.php"
        });
      });
    </script>
            </div>
        </div>
    </section>

    <section class="gazette-post-discussion-area section_padding_100 bg-gray">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <!-- Comment Area Start -->
                    <div class="comment_area section_padding_50 clearfix">
                        <div class="gazette-heading">
                            <h4 class="font-bold">Discussion</h4>
                        </div>

                        <ol>
                                            <?php
                                        $selectSql = "SELECT * FROM commentInfo WHERE newsId = ".$id;
                                        $result = $mysqli->query($selectSql);
                                        if ($result->num_rows > 0) {
                                            // output data of each row
                                            while($row = $result->fetch_assoc()) {
                                                if (!$row["commentContent"]) {
                                                    continue;
                                                }
                                                echo '<li class="single_comment_area">';
                                                echo '<div class="comment-wrapper d-md-flex align-items-start">';
                                                echo '<div class="comment-author">';
                                                echo  '<img src="img/blog-img/25.jpg" alt="">';
                                                echo    '</div>';
                                                echo '<div class="comment-content">';
                                                echo '<h5>'.$row["userName"].'</h5>';
                                                echo '<span class="comment-date font-pt"> '.$row['commentTime'].'</span>';
                                                echo '<p>'.$row["commentContent"].'</p>';
                                                echo '</div>';
                                                echo '</div>';
                                              //echo "id: " . $row["userId"]. " - Name: " . $row["userName"]. " " . $row["email"]. "<br>";
                                            }
                                          } else {
                                            echo "0 results";
                                          }
                                        ?>
                            </li>
                        </ol>
                    </div>
                    <div class="comment_area section_padding_50 clearfix">
                        <div class="gazette-heading">
                            <h4 class="font-bold">Vote for your Opinion</h4>
                        </div>

                        <ol>
                            <?php
                            $dataPoints = array (array("y"=>$selectRow["endorse"],"label"=>"Endorse"),
                        array("y"=>$selectRow["oppose"],"label"=>"Oppose")
                        );

                            ?>
                            <head>
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "# of People Endorse this news"
	},
	axisY: {
		title: "# of People",
		includeZero: true,
		// prefix: "$",
		// suffix:  "k"
	},
	data: [{
		type: "bar",
		yValueFormatString: "#,##0",
		indexLabel: "{y}",
		indexLabelPlacement: "inside",
		indexLabelFontWeight: "bolder",
		indexLabelFontColor: "white",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
<form action = "vote.php">
 <fieldset>
    <legend>Select a maintenance drone:</legend>

    <div>
      <input type="radio" id="huey" name="choise" value="endorse"
             checked>
      <label for="endorse">Endorse it!</label>
    </div>

    <div>
      <input type="radio" id="dewey" name="choise" value="oppose">
      <label for="oppose">Oppose it!</label>
    </div>
    <input type = 'submit'/>
</fieldset>
</form>


                        </ol>
                    </div>
                    <!-- Leave A Comment -->
                    <div class="leave-comment-area clearfix">
                        <div class="comment-form">
                            <div class="gazette-heading">
                                <h4 class="font-bold">leave a comment</h4>
                            </div>
                            <!-- Comment Form -->
                            <form action="submit.php">
                                <!-- <div class="form-group">
                                    <input type="text" class="form-control" id="contact-name"name = "tag" placeholder="Enter Your tag">
                                </div> -->
                                <div class="form-group">
                                    <textarea class="form-control" name="message" id="message" cols="30" name = "message"rows="10" placeholder="Message"></textarea>
                                </div>
                                <button type="submit" class="btn leave-comment-btn">SUBMIT </button>
                            </form>
                        </div>
                    </div>
                    <div class="leave-comment-area clearfix">
                        <div class="comment-form">
                            <div class="gazette-heading">
                                <h4 class="font-bold">leave a tag</h4>
                            </div>
                            <!-- Comment Form -->
                            <form action="submittags.php">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="contact-name"name = "tag" placeholder="Enter Your tag">
                                </div>
                                <!-- <div class="form-group">
                                    <textarea class="form-control" name="message" id="message" cols="30" name = "message"rows="10" placeholder="Message"></textarea>
                                </div> -->
                                <button type="submit" class="btn leave-comment-btn">SUBMIT </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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