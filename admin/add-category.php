<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br/><br/>

        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <br/><br/>

        <!-------- Add Category Starts ------->
        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" placeholder="category Title">
                </td>
            </tr>

            <tr>
                <td>Select Image: </td>
                <td>
                    <input type="file" name="image">
                </td>
           </tr>

            <tr>
                <td>Featured: </td>
                <td>
                <input type="radio" name="featured" value="Yes"> Yes
                <input type="radio" name="featured" value="No"> No
                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
                <input type="radio" name="active" value="Yes"> Yes
                <input type="radio" name="active" value="No"> No
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                </td>
            </tr>
        </table>
        </form>
         <!-------- Add Category Ends ------->

         <?php

         //Check whether the submit button is clicked or not
         if(isset($_POST['submit']))
         {
            //1. Get the value from Category Form
            $title = $_POST['title'];

            //For Radio button we need to check whether its clicked or not
            if(isset($_POST['featured']))
            {
                //Get the value from the form
                $featured = $_POST['featured'];
            }
            else
            {
                //Set the default value
                $featured = "No";
            }

            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }
            else
            {
                $active = "No";
            }

            //Check whether the image is selected or not and set the value for image name accordingly
            //print_r($_FILES['image']);

            //die();//Break the code here

            if(isset($_FILES['image']['name']))
            {
                //Upload the Image
                $image_name = $_FILES['image']['name'];

                //upload the image only if Image is selected
                if($image_name != "")
                {

                

                      //AutoRename Our Image
                     //Get the Extension of our image
                     $ext = end(explode('.',$image_name));

                     //Rename the Image
                      $image_name = "Food_Category_".rand(000, 999).'.'.$ext;

                     $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/category/".$image_name;

                     //Finally upload the Image
                     $upload = move_uploaded_file($source_path,$destination_path);

                    //Check whether the image is uploaded or not
                     if($upload==false)
                     {
                     //Set Message
                     $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                     //Redirect
                     header('location'.SITEURL.'/admin/add-category.php');
                     //Stop the Process
                     die();
                    }

              }
            }
            else
            {
                //Don't Upload the Image and set the image name value as blank
                $image_name = "";
            }

            //2. Set SQL query to insert category into database
            $sql = "INSERT INTO tbl_category SET title='$title',image_name='$image_name',featured='$featured',active='$active' ";

            //3.Execute the query and save in database
            $res = mysqli_query($conn, $sql);

            //4.Check whether the query executed or not
            if($res == true)
            {
                //Query Executed and Category Added
                $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                header('location:'.SITEURL.'/admin/manage-category.php');
            }
            else
            {
                //Failed to Add Category
                $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                header('location:'.SITEURL.'/admin/add-category.php');

            }
         }
         ?>
    </div>
</div>

<?php include('partials/footer.php');?>
