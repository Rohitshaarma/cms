<?php
require_once("includes/db.php");
require_once("includes/function.php");
require_once("includes/session.php");
?>
<?php 
$search = $_GET['id'];
?>
<?php
if(isset($_POST["submit"])){


    $name = $_POST["commentname"];
    $email = $_POST["commentemail"];
    $comment = $_POST["commentthought"];

    date_default_timezone_get("Asia/karachi");
    $currenttime = time();
    $datetime = strftime("%B-%d-%y-%H-%M-%S",$currenttime);

    if(empty($name)||empty($email||empty($comment))){
        $_SESSION['Errormessage'] = "All field must be filled out";
        Redirect_to("fullpost.php?id={$search}");

    }elseif(strlen($comment) < 500){

        $_SESSION['Errormessage'] = "commnet lenght should be less than 500 characters";
        Redirect_to("fullpost.php?id={$search}");
    }else{
      global $conn;
      $sql = "INSERT INTO commnet(`datetime`,`name`,email,commnet,approovedby,status,post_id)";
      $sql = "VALUES(:datetime,:name,:email,:commnet,'pending','OFF',:postid)";
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':dateTime',$datetime);
      $stmt->bindValue(':name',$name);
      $stmt->bindValue(':email',$email);
      $stmt->bindValue(':comment',$comment);
      $stmt->bindValue(':postid',$search);
      $execute-$stmt->execute();

      if($execute){
        $_SESSION["SuccessMesssage"] = "commnet submitted successfully";
        Redirect_to("fullpost.php?id={$search}");
      }else{
        $_SESSION['Errormessage'] = "somethinf went wrong. try again";
        Redirect_to("fullpost.php?id={$search}");
      }

    }


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>full blog page</title>
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
  <div class="container">
    <div class="row mt-4">
        <div class="col-sm-8  ">
            <h1>Lorem ipsum dolor sit amet consectetur.</h1>
            <h1 class="lead">Lorem ipsum dolor sit amet consectetur.</h1>
            <?php
 echo Errormessage();
 echo successmessage();

?>
            <?php
             if(isset($_GET['searchbutton'])){
                $search = $_GET['search'];
                $sql ="SELECT * FROM post WHERE `datetime` LIKE $search OR `category` LIKE $search OR `title` LIKE $search OR `post` LIKE $search";
                $result = mysqli_query($conn,$sql);
                $result ->bindValue(':search','%'.$search.'%');

             }
           else{
            $id = $_GET['id'];
            if(!isset($id)){
                $_SESSION['Errormessage'] = "bad request";
                Redirect_to("blog.php");
            }
             $sql ="SELECT * FROM post WHERE id='$id'";
            $result = mysqli_query($conn,$sql);
           $res = $result->rowcount();
           if($res!=1 ){
            $_SESSION['Errormessage'] = "bad request";
                Redirect_to("blog.php?page=1");
           }
        
        }
            while($datarows = mysqli_fetch_array($result)){
                $postid = $datarows['id'];
                $datetime = $datarows['datetime'];
                $title = $datarows['title'];
                $category = $datarows['category'];
                $admin = $datarows['author'];
                $image = $datarows['image'];
                $post = $datarows['post'];
            
            ?>
            <div class="card">
                <img src="upload/<?php echo htmlentities($image);?>" style="min-height:450px;" class="img-fluid card-img-top"/>
                <div class="card-body">
                    <h4 class="crad-title"><?php echo htmlentities($title)?></h4>
                    <small class="text-muted"> category :<span class="text-dark"><a href="blog.php?category<?php echo htmlentities($category);?>"><?php echo htmlentities($category);?></a></span>   &written by <span class="text-dark"><a href="profile.php?username=<?php echo htmlentities($admin);?>"><?php echo htmlentities($admin);?></a></span> on <?php echo htmlentities($datetime);?></small>
                  
                    <hr>
                    <p class="card-text">
                        <?php 
                        echo nl2br($post);?></p>
                 
                </div>
            </div>
            <?php }?>
            <span class="fieldinfo">comment</span>
            <br><br>
            <?php 
            $sql = "SELECT * FROM commnet WHERE post_id = '$search' AND status='ON'";
            $result = mysqli_query($conn,$sql);
            while($datarow = mysqli_fetch_array($result)){
                $date = $datarow['datetime'];
                $name = $datarow['name'];
                $commentcontent = $datarow['content'];
            
            ?>
            <div>
              
                <div class="media commnetblock ">
                    <img class="d-block img-fuild align-self-start" src="image/commnet.php" alt="">
                    <div class="media-body ml-2">
                        <h6 class="lead"><?php echo $name;?></h6>
                        <p class="small"><?php $date;?></p>
                        <p><?php $commentcontent;?></p>
                    </div>
                </div>
            </div>
            <hr>
            <?php }?>
            <div class="">
                <form action="fullpost.php?id=<?php echo $search;?>" method="post">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="fieldInfo">Lorem ipsum dolor sit amet consectetur.</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="inut-group-prepand">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input class="form-control" type="text" name="commentname" placeholder="name" id="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="inut-group-prepand">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input class="form-control" type="email" name="commentemail" placeholder="email" id="">
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea name="commnetthoughts" class="form-control" row="6" cols="80" id=""></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">submit</button>
                </div>
            </div>
        </form>
            </div>
        </div>
        <div class="col-sm-4">

