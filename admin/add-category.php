<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

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
<br><br>

        <!-- Category form -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image</td>
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

        <?php
            //check if the button is clicked
            if(isset($_POST['submit']))
            {
                //get value from form
                $title = $_POST['title'];

                //checking if the radio button is checked
                if(isset($_POST['featured']))
                {
                    //get value from form
                    $featured = $_POST['featured'];
                } 
                else
                {
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    //get value from form
                    $active = $_POST['active'];
                } 
                else
                {
                    $active = "No";
                }

                //checking if the image is selected

                if(isset($_FILES['image']['name']))
                {
                    //upload image
                    $image_name = $_FILES['image']['name'];

                    // Upload image only when selected
                    if($image_name != "")
                    {
                        $ext = end(explode('.', $image_name));
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext;


                        $source_path =$_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/". $image_name;

                        $upload = move_uploaded_file($source_path, $destination_path);

                        if($upload==false)
                        {
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            header('location:'.SITEURL.'admin/add-category.php');
                            die();
                        }
                    }
                }
                else
                {
                    //Don't upload image
                    $image_name = "";
                }

               // create query to insert category into db
               $sql = "INSERT INTO tbl_category SET 
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active='$active'
               ";

               //execute query and save in db
               $res = mysqli_query($conn, $sql);

               //check wether the query is executed
               if ($res==true)
               {
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                    //redirect to manage category
                    header('location:'.SITEURL.'admin/manage-category.php');
               }
               else
               {
                    $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                    //redirect to manage category
                    header('location:'.SITEURL.'admin/add-category.php');
               }

            }
        ?>


    </div>
</div>


<?php include('partials/footer.php'); ?>