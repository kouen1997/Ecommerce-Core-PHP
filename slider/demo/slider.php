<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
 
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="../responsiveslides.css">
  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
  <script src="../responsiveslides.min.js"></script>
  <script>
    // You can also use "$(window).load(function() {"
    $(function () {

      // Slideshow 1
      $("#slider1").responsiveSlides({
        maxwidth: 800,
        speed: 800
      });

 
    });
  </script>
</head>
<body>
  <div id="wrapper">
   
    <ul class="rslides" id="slider1">
      <li><img src="images/1.jpg" alt=""></li>
      <li><img src="images/2.jpg" alt=""></li>
      <li><img src="images/3.jpg" alt=""></li>
    </ul>




    
  </div>
</body>
</html>