<dic class="card mt-4">
    <div class="card-body">
        <img src="image/" class="d-block img-fluid mb-3">
        <div class="text-center">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum laboriosam hic consequatur dignissimos distinctio porro labore earum voluptate placeat mollitia!

        </div>
    </div>
</div>
<br>
<div class="card">
    <div class="card-header bg-dark text-light">
        <h2 class="lead">sign up !</h2>
    </div>
    <div class="card-body">
        <button type="button" class="btn btn-success btn-block text-center text-white mb-4" name="button">join the forum</button>
        <button type="button" class="btn btn-danger btn-block text-center text-white mb-4" name="button">login</button>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="" placeholder="enter you email" id="">
            <button type="button" class="btn btn-primary btn-sm text-center text-white" name="button">subscribe now</button>
        </div>
    </div>
</div>
</div>
</div>
<br>
<div class="card">
<div class="card-header bg-primary text-light">
    <h2 class="lead">category</h2>
    </div>
    <div class="card-body">
        <?php
        $sql = "SELECT * FROM category ORDER BY id desc";
        $result = mysqli_query($conn,$sql);
        while($datarows = mysqli_fetch_array($result)){
            $id = $datarows['id'];
            $name = $datarows['title'];
        
        ?>
       <a href="blog.php?category=<?php echo  $name;?>"> <span class="heading"><?php echo $name;?></span></a><br>
        <?php }?>
    
</div>
</div>
<br>
<div class="card">
<div class="card-header bg-info text-white">
    <h2 class="lead">recent post</h2>
</div>
<div class="card-body">
    <?php
    $sql = "SELECT * FROM post ORDER BY id desc LIMIT 0,5 ";
    $result = mysqli_query($conn,$sql);
    while($datarows = mysqli_fetch_array($result)){
        $id = $datarows['id'];
        $title = $datarows['title'];
        $datetime = $datarows['datetime'];
        $image = $datarows['image'];

    

    ?>
    <div class="media">
        <img src="upload/<?php echo htmlentities($image) ;?>" class="d-block img-fluid align-self-start" width="90" height="94" alt="">
        <div class="media-body ml-2">
           <a href="fullpost.php?id=<?php echo htmlentities($id)?> " target="_blank"> <h6 class="lead"><?php echo htmlentities( $title);?></h6></a>
            <p class="small"><?php echo htmlentities($datetime);?></p>
        </div>
    </div>
    <hr>
    <?php }?>
</div>
</div>
</div>
    </div>
  </div>
  <!-- header -->
  <!-- main area  -->
  
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