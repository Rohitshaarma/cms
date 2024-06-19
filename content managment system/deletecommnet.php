<?php
require_once("includes/db.php");
require_once("includes/function.php");
require_once("includes/session.php");

if(isset($_GET['id'])){
    $search = $_GET['id'];
    $admin = $_SESSION['adminname'];
    $sql = " DELETE FROM commnet  WHERE id='$search'";
    $result = mysqli_query($conn,$sql);

    if($result){
        $_SESSION['Successmessage'] = "commnet deleted successfully";
        Redirect_to("commnet.php");
    }else{
        $_SESSION['Errormessage'] = "something went wrong";
        Redirect_to("commnet.php");
    }
}

?>