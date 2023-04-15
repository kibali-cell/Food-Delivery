<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php
    //check submit button if clicked
    if(isset($_POST['submit']))
    {
        //get data from form

        //check if the user exists
        $id = $_POST['id'];
        $current_password=md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        //checking if the new password match with the old one
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        if($res == true)
        {
            //check whether data is available
            $count = mysqli_num_rows($res);

            if ($count==1)
            {
                //User exists and Password can be changed
                //checking if the new password match
                if($new_password == $confirm_password)
                {
                    //Update password
                    $sql2 = "UPDATE tbl_admin SET password ='$new_password' WHERE id=$id";

                    //execute query
                    $res2 = mysqli_query($conn, $sql2);

                    //is the query executed?
                    if($res2==true)
                    {
                        //Display message
                        //redirect to manage admin page
                        $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully. </div>";
                        //redirect user
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    } 
                    else{
                        //Display error message
                        //redirect to manage admin page
                        $_SESSION['change-pwd'] = "<div class='error'>Failed To Change Password. </div>";
                        //redirect user
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else
                {
                    //redirect to manage admin page
                    $_SESSION['pwd-not-match'] = "<div class='error'>Password Did Not Match</div>";
                    //redirect user
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            else
            {
                //User doesn't exist
                $_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";
                //redirect user
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        //Change password if all above is true
    }
?>

<?php include('partials/footer.php'); ?>