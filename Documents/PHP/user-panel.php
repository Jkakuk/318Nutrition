<!-- ##################################################################################
#Script Name: Admin panel
#Description: Admin functions
#Author: Mathew Philp
#Date: 2022-03-02
################################################################################## -->
<?php
session_start();

require_once "../../Database/config.php";

// Check if the user is logged in, if not then redirect them to the login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    header("location: login.php");
    exit;
}

if ($_SESSION["Employee"] == 1)
{
    header("location:  ../../Documents/PHP/admin-panel.php");
    exit;
}


$currentTime = date("h:i:sa");
$time = strtotime($currentTime);

$hour = date('H');


    if ($hour >= 17) 
    {
      $welcome_msg = "Good Evening, ";
    } 
    elseif ($hour >= 12) 
    {
      $welcome_msg = "Good Afternoon, ";
    } 
    elseif ($hour < 12) 
    {
      $welcome_msg ="Good Morning, ";
    }


$id = $_SESSION["ACC_ID"];
$result = $link->query("SELECT * FROM Accounts WHERE ACC_ID='$id'");
$row = $result->fetch_assoc();



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="apple-touch-icon" sizes="180x180" href="../../Images/Favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../../Images/Favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../../Images/Favicon/favicon-16x16.png">
  <link rel="manifest" href="../../Images/Favicon/site.webmanifest">
  <link rel="script" href="../JS/button-script.js">
  <link rel="stylesheet" href="../CSS/boot-strap.css ">
  <link rel="stylesheet" href="../CSS/styles.css ">
  <link rel="script" href="../JS/button-script.js">
  <script src="../JS/button-script.js" defer></script>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>318 Nutrition | <?php echo htmlspecialchars($_SESSION["FName"]);?> <?php echo htmlspecialchars($_SESSION["LName"]); ?></title>
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
      <!--<a href="#">Monthly Packages</a>-->
      <!--<a href="# ">Couples Nutrition</a>-->
      <!--<a href="#">Adolescent Nutrition</a>-->
      <!--<a href="#">Workshops/Seminars</a>-->
    </div>
    </div>
    <li><a href="../PHP/macro-calculator.php">MACRO CALCULATOR</a></li>
    <div class="dropdown">
        <li><a class="dropbtn" href="../PHP/admin-panel.php">MY PLAN</a></li>
        <div class="dropdown-content">
      <a href="../PHP/account-sign-out.php">Log Out</a>
    </div>
    </div>
        <div class="contact">
          <li><a href="../PHP/contact.php">CONTACT</a></li>
        </div>
      </ul>
    </div>
  </nav>

  <div class="hero-image">
  <div class="hero-text">
  <h1 class="my-5 welcome-message"><?php echo $welcome_msg; ?> <b><?php echo htmlspecialchars($_SESSION["FName"]);?>  <?php echo htmlspecialchars($_SESSION["LName"]); ?></b></h1>
  </div>
</div>


    <div class="container-panel-3">
    <div class="row">
    <div class="column-3" id="blue">
    <h1><?php
      $resultinfo = mysqli_query($link, "SELECT count(*) FROM Journal WHERE ACC_ID='$id' AND J_Reviewed='0'");
      $num_rows = mysqli_fetch_row($resultinfo)[0];
      echo $num_rows;
        ?> </h1>
      <h1>Under review Journals</h1>

      </div>

      <div class="column-3" id="pink">
      
      <h1><?php
      $resultinfo = mysqli_query($link, "SELECT count(*) FROM Journal WHERE ACC_ID='$id'");
      $num_rows = mysqli_fetch_row($resultinfo)[0];
      echo $num_rows;
        ?> </h1>
        <h1>Journals Entry</h1>

      </div>

      <div class="column-3" id="green">
      <h3 style="text-align: center;"> <?php
        echo date("l")," ", date("d, Y");
        ?></h3>

      </div>

      
  </div>

  

  



  <div class="container-icons">
    <div class="row">
    <div onclick="location.href='../../Documents/PHP/new-journal.php';" style="cursor: pointer;"  class="icon-button">
    <img class="img-icon-2"src="../../Images/Icons/calendar.png" width="75px" height="75px">
    <br>
    <span class="button-text"><a href="../../Documents/PHP/new-journal.php">New Entry</a></span>
    </div>
    
    <div onclick="location.href='../PHP/view-journals.php';" style="cursor: pointer;"  class="icon-button">
    <img class="img-icon-2"src="../../Images/Icons/book.png" width="75px" height="75px">
    <br>
    <span class="button-text"><a href="../PHP/view-journals.php">View Journals</a></span>
    </div>


    <div onclick="location.href='../../Documents/PHP/edit-profile.php';" style="cursor: pointer;"  class="icon-button">
    <img class="img-icon-3"src="../../Images/Icons/user-edit-solid.png" width="75px" height="75px">
    <br>
    <span class="button-text"><a href="../../Documents/PHP/edit-profile.php">Edit Profile</a></span>
    </div>

    <div <?php
        $id =$_SESSION['ACC_ID'];
        $result = $link->query("SELECT * FROM `Accounts` WHERE ACC_ID ='$id'");
        $row = $result->fetch_assoc();
        $plan = $row['NutritionPlan'];
        $symbol = "'";
        echo 'onclick="location.href=';
        echo $symbol;
        echo '../../ProgramPlan/';
        echo $plan;
        echo $symbol;
        echo ';"';
        echo 'style="cursor: pointer;"  class="icon-button"';
        
        ?>>
    <img class="img-icon-2"src="../../Images/Icons/file.png" width="75px" height="75px">
    <br>
    <span class="button-text"><a href="../../ProgramPlan/<?php echo $row["NutritionPlan"]; ?>">View Plan</a></span>
    </div>

  </div>
  </div>


  


  




</body>




</html>
