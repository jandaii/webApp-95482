<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Love React Animation</title>
    <link rel="stylesheet" href="css/like.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  </head>
  <body>
    <div class="heart-btn">
      <div class="content">
        <span class="heart"></span>
        <span class="text" >Like</span>
        <span class="numb"></span>
      </div>
    </div>
    <script>
      $(document).ready(function(){
        $('.content').click(function(){
          $('.content').toggleClass("heart-active")
          $('.text').toggleClass("heart-active")
          $('.numb').toggleClass("heart-active")
          $('.heart').toggleClass("heart-active")
        });
      });
    </script>

  </body>
</html>