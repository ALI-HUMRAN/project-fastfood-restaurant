<?php
$host = 'mysql';
$db = getenv("MYSQL_DATABASES_FASTFOOD");
$user = 'root';
$pass = getenv("MYSQL_ROOT_PASSWORD"); 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB connection failed: " . $e->getMessage());
}
?>
