<?php
session_start();
if(isset($_SESSION['open']) && $_SESSION['open'] && $_SESSION['nav'] == $_SERVER["HTTP_USER_AGENT"] ){
ob_start();
require "../cnx.php";
if(isset($_GET['product_id'])) {
$con = cnx_pdo();
$sql = "SELECT * FROM products WHERE product_id=:prod";
$req = $con->prepare($sql);
$req->bindValue(':prod',$_GET['product_id']);
$req->execute();
$product = $req->fetch();
$ratings = $con->prepare("SELECT r.* , CONCAT(u.firstname , u.lastname) AS user_name FROM ratings r JOIN users u ON u.id = r.user_id WHERE product_id = :product_id");
$ratings -> bindValue(":product_id",$_GET['product_id']);
$ratings ->execute();
$review=$ratings->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="../js/bootstrap.bundle.js"></script>
  </head>
<body>
<!--Header -->
<?php
$value = isset($_POST['item']) ? $_POST['item'] : 1; //to be displayed
if(isset($_POST['incqty'])){
  if($value < $product['stock']){
   $value += 1;
  }
}
if(isset($_POST['decqty'])){
  if($value >0){
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
      <li><a href="../Shop/index.php" class="nav-link px-2 link-body-emphasis">Shop</a></li>
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
<!-- ========== Breadcrumb ========== -->
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
      <?=$product['name']?>
      </li>
    </ol>
  </nav>
</div>
<!-- ========== Product ========== -->
<div class="container">
  <div class="row">
    <div class="col-lg-5 col-md-12 col-12 border-right">
      <img src="../Shop/Images/<?=$product['image']?>" class="rounded img-fluid" width="80%">
    </div>
    <div class="col-md-6 col-ml- border border-secondary rounded">
      <div class="row-ml-5 mt-2 h4"><?=$product['name']?></div>
<?php 
$averageRatingQuery = $con->prepare("SELECT AVG(rating) AS avg_rating FROM ratings WHERE product_id = :product_id");
$averageRatingQuery->bindValue(':product_id', $_GET['product_id']);
$averageRatingQuery->execute();
$avg = $averageRatingQuery->fetch();
$x =$avg['avg_rating'];
$z ="";
for ($i=0;$i<5;$i++){
    if($x<1 && $x>0){
        $z=$z.'<i class="bx bxs-star-half"></i>';
    }
    else if($x>=1){
        $z=$z.'<i class="bx bxs-star"></i>';
    }
    else if($x<=0){
        $z=$z.'<i class="bx bx-star" style="o"></i>';
    }
    $x-=1;
  }
$ratingsCount = $con->prepare("SELECT COUNT(*) AS total_ratings FROM ratings WHERE product_id = :product_id");
$ratingsCount->bindValue(':product_id', $_GET['product_id']);
$ratingsCount->execute();
$count = $ratingsCount->fetch();
echo $z;
echo "(<span>".$count['total_ratings']."</span>)";
      ?>
       
      <div class="row-ml-6 ">
        <div class="col text-danger">
       <strong><?=$product['price']. " DH"?></strong>
       </div>
       <div class="col text-success"><strong> <?='In Stock: '.$product['stock']?> </strong></div>
      </div>
      <div class="row-ml-6"><?= $product['description'] ?></div>
        <div class="row" style="margin-top: 20px; text-align:center">
        <form method="post">
          <div class="btn-group" role="group" aria-label="Basic example">
            <button name='decqty' class="btn btn-secondary">-</button>
            <input type='text' style="width:250px;" size='3' name='item' class="btn btn-light" value='<?= $value; ?>'/>
            <button name='incqty' class="btn btn-danger">+</button>
          </div>
        <span style="margin-left: 40px;"><a href="addtocart.php?product_id=<?= $_GET['product_id']."&quantity=".$value?>&header=1" class="btn
<?php
$style2="";
$req2 = $con->prepare("SELECT * FROM cart_items ci JOIN shopping_cart sc ON ci.shoppingCartId = sc.Shopping_cart_id WHERE sc.user_id = :id AND ci.product_id = :pid;");
$req2->bindValue(":id",$_SESSION['id']);
$req2->bindValue(":pid",$_GET['product_id']);
$req2->execute();
$user2= $req2->fetch();
if ($user2!=null){
  $style2='btn-danger">Added';
}else{
  $style2='btn-outline-danger">Add to cart';
}
echo $style2
?>
</a>    </span> <span style="margin-left: 40px;"><a href="addtowishlist.php?product_id=<?=$_GET['product_id']?>&header=1" class="btn 
<?php
$style = "";
$req = $con->prepare("SELECT * FROM wishlist WHERE user_id = :id AND product_id = :pid");
$req->bindValue(":id",$_SESSION['id']);
$req->bindValue(":pid",$_GET['product_id']);
$req->execute();
$user= $req->fetch();
if ($user!=null){
  $style="btn-danger";
}else{
  $style="btn-outline-danger";
}
echo $style;
?>"><i class='bx bxs-heart'></i></a></span>
        <div class="row">
          <div class="col mx-auto mt-4">
        <button class="btn btn-danger" style="height: 50px; width: 400px;">Compare Product To Another</button>
        </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<div class="container items border-top" style="margin-top: 100px; text-align: center; margin-bottom:30px;">
  <h1 class="row mt-4 font-weight-bold text-danger">
      <div class="col">
        <button class="border rounded border-danger bg-danger">&nbsp;&nbsp;&nbsp;</button> Product Reviews 
      </div>
  </h1>
</div>

<!-- ========== Reviews ========== -->

<?php
foreach ($review as $rev){
  $req=$con->prepare("SELECT sum(isLike = 1) as approved, sum(isLike = 0) as disapproved FROM likes WHERE review_id = :review_id");
  $req->bindValue(':review_id',$rev['id']);
  $req->execute();
  $appr = $req->fetch();
  $req=$con->prepare('SELECT * FROM likes WHERE user_id = :user_id AND review_id = :review_id');
  $req->bindValue(":review_id",$rev['id']);
  $req->bindValue(":user_id",$_SESSION['id']);
  $req->execute();
  $userrating = $req->fetch();
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['approve' . $rev['id']])) {
    if (!empty($userrating)){
      $req=$con->prepare('UPDATE likes SET isLike = 1 WHERE user_id = :user_id AND review_id = :review_id');
    }else{
      $req=$con->prepare('INSERT INTO likes(id,review_id,user_id, isLike) VALUES (NULL,:review_id,:user_id,0)');}
      $req->bindValue(":review_id",$rev['id']);
      $req->bindValue(":user_id",$_SESSION['id']);
      $req->execute();
      header("Refresh:0");
      exit();
    }
  elseif (isset($_POST['disapprove' . $rev['id']])) {
      if (!empty($userrating)){
        $req=$con->prepare('UPDATE likes SET isLike = 0 WHERE user_id = :user_id AND review_id = :review_id');
      }else{
        $req=$con->prepare('INSERT INTO likes(id,review_id,user_id, isLike) VALUES (NULL,:review_id,:user_id,0)');}
        $req->bindValue(":review_id",$rev['id']);
        $req->bindValue(":user_id",$_SESSION['id']);
        $req->execute();
        header("Refresh:0");
        exit();
      }}

  $x =$rev['rating'];
  $z ="";
  for ($i=0;$i<5;$i++){
      if($x>=0.4 && $x<1){
          $z=$z.'<i class="bx bxs-star-half"></i>';
      }
      else if($x>=1){
          $z=$z.'<i class="bx bxs-star"></i>';
      }
      else if($x<0.4){
          $z=$z.'<i class="bx bx-star" style="o"></i>';
      }
      $x-=1;
  }
echo '<div class="container border">';
echo '<a class="nav-link link-body-emphasis" href="#"><img src="../profile_icon.jpg" alt="mdo" width="32" height="32" class="rounded-circle"></a>';
echo  '<div class="row m-lg-0">'.$rev['user_name']. '</div></a>';
echo  '<div class="col">';
echo $z;
echo '</div>';
echo '<div class="row h4" style="margin-left:auto">';
echo $rev['title'];
echo  '</div>';
echo '<div class="row" style="margin-left: auto;">';
echo $rev['description'];
echo  '</div>';
echo '<div class="col-md-6 text-primary"><strong>Helpful?</strong></div>';
echo '<form method="post">';
echo '<button type="submit" class="btn btn-outline-success mb-4" name="approve' . $rev['id'] . '">Like(' . $appr['approved'] . ')</button>';
echo '<button type="submit" class="btn btn-outline-danger mb-4" name="disapprove' . $rev['id'] . '">Dislike(' . $appr['disapproved'] . ')</button>';
echo '</form>';
echo'</div>';
}
?>
<!-- ========== Write your own review ========== -->
<div class="container items border-top" style="margin-top: 100px; text-align: center; margin-bottom:30px;">
  <h1 class="row mt-4 font-weight-bold text-danger">
      <div class="col">
        <button class="border rounded border-danger bg-danger">&nbsp;&nbsp;&nbsp;</button> Write Your Own Review!
      </div>
  </h1>
</div>
<?php
if (!empty($_POST['rating']) && $_POST['rating'] >= 0 && $_POST['rating'] <= 5) {
  $ordercheck = $con->prepare("SELECT * FROM orders o JOIN transactions t JOIN shopping_cart s ON t.shop_id = s.Shopping_cart_id AND t.transaction_id = o.transaction_id WHERE s.user_id = ".$_SESSION['id']." AND o.product_id =".$_GET['product_id']);
  $ordercheck->execute();
  $check = $ordercheck->fetchAll();
  if ($check!=null){
  if (isset($_POST['review']) && !empty($_POST['title']) && !empty($_POST['description'])) {
      $req = $con->prepare('INSERT INTO `ratings` (`id`, `product_id`, `user_id`, `rating`, `title`, `description`, `date_created`) VALUES (NULL, :product_id, :user_id, :rating, :title, :description, current_timestamp())');
      $req->bindValue(":product_id", $_GET['product_id']);
      $req->bindValue(":user_id", $_SESSION['id']);
      $req->bindValue(":rating", $_POST['rating']);
      $req->bindValue(":description", $_POST['description']);
      $req->bindValue(":title", $_POST['title']);
      $req->execute();
      header("Refresh:0");
  }}else{
    echo "<div class='text-danger' style='margin-left:300px'><strong>item not bought, please buy item to review.</strong></div>";
  }
}
?>
<div class="container">
  <form method="post">
        <div class="form-floating mb-3">
        <input type="number" name="rating" step="0.1" class="form-control" max="5" style="width: auto;" require min="1">
        <label for="floatingInput">Rating (?/5)</label>      
      </div>
      <div class="form-floating mb-3">
        <input type="text" name="title" class="form-control" style="width: auto;" require>
        <label for="floatingInput">Title</label>      
      </div>
      <div class="form-floating mb-3">
        <textarea name="description" class="form-control" style="width: auto; height:200px text-align" rows="5" require></textarea>
        <label for="floatingInput">description</label>      
      </div>  
      <div class="col-12">
      <button class="btn btn-danger" name="review" onclick="return confirm('Confirm Review.')" type="submit">Write Review</button> </div>
  </form>
</div>
  </main><div class="container">
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

</body>
</html>
<?php
}else{
  header("Location:../LogIn/index.php");
  exit;
}

?>