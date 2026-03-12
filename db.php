<?php
$host = 'localhost';
$db = 'frostsub_anime';
$user = 'frostsub_anime'; // MySQL kullanıcı adını girin
$pass = 'frostsub3123123123'; // MySQL şifresini girin

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Veritabanı bağlantısı başarısız: ' . $e->getMessage();
}
?>
