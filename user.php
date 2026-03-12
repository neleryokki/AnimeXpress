<?php
// Oturumu başlat
session_start();

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

// URL'den kullanıcı ID'sini al
if (isset($_GET['id'])) {
    $user_id = (int) $_GET['id'];
} else {
    // Eğer ID yoksa anasayfaya yönlendir
    header("Location: index.php");
    exit();
}

// Veritabanından kullanıcı bilgilerini çek
$sql = "SELECT username, role, profile_image, description FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->bind_result($username, $role, $profile_image, $description);
$stmt->fetch();
$stmt->close();

// Eğer kullanıcı bulunamazsa
if (empty($username)) {
    echo "<p>Kullanıcı bulunamadı.</p>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $username; ?>'nin Profili</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Genel stiller */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #fff;
            color: #333;
            padding: 20px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .logo img {
            width: 150px;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
            margin: 0;
            padding: 0;
            align-items: center;
        }

        nav a {
            color: #333;
            text-decoration: none;
            font-weight: bold;
        }

        nav a:hover {
            color: #007bff;
        }

        /* Profil Container */
        .profile-banner {
            background-color: #0d6efd;
            height: 250px;
            background-image: url('uploads/banner-default.jpg'); /* Varsayılan arka plan resmi */
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .profile-container {
            max-width: 1000px;
            margin: -100px auto 0;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-top: -75px;
            border: 5px solid #fff;
            background-color: #fff;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-container h2 {
            font-size: 28px;
            margin-top: 10px;
        }

        .role-badge {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: bold;
            color: #fff;
            margin-bottom: 20px;
        }

        /* Rollere göre renkler */
        .role-kur
        /* Rollere göre renkler */
        .role-kurucu {
            background-color: #007bff;
        }

        .role-admin {
            background-color: #dc3545;
        }

        .role-mod {
            background-color: #ffc107;
        }

        .role-user {
            background-color: #6c757d;
        }

        .description {
            margin: 20px 0;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            text-align: left;
        }

        .description p {
            font-size: 16px;
            color: #555;
        }

        /* Responsive tasarım */
        @media (max-width: 768px) {
            .profile-container {
                margin-top: -75px;
            }

            .profile-image {
                width: 120px;
                height: 120px;
                margin-top: -60px;
            }

            .profile-container h2 {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="logo">
        <img src="https://i.hizliresim.com/ryiopc0.jpeg?_gl=1*aw4gtq*_ga*MzE2OTY4NDM4LjE3Mjg4MzA4OTk.*_ga_M9ZRXYS2YN*MTczMDE5MTY1MC4xNi4xLjE3MzAxOTE4MjcuNjAuMC4w" alt="logo" style="width: 80px; height: auto;">
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Anasayfa</a></li>
            <li><a href="seriler.php">Seriler</a></li>
            <li><a href="oneriler.php">Anime Önerileri</a></li>
            <li><a href="iletisim.php">İletişim</a></li>
            <li><a href="gizlilikpolitikası.html">Gizlilik Politikası</a></li>
       
        </ul>
    </nav>
</header>

<!-- Kullanıcı Profil Bölümü -->
<div class="profile-banner"></div>

<div class="profile-container">
    <!-- Profil Resmi -->
    <img class="profile-image" src="<?php echo $profile_image; ?>" alt="<?php echo $username; ?>'nin Profili">
    
    <!-- Kullanıcı Adı -->
    <h2><?php echo $username; ?></h2>

    <!-- Rol Badge -->
    <div class="role-badge role-<?php echo $role; ?>">
        <?php echo ucfirst($role); ?>
    </div>

    <!-- Kullanıcı Hakkında Açıklama -->
    <div class="description">
        <p><?php echo $description; ?></p>
    </div>
</div>

</body>
</html>

<?php
$conn->close();
?>
