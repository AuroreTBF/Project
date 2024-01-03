<?php
session_start();
if(isset($_SESSION['open']) && $_SESSION['open'] && $_SESSION['nav'] == $_SERVER["HTTP_USER_AGENT"] ){
ob_start();
require "../cnx.php";
if(isset($_GET['product_id'])&& isset($_GET['quantity'])&& isset($_GET['header'])) {
 $con =cnx_pdo();
 $req = $con->prepare("SELECT ci.* FROM cart_items ci JOIN shopping_cart sc ON ci.shoppingCartId = sc.Shopping_cart_id WHERE sc.user_id = :id AND ci.product_id = :pid;");
 $req->bindValue(":id",$_SESSION['id']);
 $req->bindValue(":pid",$_GET['product_id']);
 $req->execute();
 $user= $req->fetch();
 if ($user==null){
   $shop=$con->query("SELECT * FROM shopping_cart WHERE user_id =".$_SESSION['id']);
   $check = $shop->fetch();
    if($check==null){
      $que = $con->prepare("INSERT INTO shopping_cart (Shopping_cart_id,user_id,date_created) VALUES (NULL,".$_SESSION['id'].",current_timestamp())");
      $que ->execute();
      $shop=$con->query("SELECT * FROM shopping_cart WHERE user_id =".$_SESSION['id']);
      $check = $shop->fetch();
    }
    $add = $con->prepare("INSERT INTO cart_items(cart_id,product_id,quantity,date_added,shoppingCartId) VALUES (null,:pid,:quantity,current_timestamp(),:shop)");
    $add->bindValue(":quantity",$_GET['quantity']);
    $add->bindValue(":pid",$_GET['product_id']);
    $add->bindValue(":shop",$check['Shopping_cart_id']);
    $add->execute();
 }else{
    $del = $con->prepare("DELETE FROM cart_items WHERE shoppingCartId = :id AND product_id = :pid");
    $del->bindValue(":id",$user['shoppingCartId']);
    $del->bindValue(":pid",$_GET['product_id']);
    $del->execute();
 }
 if ($_GET['header']==1){
   header("Location: product.php?product_id=".$_GET['product_id']."");
 }else if($_GET['header']==2){
 header("Location: ../Change Info/cart.php");}
 else{
   header("Location: ../Shop/index.php");
 }
}
}else{
   header("Location:../LogIn/index.php");
   exit;
 }
 
 ?>