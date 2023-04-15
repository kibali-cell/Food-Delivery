<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br>

        <?php
                if(isset($_SESSION['add']))//checking if the session is set or not
                {
                    echo $_SESSION['add']; //displaying session method
                    unset($_SESSION['add']); //removing session method
                }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Name"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Username"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Password"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" placeholder="Add Admin" class="btn-secondary"></td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include("partials/footer.php");  ?>

<?php
    //process the value from form and save it in database
    //Check if the submit button is clicked
    if(isset($_POST['submit']))
    {
        //1: get data from form
        $full_name = $_POST["full_name"];
        $username = $_POST["username"];
        $password = md5($_POST["password"]); //Password Encrypted

        //2: SQL Query to save data to db
        $sql = "INSERT INTO tbl_admin SET 
                full_name = '$full_name',
                user_name='$username',
                password='$password'
        ";

        //executing and saving data to db
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        //check whether the data is Executed
        if($res == TRUE)
        {
            //echo "Data is inserted";
            //create a session variable
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
            //redirecting page to manage admin
            header("location:". SITEURL.'admin/manage-admin.php');
        } else 
        {
            //echo "Data failed to be inserted";
            //create a session variable
            $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
            //redirecting page to manage admin
            header("location:". SITEURL.'admin/add-admin.php');
        }
    } 
?>