<?php
if(isset($_POST['login']) && $_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['email']) && !empty($_POST['pwd'])){
    require "../cnx.php";
    $con = cnx_pdo();
    //---------verifier si user exist------------
    $reqUser = $con->prepare("SELECT * FROM users WHERE email =:email");
    $reqUser->bindValue(':email',$_POST['email']);
    $reqUser->execute();
    $user = $reqUser->fetch();
    //var_dump($user);
    $msg = "";
    if($user!=null){
        $hashed_pwd = sha1($_POST['pwd']);
        if($hashed_pwd === $user['password']){
            //-----------Redirection-------------------
          session_start();
          $_SESSION['open'] = true;
          $_SESSION['email'] = $user['email'];
          $_SESSION['nav']  =$_SERVER["HTTP_USER_AGENT"]; //navigateur
          $_SESSION['ip'] = $_SERVER['REMOTE_ADDR']; //ip
          
        
          header("Location:../Shop/index.php");
          exit;
        }else{
            $msg = "Error password ";
        }// if($hashed_pwd === $user['password'])
        
    }else{
        $msg = "Error Email ";
    }//if($user!=null)
}

?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
  </head>

<body>
<script src="../js/bootstrap.bundle.js"></script>
<!--Header -->
<div class="container">
  <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-2 mb-2 border-bottom">
    <div class="col-md-3 mb-2 mb-md-0">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
        <span class="fs-4"><strong>MecAssist</strong></span>
      </a>
    </div>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
      <li><a href="#" class="nav-link px-2 link-secondary">Home</a></li>
      <li><a href="#" class="nav-link px-2 link-body-emphasis">Community</a></li>
      <li><a href="../Shop/index.php" class="nav-link px-2 link-body-emphasis">Shop</a></li>
      <li><a href="#" class="nav-link px-2 link-body-emphasis">FAQs</a></li>
      <li><a href="#" class="nav-link px-2 link-body-emphasis">About</a></li>
    </ul>
      
    <div class="col-md-3 text-end">
      <a href="../LogIn/index.php" class="btn btn-outline-danger me-2">Login</a>
      <a href="../SignUp/index.php" class="btn btn-danger">Sign-up</a>
    </div>
  </header>
</div>

<!--Main Page-->

<div class="bg-img">
  <main>
    <form class="container" method="post" style="padding: 15%; text-align: center;" action='<?=htmlentities($_SERVER['PHP_SELF']) ?>'>
      <h1><span class="badge badge-light">Login</span></h1>
      <div class="form-floating mb-3">
        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>      
      </div>
      <div class="form-floating">
        <input type="password" name="pwd" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>
      <button type="submit" name="login" class="btn btn-danger"><strong>Login</button>
      <button type="button" class="btn btn-outline-light" >Forgot Password?</strong></button>
    </form>
  </main>
</div>
</div>
</body>
</html>