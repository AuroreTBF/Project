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
                        <li><a href="index.php" class="nav-link px-4 link-light font-weight-bold border rounded border-secondary li">Account Settings</a></li>
                        <li><a href="cart.php" class="nav-link px-2 link-light font-weight-bold border rounded border-secondary li">Cart</a></li>
                        <li><a href="wishlist.php" class="nav-link px-2 link-light font-weight-bold border rounded border-secondary selected">Manage Wishlist</a></li>
                        <li><a href="orders.php" class="nav-link px-2 link-light font-weight-bold border rounded border-secondary li">Ordered Items</a></li>
                        <li><a href="delete.php" onclick="return confirm('YOU CANNOT UNDO THIS ACTION, ARE YOU SURE YOU WANT TO PROCEED WITH ACCOUNT DELETION?')" class="nav-link px-2 link-light font-weight-bold border rounded border-secondary li">Delete Account</a></li>
                    </ul>
                </nav>
            </div>
            <!-- Form on the right -->
            
            <div class="col-md-9 mt-5">
                    <div class="shopping-cart mt-5">
                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block"style="background-color: rgba(0, 0, 0, 0.3);">
                            <div class="row text-light">
                                <div class="col-md-6">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-2 text-end">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>
<?php
$con = cnx_pdo();
$wishlist = $con->prepare("SELECT p.* FROM wishlist w JOIN products p ON w.product_id = p.product_id WHERE w.user_id = :user_id;");
$wishlist->bindValue(":user_id",$_SESSION['id']);
$wishlist->execute();
$wish = $wishlist ->fetchAll();
foreach($wish as $product){
echo '<div class="cart-item border m-1" style=" background-color: rgba(0, 0, 0, 0.3);">';
echo '<div class="row text-light">';
echo '<div class="col-md-6 my-auto ">';
echo ' <a href="#" class="nav-link px-2 link-light font-weight-bold">';
echo '<label class="">';
echo '<img src="../Shop/Images/'.$product["image"].'" style="width: 50px; height: 50px" alt="">';
echo  '   <strong>'.$product["name"].'</strong>';
echo ' </label>';
echo ' </a>';
echo ' </div>';
echo ' <div class="col-md-2 my-auto">';
echo '<label class="price"><strong>'.$product['price'].' DH</strong></label>';
echo ' </div>';
echo '<div class="col-md-2 col-5 my-auto text-end">';
echo '<div class="remove">';
echo '<a href="../ProductDetails/addtowishlist.php?product_id='.$product['product_id'].'&header=2" class="btn btn-danger btn-sm">';
echo '<i class="fa fa-trash"></i> Remove';
echo '</a>';
echo' </div> </div> </div> </div>';
}?>
  </body>
</html>
<?php
}else{
  header("Location:../LogIn/index.php");
  exit;
}

?>