<?php
session_start();
if(isset($_SESSION['open']) && $_SESSION['open'] && $_SESSION['nav'] == $_SERVER["HTTP_USER_AGENT"] ){
  
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <script src="../js/bootstrap.bundle.js"></script>
  </head>

<body>
<?php
require "../cnx.php";
$con = cnx_pdo();
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
            <div class="col-md-2" style="margin-top: 100px;"> <!-- Adjust margin-top as needed -->
                <nav>
                <ul class="nav1 justify-content-center mb-md-0">
                        <li><a href="index.php" class="nav-link px-4 link-light font-weight-bold border rounded border-secondary li">Account Settings</a></li>
                        <li><a href="cart.php" class="nav-link px-2 link-light font-weight-bold border rounded border-secondary selected">Cart</a></li>
                        <li><a href="wishlist.php" class="nav-link px-2 link-light font-weight-bold border rounded border-secondary li">Manage Wishlist</a></li>
                        <li><a href="orders.php" class="nav-link px-2 link-light font-weight-bold border rounded border-secondary li">Ordered Items</a></li>
                        <li><a href="enlisted.php" class="nav-link px-2 link-light font-weight-bold border rounded border-secondary li">My Enlisted items</a></li>
                        <li><a href="delete.php" onclick="return confirm('YOU CANNOT UNDO THIS ACTION, ARE YOU SURE YOU WANT TO PROCEED WITH ACCOUNT DELETION?')" class="nav-link px-2 link-light font-weight-bold border rounded border-secondary li">Delete Account</a></li>
                    </ul>
                </nav>
            </div>
            <!-- Form on the right -->
            
            <div class="col-md-10 mt-5">
                    <div class="shopping-cart mt-5">
                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block"style="background-color: rgba(0, 0, 0, 0.3);">
                            <div class="row text-light">
                                <div class="col-md-6">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Quantity</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>
<?php
$con = cnx_pdo();
$total = $con->prepare("SELECT SUM(p.price*s.quantity) as sum FROM products p JOIN shopping_cart sp JOIN cart_items s ON sp.Shopping_cart_id= s.shoppingCartId AND s.product_id = p.product_id WHERE sp.user_id= :user_id;");
$total->bindValue(":user_id",$_SESSION['id']);
$total->execute();
$sum = $total ->fetch();
$cart = $con->prepare("SELECT p.*, c.quantity FROM cart_items c JOIN products p JOIN shopping_cart sp ON c.product_id = p.product_id AND c.shoppingCartId = sp.Shopping_cart_id WHERE sp.user_id = :user_id;");
$cart->bindValue(":user_id",$_SESSION['id']);
$cart->execute();
$shoppingcart = $cart->fetchAll();
foreach($shoppingcart as $product){
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
echo ' <div class="col my-auto">';
echo '<label class="price"><strong>'.$product['quantity'].'</strong></label>';
echo ' </div>';
echo '<div class="col-md-2 col-5 my-auto">';
echo '<div class="remove">';
echo '<a href="../ProductDetails/addtocart.php?product_id='.$product['product_id'].'&quantity='.$product['quantity'].'&header=2" class="btn btn-danger btn-sm">';
echo '<i class="fa fa-trash"></i> Remove';
echo '</a>';
echo' </div> </div> </div> </div>';
}?>
                    </div>
<div class="col-md-11 text-light text-center h4">
 <strong>Total: <?= $sum['sum']?> </strong>
    <div></div>
        <a href="checkout.php" class="btn btn-danger">Buy Now</a>
</div>
  </body>
</html>
<?php
}else{
  header("Location:../LogIn/index.php");
  exit;
}

?>