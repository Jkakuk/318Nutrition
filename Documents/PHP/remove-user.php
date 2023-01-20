<!-- ##################################################################################
#Script Name: Delete Account
#Description: Allows users to delete journal entry
#Author: Mathew Philp
#Date: 2022-03-02
################################################################################## -->

<?php
session_start();
require_once "../../Database/config.php";

$accountID = $_GET['varname'];




// sql to delete a record
$sql = "DELETE FROM Journal WHERE ACC_ID='$accountID'";


if (mysqli_query($link, $sql)) 
{
  $sql = "DELETE FROM Accounts WHERE ACC_ID='$accountID'";
  if (mysqli_query($link, $sql)) 
  {
    header("location: ../PHP/user-panel.php");
  }
} 
else
 {
  echo "Error deleting record: " . mysqli_error($link);
}


mysqli_close($link);


?>