<?php
require_once("includes/db.php");
require_once("includes/function.php");
require_once("includes/session.php");

if(isset($_GET['id'])){
    $search = $_GET['id'];
    $admin = $_SESSION['adminname'];
    $sql = " DELETE FROM category  WHERE id='$search'";
    $result = mysqli_query($conn,$sql);

    if($result){
        $_SESSION['Successmessage'] = "category deleted successfully";
        Redirect_to("category.php");
    }else{
        $_SESSION['Errormessage'] = "something went wrong";
        Redirect_to("category.php");
    }
}

?>