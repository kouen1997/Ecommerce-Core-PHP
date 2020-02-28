<?php
include 'include/head.php';
include 'include/nav.php';

?>
<html>
<head>
<title>EJV Enterprises</title>
</head>

<body background='images/17236913_1212720218848822_702807660_o.jpg'>
<style>

.header{
background-image: url(images/17236913_1212720218848822_702807660_o.jpg);
height: 1000%;
width: 50%;

}
#label{
position:fixed;
margin-top: 80px;
height:500px;
width:600px;
border: 1px solid black;
background: #000;
opacity: 0.5;
}
.box{
margin-top: 170px;
margin-left: 30px;

}
#wrapper{
margin-top:190px;
margin-left: 650px;

}
#slider1{

height:2000%;
width: 700px;
}
</style>

<div class='header'>
	
	<div class='container1'>		
<div class='col-md-3' id='label'>
<div class="box">
  <font color='white' size='5'><h1>Welcom, EJV Enterprises!</h1>
  <p>EJV Enterprises aims to integrigate a culture of
  continuous improvement within the company.
  This is very reason why EJV was certified
  to the prestigious ISO 9001:2000 International
  Standard for quality.</p></font>
  <p><a class="btn btn-primary btn-lg" href="#" role="button">Read More</a></p>
</div>
</div>
</div>

</div>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
 
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="css/responsiveslides.css">
  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
  <script src="js/responsiveslides.min.js"></script>
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
      <li><img src="images/17194126_1212716832182494_1475081463_o.jpg" alt=""></li>
      <li><img src="images/17195399_1212717488849095_1997372387_o.jpg" alt=""></li>
      <li><img src="images/17200294_1212718678848976_1107545937_o.jpg" alt=""></li>
	  <li><img src="images/17236940_1212719025515608_1960879006_o.jpg" alt=""></li>
    </ul>




    
  </div>
</body>
</html>

</body>
</html>