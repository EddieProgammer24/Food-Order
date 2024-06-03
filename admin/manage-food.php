<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
    <h1>Manage Food</h1><br/><br/>



    <!----- Button to add admin ------>
    <a href="<?php echo SITEURL; ?>/admin/add-food.php" class="btn-primary">Add Food</a><br/><br/><br/>

    <?php
    if(isset($_SESSION['add']))
    {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }
    ?>

<table class="tbl-full">
    <tr>
        <th>S.N.</th>
        <th>Title</th>
        <th>Price</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Actions</th>
    </tr>

    <?php
    //Create SQL Query to get all the food
    $sql = "SELECT * FROM tbl_food";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Count Rows to check whether we have food s or not
    $count = mysqli_num_rows($res);

    //Create Serial Number Variable and Set Default Value as 1
    $sn = 1;

    if($count>0)
    {
        //We have Food in Database
        while($row=mysqli_fetch_assoc($res))
        {
            //get the value from individual columns
            $id = $row['id'];
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];
            ?>

                      <tr>
                                     <td><?php echo $sn++;?>.</td>
                                     <td><?php echo $title; ?></td>
                                     <td>$<?php echo $price; ?></td>
                                     <td>
                                        <?php 
                                        //Check whether we have image or not
                                        if($image_name=="")
                                        {
                                            //We do not have Image
                                            echo "<div class='error'>Image not Added.</div>";
                                        }
                                        else
                                        {
                                            //We Have Image
                                            ?>
                                            <img src="<?php echo SITEURL;?>/images/food/<?php echo $image_name; ?>" width="100px">
                                            <?php
                                        }
                                        ?>
                                     </td>
                                     <td><?php echo $featured; ?></td>
                                     <td><?php echo $active; ?></td>
                            <td>
                                    <a href="#" class="btn-secondary">Update Food</a>
                                    <a href="#" class="btn-danger">Delete Food</a>
                             </td>
                      </tr>

            <?php
        }
    }
    else
    {
        //Food Not Added in Database
        echo "<tr> <td colspan='7' class='error'> Food Not Added Yet. </td> </tr>";
    }

    ?>
   

   
</table>

    </div>
    
</div>

<?php include('partials/footer.php');?>
