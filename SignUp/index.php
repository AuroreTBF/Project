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
<?php
include '../cnx.php';
$con = cnx_pdo();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //---------verifier si user exist------------
  $reqUser = $con->prepare("SELECT * FROM users WHERE email =:email");
  $reqUser->bindValue(':email',$_POST['email']);
  $reqUser->execute();
  $user = $reqUser->fetch();
  $nameErr = "";
  $lastnameErr ="";
  $emailErr = "";
  $addressErr = "";
  $pwErr = "";
  if(empty($_POST['firstname'])){
    $nameErr = "First Name is required";
  }else {
    if (!preg_match("/^[a-zA-Z-' ]*$/",$_POST['firstname'])) {
      $nameErr = "Only letters and white space allowed";
    }
    else{
      $name = $_POST['firstname'];
    }
    
  }

  if(empty($_POST['lastname'])){
    $lastnameErr = "Last Name is required";
  }else {
    if (!preg_match("/^[a-zA-Z-' ]*$/",$_POST['lastname'])) {
      $lastnameErr = "Only letters and white space allowed";
    }
    else{
      $lastname = $_POST['lastname'];
    }
  }

  if(empty($_POST['email'])){
    $emailErr = "Email is required";
  }else {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
    else if ($user!=null){
      $emailErr = "Email exists already";
    }
    else{
      $email = $_POST['email'];
    }
  }
  if(empty($_POST['address'])){
    $addressErr = "Address is required";
  }else {
    $address = $_POST['address'];
  }
  if(empty($_POST['password'])){
    $pwErr = "Password is required";
  }else {
    $password = $_POST['password'];
  }
  if($_POST['confirmpassword'] != $_POST['password']){
    $pwErr = "Please confirm your password";
  }else {
    $confirmpassword = $_POST['confirmpassword'];
  }
if (!empty($password) && !empty($confirmpassword)&& !empty($name) && !empty($lastname) && !empty($email)){
$req_prep = $con->prepare("INSERT INTO users (`id`, `firstname`, `lastname`, `email`, `password`, `date`, `address`)VALUES (NULL,:firstname,:lastname,:email,:pass,current_timestamp(),:address1);");
$req_prep->bindValue(':firstname', $name);
$req_prep->bindValue(':lastname', $lastname);
$req_prep->bindValue(':email', $email);
$req_prep->bindValue(':address1', $address);
if ($password == $confirmpassword){
    $hash = sha1($password);
    $req_prep->bindValue(':pass',$hash);
    $req_prep->execute(); 
    header('location: ../LogIn/index.php');
}
} 
}
?>
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
      <li><a href="../Shop/index.php" class="nav-link px-2 link-body-emphasis active">Shop</a></li>
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
<div class="bg-img" style="margin-top: 0%;">
  <main>
    <div class="container">
        <form class="row g-3 needs-validation was-validated" novalidate="" style="text-align: center; float: right;" method="post" action='<?=htmlentities($_SERVER['PHP_SELF']) ?>'>
            <h1><span class="badge badge-danger" style="text-shadow: 1px;">Sign Up</span></h1>
              <div class="col-md-3 position-relative">
                <label for="validationTooltip01" class="form-label">First name</label>
                <input type="text" class="form-control" id="validationTooltip01" name="firstname" required="<?= $nameErr ?>">
              </div>
              <div class="col-md-3 position-relative">
                <label for="validationTooltip02" class="form-label">Last name</label>
                <input type="text" class="form-control" id="validationTooltip02" name="lastname" required="<?= $lastnameErr ?>">
              </div>
                <div class="col-md-4 position-relative">
                  <label for="validationTooltipUsername" class="form-label">Email</label>
                <div class="input-group has-validation">
                  <input type="text" class="form-control" id="validationTooltipUsername" name="email" aria-describedby="validationTooltipUsernamePrepend" required="<?= $emailErr ?>">
                </div>
              </div>
              <div class="col-md-6 position-relative">
                <label for="validationTooltip03" class="form-label">Address</label>
                <input type="text" class="form-control" id="validationTooltip03" name="address" required="<?= $addressErr ?>">
              </div>
              <div class="col-md-4 position-relative">
              </div>
              <div class="col-12"></div>
                  <div class="col-md-3 position-relative">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="validationTooltip04" required="<?= $pwErr ?>"
                      placeholder="**********" />
                  </div>
                  <br>
                  <!-- input -->
                  <div class="col-md-3 mb-4 position-relative">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="confirmpassword" required="<?= $pwErr ?>"
                      placeholder="**********" />
                  </div>
                  <div class="col-12" style="text-align: center;">
                  
                      <button class="btn btn-danger" type="submit">Create Account</button>
                      <button class="btn btn-secondary" type="reset">Cancel</button>
                  </div>
          </div>
    </form>
  </main>
</div>
</div>
</body>
</html>