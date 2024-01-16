<?php
/*
include "env.php";
function cnx_pdo(){
    //DSN 
    $dsn = "mysql:dbname=".DBNAME.";host=".DBHOST.";port=".DBPORT;

    //----------connexion----------
    try{
        $db = new PDO($dsn,DBUSER,DBPASS);
        //echo "connexion établie";
        return $db;

    }catch(PDOException $e){
        die($e->getMessage());
    }

}
*/

// 1. Connect to your MySQL database
// 1. Connect to your MySQL database
function cnx_pdo() {
    $host = 'localhost';
    $port = 3307; // your port
    $db   = 'biblio';
    $user = 'thejokers';
    $pass = '@sexcigareZ2';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
    $opt = [,
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    return new PDO($dsn, $user, $pass, $opt);
}

$pdo = cnx_pdo(); // Call the function to get the PDO instance

// 2. Execute a SQL query
$sql = "SELECT book.title, author.nom
    FROM book 
    INNER JOIN author 
    ON book.author_id=author.id";
$stmt = $pdo->query($sql);

// 3. Fetch the result of the query

$books = $stmt->fetchAll();

// 4. Loop through the result and display each book and its author
foreach ($books as $book) {
    echo "Title: " . $book['title'] . ", Author: " . $book['nom'] . "<br>";
}
?>
