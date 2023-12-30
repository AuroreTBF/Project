<?php
include "env.php";
function cnx_pdo(){
//DSN 
$dsn = "mysql:dbname=".DBNAME.";host=".DBHOST;

//----------connexion----------
try{
    $db = new PDO($dsn,DBUSER,DBPASS);
    return $db;

}catch(PDOException $e){
    die($e->getMessage());
}

}


?>