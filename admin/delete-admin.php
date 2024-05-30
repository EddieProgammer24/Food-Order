<?php
//Include constants.php file here 
include('../config/constants.php');

//1. Get the ID of Admin 
$id = $_GET['id'];

$sql = "DELETE FROM tbl_admin WHERE id=$id";

//Execute the Query
$res = mysqli_query($conn, $sql);

//Check whether the query executed succesfully or not
if($res==true)
{
    //Query executed succefully and Admin Deleted
    //echo "Admin Deleted Succefully";
    //Create a session variable to display the message
    $_SESSION['delete'] = "<div class='success '>Admin Deleted Succefully.</div>";
    //Redirect to Manage Admin Page
    header('location:'.SITEURL.'/admin/manage-admin.php');

}
else
{
    //Failed to Delete Admin
   // echo "Failed to Delete Admin";
   $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again Later.</div>";

   //Redirect to Manage Admin Page
   header('location:'.SITEURL.'/admin/manage-admin.php');
}
?>