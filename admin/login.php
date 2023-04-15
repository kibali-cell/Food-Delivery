<?php include('../config/constants.php')?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Drinks Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
<br>
    <?php
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if(isset($_SESSION['no-login-message']))
        {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        
    ?>
    <br><br>
            <!-- Login Form Starts-->
            <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>

                Password: <br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>
                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
            </form>
            <!-- Login Form Ends-->

            <p class="text-center">Created By - <a href="https://github.com/kibali-cell">Jonas Kiwia</a></p>
        </div>
    </body>
</html>

<?php
    //checking whether the submit button id clicked

    if(isset($_POST['submit']))
    {
        //get login data
        //$username = $_POST['username'];
        // 

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = md5($_POST['password']);

        //sql to check if user exists
        $sql = "SELECT * FROM tbl_admin WHERE user_name='$username' AND password='$password'";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //checking whether the user exists
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //user available
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username; //to check if the user is logged in

            //redirect to home page dashboard
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //user isn't available
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            //redirect to home page dashboard
            header('location:'.SITEURL.'admin/login.php');
        }

     }
?>
