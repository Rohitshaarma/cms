<?php
require_once("includes/db.php");
require_once("includes/function.php");
require_once("includes/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>comment</title>
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
        <h1><i class="fas fa-text-height" style="color: #27aae1;"></i>manage commnet</h1>
       </div>
    </div>
  </div>
</header>
  <!-- header -->
  <!-- main area  -->
  <section class="container py-2 mb-4">
      <div class="row" style ="min-height:30px">
        <div class="col-lg-12" style ="min-height:400px">
        <?php
 echo Errormessage();
 echo successmessage();

?>
            <h2>un approved commnet</h2>
    <table class="table table-stripped table-hover">
        <thead class="thead-dark">
            <tr>
                <th>no</th>
                <th>datetime</th>
                <th>name</th>
                <th>commnet</th>
                <th>approve</th>
                <th>delete</th>
                <th>deatils</th>
              
            </tr>
        </thead>

    <?php
     $sql = "SELECT * FROM commnet WHERE status= 'OFF' oRDER BY id desc" ;
     $result = mysqli_query($conn,$sql);
     $srno = 0;

     while($datarows = mysqli_fetch_array($result)){
        $commnetid = $datarows['id'];
        $commnetdate = $datarows['datetime'];
        $commnetname = $datarows['name'];
        $commnetcontent = $datarows['commnet'];
        $commnetpostid = $datarows['post_id'];
        $srno++;
       

     
    ?>
    <tbody>
        <tr>
            <td><?php echo htmlentities($srno);?></td>
            <td><?php echo htmlentities($commnetdate);?></td>
            <td><?php echo htmlentities($commnetname);?></td>
            <td><?php echo htmlentities($commnetcontent);?></td>
            <td style="min-height:140px;" class="btn btn-success"><a href="appovecommnet.php?id=<?php echo $commnetid;?>"></a>approve </td>
            <td style="min-height:140px;"  class="btn btn-danger"><a href="deletecommnet.php?id=<?php echo $commnetid;?>"></a>approve </td>
            <td style="min-height:140px;"  class="btn btn-primary"><a href="fullpost.php?id=<?php echo $commnetpostid;?>" target="_blank">live preview</a></td>
        </tr>
    </tbody>
    <?php
};
?>
    </table>


    <h2> approved commnet</h2>
    <table class="table table-stripped table-hover">
        <thead class="thead-dark">
            <tr>
                <th>no</th>
                <th>datetime</th>
                <th>name</th>
                <th>commnet</th>
                <th>revert</th>
                <th>delete</th>
                <th>deatils</th>
              
            </tr>
        </thead>

    <?php
     $sql = "SELECT * FROM commnet WHERE status= 'ON' oRDER BY id desc" ;
     $result = mysqli_query($conn,$sql);
     $srno = 0;

     while($datarows = mysqli_fetch_array($result)){
        $commnetid = $datarows['id'];
        $commnetdate = $datarows['datetime'];
        $commnetname = $datarows['name'];
        $commnetcontent = $datarows['commnet'];
        $commnetpostid = $datarows['post_id'];
        $srno++;
       

     
    ?>
    <tbody>
        <tr>
            <td><?php echo htmlentities($srno);?></td>
            <td><?php echo htmlentities($commnetdate);?></td>
            <td><?php echo htmlentities($commnetname);?></td>
            <td><?php echo htmlentities($commnetcontent);?></td>
            <td style="min-height:140px;" class="btn btn-warning"><a href="dis-appovecommnet.php?id=<?php echo $commnetid;?>"></a>dis-approve </td>
            <td style="min-height:140px;" class="btn btn-danger"><a href="deletecommnet.php?id=<?php echo $commnetid;?>"></a>approve </td>
            <td style="min-height:140px;" class="btn btn-primary"><a href="fullpost.php?id=<?php echo $commnetpostid;?>" target="_blank">live preview</a></td>
        </tr>
    </tbody>
    <?php
;}
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