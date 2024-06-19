<?php
require_once("includes/db.php");
require_once("includes/function.php");
require_once("includes/session.php");
?>
<?php 
$_SESSION["trackingurl"] = $_SERVER['PHP_SELF'];
// echo $_SESSION["trackingurl"];
confirmlogin(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>post</title>
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
        <h1><i class="fas fa-blog" style="color: #27aae1;"></i>blog post</h1>
       </div>
       <div class="col-lg-3 mb-2">
        <a href="addnewpost.php" class="btn btn-primary btn-block">
            <i class="fas fa-edit"></i> add new post
        </a>
       </div>
       <div class="col-lg-3 mb-2">
        <a href="categories.php" class="btn btn-info btn-block">
            <i class="fas fa-folder-plus"></i> add new category
        </a>
       </div>
       <div class="col-lg-3 mb-2">
        <a href="admin.php" class="btn btn-warning btn-block">
            <i class="fas fa-user-plus"></i> add new admin
        </a>
       </div>
       <div class="col-lg-3 mb-2">
        <a href="comment.php" class="btn btn-success btn-block">
            <i class="fas fa-check"></i> approove comment
        </a>
       </div>
    </div>
  </div>
</header>
  <!-- header -->
  <!-- main area  -->
  <section class="container py-2 mb-4">
    <div class="row">
        <div class="col-lg-12">
        <?php
 echo Errormessage();
 echo successmessage();

?>
            <table class="table table-stripped table-hover">
                <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>title</th>
                    <th>category</th>
                    <th>datetime</th>
                    <th>author</th>
                    <th>banner</th>
                    <th>comment</th>
                    <th>action</th>
                    <th>live priview</th>
                </tr>
                </thead>
                <?php
                global $conn;
                  $sql = "SELECT * FROM `post`";
                  $stmt = $conn->query($sql);
                    $sr = 0;
                  while($datarows = mysqli_fetch_array($stmt)){
                    $id = $datarows['id'];
                    $dateTime =  $datarows['datetime'];
                    $title = $datarows['title'];
                    $category = $datarows['category'];
                    $admin = $datarows['author'];
                    $image = $datarows['image'];
                    $postText = $datarows['post'];
                    $sr++;
                  
                ?>
                <tbody>
                <tr>
                    <td><?php echo $sr;?></td>
                    <td class="table-danger">
                        <?php if (strlen($title)>20){$title = substr($title,0,18).'..';}
                         echo $title?></td>
                    <td>
                        <?php if (strlen($category)>8){$category = substr($category,0,8).'..';}
                        echo $category?></td>
                    <td><?php if (strlen($dateTime)>11){$dateTime = substr($dateTime,0,11).'..';}
                    echo $dateTime?></td>
                    <td class="table-primary">
                        <?php if (strlen($admin)>6){$admin = substr($admin,0,18).'..';}
                        echo $admin?></td>
                    <td><img src="upload/<?php echo $image?>" width="170px;" height="50px"></td>
                    <td>
                            <?php $total = approve(id);
                            if($total>0){
                            ?>
                                <span class="badge badge-success">
                                    <?php

                                echo $total; ?>

                                </span>

                                <?php
                            }
                            ?>
                        <?php  $total = disapprove(id);
                            if($total>0){
                            ?>
                                <span class="badge badge-danger">
                                    <?php

                                echo $total; ?>

                                </span>

                                <?php
                            }
                            ?>
                    </td>
                    <td>
                        <a href="editpost.php?id=<?php echo $id;?>"><span class="btn btn-warning">edit</span></a>
                        <a href="deletepost.php?id=<?php echo $id;?>"><span class="btn btn-danger">delete</span></a>
                </td>
                    <td><a href="fullpost.php?id=<?php echo $id;?>" target="_blank"><span class="btn btn-primary">live preview</span></a></td>
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