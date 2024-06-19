<?php
require_once("includes/db.php");
    function Redirect_to($new_location){
        header("location:".$new_location);
        exit;
    }

    function check($username){

        $sql ="SELECT `username` FROM `admin` WHERE username = '$username'";
        $result = mysqli_query($conn,$sql);
        $result->BindValue(':username',$username);
        $result->execute();
        $res = $result->rowcount();
        if($res == 1){
            return true;
        }else{
            return false;
        }
    }

    function login($username,$password){
        $sql = "SELECT * FROM `admin` WHERE username = '$username' AND `password` = '$password' LIMIT 1";
            $result = mysqli_query($conn,$sql);
            $res = $result->rowcount();
            if($res ==1){
               return $found = $result->fetch();
            }else{
                return null;
            }
    }

  function  confirmlogin(){
    if(isset($_SESSION['userid'])){
        return true;
    }else{
        $_SESSION['Errormessage'] = "login required";
        Redirect_to("login.php");
    }
  }
  function totalpost(){
    $sql = "SELECT COUNT(*) FROM post";
                        $result = mysqli($conn,$sql);

                        $Totalrows = mysqli_fetch_array($result);
                        $totalpost = array_shift($Totalrows);
                        echo $totalpost;


  }

  function totalcategory(){
    $sql = "SELECT COUNT(*) FROM category";
                        $result = mysqli($conn,$sql);

                        $Totalrows = mysqli_fetch_array($result);
                        $totalcategory = array_shift($Totalrows);
                        echo $totalcategory;
  }
  function totaladmin(){
    $sql = "SELECT COUNT(*) FROM admin";
    $result = mysqli($conn,$sql);

    $Totalrows = mysqli_fetch_array($result);
    $totaladmin = array_shift($Totalrows);
    echo $totaladmin;

  }

  function totalcommnet(){
    $sql = "SELECT COUNT(*) FROM commnet";
    $result = mysqli($conn,$sql);

    $Totalrows = mysqli_fetch_array($result);
    $totalpost = array_shift($Totalrows);
    echo $totalpost;
  }

  function approve($id){
    $sql ="SELECT COUNT(*) FROM commnet WHERE post_id = '$id' AND `status` = 'ON'";
                            $result = mysqli_query($conn,$sql);
                            $rowstotal =$result->fetch();
                            $total = array_shift($rowstotal);
                            return $total;
  }
  function disapprove($id){
    $sql ="SELECT COUNT(*) FROM commnet WHERE post_id = '$id' AND `status` = 'OFF'";
                            $result = mysqli_query($conn,$sql);
                            $rowstotal =$result->fetch();
                            $total = array_shift($rowstotal);
                            return $total;
  }

?>