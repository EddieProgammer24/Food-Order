<?php
include('../config/constants.php');
//check whether the id and image_name value is set or not
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    //Get the Value and Delete
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //Remove Physical image file if available
    if($image_name != "")
    {
        //Image is Available
        $path = "../images/category/".$image_name;

        //Remove the Image
        $remove = unlink($path);

        //If Failed to Remove Image the add an error message and stop the process
        if($remove==false)
        {
            //Set the Session Message
            $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div>";
            //Redirect to Manage Category Page
            header('location:'.SITEURL.'/admin/manage-category.php');
            //Stop the Process
            die();
        }
    }

    //Delete Data from Database
    $sql = "DELETE FROM tbl_category WHERE id=$id";

    //Execute the Query
    $res = mysqli_query($conn,$sql);

    //check whether the data is deleted from the database
    if($res==true)
    {
        //Set Success Message and Redirect
        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
        //Redirect to Manage Category
        header('location:'.SITEURL.'/admin/manage-category.php');
    }
    else
    {
        //Set Fail Message and Redirect
        $_SESSION['delete'] = "<div class='error'>Category Deleted Successfully.</div>";
        //Redirect to Manage Category
        header('location:'.SITEURL.'/admin/manage-category.php');
    }


}
else
{
    //Redirect to manage category page
    header('location:'.SITEURL.' /admin/manage-category.php');
}
?>