<?php include('partials/menu.php');?>

    <!-------- Main Content Section Starts ----->
    <div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1><br/>

        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add']; //Displaying Session Message
            unset($_SESSION['add']); //Removing Session Message
        }
        ?><br/><br/><br/>
        <!----- Button to add admin ------>
        <a href="add-admin.php" class="btn-primary">Add Admin</a><br/><br/><br/>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php 
            //Query to get all admin
            $sql = "SELECT * FROM tbl_admin";
            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Check whether the Query is executed or not
            if($res==TRUE)
            {
                //Count Rows to Check Whether we have data in the database or not
                $count = mysqli_num_rows($res); //Function to get all the rows in 
                
                $sn = 1;

                //Check the number of rows
                if($count>0)
                { 
                    //We have data in the database
                    while($rows=mysqli_fetch_assoc($res))
                    {
                        //Using while loop to get all the data from the database
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        //Display the values in our table
                        ?>

                          <tr>
                                <td><?php echo $sn++;?></td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username;?></td>
                              <td>
                                    <a href="#" class="btn-secondary">Update Admin</a>
                                    <a href="#" class="btn-danger">Delete Admin</a>
                    
                              </td>
                         </tr>

                        <?php 


                    }
                }
                else
                {
                    //We do not have data in the database

                }
            }
            ?>

        </table>
        

    </div>
        
    </div>
    <!-------- Main Content Section Ends  ---->

 
 <?php include('partials/footer.php');?>   
