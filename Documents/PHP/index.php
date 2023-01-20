<?php
session_start();
 
require_once "../../Database/config.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="apple-touch-icon" sizes="180x180" href="../../Images/Favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../../Images/Favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../../Images/Favicon/favicon-16x16.png">
  <link rel="manifest" href="../../Images/Favicon/site.webmanifest">
  <link rel="stylesheet" href="../CSS/styles.css ">
  <link rel="script" href="../JS/button-script.js">
  <script src="../JS/button-script.js" defer></script>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>318 Nutrition | Home</title>
</head>
<body>
  <nav class="navbar">
    <div onclick="location.href='../../Documents/PHP/index.php';" style="cursor: pointer;" class="brand-title">318 Nutrition</div>
    <a href="#" class="toggle-button">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </a>
    <div class="navbar-links">
      <ul>
        <li><a href="../../Documents/PHP/index.php">HOME</a></li>
        <li><a href="../PHP/about.php">ABOUT 318</a></li>
      <div class="dropdown">
        <li><a class="dropbtn" href="../../Documents/PHP/programs.php">PROGRAMS</a></li>
        <div class="dropdown-content">
      <!--<a href="#">Monthly Packages</a>
      <a href="# ">Couples Nutrition</a>
      <a href="#">Adolescent Nutrition</a>
      <a href="#">Workshops/Seminars</a>-->
    </div>
    </div>
        <li><a href="../PHP/macro-calculator.php">MACRO CALCULATOR</a></li>
<?php
        if(isset($_SESSION["loggedin"]) == true)  
        {
          echo '<div class="dropdown">
                <li><a class="dropbtn" href="../PHP/admin-panel.php">MY PLAN</a></li>
                <div class="dropdown-content">
                <a href="../PHP/account-sign-out.php">Log Out</a>
                </div>
                </div>';
        }
        else 
        {
         echo '<li><a href="../PHP/admin-panel.php">MY PLAN</a></li>';
        }
?> 
        <div class="contact">
          <li><a href="../PHP/contact.php">CONTACT</a></li>
        </div>   
      </ul>
    </div>
  </nav>

  

  <div class="hero-image">
  <div class="hero-text">
    <h1>Suttie 318</h1>
  </div>
</div>



<div class="container">
  <div class="row">
    <div class="column-66">
    <h1 style=" text-align: center; font-size: 24px;"><b>Nutritional Programming</b></h1>
    <p style=" text-align: center;">
        
        individualized-sustainable-supported
        
         </p>
    </div>
    <div class="column-33">
    <img src="../../Images/ref1.jpg" class="statement-image"srcset="../../Images/ref1.jpg 480w,../../Images/ref1.jpg 800w" sizes="(max-width: 600px) 480px,800px">
    </div>
  </div>
</div>


<div class="container">
  <div class="row">
    <div class="column-33">
    <img src="../../Images/index2.jpg" class="statement-image" style="width:75%;height:75%;">
    </div>
    <div class="column-66">
      <h1 style=" text-align: center; font-size: 24px;"><b>"I have so much more energy!"</b></h1>
    <p style = "text-align:center;">- heather <br>
    (school teacher, Lethbridge)</p>
    </div>
  </div>
</div>

</body>

<footer>
  <div class="footer">
    <div class="button-format">
    <a href="../PHP/contact.php">CONTACT ME</a>
    </div>
    <br>
  <p>Copyright © 318 Nutrition<br></p>
</div>
</footer>

</html>