<?php
// Initialize the session
session_start();
// Include config file
require_once "../../Database/config.php";

$weight;
$height;
$age;
$male = 5;
$female = 161;
$activity = 1;
$total;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Links Favicon's -->
  <link rel="apple-touch-icon" sizes="180x180" href="../../Images/Favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../../Images/Favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../../Images/Favicon/favicon-16x16.png">
  <link rel="manifest" href="../../Images/Favicon/site.webmanifest">
  <!-- Links CSS/JS Scripts -->
  <link rel="stylesheet" href="../CSS/boot-strap.css ">
  <link rel="stylesheet" href="../CSS/styles.css ">
  <link rel="script" href="../JS/button-script.js">
  <script src="../JS/button-script.js" defer></script>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>318 Nutrition | Macro Calculator</title>
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
          <a href="#">Workshops/Seminars</a>-->
        </div>
      </div>
      <li><a href="../PHP/macro-calculator.php">MACRO CALCULATOR</a></li>
<?php if (isset($_SESSION["loggedin"]) == true) {
  echo '<div class="dropdown">
                <li><a class="dropbtn" href="../PHP/admin-panel.php">MY PLAN</a></li>
                <div class="dropdown-content">
                <a href="../PHP/account-sign-out.php">Log Out</a>
                </div>
                </div>';
} else {
  echo '<li><a href="../PHP/admin-panel.php">MY PLAN</a></li>';
} ?>
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

  
<!-- Place Macro Calculator Code here -->
    <div class="wrapper" >
        <h2>Macro Nutrient Calculator</h2>

        
        
        <form  method="post">
            <div class="form-group">
               <label>Sex:</label><br>
                <input type="radio" id="male" name="question" value="male">
                <label for="yes">Male</label><br>
            </div>    
            
            <div class="form-group">    
                <input type="radio" id="female" name="question" value="female">
                <label for="no">Female</label><br><br>
            </div> 
            <div class="form-group">
                <label>Height(cm)</label>
                <input type="number" name="height" class="form-control" value="<?php echo $height; ?>"><br>
            </div>
            <div class="form-group">
                <label>Weight (kgs)</label>
                <input type="number" name="weight" class="form-control"  value="<?php echo $weight; ?>"><br>
                
            </div>    
           <div class="form-group">
                <label>Age</label>
                <input type="number" name="age" class="form-control" value="<?php echo $age; ?>"><br><br>
            </div>
            
            
             <div class="form-group">
               <label>Activity Level:</label><br>
                <input type="radio" id="sed" name="activity" value="sed">
                <label for="yes">Sedentary</label><br>
                
                <input type="radio" id="light" name="activity" value="light">
                <label for="no">Lightly Active</label><br>
                
                <input type="radio" id="mod" name="activity" value="mod">
                <label for="no">Moderately Active</label><br>
                
                <input type="radio" id="very" name="activity" value="very">
                <label for="no">Very Active</label><br>
                
                <input type="radio" id="extra" name="activity" value="extra">
                <label for="no">Extra Active</label><br><br>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Calculate">
            </div>
        </form>
        
   <?php
   if($_SERVER["REQUEST_METHOD"] == "POST")
    {
       
      if(empty(trim($_POST["weight"])))
    {
        echo " <br> <h1>Please Fill out All fields<h1>";
        
    }else if(empty(trim($_POST["height"])))
    {
        echo " <br> <h1>Please Fill out All fields<h1>";
        
    } else if(empty(trim($_POST["age"])))
    {
         echo " <br> <h1>Please Fill out All fields<h1>";
    } elseif(empty(trim($_POST["activity"])))
    {
         echo " <br> <h1>Please Fill out All fields<h1>";
    }elseif(empty(trim($_POST["question"]))){
         echo " <br> <h1>Please Fill out All fields<h1>";
    }else{
       
        if(($_POST["activity"]) == "sed"){
                $activity = 1.2;
            }elseif(($_POST["activity"]) == "light"){
                $activity = 1.375;
            }elseif(($_POST["activity"]) == "mod"){
                $activity = 1.55;
            }elseif(($_POST["activity"]) == "very"){
                $activity = 1.725;
            }elseif(($_POST["activity"]) == "extra"){
                $activity = 1.9;
            }else{
                echo "please enter an activity level";
                
            }
            
        if (($_POST["question"]) == 'male'){
            
            
            
            
        $height = ($_POST["height"]);
        $weight = ($_POST["weight"]);
        $age = ($_POST["age"]);
        $total = (($height * 6.25) + ($weight * 10) - ($age * 5) + $male)* $activity;
        echo "<h1>Daily Calories: " . $total;
    
        }
         elseif (($_POST["question"]) == 'female') {
        $height = ($_POST["height"]);
        $weight = ($_POST["weight"]);
        $age = ($_POST["age"]);
        $total = (($height * 6.25) + ($weight * 10) - ($age * 5) - $female) * $activity;
        echo "<h1>Daily Calories: <h1> " . $total ;
        
        }else
        {
            echo " <br> Please Fill out All fields";
        }
    }
    }
   ?>
        
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