<?php
// Oturumu başlat
session_start();

// Hata raporlamayı etkinleştir
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Veritabanı bağlantısı
$host = 'localhost';
$db = 'frostsub_anime';
$user = 'frostsub_anime';
$pass = 'frostsub3123123123';

$conn = new mysqli($host, $user, $pass, $db);

// Veritabanı bağlantısı kontrolü
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

// URL'den anime ID'sini al
if (isset($_GET['id'])) {
    $anime_id = (int)$_GET['id'];
} else {
    header("Location: index.php");
    exit();
}

// Anime bilgilerini veritabanından çek
$sql = "SELECT name, genre, description, image_url, episode_count FROM animes WHERE id = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Sorgu hazırlama hatası: " . $conn->error);
}

$stmt->bind_param('i', $anime_id);
$stmt->execute();
$stmt->bind_result($anime_name, $anime_genre, $anime_description, $anime_image_url, $anime_episode_count);
$stmt->fetch();
$stmt->close();

// Tüm bölümleri veritabanından çek
$sql_episodes = "SELECT id, episode_number, video_url, created_at FROM episodes WHERE anime_id = ? ORDER BY episode_number ASC";
$stmt_episodes = $conn->prepare($sql_episodes);
if (!$stmt_episodes) {
    die("Sorgu hazırlama hatası: " . $conn->error);
}

$stmt_episodes->bind_param('i', $anime_id);
$stmt_episodes->execute();
$episodes_result = $stmt_episodes->get_result();
$stmt_episodes->close();

// Yorumları veritabanından çek
$sql_comments = "SELECT users.username, users.profile_image, comments.comment, comments.created_at 
                FROM comments 
                JOIN users ON comments.user_id = users.id 
                WHERE anime_id = ? 
                ORDER BY created_at DESC";
$stmt_comments = $conn->prepare($sql_comments);
if (!$stmt_comments) {
    die("Sorgu hazırlama hatası: " . $conn->error);
}

$stmt_comments->bind_param('i', $anime_id);
$stmt_comments->execute();
$comments_result = $stmt_comments->get_result();
$stmt_comments->close();

// Yorum ekleme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $comment = $_POST['comment'];
    $user_id = $_SESSION['user_id'];

    $sql_insert_comment = "INSERT INTO comments (anime_id, user_id, comment) VALUES (?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert_comment);
    if (!$stmt_insert) {
        die("Sorgu hazırlama hatası: " . $conn->error);
    }

    $stmt_insert->bind_param('iis', $anime_id, $user_id, $comment);
    $stmt_insert->execute();
    $stmt_insert->close();

    header("Location: anime.php?id=" . $anime_id);
    exit();
}

// Fansub'ları ve bağlantılarını veritabanından çek
$sql_fansubs = "SELECT fs.id AS fansub_id, fs.name AS fansub_name, fl.link, fl.name AS link_name 
                FROM fansubs fs 
                LEFT JOIN fansub_links fl ON fs.id = fl.fansub_id 
                WHERE fs.anime_id = ?";
$stmt_fansubs = $conn->prepare($sql_fansubs);
$stmt_fansubs->bind_param('i', $anime_id);
$stmt_fansubs->execute();
$fansubs_result = $stmt_fansubs->get_result();
$stmt_fansubs->close();

// Fansub bağlantılarını gruplamak için bir dizi oluştur
$fansub_links = [];
while ($row = $fansubs_result->fetch_assoc()) {
    $fansub_links[$row['fansub_id']]['name'] = $row['fansub_name'];
    $fansub_links[$row['fansub_id']]['links'][] = [
        'link' => $row['link'],
        'name' => $row['link_name']
    ];

    // SEO için meta açıklaması oluştur
$meta_description = mb_substr(strip_tags($anime_description), 0, 160, 'UTF-8');
$canonical_url = "https://frostsubs.com/anime.php?id=" . $anime_id;
// Open Graph ve Twitter Card meta verilerini oluştur
$og_image = $anime_image_url ? $anime_image_url : 'https://frostsubs.com/default-anime-image.jpg';
}

