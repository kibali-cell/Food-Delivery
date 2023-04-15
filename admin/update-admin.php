<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
            <br><br>

        <?php
            //get id of selected admin
                $id=$_GET['id'];

            //create query for getting the details
            $sql= "SELECT * FROM tbl_admin WHERE id=$id";

            //execute the query
            $res = mysqli_query($conn, $sql);

            //checking the query execution
            if ($res == true)
            {
                //check data availability
                $count = mysqli_num_rows($res);
                //check admin data availability
                if($count == 1)
                {
                    // Get details
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['user_name'];
                }
                else
                {
                    //redirect to manage admin page
                    header('location'.SITEURL.'admin/manage-admin.php');
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
                </tr>
                
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

    //Check whether the submit button is clicked or not
    if(isset( $_POST['submit']))
    {
        //Get value from form to update

        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //create query to update admin
        $sql = "UPDATE tbl_admin SET 
        full_name = '$full_name',
        user_name = '$username'
        WHERE id='$id'
        ";

        //create the query
        $res = mysqli_query($conn, $sql);

        //check query execution
        if ( $res == true)
        {
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully. </div>";
            //redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            $_SESSION['update'] = "<div class='error'>Failed to Delete Admin. </div>";
            //redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }

?>

<?php include('partials/footer.php'); ?>