<?php
session_start(); // Oturumu başlat

// Oturumu yok et
if (isset($_SESSION['user_id'])) {
    unset($_SESSION['user_id']); // Kullanıcı ID'sini oturumdan kaldır
}

// Tüm oturum değişkenlerini yok et
session_destroy(); // Oturumu tamamen yok et

// Kullanıcıyı index.php sayfasına yönlendir
header("Location: index.php");
exit(); // Scriptin devam etmesini engelle
?>
