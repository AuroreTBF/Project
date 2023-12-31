<?php
session_start();
if(isset($_SESSION['open']) && $_SESSION['open'] && $_SESSION['nav'] == $_SERVER["HTTP_USER_AGENT"] ){
  
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <script src="../js/bootstrap.bundle.js"></script>
  </head>

<body>
<?php
require "../cnx.php";
$con = cnx_pdo();
$reqUser = $con->prepare("SELECT * FROM users WHERE email =:email");
        $reqUser->bindValue(':email',$_SESSION['email']);
        $reqUser->execute();
        $user = $reqUser->fetch();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){        
        $updateaddress = $_POST['address'];
        $updatename = $_POST['name'];
        $updatelastname = $_POST['lastname'];
        $oldpass = sha1($_POST['oldpass']);
        $updatepass = sha1($_POST['newpass']);
if($oldpass === $user['password']){
        $req_prep = $con->prepare("UPDATE users  SET firstname= :fname , password= :pass , address =:addr, lastname =:lname WHERE email =:email");
        $req_prep->bindValue(':email', $_SESSION['email']);
        $req_prep->bindValue(':fname', $updatename);
        $req_prep->bindValue(':lname', $updatelastname);
        $req_prep->bindValue(':addr', $updateaddress);
        $req_prep->bindValue(':pass', $updatepass);
        $req_prep->execute();
}}
?>
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
      <li><a href="#" class="nav-link px-2 link-body-emphasis">Shop</a></li>
      <li><a href="#" class="nav-link px-2 link-body-emphasis">FAQs</a></li>
      <li><a href="#" class="nav-link px-2 link-body-emphasis">About</a></li>
    </ul>
      
    <div class="flex-shrink-0 dropdown">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../profile_icon.jpg" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small shadow">
            <li><a class="dropdown-item" href="../Change Info/index.php">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../logout.php">Sign out</a></li>
          </ul>
        </div>
  </header>
</div>
<div class="bg-img">
  <main>
    <div class="container">
        <div class="row">
            <!-- Navigation on the left -->
            <div class="col-md-3" style="margin-top: 100px;"> <!-- Adjust margin-top as needed -->
                <nav>
                    <ul class="nav1 justify-content-center mb-md-0">
                        <li><a href="#" class="nav-link px-4 link-light font-weight-bold border rounded border-secondary selected">Account Settings</a></li>
                        <li><a href="#" class="nav-link px-2 link-light font-weight-bold border rounded border-secondary li">Profile Details</a></li>
                        <li><a href="#" class="nav-link px-2 link-light font-weight-bold border rounded border-secondary li">Cart</a></li>
                        <li><a href="#" class="nav-link px-2 link-light font-weight-bold border rounded border-secondary li">Manage Wishlist</a></li>
                        <li><a href="#" class="nav-link px-2 link-light font-weight-bold border rounded border-secondary li">Ordered Items</a></li>
                        <li><a href="#" class="nav-link px-2 link-light font-weight-bold border rounded border-secondary li">Delete Account</a></li>
                    </ul>
                </nav>
            </div>
            <!-- Form on the right -->
            <div class="col-md-9">
                <form class="row g-3 needs-validation was-validated" method="POST" action="<?=htmlentities($_SERVER['PHP_SELF']) ?>" style="text-align: center; float: right;">
                    <h1><span class="badge badge-secondary">Account Details</span></h1>
                      <div class="col-md-3 position-relative">
                        <label for="validationTooltip01" class="form-label">First name</label>
                        <input type="text" class="form-control" name="name" id="validationTooltip01" value="<?=$user['firstname']?>">
                      </div>
                      <div class="col-md-3 position-relative">
                        <label for="validationTooltip02" class="form-label">Last name</label>
                        <input type="text" class="form-control" name="lastname" id="validationTooltip02" value="<?=$user['lastname']?>">
                      </div>
                        <div class="col-md-4 position-relative">
                          <label for="validationTooltipUsername" class="form-label">Email</label>
                        <div class="input-group has-validation">
                          <input type="text" class="form-control" name="email" id="validationTooltipUsername" aria-describedby="validationTooltipUsernamePrepend" value="<?=$user['email']?>">
                        </div>
                      </div>
                      <div class="col-md-6 position-relative">
                        <label for="validationTooltip03" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" id="validationTooltip03" value="<?=$user['address']?>">
                      </div>
                      <div class="row">
                      <div class="col-12"></div>
                          <div class="col-md-3 position-relative">
                            <label class="form-label">Old Password</label>
                            <input type="password" class="form-control" id="validationTooltip04" name="oldpass"
                              placeholder="**********" />
                          </div>
                          <br>
                          <!-- input -->
                          <div class="col-md-3 mb-4 position-relative">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control" name="newpass"
                              placeholder="**********" />
                          </div>
                          <div class="col-12" style="text-align: center;">
                              <button class="btn btn-danger" name="change" type="submit">Confirm Changes</button>
                              <button class="btn btn-secondary" type="reset">Cancel</button>
                          </div>
                          </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>
  </body>
</html>
<?php
}else{
  header("Location:../LogIn/index.php");
  exit;
}

?>