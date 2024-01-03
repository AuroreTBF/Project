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
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="write-post.css" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="fontawesome/css/brands.css">
    <link rel="stylesheet" href="fontawesome/css/solid.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
    <script src="app.js"></script>
  </head>
<!--Header -->
<body>
  <?php
  // Include the database configuration file 
  require "../cnx.php";
  $con = cnx_pdo();
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $target_dir = "../Shop/Images/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
  
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "The Product has been uploaded successfully.";
        $insert = $con->prepare("INSERT INTO products(post_id,user_id,title,description,image,date_created) VALUES (NULL,:id,:tit,:desc,:image,current_timestamp())"); 
        $insert ->bindValue(":id",$_SESSION['id']);
        $insert ->bindValue(":tit",$_POST['title']);
        $insert ->bindValue(":desc",$_POST['description']);
        $insert ->bindValue(":image", htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])));
        $insert ->execute();
    } else {
      echo "Sorry, there was an error uploading your product.";
    }
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
          Create Post
        </li>
      </ol>
    </nav>
  </div>
    <div class="container items border-bottom" style="margin-top: 40px; text-align: center; margin-bottom:50px;">
      <h1 class="row mt-4 font-weight-bold text-danger">
        <div class="col">
          <button class="border rounded border-danger bg-danger">&nbsp;&nbsp;&nbsp;</button> Create you're own post!
        </div>
      </h1>
    </div>
  <div class="container2">
        <form style="margin-left: 100px;">
        <div class="form-floating mb-3">
          <input type="text" name="title" class="form-control" style="width: auto;" require>
          <label for="floatingInput">Title</label>      
        </div>
        <div class="form-floating mb-3">
          <input type="text" name="description" class="form-control" style="width: auto; height:200px"require>
          <label for="floatingInput">description</label>      
        </div> 
        </form>
    <form style="position:relative;" action="/upload" method="post" enctype="multipart/form-data" >
      <div id="preview"></div>
      <div class="Upload">
      <button class="btn btn-outline-danger" style="position: relative;">
        <i class="fa fa-upload"></i>Choose file
      <input type="file" name="fileToUpload" id="fileToUpload"  required onchange="previewImage()" style="cursor: pointer;margin-left: -110px; opacity: 0; width: 140px;" >
      </button>
    </div>
    <div style="margin-top: 10px;">
    <button class="btn btn-outline-danger" type="button" onclick="cancelSelection()">Cancel</button>
    <button class="btn btn-danger px-3" type="submit" value="Upload Image" name="submit" onclick="confirm('Post?')">Post</button>
  </div>
      </form>
  </div>
</body>
<div class="container">
  <footer class="py-3 my-4">
      <ul class="nav justify-content-center border-bottom pb-3 mb-3">
      <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Home</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Features</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pricing</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li>
      </ul>
      <p class="text-center text-body-secondary">&copy; 2023 MecAssist, Inc</p>
  </footer>
</div>
</html>
}else{
  header("Location:../LogIn/index.php");
  exit;
}

?>