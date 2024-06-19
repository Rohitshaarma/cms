<?php
require_once("includes/db.php");
require_once("includes/function.php");
require_once("includes/session.php");
?>
<?php

if(isset($_POST["submit"])){

    $posttitle = $_POST["posttitle"];
   $category = $_POST["category"];
   $image = $_FILES['image']['name'];
   $target = "upload/".basename($_FILES['image']['name']);
   $posttext = $_POST['postdescription'];
   $admin = "rohit";

   date_default_timezone_get("asia/india");
   $currenttime = time();
   $datetime = strftime("%B-%d-%y-%h:%m:$s",$currenttime);

    if(empty($posttitle)){
        $_SESSION['Errormessage'] = "title cant be empty";
        Redirect_to("addnewpost.php");

    }elseif(strlen($posttitle) <  5){

        $_SESSION['Errormessage'] = "post title should be greater than 5 characters";
        Redirect_to("addnewpost.php");
    }elseif(strlen($posttext) >999){

        $_SESSION['Errormessage'] = "post description  should be less than 100 characters";
        Redirect_to("addnewpost.php");
    }else{

        $sql = "INSERT INTO post(datetime,title,category,author,image,post)";
        $sql .= "VALUES(:dataTime,:postTitle,:categoryName,:adminNAME,:imageName,:postdescription)";
        $stmt = $conn->prepare($sql);
        $stmt -> bindValue(':dateTime',$datetime);
        $stmt -> bindValue(':postTitle',$$posttitle);
        $stmt -> bindValue(':category',$category);
        $stmt -> bindValue(':adminName',$admin);
        $stmt -> bindValue(':imageName',$image);
        $stmt -> bindValue(':postdescription',$$posttext);

        $Excute= $stmt->execute();

        move_uploaded_file($_FILES["image"]["tmp_name"],$target);

        if($Excute){
            $_SESSION['SuccessMessage'] = 'post with id'.$conn->lastINsertid()."addedd successfully";
            Redirect_to("addnewpost.php");
        }else{
            $_SESSION['ErrorMessage'] = "something went wrong";
            Redirect_to("addnewpost.php");
        }
       

    }


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    
  <!-- navbar -->
  <div style="height: 10px; background: #27aae1;"></div>

  <nav class="navbar navbar-expand navbar-dark bg-dark">
    <div class="container" >
        <a href="#" class="navbar-brand">jazebakram.com</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarcollapseCMS">
        <ul class="navbar-nav mr-auto ">
            <li class="nav-item">
                <a href="myprofile.php" class="nav-link  text- text-white"><i class="fa-solid fa-user text-succcess"></i>my profile</a>
            </li>
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link">dashboard</a>
            </li>
            <li class="nav-item">
                <a href="post.php" class="nav-link">post</a>
            </li>
            <li class="nav-item">
                <a href="categories.php" class="nav-link">categories</a>
            </li>
            <li class="nav-item">
                <a href="admin.php" class="nav-link">manage admin</a>
            </li>
            <li class="nav-item">
                <a href="comment.php" class="nav-link">comment</a>
            </li>
            <li class="nav-item">
                <a href="blog.php?page=1" class="nav-link">live blog</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto ">
            <li class="nav-item"><a href="logout.php" class="nav-link text-danger "><i class="fas fa-user-times"></i>logout</a></li>
        </ul>
    </div>
    </div>
  </nav>
  <div style="height: 10px; background: #27aae1;"></div>
  <!-- header -->
  <header class="bg-dark text-white py-5">
  <div class="container">
    <div class="row">
       <div class="col-md-12">
        <h1><i class="fas fa-edit" style="color: #27aae1;"></i>Add new post</h1>
       </div>
    </div>
  </div>
</header>
  <!-- header -->
  <!-- main area  -->
  <section class="container py-2 mb-4">
    <div class="row" >
<div class="offset-lg-1 col-lg-10" style="min-height:400px;" >
<?php
 echo Errormessage();
 echo successmessage();

?>
   <form action="addnewpost.php" method="post" enctype="multipart/form-data">
    <div class="card bg-secondry text-aling mb-3">
        
        <div class="card-body bg-dark">
            <div class="form-group">
                <label for="title"> <span class="feildinfo"></span>post title:</label>
                <input class="form-control" type="text" name="posttitle" id="title" placeholder="type tittle here" value="">
            </div>
            <div class="form-group">
                <label for="categorytitle"> <span class="feildinfo"></span>category title:</label>
                <select class="form-control" name="category" id="categorytitle">
                   <?php
                   global $conn;

                   $sql = "SELECT id,title from `category` ";

                   $stmt  = $conn->query($sql);

                   while($daterows = $stmt->fetch()){
                    $id = $daterows['id'];
                    $title = $daterows['title'];
                    ?>
               <option><?php  echo $title; ?></option>
               <?php } ?>
                
                
               
                </select>
            </div>
            <div class="form-group mb-1">
            
            <div class="custom-file">
            <input class="custom-file-input" type="file" name="image" id="imageselect">
            <label for="imageselect" class="custom-file-label">select image</label>
            </div>
            </div>
            <div class="form-group">
            <label for="post"> <span class="feildinfo"></span>post:</label>
            <textarea class="form-control" name="postdescription" id="post" cols="80" rows="8"></textarea>
            </div>
            <div class="row" >
        <div class="col-lg-6 mb-2" >
            <a href="dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i>back to dashboard</a>
        </div>
        <div class="col-lg-6 mb-2">
           <button type="submit" name="submit" class="btn btn-success btn-block">
            <i class="fas fa-check"></i>publish
           </button>
        </div>
        </div>
        </div>
    </div>
   </form>
</div>
</div>
  </section>
  <!-- main area  -->


  <footer class="bg-dark text-white">
    <div class="container">
        <div class="row">
            <div class="col">
            <p class="lead text-center">theme by me/ 
              <span id="year"></span>  $copy; ------all right reserved</p>
              <p class="text-center small" ><a style="color: white; text-decoration: none; cursor: pointer;" href="" target="_blank">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo accusantium quia molestias cumque.</a></p>
        </div>
    </div>
    </div>
  </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        $('year').text(new Date().getFullYear());
    </script>
</body>
</html>