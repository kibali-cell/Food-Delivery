<?php

    //Authorization - Access control
    //check whether the user is logged
    if(!isset($_SESSION['user']))
    {
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please Login to Admin Panel.</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
?>