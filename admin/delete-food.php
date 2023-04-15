<?php
    include('../config/constants.php');

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //process to delete
        //get ID and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove image if available
        if($image_name != "")
        {
            $path = "../images/food/".$image_name;
            $remove = unlink($path);

            if($remove == false)
            {
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }
        }
        //delete food from db
        $sql = "DELETE FROM tbl_food WHERE id= $id";
        $res = mysqli_query($conn, $sql);

        if($res == true)
        {
            //food deleted
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
    }
    else
    {
        //Redirect to manage food page
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>