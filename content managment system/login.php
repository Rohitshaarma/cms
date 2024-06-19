<?php
require_once("includes/db.php");
require_once("includes/function.php");
require_once("includes/session.php");
?>
<?php
if(isset($_SESSION['userid'])){
    Redirect_to("dashboard.php");
}
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)){
        $_SESSION['ErrorMessage'] = 'all feild must be filled ';
        Redirect_to("login.php");
    }else{
          $found =  login($username,$password);
          if($found){
            $_SESSION['User_ID'] = '$found["id"]';
            $_SESSION['Username'] = '$found["username"]';
            $_SESSION['AdmiNname'] = '$found["aname"]';
            $_SESSION['Successmessage'] = "welcome ". $_SESSION["AdmiNname"];
            if(isset($_SESSION["trackingurl"])){
                Redirect_to($_SESSION['trackingurl']);
            }else{
                
                Redirect_to('dashboard.php');
            }
          }else{
            $_SESSION['ErrorMessage'] = 'incorrect username/password';
            Redirect_to('login.php');
          }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
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
       
    </div>
    </div>
  </nav>
  <div style="height: 10px; background: #27aae1;"></div>
  <!-- header -->
  <header class="bg-dark text-white py-5">
  <div class="container">
    <div class="row">
       <div class="col-md-12">
        
       </div>
    </div>
  </div>
</header>
  <!-- header -->
  <!-- main area  -->
  <section class="container py-2 mb-4">
    <div class="row">
        <div class="offset-sm-3 col-sm-6" style="min-height:500px; ">
        <br><br><br>
        <?php
 echo Errormessage();
 echo successmessage();

?>
        <div class="card bg-secondry text-light">
            <div class="card-header">
                <h4>welcome back</h4>
                </div>
                <div class="card-body bg-dark">

               
                <form action="login.php" method="post">
                    <div class="from-group">
                        <label for="username"><span class="fieldinfo">username</span></label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepand">
                                <span class="input-group-text text-white bg-info"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" name="username" id="username" value="">
                        </div>
                    </div>
                    <div class="from-group">
                        <label for="password"><span class="fieldinfo">password</span></label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepand">
                                <span class="input-group-text text-white bg-info"><i class="fas fa-log"></i></span>
                            </div>
                            <input type="password" class="form-control" name="password" id="password" value="">
                        </div>
                    </div>
                    <input type="submit" name="submit" class="btn btn-info btn-block" value="login">
                </form>
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