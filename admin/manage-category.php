<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
    <h1>Manage Category</h1><br/><br/><br/>

    <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>

        <br/><br/>

    <!----- Button to add admin ------>
    <a href="<?php echo SITEURL;?> /admin/add-category.php" class="btn-primary">Add Category</a><br/><br/><br/>

<table class="tbl-full">
    <tr>
        <th>S.N.</th>
        <th>Title</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Actions</th>
    </tr>

    <?php

    $sql = "SELECT * FROM tbl_category";

    //Execute Query
    $res = mysqli_query($conn,$sql);

    //Count Rows
    $count = mysqli_num_rows($res);

    //Create Serial Number Variable and assign value as 1
    $sn=1;

    //Check whether we have data in the database
    if($count>0)
    {
        //We have data in the database
        //get the data and display
        while($row=mysqli_fetch_assoc($res))
        {
            $id = $row['id'];
            $title = $row['title'];
            $image_name = $row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];

            ?>
             <tr>
                     <td><?php echo $sn++;?></td>
                     <td><?php echo $title;?></td>

                     <td>
                        <?php 
                        //Check whether image name is available or not
                        if($image_name!="")
                        {
                            //Display the Image
                            ?>
                            <img src="<?php echo SITEURL; ?>/images/category/<?php echo $image_name;?>" width="100px">
                            <?php
                        }
                        else
                        {
                            //Display the Message
                            echo "<div class='error'>Image not  Added.</div>";
                        }
                        ?>
                    </td>

                     <td><?php echo $featured;?></td>
                     <td><?php echo $active;?></td>
                 <td>
                       <a href="#" class="btn-secondary">Update Category</a>
                       <a href="#" class="btn-danger">Delete Category</a>
            
               </td>
            </tr>
            <?php
        }
    }
    else
    {
        //We do not have data
        //We'll display message inside the table
        ?>
        <tr>
            <td colspan="6"><div class="error">No Category Added.</div></td>
        </tr>
        <?php
    }
    ?>

    

</table>

    </div>
    
</div>

<?php include('partials/footer.php');?>
