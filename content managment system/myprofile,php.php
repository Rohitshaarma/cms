<?php
require_once("includes/db.php");
require_once("includes/function.php");
require_once("includes/session.php");
?>
<?php 
$_SESSION["trackingurl"] = $_SERVER['PHP_SELF'];
confirmlogin(); ?>
<?php
$adminid = $_SESSION['User_ID'];
$sql = "SELECT * FROM table WHERE id = '$adminid'";
$result =  mysqli_query($conn,$sql);
while($datarows = mysqli_fetch_array($result)){
    $name = $datarows['aname'];
    $eusername = $datarows['username'];
    $eheadline = $datarows['aheadline'];
    $ebio = $datarows['abio'];
    $eimage = $datarows['aimage'];
}
if(isset($_POST["submit"])){


    $aname = $_POST["name"];
    $aheadline = $_POST['headline'];
    $abio = $_POST['abio'];
    $image = $_FILES['image']['name'];
    $target = "image/".basename($_FILES['image']['name']);
  

   if(strlen($aheadline) >30){

        $_SESSION['Errormessage'] = "headline should be less than 30 characters";
        Redirect_to("myprofile.php");
    }elseif(strlen($abio) >500){

        $_SESSION['Errormessage'] =" bio should be less than 500 characters";
        Redirect_to("myprile.php");
    }else{
        global $conn;
      if(!empty($image)){

          $sql = "UPDATE admin SET `aname`='$aname', `aheadline`,'$aheadline',`abio`='$abio' , `aimage`='$image' WHERE id = '$adminid'";
        }else{
            
            $sql = "UPDATE admin SET `aname`='$aname', `aheadline`,'$aheadline',`abio`='$abio'  WHERE id = '$adminid'";
      }
      $result = mysqli_query($conn,$sql);
      
      move_uploaded_file($_FILES['image']['tmp_name'],$target);

      if($execute){
        $_SESSION["SuccessMesssage"] = "details updated successfull";
        Redirect_to("myprofile.php");
      }else{
        $_SESSION['Errormessage'] = "somethinf went wrong. try again";
        Redirect_to("myprofile.php");
      }

    }


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my profile</title>
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
        <h1><i class="fas fa-user text-success mr-2"></i>@<?php echo $eusername;?> </h1>
        <small><?php echo $ebio;?></small>
       </div>
    </div>
  </div>
</header>
  <!-- header -->
  <!-- main area  -->
  <section class="container py-2 mb-4">
    <div class="row" >
        <div class="col-md-3">
    <div class="card">
        <div class="card-header bg-dark text-light">
            <h3><?php echo $name;?></h3>
        </div>
        <div class="card-body">
            <img src="images/<?php echo $eimage; ?>" class="block img-fulid mb-3" alt="">
            <div class="">
              <?php echo $ebio;?>

            </div>
        </div>
    </div>
        </div>
<div class="col-lg-9" style="min-height:400px;" >
<?php
 echo Errormessage();
 echo successmessage();

?>
   <form action="myprofile.php.php" method="post" enctype="multipart/form-data">
    <div class="card bg-dark text-aling">
       <div class="card-header bg-secondry text-light">
        <h4>edit profile</h4>
       </div>
        <div class="card-body">
            <div class="form-group">
                
                <input class="form-control" type="text" name="name" id="title" placeholder="your name" value="">
              
            </div>
            <div class="form-group">
                
                <input class="form-control" type="text" id="title" placeholder="headline"  name="headline">
                <small class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit.</small>
                <span class="text-danger">not more than 30 characters</span>
            </div>
            <div class="from-group">
       
            <textarea placeholder="bio"c class="form-control" id="post" name="bio" row="8" id=""></textarea>
            </div>
          
            <div class="form-group">
            <div class="custom-file">
            <input class="custom-file-input" type="file" name="image" id="imageselect">
            <label for="imageselect"  class="custom-file-label">select image</label>
            </div>
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