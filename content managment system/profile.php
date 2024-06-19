<?php
require_once("includes/db.php");
require_once("includes/function.php");
require_once("includes/session.php");
?>
<?php
$search = $_GET['username'];

$sql ="SELECT aname,aheadline,abio,aimage FROM admin WHERE username = '$search'";
$result = mysqli_query($conn,$sql);
$res = $result->rowcount();
if($res ==1 ){
    while($datarows = mysqli_fetch_array($res)){
        $ename = $datarows['aname'];
        $ebio = $datarows['abio'];
        $aimage = $datarows['aimage'];
        $aheadline = $datarows['aheadline'];
    }
}else{
    $_SESSION['Errormessage'] = "bad request";
    Redirect_to('blog.php?page=1');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    
  <!-- navbar -->
  <div style="height: 10px; background: #27aae1;"></div>

  <nav class="navbar navbar-expand navbar-dark bg-dark">
    <div class="container" >
        <a href="#" class="navbar-brand">rohit.com</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarcollapseCMS">
        <ul class="navbar-nav mr-auto ">
           
            <li class="nav-item">
                <a href="blog.php" class="nav-link">home</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">about us</a>
            </li>
            <li class="nav-item">
                <a href="blog.php" class="nav-link">blog</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">contact us</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">feature</a>
            </li>
           
        </ul>
        <ul class="navbar-nav ml-auto ">
            <form class="form-inline d-none d-sm-block " action="blog.php" method="post">
                <div class="form-group">
    <input type="text" class="form-control mr-2" name="search" placeholder="type here" id="">
    <button  class="btn btn-primary" name="searchbutton">go</button>
   
    </div>
            </form>
        </ul>
    </div>
    </div>
  </nav>
  <div style="height: 10px; background: #27aae1;"></div>
  <!-- header -->
  <header class="bg-dark text-white py-5">
  <div class="container">
    <div class="row">
       <div class="col-md-6">
        <h1><i class="fas fa-user text-success mr-2" style="color: #27aae1;"></i><?php echo $ename;?></h1>
        <h3><?php echo $aheadline;?></h3>
       </div>
    </div>
  </div>
</header>
  <!-- header -->
  <!-- main area  -->
  <section class="container py mb-4">
    <div class="row">
        <div class="col-md-3">
            <img src="image/<?php echo $aimage;?>" class="d-block img-fluid mb-3 rounded-circle" alt="">
        </div>
        <div class="col-md-9 " style="min-hieght:350px">
            <div class="card">
                <div class="card-body">
                    <p class="lead"><?php echo $ebio;?></p>
                </div>
            </div>
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