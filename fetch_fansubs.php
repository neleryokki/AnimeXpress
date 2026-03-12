<?php
// Oturumu başlat
session_start();

// Hata raporlamayı etkinleştir
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Veritabanı bağlantısı
$host = 'localhost';
$db = 'frostsub_anime';
$user = 'frostsub_anime'; // MySQL kullanıcı adını girin
$pass = 'frostsub3123123123'; // MySQL şifresini girin

$conn = new mysqli($host, $user, $pass, $db);

// Veritabanı bağlantısı kontrolü
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// URL'den bölüm ID'sini al
if (isset($_GET['episode_id'])) {
    $episode_id = (int)$_GET['episode_id'];

    // Fansub'ları al
    $sql_fansubs = "SELECT fs.id AS fansub_id, fs.name AS fansub_name, fl.link, fl.name AS link_name 
                    FROM fansubs fs 
                    LEFT JOIN fansub_links fl ON fs.id = fl.fansub_id 
                    WHERE fs.episode_id = ?";
    $stmt_fansubs = $conn->prepare($sql_fansubs);
    $stmt_fansubs->bind_param('i', $episode_id);
    $stmt_fansubs->execute();
    $fansubs_result = $stmt_fansubs->get_result();

    $fansub_links = [];
    while ($row = $fansubs_result->fetch_assoc()) {
        $fansub_links[] = [
            'id' => $row['fansub_id'],
            'name' => $row['fansub_name'],
            'link' => $row['link']
        ];
    }

    echo json_encode($fansub_links);
}

$conn->close();
?>
