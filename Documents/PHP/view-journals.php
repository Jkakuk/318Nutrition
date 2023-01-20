<!-- ##################################################################################
#Script Name: List Accounts
#Description: Displays and fetches accounts from database
#Author: Mathew Philp
#Date: 2022-02-27
################################################################################## -->
<?php
session_start();
require_once "../../Database/config.php";

?>
<?php


// For extra protection these are the columns of which the user can sort by (in your database table).
$columns = array('ENT_ID', 'ACC_ID', 'J_Entry','J_Weight', 'J_EnergyLevel', 'J_ExericeNotes', 'J_Reviewed', 'Accounts.FName', 'Accounts.LName', 'Accounts.ACC_ID');

// Only get the column if it exists in the above columns array, if it doesn't exist the database table will be sorted by the first item in the columns array.
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

// Get the sort order for the column, ascending or descending, default is ascending.
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

// Get the current Date.
$date = date("Y-m-d");

// Get the date a month back from the above date.
$date_MonthBack = date("Y-m-d", strtotime("$date -1 month"));

// Get the result...
if ($_SESSION['Employee'] == 1) 
{
  $result = $link->query('SELECT Journal.*, Accounts.FName, Accounts.LName, CASE WHEN J_Reviewed = 1 THEN "Reviewed"
  ElSE "NEW" 
  END AS ReviewedText 
  FROM Journal INNER JOIN Accounts ON Journal.ACC_ID=Accounts.ACC_ID  ORDER BY ' .  $column . ' ' . $sort_order . ' ' . '' . ' '. '');
	// Some variables we need for the table.
	$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
	$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
	$add_class = ' class="highlight"';
  





  if(isset($_POST['calendersearch']))
	{

    $firstDateToSearch = $_POST['firstDateToSearch'];
    $secondDateToSearch = $_POST['secondDateToSearch'];
		$date_MonthBack = $firstDateToSearch;
		$date = $secondDateToSearch;
    $result = $link->query("SELECT Journal.* , Accounts.FName, Accounts.LName, CASE WHEN J_Reviewed = 1 THEN 'Reviewed'
    ElSE 'NEW' 
    END AS ReviewedText
    FROM Journal INNER JOIN Accounts ON Journal.ACC_ID=Accounts.ACC_ID WHERE J_EntryData BETWEEN '$firstDateToSearch' AND '$secondDateToSearch'" );

	}

  if(isset($_POST['search']))
	{
      $valueToSearch = $_POST['valueToSearch'];
      $result = $link->query("SELECT Journal.* , Accounts.FName, Accounts.LName, CASE WHEN J_Reviewed = 1 THEN 'Reviewed'
      ElSE 'NEW' 
      END AS ReviewedText
      FROM Journal INNER JOIN Accounts ON Journal.ACC_ID=Accounts.ACC_ID WHERE CONCAT(UPPER(FName), UPPER(LName), J_EntryData, ENT_ID) LIKE '%$valueToSearch%'");
	}




	// When reset button is clicked. Reset to default loading order.
	if (isset($_POST['reset']))
	{
  		$result = $link->query("SELECT Journal.* , Accounts.FName, Accounts.LName, CASE WHEN J_Reviewed = 1 THEN 'Reviewed'
      ElSE 'NEW'
      END AS ReviewedText
      FROM Journal INNER JOIN Accounts ON Journal.ACC_ID=Accounts.ACC_ID WHERE J_EntryData BETWEEN '$date_MonthBack' AND '$date' ORDER BY  '$column'  '$sort_order'");

	}



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
<link rel="stylesheet" href="../CSS/table-format.css">
<link rel="script" href="../JS/button-script.js">
<script src="../JS/button-script.js" defer></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="stylesheet" href="../CSS/styles.css ">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>318 Nutrition | View Journals</title>
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

  <div class="second-navbar">
    <div class="second-navbar-links">
      <ul>
  <li><a href="../PHP/login.php"><span class="fa fa-arrow-left" aria-hidden="true"><p>BACK</p></a></li>
  <li><a href="../../Documents/PHP/view-accounts.php"><span class="fa fa-users" aria-hidden="true"><p>VIEW ACCOUNTS</p></a></li>
  <li><a href="../PHP/view-journals.php"><span class="fa fa-book" aria-hidden="true"><p>VIEW JOURNALS</p></a></li>
  <li><a href="../../Documents/PHP/create-account.php"><span class="fa fa-user-plus" aria-hidden="true"><p>NEW ACCOUNTS</p></a></li>
  <li><a href="../../Documents/PHP/edit-profile.php"><span class="fa fa-user-edit" aria-hidden="true"><p>EDIT PROFILE</p></a></li>
</ul>
  </div>
  </div>

    <form class="" action="view-journals.php" method="post">
            <input class="mover-search" type="text" name="valueToSearch" placeholder="Search">
            <input class="mover-search" type="submit" name="search" value="Search">
            <br>
            <input class="mover-search" type="date" name="firstDateToSearch" value="<?php echo $date_MonthBack; ?>">
            <input class="mover-search" type="date" name="secondDateToSearch"value="<?php echo $date; ?>">
            <input class="mover-search" type="submit" name="calendersearch" value="Search">
            <input class="mover-search" type="submit" name="reset" value="Reset">
		</form>
			<table id="myTable">
				<tr>
          <th><a href="view-journals.php?column=FName&order=<?php echo $asc_or_desc; ?>">First Name<i class="fas fa-sort<?php echo $column == 'FName' ? '-' . $up_or_down : ''; ?>"></i></a></th>
          <th><a href="view-journals.php?column=LName&order=<?php echo $asc_or_desc; ?>">last Name<i class="fas fa-sort<?php echo $column == 'LName' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a href="view-journals.php?column=J_EntryData&order=<?php echo $asc_or_desc; ?>">Entry Date<i class="fas fa-sort<?php echo $column == 'J_EntryData' ? '-' . $up_or_down : ''; ?>"></i></a></th>
          <th><a href="view-journals.php?column=J_Weight&order=<?php echo $asc_or_desc; ?>">Weight<i class="fas fa-sort<?php echo $column == 'J_Weight' ? '-' . $up_or_down : ''; ?>"></i></a></th>
          <th><a href="view-journals.php?column=J_EnergyLevel&order=<?php echo $asc_or_desc; ?>">Energy Level<i class="fas fa-sort<?php echo $column == 'J_EnergyLevel' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a href="view-journals.php?column=J_ExericeNotes&order=<?php echo $asc_or_desc; ?>">Client Notes<i class="fas fa-sort<?php echo $column == 'J_ExericeNotes' ? '-' . $up_or_down : ''; ?>"></i></a></th>
          <th><a href="view-journals.php?column=J_InstructorNotes&order=<?php echo $asc_or_desc; ?>">Instructor Note<i class="fas fa-sort<?php echo $column == 'J_InstructorNotes' ? '-' . $up_or_down : ''; ?>"></i></a></th>
          <th><a href="view-journals.php?column=J_Reviewed&order=<?php echo $asc_or_desc; ?>">Review<i class="fas fa-sort<?php echo $column == 'J_Reviewed' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a>Modify</a></th>
				</tr>
				<?php while ($row = $result->fetch_assoc()): ?>
					
				<tr>
         
          <td<?php echo $column == 'FName' ? $add_class : ''; ?>><?php echo $row['FName']; ?></td>
					<td<?php echo $column == 'LName' ? $add_class : ''; ?>><?php echo $row['LName']; ?></td>
					<td<?php echo $column == 'J_EntryData' ? $add_class : ''; ?>><?php echo $row['J_EntryData']; ?></td>
          <td<?php echo $column == 'J_Weight' ? $add_class : ''; ?>><?php echo $row['J_Weight']; ?></td>
          <td<?php echo $column == 'J_EnergyLevel' ? $add_class : ''; ?>><?php echo $row['J_EnergyLevel']; ?></td>
					<td<?php echo $column == 'J_ExericeNotes' ? $add_class : ''; ?>><?php echo $row['J_ExericeNotes']; ?></td>
          <td<?php echo $column == 'J_InstructorNotes' ? $add_class : ''; ?>><?php echo $row['J_InstructorNotes']; ?></td>
          <td<?php echo $column == 'J_Reviewed' ? $add_class : ''; ?>><?php echo $row['ReviewedText']; ?></td>
					
          <?php $var_value = $row['J_EntryData'];
          $clientid = $row['ACC_ID'];
					$_SESSION['varname'] = $var_value;
          $_SESSION['clientid'] = $clientid;

          if ($_SESSION["Employee"] == true)
          {
            echo '<td><a href="../PHP/edit-journal-entry.php?varname=';
            echo $var_value;
            echo '&clientid=';
            echo $clientid;
            echo '" >Add Note</a></td>';

          }
          else
          {
            echo '<td><a href="../PHP/edit-journal-entry.php?varname=';
            echo $var_value;
            echo '" >Edit</a></td>';
          }

          
					?>

				</tr>
				<?php endwhile; ?>
			</table>	
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
	<?php
	$result->free();
}
else if ($_SESSION['Employee'] == 0)
{
  


  $id = $_SESSION['ACC_ID'];


  
	$result = $link->query("SELECT Journal.*, Accounts.FName, Accounts.LName, Accounts.NutritionPlan FROM Journal INNER JOIN Accounts ON Journal.ACC_ID=Accounts.ACC_ID WHERE Accounts.ACC_ID='$id'  ORDER BY " .  $column . ' ' . $sort_order . ' ' . '' . '' . '');
	// Some variables we need for the table.
	$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
	$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
	$add_class = ' class="highlight"';
  





  if(isset($_POST['calendersearch']))
	{
			$id = $_SESSION['ACC_ID'];
			$firstDateToSearch = $_POST['firstDateToSearch'];
    	$secondDateToSearch = $_POST['secondDateToSearch'];
			$date_MonthBack = $firstDateToSearch;
			$date = $secondDateToSearch;
    	$result = $link->query("SELECT Journal.* , Accounts.FName, Accounts.LName, Accounts.NutritionPlan
    FROM Journal INNER JOIN Accounts ON Journal.ACC_ID=Accounts.ACC_ID WHERE Accounts.ACC_ID='$id' AND J_EntryData BETWEEN '$firstDateToSearch' AND '$secondDateToSearch'" );
	}

  if(isset($_POST['search']))
	{
      $id = $_SESSION['ACC_ID'];
      $valueToSearch = $_POST['valueToSearch'];
      $result = $link->query("SELECT Journal.* , Accounts.FName, Accounts.LName, Accounts.NutritionPlan
      FROM Journal INNER JOIN Accounts ON Journal.ACC_ID=Accounts.ACC_ID WHERE Accounts.ACC_ID='$id' AND CONCAT(UPPER(FName), UPPER(LName), J_EntryData, ENT_ID) LIKE '%$valueToSearch%'");
	}




	// When reset button is clicked. Reset to default loading order.
	if (isset($_POST['reset']))
	{
			$id = $_SESSION['ACC_ID'];
      $result = $link->query("SELECT Journal.* , Accounts.FName, Accounts.LName, Accounts.NutritionPlan
      FROM Journal INNER JOIN Accounts ON Journal.ACC_ID=Accounts.ACC_ID WHERE Accounts.ACC_ID='$id' AND J_EntryData BETWEEN '$date_MonthBack' AND '$date' ORDER BY  '$column'  '$sort_order'");
	}



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
<link rel="stylesheet" href="../CSS/table-format.css">
<link rel="script" href="../JS/button-script.js">
<script src="../JS/button-script.js" defer></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="stylesheet" href="../CSS/styles.css ">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>318 Nutrition | View Journals</title>
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
      <a href="#">Monthly Packages</a>
      <a href="# ">Couples Nutrition</a>
      <a href="#">Adolescent Nutrition</a>
      <a href="#">Workshops/Seminars</a>
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

  

    <form class="" action="view-journals.php" method="post">
            <input class="mover-search" type="text" name="valueToSearch" placeholder="Search">
            <input class="mover-search" type="submit" name="search" value="Search">
            <br>
            <input class="mover-search" type="date" name="firstDateToSearch" value="<?php echo $date_MonthBack; ?>">
            <input class="mover-search" type="date" name="secondDateToSearch"value="<?php echo $date; ?>">
            <input class="mover-search" type="submit" name="calendersearch" value="Search">
            <input class="mover-search" type="submit" name="reset" value="Reset">
		</form>
			<table id="myTable">
				<tr>
					<th><a href="view-journals.php?column=FName&order=<?php echo $asc_or_desc; ?>"> First Name<i class="fas fa-sort<?php echo $column == 'FName' ? '-' . $up_or_down : ''; ?>"></i></a></th>
          <th><a href="view-journals.php?column=LName&order=<?php echo $asc_or_desc; ?>">Last Name<i class="fas fa-sort<?php echo $column == 'LName' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a href="view-journals.php?column=J_EntryData&order=<?php echo $asc_or_desc; ?>">Entry Date<i class="fas fa-sort<?php echo $column == 'J_EntryData' ? '-' . $up_or_down : ''; ?>"></i></a></th>
          <th><a href="view-journals.php?column=J_Weight&order=<?php echo $asc_or_desc; ?>">Weight<i class="fas fa-sort<?php echo $column == 'J_Weight' ? '-' . $up_or_down : ''; ?>"></i></a></th>
          <th><a href="view-journals.php?column=J_EnergyLevel&order=<?php echo $asc_or_desc; ?>">Energy Level<i class="fas fa-sort<?php echo $column == 'J_EnergyLevel' ? '-' . $up_or_down : ''; ?>"></i></a></th>
          <th><a href="view-journals.php?column=J_InstructorNotes&order=<?php echo $asc_or_desc; ?>">Instructor Note<i class="fas fa-sort<?php echo $column == 'J_InstructorNotes' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a href="view-journals.php?column=J_ExericeNotes&order=<?php echo $asc_or_desc; ?>">Exerice Notes<i class="fas fa-sort<?php echo $column == 'J_ExericeNotes' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a>Modify</a></th>
				</tr>
				<?php while ($row = $result->fetch_assoc()): ?>
					
				<tr>
          <td<?php echo $column == 'FName' ? $add_class : ''; ?>><?php echo $row['FName']; ?></td>
					<td<?php echo $column == 'LName' ? $add_class : ''; ?>><?php echo $row['LName']; ?></td>
					<td<?php echo $column == 'J_EntryData' ? $add_class : ''; ?>><?php echo $row['J_EntryData']; ?></td>
          <td<?php echo $column == 'J_Weight' ? $add_class : ''; ?>><?php echo $row['J_Weight']; ?></td>
          <td<?php echo $column == 'J_EnergyLevel' ? $add_class : ''; ?>><?php echo $row['J_EnergyLevel']; ?></td>
          <td<?php echo $column == 'J_InstructorNotes' ? $add_class : ''; ?>><?php echo $row['J_InstructorNotes']; ?></td>
					<td<?php echo $column == 'J_ExericeNotes' ? $add_class : ''; ?>><?php echo $row['J_ExericeNotes']; ?></td>
          <?php 
          $var_value = $row['J_EntryData'];
          $clientid = $row['ACC_ID'];
          $plan = $row['NutritionPlan'];
					$_SESSION['varname'] = $var_value;
          $_SESSION['clientid'] = $clientid;

          if ($_SESSION["Employee"] == true)
          {
            echo '<td><a href="../PHP/edit-journal-entry.php?varname=';
            echo $var_value;
            echo '&clientid=';
            echo $clientid;
            echo '" >Add Note</a></td>';

          }
          else
          {
            echo '<td><a href="../PHP/edit-journal-entry.php?varname=';
            echo $var_value;
            echo '" >Edit</a></td>';
          }

          
					?>

				</tr>
				<?php endwhile; ?>

    <div class="second-navbar">
    <div class="second-navbar-links">
      <ul>
  <li><a href="../PHP/user-panel.php"><span class="fa fa-arrow-left" aria-hidden="true"><p>BACK</p></a></li>
  <li><a href="../../Documents/PHP/NEW-journal.php"><span class="fa fa-calendar-plus" aria-hidden="true"><p>NEW ENTRY</p></a></li>
  <li><a href="../PHP/view-journals.php"><span class="fa fa-book" aria-hidden="true"><p>VIEW JOURNALS</p></a></li>
  <li><a href="../../Documents/PHP/edit-profile.php"><span class="fa fa-user-edit" aria-hidden="true"><p>EDIT PROFILE</p></a></li>
  <li><a href="../../ProgramPlan/<?php echo $plan; ?>"><span class="fa fa-file-pdf" aria-hidden="true"><p>VIEW PLAN</p></a></li>
</ul>
  </div>
  </div>
			</table>	
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
	<?php
	$result->free();
}
?>






