<?php
session_start();
if(isset($_SESSION['open']) && $_SESSION['open'] && $_SESSION['nav'] == $_SERVER["HTTP_USER_AGENT"] ){
ob_start();
require "../cnx.php";
if(isset($_GET['product_id'])&& isset($_GET['header'])) {
 $con =cnx_pdo();
 $req = $con->prepare("SELECT * FROM wishlist WHERE user_id = :id AND product_id = :pid");
 $req->bindValue(":id",$_SESSION['id']);
 $req->bindValue(":pid",$_GET['product_id']);
 $req->execute();
 $user= $req->fetch();
 if ($user==null){
    $add = $con->prepare("INSERT INTO wishlist(wishlist_id,user_id,product_id,date_created) VALUES (null,:id,:pid,current_timestamp())");
    $add->bindValue(":id",$_SESSION['id']);
    $add->bindValue(":pid",$_GET['product_id']);
    $add->execute();
 }else{
    $del = $con->prepare("DELETE FROM wishlist WHERE user_id = :id AND product_id = :pid");
    $del->bindValue(":id",$_SESSION['id']);
    $del->bindValue(":pid",$_GET['product_id']);
    $del->execute();
 }
 if ($_GET['header']==1){
   header("Location: product.php?product_id=".$_GET['product_id']."");
 }else {
 header("Location: ../Change Info/wishlist.php");}
}
}else{
   header("Location:../LogIn/index.php");
   exit;
 }
 
 ?>