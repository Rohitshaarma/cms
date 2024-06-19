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
    <title>dashboard</title>
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
        <h1><i class="fas fa-cog" style="color: #27aae1;"></i>dashboard</h1>
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
        <?php
 echo Errormessage();
 echo successmessage();

?>
        <div class="col-lg-12 d-none d-md-block">
            <div class="card text-center bg-dark text-white mb-3">
                <div class="card body">
                    <h1 class="lead">post</h1>
                    <h4 class="display-5">
                        <i class="fab fa-readme"></i>
                        <?php
                        totalpost();
                        ?>
                    </h4>
                </div>
            </div>
        </div>
            <div class="card text-center bg-dark text-white mb-3">
                <div class="card body">
                    <h1 class="lead">categories</h1>
                    <h4 class="display-5">
                        <i class="fas fa-folder"></i>
                        <?php
                        totalcategory();

                        ?>
                    </h4>
                </div>
            </div>
        </div>
            <div class="card text-center bg-dark text-white mb-3">
                <div class="card body">
                    <h1 class="lead">admin</h1>
                    <h4 class="display-5">
                        <i class="fas fa-user"></i>
                        <?php
                     totaladmin();
                        ?>
                    </h4>
                </div>
            </div>
        </div>
            <div class="card text-center bg-dark text-white mb-3">
                <div class="card body">
                    <h1 class="lead">comment</h1>
                    <h4 class="display-5">
                        <i class="fas fa-commnet"></i>
                        <?php
                     totalcommnet();

                        ?>
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-lg-10">
            <h1>top post</h1>
            <table class="table table-stripped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>no</th>
                        <th>title</th>
                        <th>datetime</th>
                        <th>author</th>
                        <th>commnets</th>
                        <th>deatils</th>
                    </tr>
                </thead>
                <?php
                $srno = 0;
                $sql = "SELECT * FROM post ORDER BY id desc LIMIT 0,5";

                $result = mysqli_query($conn,$sql);

                while($datarows = mysqli_fetch_array($result)){
                    $id = $datarows['id'];
                    $datetime = $datarows['datetime'];
                    $author = $datarows['author'];
                    $title = $datarows['title'];
                    $srno ++;
                
                
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $srno?></td>
                        <td><?php echo $title?></td>
                        <td><?php echo $datetime?></td>
                        <td><?php echo $author?></td>
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
                        <td><a target="_blank" href="fullpost.php?id=<?php echo $id ;?>"><span class="badge btn-success">preview</span></a></td>
                    </tr>
                </tbody>
                <?php }?>
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