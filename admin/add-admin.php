<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br/><br/>

        <?php 
        if(isset($_SESSION['add']))//Checking Whether the session is set or not
        {
            echo $_SESSION['add'];//Display the Session Message if SET
            unset($_SESSION['add']); //Removing Session Message
        }
        ?>

        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Full Name:</td>
                <td>
                    <input type="text" name="full_name" placeholder="Enter Your Name">
                </td>
            </tr>

            <tr>
                <td>Username:</td>
                <td>
                    <input type="text" name="username" placeholder="Your Username">
                </td>
            </tr>

            <tr>
                <td>Password: </td>
                <td>
                    <input type="password" name="password" placeholder="Your Password">
                </td>    
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
            </tr>
        </table>

        </form>    
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
   //Process the value from form and save it in the database

   //Check whether the submit button is clicked or not

   //1. Get the data from the form

   if(isset($_POST['submit'])){
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //2. SQL query to save the dat into the Database

    $sql = "INSERT INTO tbl_admin SET full_name='$full_name',username='$username',password='$password' ";
    
    //3. Executing Query and Saving Data into the Database
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    //4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
    if($res==TRUE)
    {
        //Data Inserted
        //Create a session variable to display Message
        $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
        //Redirect Page to Manage Admin
        header("location:".SITEURL.'/admin/manage-admin.php');
    }
    else
    {
        //FAILED to insert data
        echo "Failed to insert data";
        //Create a session variable to display Message
        $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
        //Redirect Page to Add Admin
        header("location:".SITEURL.'/admin/add-admin.php');

    }

   

   }   
?>

