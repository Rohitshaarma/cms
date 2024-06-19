<?php
require_once("includes/db.php");
require_once("includes/function.php");
require_once("includes/session.php");
?>
<?php
$_SESSION["trackingurl"] = $_SERVER['PHP_SELF'];
// echo $_SESSION["trackingurl"];
confirmlogin(); ?>
<?php

if(isset($_POST["submit"])){


    $category = $_POST["categorytitle"];
    $admin = $_SESSION['username'];
    date_default_timezone_get("Asia/karachi");
    $currenttime = time();
    $datetime = strftime("%B-%d-%y-%H-%M-%S",$currenttime);

    if(empty($category)){
        $_SESSION['Errormessage'] = "All field must be filled out";
        Redirect_to("categories.php");

    }elseif(strlen($category) < 3){

        $_SESSION['Errormessage'] = "category title should be greater than 2 characters";
        Redirect_to("categories.php");
    }elseif(strlen($category) >49){

        $_SESSION['Errormessage'] = "category title should be less than 50characters";
        Redirect_to("categories.php");
    }else{
      global $conn;
      $sql = "INSERT INTO categories(`title`,`author`,datetime)";
      $sql = "VALUES(:categoriesNeme:adminName:dateTime)";
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':categoryName',$category);
      $stmt->bindValue(':adminName',$admin);
      $stmt->bindValue(':dateTime',$datetime);
      $execute-$stmt->execute();

      if($execute){
        $_SESSION["SuccessMesssage"] = "categories with id :".$conn->LastINSERTid()."added successfully";
        Redirect_to("categories.php");
      }else{
        $_SESSION['Errormessage'] = "somethinf went wrong. try again";
        Redirect_to("categories.php");
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
        <h1><i class="fas fa-edit" style="color: #27aae1;"></i>Manage categories</h1>
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
   <form action="categories.php" method="post">
    <div class="card bg-secondry text-aling mb-3">
        <div class="card-header">
            <h1>add new category</h1>
        </div>
        <div class="card-body bg-dark">
            <div class="form-group">
                <label for="title"> <span class="feildinfo"></span>category title:</label>
                <input class="form-control" type="text" name="categorytitle" id="title" placeholder="type tittle here" value="">
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

   <h2>existing category</h2>
    <table class="table table-stripped table-hover">
        <thead class="thead-dark">
            <tr>
                <th>no</th>
                <th>datetime</th>
                <th>category name</th>
                <th>creator name</th>
                <th>action</th>
              
              
            </tr>
        </thead>

    <?php
     $sql = "SELECT * FROM category  oRDER BY id desc" ;
     $result = mysqli_query($conn,$sql);
     $srno = 0;

     while($datarows = mysqli_fetch_array($result)){
        $categoryid = $datarows['id'];
        $categorydate = $datarows['adtetime'];
        $categoryname = $datarows['title'];
        $creatorname = $datarows['author'];
        $srno ++;
     
       

     
    ?>
    <tbody>
        <tr>
            <td><?php echo htmlentities($srno);?></td>
            <td><?php echo htmlentities($categorydate);?></td>
            <td><?php echo htmlentities($categoryname);?></td>
            <td><?php echo htmlentities($creatorname);?></td>
           
            <td style="min-height:140px;" class="btn btn-danger"><a href="deletecategory.php?id=<?php echo $categoryid;?>"></a>approve </td>
          
        </tr>
    </tbody>
    <?php 
}
?>
    </table>
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