<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br/><br/>

        <?php
        //1.Get the admin of the selected Admin
        $id = $_GET['id'];

        //2.Create SQL Query to Get the Details
        $sql = "SELECT * FROM tbl_admin WHERE id=$id";

        //3. Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the query is executed or not
        if($res==true)
        {
            // check whether the data is available or not
            $count = mysqli_num_rows($res);
            //Check whether we have admin data or not
            if($count==1)
            {
                //Get the Details
                //echo "Admin Available";
                $row = mysqli_fetch_assoc($res);
                $full_name = $row['full_name'];
                $username = $row['username'];

            }
            else
            {
                //Redirect to Manage Admin Page
                header('location:'.SITEURL.'/admin/manage-admin.php');
            }
        }
        ?>
        
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                <tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>


            </table>

        </form>
    </div>
</div>

<?php

//Check whether the submit button is clicked
if(isset($_POST['submit']))
{
    //obtain the values from form to update
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    //Create SQL query to update admin
    $sql = "UPDATE tbl_admin SET 
    full_name = '$full_name',
    username = '$username' 
    WHERE id = '$id' ";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    if($res==true){
    //Create a session variable to display the message
      $_SESSION['update'] = "<div class='success '>Admin Updated Succefully.</div>";
    //Redirect to Manage Admin Page
    header('location:'.SITEURL.'/admin/manage-admin.php');

    }
    else
    {
         //Create a session variable to display the message
         $_SESSION['delete'] = "<div class='success '>Failed to Update Admin.</div>";
         //Redirect to Manage Admin Page
         header('location:'.SITEURL.'/admin/manage-admin.php');
    }
}
?>

<?php include('partials/footer.php');?>