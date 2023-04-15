<?php
    // include constants.php file
    include ("../config/constants.php");

    // get admin ID to be deleted
    $id = $_GET['id'];

    //create a query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //execute the query
    $res = mysqli_query($conn, $sql);

    // check the query execution

    if ($res == true) 
    {
        //admin deleted
      //  echo"Admin Deleted";
      //create session variable to display message 
      $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
      //redirect to manage admin page
      header('location:'.SITEURL.'admin/manage-admin.php');
    }
     else 
    {
        //echo "Failed To Delete Admin";
        $_SESSION['delete'] = "<div class='error'>Failed to DeleteAdmin. Please TRy Again Later.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

    //redirect to manage admin page
?>