?>
<!DOCTYPE html>
<html lang="tr">
<head>
     <title><?php echo htmlspecialchars($anime_name); ?> İzle - Tüm Bölümler | FrostSubs</title>
    <meta name="description" content="<?php echo htmlspecialchars($meta_description); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($anime_name); ?>, anime izle, <?php echo htmlspecialchars($anime_genre); ?>, türkçe altyazı">
    <link rel="canonical" href="<?php echo $canonical_url; ?>">
    <!-- Open Graph Meta Etiketleri -->
    <meta property="og:title" content="<?php echo htmlspecialchars($anime_name); ?> İzle">
    <meta property="og:description" content="<?php echo htmlspecialchars($meta_description); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($og_image); ?>">
    <meta property="og:url" content="<?php echo $canonical_url; ?>">
    <meta property="og:type" content="video.episode">
    <meta property="og:site_name" content="FrostSubs">
    <meta charset="UTF-8">
    <meta name="robots" content="index, follow">
    <meta name="author" content="FrostSubs">
    <!-- Schema.org Yapılandırılmış Veri -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "TVSeries",
        "name": "<?php echo htmlspecialchars($anime_name); ?>",
        "description": "<?php echo htmlspecialchars($meta_description); ?>",
        "image": "<?php echo htmlspecialchars($og_image); ?>",
        "genre": "<?php echo htmlspecialchars($anime_genre); ?>",
        "numberOfEpisodes": "<?php echo $anime_episode_count; ?>",
        "publisher": {
            "@type": "Organization",
            "name": "FrostSubs",
            "logo": {
                "@type": "ImageObject",
                "url": "https://frostsubs.com/logo.png"
            }
        },
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.5",
            "reviewCount": "100"
        }
    }
    </script>

    <!-- Preload önemli kaynaklar -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" as="style">
    
    <!-- CSS ve diğer kaynaklar -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($anime_name); ?> - Bölümler</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #7c3aed;
            --secondary-color: #5b21b6;
            --bg-light: #f8fafc;
            --text-light: #334155;
            --bg-dark: #1e293b;
            --text-dark: #f1f5f9;
            --transition: all 0.3s ease;
        }

        [data-theme="dark"] {
            --primary-color: #8b5cf6;
            --secondary-color: #7c3aed;
            --bg-light: #1e293b;
            --text-light: #f1f5f9;
            --bg-dark: #0f172a;
            --text-dark: #f8fafc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-light);
            transition: var(--transition);
        }

        header {
            background-color: var(--bg-dark);
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo img {
            width: 50px;
            height: auto;
            transition: var(--transition);
        }

        .logo img:hover {
            transform: scale(1.1);
        }

        nav ul {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        nav a {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 500;
            position: relative;
            padding: 0.5rem 0;
        }

        nav a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--primary-color);
            transition: var(--transition);
        }

        nav a:hover::after {
            width: 100%;
        }

        .user-menu {
            position: relative;
        }

        .user-menu button {
            background: none;
            border: none;
            color: var(--text-dark);
            font-size: 1rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: var(--transition);
        }

        .user-menu button:hover {
            background-color: var(--primary-color);
        }

        .user-menu-content {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: var(--bg-dark);
            border-radius: 0.5rem;
            padding: 0.5rem;
            min-width: 200px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: var(--transition);
        }

        .user-menu:hover .user-menu-content {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .user-menu-content a {
            color: var(--text-dark);
            text-decoration: none;
            padding: 0.75rem 1rem;
            display: block;
            border-radius: 0.25rem;
            transition: var(--transition);
        }

        .user-menu-content a:hover {
            background-color: var(--primary-color);
        }

        .theme-toggle {
            background: none;
            border: none;
            color: var(--text-dark);
            cursor: pointer;
            font-size: 1.25rem;
            padding: 0.5rem;
            border-radius: 50%;
            transition: var(--transition);
        }

        .theme-toggle:hover {
            background-color: var(--primary-color);
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
            display: flex;
            gap: 2rem;
        }

        .anime-details {
            flex: 3;
            background-color: var(--bg-dark);
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .anime-details h2 {
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .episode-count {
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .anime-description {
            margin-top: 2rem;
        }

        .anime-description img {
            max-width: 200px;
            border-radius: 0.5rem;
            margin-right: 1rem;
            float: left;
        }

        .description {
            color: var(--text-dark);
            line-height: 1.6;
        }

        .sidebar {
            flex: 1;
        }

        .episodes-section {
            background-color: var(--bg-dark);
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 100px;
        }

        .episodes-section h3 {
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .episodes-list {
            list-style: none;
            max-height: 600px;
            overflow-y: auto;
        }

        .episode-item {
            padding: 1rem;
            border-bottom: 1px solid var(--text-light);
            cursor: pointer;
            transition: var(--transition);
            color: var(--text-dark);
        }

        .episode-item:hover {
            background-color: var(--primary-color);
        }

        .episode-item.active {
            background-color: var(--primary-color);
        }

        .video-container {
            width: 100%;
            height: 550px;
            margin: 2rem 0;
            border-radius: 1rem;
            overflow: hidden;
            display: none;
        }

        .image-container {
            width: 100%;
            height: 550px;
            margin: 2rem 0;
            border-radius: 1rem;
            overflow: hidden;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .video-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .fansub-buttons {
            display: flex;
            gap: 1rem;
            margin: 1rem 0;
            flex-wrap: wrap;
        }

        .fansub-button {
            padding: 0.75rem 1.5rem;
            background-color: var(--primary-color);
            color: var(--text-dark);
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .fansub-button:hover {
            background-color: var(--secondary-color);
        }

        .video-fansub-links {
            display: flex;
            gap: 1rem;
            margin: 1rem 0;
            flex-wrap: wrap;
        }

        .video-fansub-link {
            padding: 0.75rem 1.5rem;
            background-color: var(--primary-color);
            color: var(--text-dark);
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .video-fansub-link:hover {
            background-color: var(--secondary-color);
        }

        .comments-section {
            background-color: var(--bg-dark);
            padding: 2rem;
            border-radius: 1rem;
            margin-top: 2rem;
        }

        .comments-section h3 {
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .comment-form textarea {
            width: 100%;
            padding: 1rem;
            border: 1px solid var(--text-light);
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            background-color: var(--bg-light);
            color: var(--text-light);
            resize: vertical;
        }

        .comment-form button {
            padding: 0.75rem 1.5rem;
            background-color: var(--primary-color);
            color: var(--text-dark);
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .comment-form button:
        hover {
            background-color: var(--secondary-color);
        }

        .comments-list {
            margin-top: 2rem;
        }

        .comment-item {
            background-color: var(--bg-light);
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }

        .comment-item img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 1rem;
            float: left;
        }

        .comment-item strong {
            color: var(--text-dark);
            display: block;
        }

        .comment-item span {
            color: var(--text-light);
            font-size: 0.875rem;
        }

        .comment-item p {
            color: var(--text-dark);
            margin-top: 0.5rem;
            line-height: 1.6;
        }
         footer {
        background-color: var(--bg-dark);
        color: var(--text-dark);
        padding: 3rem 0;
        border-top: 2px solid var(--primary-color);
    }

    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .footer-column h4 {
        color: var(--primary-color);
        margin-bottom: 1rem;
        font-size: 1.2rem;
        position: relative;
        padding-bottom: 0.5rem;
    }

    .footer-column h4::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 2px;
        background-color: var(--primary-color);
    }

    .footer-column ul {
        list-style: none;
        padding: 0;
    }

    .footer-column ul li {
        margin-bottom: 0.5rem;
    }

    .footer-column ul li a {
        color: var(--text-dark);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer-column ul li a:hover {
        color: var(--primary-color);
    }

    .footer-logo img {
        max-width: 150px;
        border-radius: 10px;
    }

    .social-links-extended {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .social-icon {
        color: var(--text-dark);
        font-size: 1.5rem;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .social-icon:hover {
        color: var(--primary-color);
        transform: translateY(-3px);
    }

    .footer-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid rgba(255,255,255,0.1);
        padding-top: 1.5rem;
    }

    .footer-links {
        display: flex;
        gap: 1rem;
    }

    .footer-links a {
        color: var(--text-dark);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer-links a:hover {
        color: var(--primary-color);
    }

    @media (max-width: 768px) {
        .footer-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 480px) {
        .footer-grid {
            grid-template-columns: 1fr;
        }

        .footer-bottom {
            flex-direction: column;
            text-align: center;
        }

        .footer-links {
            margin-top: 1rem;
        }
    }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo">
                <img src="https://i.hizliresim.com/ryiopc0.jpeg" alt="logo">
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Anasayfa</a></li>
                    <li><a href="seriler.php">Seriler</a></li>
                    <li><a href="#">Anime Önerileri</a></li>
                    <li><a href="iletişim.php">İletişim</a></li>
                    <li><a href="gizlilikpolitikası.html">Gizlilik Politikası</a></li>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <li><a href="admin.php">Admin Paneli</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
            <div class="user-menu">
                <button>
                    <i class="fa-solid fa-user"></i>
                    <span>Merhaba!</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="user-menu-content">
                    <a href="user.php?id=<?php echo $_SESSION['user_id']; ?>">Profil</a>
                    <a href="settings.php">Ayarlar</a>
                    <a href="logout.php">Çıkış Yap</a>
                </div>
            </div>
            <button class="theme-toggle" id="theme-toggle">
                <i class="fa-solid fa-moon"></i>
            </button>
        </div>
    </header>

    <div class="container">
        <section class="anime-details">
            <h2><?php echo htmlspecialchars($anime_name); ?></h2>
            <div class="episode-count">Bölüm Sayısı: <?php echo $anime_episode_count; ?></div>

            <div class="fansub-buttons" id="fansub-buttons-container">
                <!-- Başlangıçta boş, bölüm seçilince gösterilecek -->
            </div>

            <div class="image-container">
                <img src="https://images.unsplash.com/photo-1569470451072-68314f596aec?q=80&w=2531&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="<?php echo htmlspecialchars($anime_name); ?>">
            </div>

            <div class="video-container">
                <iframe id="video-player" src="" frameborder="0" allowfullscreen></iframe>
            </div>

            <div class="video-fansub-links" id="fansub-links-container">
                <!-- Başlangıçta boş, fansub'a tıklanınca buraya linkler gelecek -->
            </div>

            <div class="anime-description">
                <img src="<?php echo htmlspecialchars($anime_image_url); ?>" alt="<?php echo htmlspecialchars($anime_name); ?>">
                <div class="description">
                    <strong>Tür:</strong> <?php echo htmlspecialchars($anime_genre); ?><br><br>
                    <?php echo nl2br(htmlspecialchars($anime_description)); ?>
                </div>
            </div>
        </section>

        <aside class="sidebar">
            <section class="episodes-section">
                <h3>Bölümler</h3>
                <ul class="episodes-list">
                    <?php while ($episode = $episodes_result->fetch_assoc()): ?>
                        <li class="episode-item" data-video="<?php echo htmlspecialchars($episode['video_url']); ?>" data-id="<?php echo $episode['id']; ?>">
                            <?php echo $episode['episode_number']; ?>. Bölüm
                            <span class="episode-date"><?php echo date("d M Y", strtotime($episode['created_at'])); ?></span>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </section>
        </aside>
    </div>

    <section class="comments-section">
        <h3>Yorumlar</h3>
        <form class="comment-form" method="POST">
            <textarea name="comment" required placeholder="Yorumunuzu buraya yazın..." rows="3"></textarea>
            <button type="submit">Yorum Yap</button>
        </form>

        <div class="comments-list">
            <?php while ($comment = $comments_result->fetch_assoc()): ?>
                <div class="comment-item">
                    <img src="<?php echo htmlspecialchars($comment['profile_image']); ?>" alt="<?php echo htmlspecialchars($comment['username']); ?>">
                    <strong><?php echo htmlspecialchars($comment['username']); ?></strong>
                    <span><?php echo date("d M Y H:i", strtotime($comment['created_at'])); ?></span>
                    <p><?php echo nl2br(htmlspecialchars($comment['comment'])); ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
 <footer>
    <div class="footer-container">
        <div class="footer-grid">
            <div class="footer-column">
                <h4>FrostSubs</h4>
                <p>Kaliteli ve güncel anime yayınları için en iyi platform.</p>
                <div class="footer-logo">
                    <img src="https://i.hizliresim.com/ryiopc0.jpeg" alt="FrostSubs Logo">
                </div>
            </div>
            
            <div class="footer-column">
                <h4>Hızlı Erişim</h4>
                <ul>
                    <li><a href="index.php">Anasayfa</a></li>
                    <li><a href="seriler.php">Anime Arşivi</a></li>
                    <li><a href="iletisim.php">İletişim</a></li>
                    <li><a href="destek.php">Destek</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h4>Yasal</h4>
                <ul>
                    <li><a href="gizlilikpolitikası.html">Gizlilik Politikası</a></li>
                    <li><a href="kullanim-sartlari.html">Kullanım Şartları</a></li>
                    <li><a href="cerez-politikasi.html">Çerez Politikası</a></li>
                    <li><a href="telif-hakları.html">Telif Hakları</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h4>Bize Ulaşın</h4>
                <div class="contact-info">
                    <p><i class="fas fa-envelope"></i> destek@frostsubs.com</p>
                    <p><i class="fas fa-phone"></i> +90 555 123 45 67</p>
                    <div class="social-links-extended">
                        <a href="#" class="social-icon"><i class="fab fa-discord"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="copyright">
                <p>© 2025 FrostSubs Anime. Tüm hakları saklıdır.</p>
            </div>
            <div class="footer-links">
                <a href="iletisim.php">İletişim</a>
                <a href="destek.php">Destek</a>
                <a href="sss.php">Sıkça Sorulan Sorular</a>
            </div>
        </div>
    </div>
</footer>
    
    <script>
    // Dark mode'u varsayılan olarak başlat
    document.addEventListener('DOMContentLoaded', () => {
        const body = document.body;
        const themeToggle = document.getElementById('theme-toggle');
        const icon = themeToggle.querySelector('i');

        // Varsayılan olarak dark mode'u etkinleştir
        body.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
        icon.className = 'fas fa-sun'; // Dark modda güneş ikonu

        // Tema değiştirme fonksiyonu
        function toggleTheme() {
            const currentTheme = body.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            body.setAttribute('data-theme', newTheme);
            icon.className = newTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
            
            localStorage.setItem('theme', newTheme);
        }

        // Tema değiştirme event listener'ı
        themeToggle.addEventListener('click', toggleTheme);
    });

        // Bölümleri tıklayınca video oynatma fonksiyonu
        const episodeItems = document.querySelectorAll('.episode-item');
        const iframe = document.querySelector('.video-container iframe');
        const imageContainer = document.querySelector('.image-container');
        const videoContainer = document.querySelector('.video-container');

        // İlk bölüm için varsayılan olarak video URL'sini ayarlama
        const firstEpisode = episodeItems[0];
        if (firstEpisode) {
            firstEpisode.click();
        }

        // Bölüm tıklama olayları
        episodeItems.forEach(item => {
            item.addEventListener('click', function() {
                // Aktif olan bölümü işaretle
                episodeItems.forEach(i => i.classList.remove('active'));
                this.classList.add('active');

                // Seçilen bölüme ait fansubları getir
                const episodeId = this.getAttribute('data-id');
                fetchFansubs(episodeId);
            });
        });

        // Fansub video bağlantılarını gösteren fonksiyon
        function showFansubLinks(fansubId) {
            const fansubLinksContainer = document.getElementById('fansub-links-container');
            fansubLinksContainer.innerHTML = '';

            const fansubLinks = <?php echo json_encode($fansub_links); ?>;
            if (fansubLinks[fansubId] && fansubLinks[fansubId]['links']) {
                fansubLinks[fansubId]['links'].forEach(link => {
                    const button = document.createElement('button');
                    button.classList.add('video-fansub-link');
                    button.innerText = link.name;
                    button.onclick = function() {
                        document.getElementById('video-player').src = link.link;
                        imageContainer.style.display = 'none';
                        videoContainer.style.display = 'block';
                    };
                    fansubLinksContainer.appendChild(button);
                });
            }
        }

        // Bölüm ID'sine göre fansub butonlarını al ve güncelle
        function fetchFansubs(episodeId) {
            fetch(`fetch_fansubs.php?episode_id=${episodeId}`)
                .then(response => response.json())
                .then(data => {
                    const fansubButtonsContainer = document.getElementById('fansub-buttons-container');
                    fansubButtonsContainer.innerHTML = '';

                    data.forEach(fansub => {
                        const button = document.createElement('button');
                        button.classList.add('fansub-button');
                        button.innerText = fansub.name;
                        button.onclick = function() {
                            showFansubLinks(fansub.id);
                        };
                        fansubButtonsContainer.appendChild(button);
                    });
                });
        }
        
    </script>
</body>
</html>

<?php
$conn->close();
?>