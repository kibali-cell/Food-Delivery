<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset ($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype = "multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>

                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Food Description."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php
                                //create query to get active categories from db
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                
                                //executing query
                                $res = mysqli_query($conn, $sql);

                                //count rows to check categories availability
                                $count = mysqli_num_rows($res);

                                //if count is > than 0, we have categories

                                if ($count > 0)
                                {
                                    while ($row=mysqli_fetch_assoc($res))
                                    {
                                        //get categories details
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>

                                        <option value="<?php echo $id;?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <option value="0">No Categories Found</option>
                                    <?php
                                }
                            ?>

                            <option value="1">Food</option>
                            <option value="2">Snacks</option>
                        </select>
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
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

        <?php

            //check if the button is clicked
            if(isset($_POST['submit']))
            {
                //Add food in db
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $category = $_POST['category'];

                //check if radio ntn is clicked
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured="No";
                }

                if(isset($POST['active']))
                {
                    $active = $_POST['active'];
                }
                else 
                {
                    $active ="No";
                }

                //upload image if selected
                if(isset($_FILES['image']['name']))
                {
                    $image_name= $_FILES['image']['name'];

                    if($image_name!="")
                    {
                        //means image is selected
                        //rename image
                        $ext = explode('.', $image_name);
                        $file_extension = end($ext);

                        $image_name = "Food-Name-".rand(0000,9999).".".$file_extension;

                        //upload the image
                        $src = $_FILES['image']['tmp_name'];

                        $dst = "../images/food/".$image_name;
                        $upload = move_uploaded_file($src, $dst);

                        //check whether image is uploaded
                        if($upload == false)
                        {
                            $_SESSION['upload'] = "<div class = 'error'>Failed to upload Image.<div/>";
                            header('location'.SITEURL.'admin/add-food.php');
                            die();
                        }
                    }
                }
                else
                {
                    $image_name= "";
                }

                //insert into db

                $sql2 = "INSERT INTO tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

                //query execution
                $res2 = mysqli_query($conn, $sql2);

                if ($res2 == true)
                {
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

            }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>