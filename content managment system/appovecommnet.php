<?php
require_once("includes/db.php");
require_once("includes/function.php");
require_once("includes/session.php");

if(isset($_GET['id'])){
    $search = $_GET['id'];
    $admin = $_SESSION['adminname'];
    $sql = "UPDATE commnet SET `status` = 'ON', approveby = '$admin' WHERE id='$search'";
    $result = mysqli_query($conn,$sql);

    if($result){
        $_SESSION['Successmessage'] = "commnet approved successfully";
        Redirect_to("commnet.php");
    }else{
        $_SESSION['Errormessage'] = "something went wrong";
        Redirect_to("commnet.php");
    }
}

?>