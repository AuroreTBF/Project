<?php
session_start();
if(isset($_SESSION['open']) && $_SESSION['open'] && $_SESSION['nav'] == $_SERVER["HTTP_USER_AGENT"] ){
  
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="" rel="stylesheet">
    <script src="../js/bootstrap.bundle.js"></script>
  </head>

  <body class="bg-body-tertiary">
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
<?php
require "../cnx.php";
$con = cnx_pdo();
$total = $con->prepare("SELECT SUM(p.price*s.quantity) as sum FROM products p JOIN shopping_cart sp JOIN cart_items s ON sp.Shopping_cart_id= s.shoppingCartId AND s.product_id = p.product_id WHERE sp.user_id= :user_id;");
$total->bindValue(":user_id",$_SESSION['id']);
$total->execute();
$sum = $total ->fetch();
$cart = $con->prepare("SELECT p.*, c.quantity ,sp.Shopping_cart_id AS shop_id FROM cart_items c JOIN products p JOIN shopping_cart sp ON c.product_id = p.product_id AND c.shoppingCartId = sp.Shopping_cart_id WHERE sp.user_id = :user_id;");
$cart->bindValue(":user_id",$_SESSION['id']);
$cart->execute();
$shoppingcart = $cart->fetchAll();
$select =$con->prepare("SELECT * FROM shopping_cart WHERE user_id = :user_id");
$select->bindValue(":user_id",$_SESSION['id']);
$select->execute();
$shop= $select->fetch();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset($_POST['address'])&& isset($_POST['city'])){
$payment= $con ->prepare("INSERT INTO transactions(transaction_id,shop_id,amount,payment_date,payment_method,Location) VALUES 
(NULL,:shop,".$sum['sum'].",current_timestamp(),:method,:address)");
$address = $_POST['city']." ".$_POST['address'];
$payment->bindValue(":address",$address);
$payment->bindValue(":shop",$shop['Shopping_cart_id']);
$method = $_POST['method'];
$payment->bindValue(":method",$method);
$payment->execute();
// fetching latest transaction
$latesttransaction=$con->prepare("SELECT * FROM transactions ORDER BY transaction_id DESC LIMIT 1;");
$latesttransaction->execute();
$transaction=$latesttransaction->fetch();
if ($method ==1){
    $payment2=$con->prepare('INSERT INTO paypaldetails(paypal_id,payment_id,total_amount) VALUES (NULL,1,'.$sum["sum"].')');
}else if($method==2){
    $payment2=$con->prepare('INSERT INTO debitpayment(debit_id,payment_id,total_amount) VALUES (NULL,2,'.$sum["sum"].')');
}else{
    $payment2=$con->prepare('INSERT INTO cashpaymentdetails(cash_id,payment_id,total_amount) VALUES (NULL,3,'.$sum["sum"].')');
}
$payment2->execute();
foreach($shoppingcart as $ordered){
 $order= $con ->prepare("INSERT INTO orders(order_id,product_id,order_date,transaction_id) VALUES (NULL,".$ordered['product_id'].",current_timestamp(),".$transaction['transaction_id'].")");
 $order->execute();
}
$deletecart = $con->prepare('DELETE FROM shopping_cart WHERE user_id = '.$_SESSION['id'].'');
$deletecartitems = $con->prepare('DELETE FROM cart_items WHERE ShoppingCartId = '.$shop['Shopping_cart_id'].'');
$deletecartitems->execute();
$deletecart ->execute();
header("Location: cart.php");
}
}
?>
<div class="container">
  <main>
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="download.png" alt="" width="72" height="57">
      <h2>Checkout</h2>
    </div>
    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-danger">Your cart</span>
        </h4>
        <ul class="list-group mb-3">
<?php
foreach($shoppingcart as $product){
echo '<li class="list-group-item d-flex justify-content-between lh-sm">';
echo '<div>';
echo '<h6 class="my-0">'.$product['name'].'</h6>';
echo '<small class="text-body-secondary">Quantity: '.$product['quantity'].'</small>';
echo '</div>';
echo '<span class="text-body-secondary">'.$product['price'].' DH</span>';
echo '</li>';
}
?>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (USD)</span>
            <strong><?=$sum['sum']." DH"?></strong>
          </li>
        </ul>
      </div>
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Billing address</h4>
        <form class="needs-validation" method="post">
          <div class="row g-3">
            <div class="col-12">
              <label for="address" class="form-label">Address</label>
              <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St" required>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="col-md-5">
              <label for="city" class="form-label">City</label>
              <select class="form-select" name="city" id="city" required>
                <option value="">Choose...</option>
                <option value="Casablanca">Casablanca</option>
                <option value="Fes">Fes</option>
                <option value="Rabat">Rabat</option>
              </select>
              <div class="invalid-feedback">
                Please select a valid country.
              </div>
            </div>

            <div class="col-md-3">
              <label for="zip" class="form-label">Zip</label>
              <input type="text" class="form-control" id="zip" placeholder="" required>
              <div class="invalid-feedback">
                Zip code required.
              </div>
            </div>
          </div>

          <hr class="my-4">

          <h4 class="mb-3">Payment</h4>
          <div class="my-3 col-3">
          <select name="method" class="form-select form-select-lg mb-3" size="3">
            <option value="1" class="nav-link px-2 link-secondary">Paypal</option>
            <option value="3" class="nav-link px-2 link-secondary">Cash</option>
            <option value="2" class="nav-link px-2 link-secondary">Debit</option>
</select>
          </div>

          <div class="row gy-3">
            <div class="col-md-6">
              <label for="cc-name" class="form-label">Name on card</label>
              <input type="text" class="form-control" id="cc-name" placeholder="" required>
              <small class="text-body-secondary">Full name as displayed on card</small>
              <div class="invalid-feedback">
                Name on card is required
              </div>
            </div>

            <div class="col-md-6">
              <label for="cc-number" class="form-label">Credit card number</label>
              <input type="text" class="form-control" id="cc-number" placeholder="" required>
              <div class="invalid-feedback">
                Credit card number is required
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-expiration" class="form-label">Expiration</label>
              <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
              <div class="invalid-feedback">
                Expiration date required
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-cvv" class="form-label">CVV</label>
              <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
              <div class="invalid-feedback">
                Security code required
              </div>
            </div>
          </div>

          <hr class="my-4">

          <button class="w-100 btn btn-danger btn-lg" type="submit">Confirm Purchase</button>
        </form>
      </div>
    </div>
  </main>

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

</div>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</html>
<?php
}else{
  header("Location:../LogIn/index.php");
  exit;
}

?>