<?php

include('../config/constants.php'); 

if(isset($_GET['id']) && isset($_GET['image_name']))
{
    //Proceed to Delete

    //1. Get Id and Image Name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //2. Remove Image if Available
    //Check whether Image is available or not and delete when available
    if($image_name != "")
    {
        //It has Image and Need to Remove from folder
        //get the image path
        $path = "../images/food/".$image_name;

        //Remove Image File From Folder
        $remove = unlink($path);

        //check whether image is removed
        if($remove==false)
        {
            //Failed to Remove Image
            $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
            //redirect to manage food
            header('location:'.SITEURL.'/admin/manage-food.php');
            //Stop the Process of deleting
            die();

        }
    }
    //3.Delete Food From Database
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check whether the query executed or not and set the session message respectively
     //4.Redirect to Manage Food with Session Message
    if($res==true)
    {
        //Food Deleted
        $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
        header('location:'.SITEURL.'/admin/manage-food.php');
    }
    else
    {
        //Failed to Delete Food
        $_SESSION['delete'] = "<div class='error'>Fail to Delete Food.</div>";
        header('location:'.SITEURL.'/admin/manage-food.php');
    }
   
}
else
{
    //Redirect to Manage Food Page
    $_SESSION['unauthorize'] =  "<div class='error'>Unauthorized Access.</div>";
    header('location:'.SITEURL.'/admin/manage-food.php');
}

?>