<?php
session_start();
if(isset($_SESSION['open']) && $_SESSION['open'] && $_SESSION['nav'] == $_SERVER["HTTP_USER_AGENT"] ){

  $to = "archlee196@gmail.com";
  $subject = "My subject";
  $txt = "Hello world!";
  $header = "From: archlee169@gmail.com";
  
  mail($to,$subject,$txt,$header);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="write-post.css" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="fontawesome/css/brands.css">
    <link rel="stylesheet" href="fontawesome/css/solid.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="app.js"></script>
  </head>

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
      $insert = $con->prepare("INSERT INTO products(product_id,Category_id,user_id,name,price,description,stock,image,date_created) VALUES (NULL,:catid,:id,:prod,:price,:desc,:stock,:image,current_timestamp())"); 
      $insert ->bindValue(":catid",$_POST['type']);
      $insert ->bindValue(":id",$_SESSION['id']);
      $insert ->bindValue(":prod",$_POST['name']);
      $insert ->bindValue(":price",$_POST['price']);
      $insert ->bindValue(":desc",$_POST['description']);
      $insert ->bindValue(":stock",$_POST['quantity']);
      $insert ->bindValue(":image", htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])));
      $insert ->execute();
  } else {
    echo "Sorry, there was an error uploading your product.";
  }
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
          <button class="border rounded border-danger bg-danger">&nbsp;&nbsp;&nbsp;</button> Create your own post!
        </div>
    </h1>
  </div>
  <div class="container">
  <form action="upload.php" method="post" enctype="multipart/form-data">
        <div class="form-floating mb-3">
          <input type="text" name="name" class="form-control" style="width: auto;" require>
          <label for="floatingInput">Product Name</label>      
</div>
        <div class="form-floating mb-3">
          <input type="number" step="0.01" name="price" class="form-control" style="width: auto;" require>
          <label for="floatingInput">price</label>      
        </div>
        <div class="form-floating mb-3">
          <input type="number" step="1" name="quantity" class="form-control" style="width: auto;" require>
          <label for="floatingInput">Quantity</label>      
        </div>
        <div class="form-floating mb-3">
        <div class="dropdown-center mb-3">
        <label for="cars">Category:</label>
        <select id="cars" name="type" class="btn" require>
          <option value="1">Washing</option>
          <option value="2">Correction & Polishing</option>
          <option value="3">Protective Wax</option>
          <option value="4">Rim Tires</option>
          <option value="5">Windows and Healights</option>
          <option value="6">Interior</option>
          <option value="7">Accessories</option>
          <option value="8">Kits</option>
          <option value="9">Others</option>
        </select>
        </div>
        </div>
        <div class="form-floating mb-3">
          <textarea type="text" name="description" class="form-control" style="width: auto; height:200px" require> </textarea>
          <label for="floatingInput">description</label>      
        </div>  
        <div class="col-md-2 mb-3 text-center">
        <input type="file" class="btn btn-danger" name="fileToUpload" id="fileToUpload">
        <button class="btn btn-outline-danger" type="reset">Cancel</button>
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
<?php
}else{
  header("Location:../LogIn/index.php");
  exit;
}

?>