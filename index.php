<?php
// Oturumu başlat
session_start();

$host = 'localhost';
$db = 'db name';
$user = 'db user';
$pass = 'dp pass';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

$user_logged_in = false;
$username = 'Ziyaretçi';
$role = '';
$user_id = null;

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT username, role FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->bind_result($username, $role);
    if ($stmt->fetch()) {
        $user_logged_in = true;
    }
    $stmt->close();
}

$searchQuery = '';
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $sql = "SELECT id, name, episode_count, description, image_url, created_at FROM animes WHERE name LIKE ? ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $searchTerm = '%' . $searchQuery . '%';
    $stmt->bind_param('s', $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT id, name, episode_count, description, image_url, created_at FROM animes ORDER BY created_at DESC";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "FrostSubs",
  "url": "https://frostsubs.com",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "https://domain.com/index.php?search={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="FrostSubs - En güncel ve kaliteli anime izleme platformu. Türkçe altyazılı animeler, güncel bölümler ve geniş anime arşivi.">
    <meta name="keywords" content="anime izle, türkçe altyazılı anime, FrostSubs, anime bölümleri, anime arşivi">
    <meta name="author" content="FrostSubs">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://frostsubs.com" />
    <title>FrostSubs - Türkçe Altyazılı Anime İzleme Platformu | Anime İzle</title>
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

        /* Header Styles */
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

        /* Navigation */
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

        /* User Menu */
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

        /* Theme Toggle */
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

        /* Anime Section */
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            display: flex;
            gap: 2rem;
        }

        .anime-section {
            flex: 3;
        }

        .anime-section-header {
            background-color: var(--primary-color);
            color: white;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            text-align: center;
        }

        .anime-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }

        .anime-item {
            background-color: var(--bg-dark);
            border-radius: 0.5rem;
            overflow: hidden;
            transition: var(--transition);
            position: relative;
        }

        .anime-item img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .anime-item-content {
            padding: 1rem;
            color: var(--text-dark);
        }

        .anime-item-content h3 {
            margin-bottom: 0.5rem;
        }

        .episode-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: var(--primary-color);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
        }

        .sidebar {
            flex: 1;
        }

        .search-container, .popular-section {
            background-color: var(--bg-dark);
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }

        .search-container input {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 0.25rem;
            margin-bottom: 1rem;
        }

        .search-container button {
            width: 100%;
            padding: 0.75rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
        }

        /* Footer */
        footer {
            background-color: var(--bg-dark);
            color: var(--text-dark);
            padding: 2rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-links {
            display: flex;
            gap: 1rem;
        }

        .footer-links a {
            color: var(--text-dark);
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: var(--primary-color);
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-links a {
            color: var(--text-dark);
            font-size: 1.5rem;
            transition: var(--transition);
        }

        .social-links a:hover {
            color: var(--primary-color);
            transform: translateY(-3px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .anime-list {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
        }
    </style>
</head>
<body>
    <header>
        <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
<link rel="dns-prefetch" href="//fonts.googleapis.com">
        <div class="header-content">
            <div class="logo">
                <img src="https://i.hizliresim.com/ryiopc0.jpeg" alt="logo">
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Anasayfa</a></li>
                    <li><a href="seriler.php">Seriler</a></li>
                    <li><a href="oneriler.php">Anime Önerileri</a></li>
                    <li><a href="iletisim.php">İletişim</a></li>
                    <li><a href="gizlilikpolitikası.html">Gizlilik Politikası</a></li>
                    <?php if ($role === 'admin' || $role === 'mod' || $role === 'kurucu'): ?>
                        <li><a href="admin.php">Admin Paneli</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
            <div class="user-menu">
                <button>
                    <i class="fas fa-user"></i>
                    <span>Merhaba, <?php echo ucfirst($username); ?>!</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="user-menu-content">
                    <?php if ($user_logged_in): ?>
                        <a href="settings.php"><i class="fas fa-cog"></i> Ayarlar</a>
                        <a href="user.php?id=<?php echo $user_id; ?>"><i class="fas fa-user-circle"></i> Profil</a>
                        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Çıkış Yap</a>
                    <?php else: ?>
                        <a href="login.php"><i class="fas fa-sign-in-alt"></i> Giriş Yap</a>
                        <a href="register.php"><i class="fas fa-user-plus"></i> Kayıt Ol</a>
                    <?php endif; ?>
                </div>
            </div>
            <button class="theme-toggle" id="theme-toggle">
                <i class="fas fa-moon"></i>
            </button>
        </div>
    </header>

    <div class="container">

        <section class="anime-section">
            <div class="anime-section-header">Son Güncellenenler</div>
            <div class="anime-list">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <a href="anime.php?id=<?php echo $row['id']; ?>" class="anime-item">
                            <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>">
                            <div class="episode-badge"><?php echo $row['episode_count']; ?>.Bölüm</div>
                            <div class="anime-item-content">
                                <h3><?php echo $row['name']; ?></h3>
                                <p><?php 
                                    $description = $row['description'];
                                    echo strlen($description) > 100 ? substr($description, 0, 100) . '...' : $description; 
                                ?></p>
                            </div>
                        </a>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>Henüz anime eklenmedi.</p>
                <?php endif; ?>
            </div>
        </section>

        <aside class="sidebar">
            <div class="search-container">
                <form action="index.php" method="GET">
                    <input type="text" name="search" placeholder="Anime ara..." value="<?php echo htmlspecialchars($searchQuery); ?>">
                    <button type="submit">Ara</button>
                </form>
            </div>

            <div class="popular-section">
                <h3>Popüler Animeler</h3>
                <!-- Popüler animeler buraya eklenebilir -->
            </div>
        </aside>
    </div>

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
                    <li><a href="gizlilikpolitikası.html">Kullanım Şartları</a></li>
                    <li><a href="gizlilikpolitikası.html">Çerez Politikası</a></li>
                    <li><a href="iletisim.html">Telif Hakları</a></li>
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
                <p>© 2025 AnimeXpress. BY <a href="https://github.com/neleryokki">NELER YOK Kİ</a> Tüm hakları saklıdır.</p>
            </div>
            <div class="footer-links">
                <a href="iletisim.php">İletişim</a>
                <a href="destek.php">Destek</a>
                <a href="sss.php">Sıkça Sorulan Sorular</a>
            </div>
        </div>
    </div>
</footer>

<style>
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
</script>


<?php
$conn->close();
?>

