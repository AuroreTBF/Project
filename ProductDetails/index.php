<?php
session_start();
if(isset($_SESSION['open']) && $_SESSION['open'] && $_SESSION['nav'] == $_SERVER["HTTP_USER_AGENT"] ){
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="fontawesome/css/brands.css">
    <link rel="stylesheet" href="fontawesome/css/solid.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="app.js"></script>
  </head>
<body>
<!--Header -->
<?php
$quantity=7;
$value = isset($_POST['item']) ? $_POST['item'] : 1; //to be displayed
if(isset($_POST['incqty'])){
  if($value < $quantity){
   $value += 1;
  }
}
if(isset($_POST['decqty'])){
  if($value >=0){
    $value -= 1;                                          
}}
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
      <li><a href="#" class="nav-link px-2 link-body-emphasis">Home</a></li>
      <li><a href="#" class="nav-link px-2 link-body-emphasis">Community</a></li>
      <li><a href="" class="nav-link px-2 link-body-emphasis">Shop</a></li>
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
  <main>
  <div class="container my-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb p-3 bg-body-tertiary rounded-3">
      <li class="breadcrumb-item">
        <a class="link-body-emphasis" href="">
        <i class='bx bxs-home'></i>
          <span class="visually-hidden">Home</span>
        </a>
      </li>
      <li class="breadcrumb-item">
        <a class="link-body-emphasis fw-semibold text-decoration-none" href="../Shop/index.php">Shop</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">
        Item
      </li>
    </ol>
  </nav>
</div>
<div class="container">
  <div class="row">
    <div class="col-lg-5 col-md-12 col-12">
      <img src="../Shop/Images/1.png" class="rounded img-fluid" width="80%">
    </div>
    <div class="col-md-7 col-ml- border border-secondary rounded">
      <div class="row-ml-5 mt-2 h4">Engine Clean</div>
        <i class="bx bxs-star star"></i>
        <i class="bx bxs-star star"></i>
        <i class="bx bxs-star star"></i>
        <i class="bx bxs-star star"></i>
        <i class="bx bxs-star star"></i>
       (<span>49</span>)
      
      <div class="row-ml-6 ">
        <div class="col text-danger">
       <strong>551.76 MAD</strong>
       </div>
       <div class="col text-success"><strong> Quantity: <?= $quantity ?> </strong></div>
      </div>
      <div class="row-ml-6">Our Engine Clean solution offers a high-performance, advanced formula designed to deeply cleanse and revitalize your vehicle's engine. It efficiently dissolves tough grease and grime, restoring optimal performance without compromising engine integrity. Easy to use and trusted by professionals, it ensures a visibly cleaner and smoother-running engine for peak performance and longevity.</div>
        <div class="row" style="margin-top: 20px; text-align:center">
        <form method="post">
          <div class="btn-group" role="group" aria-label="Basic example">
            <button name='decqty' class="btn btn-secondary">-</button>
            <input type='text' style="width:250px;" size='3' name='item' class="btn btn-light" value='<?= $value; ?>'/>
            <button name='incqty' class="btn btn-danger">+</button>
          </div>
        <span style="margin-left: 40px;"><button class="btn btn-danger" name="addtocart">Add to Cart</button></span>
        <span style="margin-left: 40px;"><button id="heart"class="btn btn-outline-danger" name="wishlist"><i class='bx bxs-heart'></i></button></span>
        </form>
      </div>
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