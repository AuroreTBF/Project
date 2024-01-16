<?php
session_start();
if(isset($_SESSION['open']) && $_SESSION['open'] && $_SESSION['nav'] == $_SERVER["HTTP_USER_AGENT"] ){
ob_start();
require "../cnx.php";
if(isset($_GET['product_id'])){
$con =cnx_pdo();
$del = $con->prepare("DELETE FROM products WHERE user_id = :id AND product_id = :pid");
$del->bindValue(":id",$_SESSION['id']);
$del->bindValue(":pid",$_GET['product_id']);
$del->execute();
header ("Location:../Change Info/enlisted.php");
}
}else{
   header("Location:../LogIn/index.php");
   exit;
 }
 
 ?>