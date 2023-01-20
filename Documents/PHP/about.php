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
  <title>318 Nutrition | About</title>
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
     <!-- <a href="#">Monthly Packages</a>
      <a href="# ">Couples Nutrition</a>
      <a href="#">Adolescent Nutrition</a>
      <a href="#">Workshops/Seminars</a>
      -->
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

  <div class="hero-image-1">
  <div class="hero-text">
    <h1>Suttie 318</h1>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="column-33">
    <img src="../../Images/about2.jpeg" class="statement-image" srcset="../../Images/about2.jpeg 480w,../../Images/about2.jpeg 800w" sizes="(max-width: 600px) 480px,800px">
    </div>
    <div class="column-66">
      <h1 style=" text-align: center; font-size: 24px;"><b>A Note from Lynn:</b></h1>
    <p style = "text-align:center;">
   
I value this process and relationship so much that I continue to have my own nutrition coach that I rely on. It is not that I have nutrition "all figured out" but rather, I have a decade of experience in making nutrition a priority in my life, I hope to share what I have learned and continue to learn. I aim to be your ally and teammate to help your nutrition work for your life. You're eating anyways - why not do it in a way that makes you feel happier, stronger, more energetic, and gets you closer to your goals.</p>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="column-66">
    <h1 style=" text-align: center; font-size: 24px;"><b>History</b></h1>
    <p style=" text-align: center;">
        
       Lynn Suttie is originally from Calgary AB, she moved to Lethbridge for University where she was a U of L pronghorn for the Woman's Rugby team from 2007 - 2013, winning 5 Can West titles, and 3 National Championships. Lynn graduated with a Kinesiology degree, as well as an Education degree. She then found Olympic Weightlifting, enhancing her training experience. Lynn began dedicating much of her attention and time to nutrition. 
​Lynn has a speciality in adolescent nutrition and performance, as well as a special interest in couple and household nutrition. 
Lynn is certified through Precision Nutrition with individual and group coaching experience. 
        
         </p>
    </div>
    <div class="column-33">
    <img src="../../Images/about3.jpg" class="statement-image" srcset="../../Images/about3.jpg 580w,../../Images/about3.jpg 800w" sizes="(max-width: 600px) 580px,800px">
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