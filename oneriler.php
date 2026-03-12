<?php
// Oturumu başlat
session_start();

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

// Kullanıcı oturumu kontrol et
$user_logged_in = false;
$username = 'Ziyaretçi';
$role = '';
$user_id = null;

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Kullanıcı bilgilerini çek
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

// Arama ve filtreleme
$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';
$kategori = isset($_GET['kategori']) ? trim($_GET['kategori']) : '';

// Veritabanından anime listesi çekme
$sql = "SELECT id, name, episode_count, description, image_url, created_at, genre 
        FROM animes 
        WHERE 1=1 ";

$params = [];
$types = '';

if (!empty($searchQuery)) {
    $sql .= " AND (name LIKE ? OR description LIKE ?)";
    $searchTerm = "%{$searchQuery}%";
    $params[] = &$searchTerm;
    $params[] = &$searchTerm;
    $types .= 'ss';
}

if (!empty($kategori)) {
    $sql .= " AND genre LIKE ?";
    $kategoriTerm = "%{$kategori}%";
    $params[] = &$kategoriTerm;
    $types .= 's';
}

$sql .= " ORDER BY created_at DESC LIMIT 20";

// Dinamik parametre binding
if (!empty($params)) {
    $stmt = $conn->prepare($sql);
    
    // Parametre binding
    if (!empty($params)) {
        array_unshift($params, $types);
        $ref = new ReflectionClass('mysqli_stmt');
        $method = $ref->getMethod('bind_param');
        $method->invokeArgs($stmt, $params);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query($sql);
}

// Kategoriler
$kategori_listesi = [
    'Aksiyon' => 'Aksiyon Animeleri',
    'Romantik' => 'Romantik Animeler',
    'Bilim Kurgu' => 'Bilim Kurgu Animeleri',
    'Komedi' => 'Komedi Animeleri',
    'Fantastik' => 'Fantastik Animeler'
];
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <!-- Önceki head kısmı aynı kalacak -->
    <style>
              /* Root Variables */
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

        .logo img {
            width: 50px;
            height: auto;
            transition: transform 0.3s ease;
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
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: var(--primary-color);
        }

        nav a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--primary-color);
            transition: width 0.3s ease;
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
            transition: background-color 0.3s ease;
        }

        .user-menu button:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .user-menu-content {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: var(--bg-dark);
            border-radius: 0.5rem;
            padding: 0.5rem;
            min-width: 200px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
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
            transition: background-color 0.3s ease;
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
            transition: background-color 0.3s ease;
        }

        .theme-toggle:hover {
            background-color: var(--primary-color);
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            display: flex;
            gap: 2rem;
        }

        /* Öneri Sayfası Özel Stilleri */
        .oneri-kategorisi {
            background-color: var(--bg-dark);
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .oneri-kategorisi h2 {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 0.5rem;
        }

        .oneri-listesi {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .oneri-karti {
            background-color: var(--bg-light);
            border-radius: 0.5rem;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
        }

        .oneri-karti:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .oneri-karti img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .oneri-karti-icerik {
            padding: 1rem;
            color: var(--text-light);
        }

        .oneri-karti-icerik h3 {
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .oneri-karti-puan {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: var(--primary-color);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-weight: bold;
        }

        .oneri-karti-tur {
            color: var(--text-light);
            opacity: 0.7;
            font-size: 0.9rem;
        }

        /* Sidebar Stilleri */
        .sidebar {
            flex: 1;
        }

        .search-container, 
        .popular-section {
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
            background-color: var(--bg-light);
            color: var(--text-light);
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
            transition: background-color 0.3s ease;
        }

        .search-container button:hover {
            background-color: var(--secondary-color);
        }

        .popular-section h3 {
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .popular-list {
            list-style: none;
            padding: 0;
        }

        .popular-item {
            background-color: var(--bg-light);
            padding: 0.75rem;
            border-radius: 0.25rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            transition: background-color 0.3s ease;
        }

        .popular-item:hover {
            background-color: var(--primary-color);
            color: white;
        }

        /* Footer Styles */
        footer {
            background-color: var(--bg-dark);
            color: var(--text-dark);
            padding: 2rem 0;
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
            transition: color 0.3s ease;
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
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .social-links a:hover {
            color: var(--primary-color);
            transform: translateY(-3px);
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .container {
                flex-direction: column;
            }

            .oneri-listesi {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
        }

        @media (max-width: 768px) {
            header {
                flex-direction: column;
                gap: 1rem;
            }

            nav ul {
                flex-wrap: wrap;
                justify-content: center;
            }

            .footer-content {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }
        }
        
        /* Kategori butonları için ekstra stil */
        .kategori-listesi {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .kategori-btn {
            background-color: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .kategori-btn:hover {
            background-color: var(--secondary-color);
        }
    </style>
</head>
<body data-theme="dark">
       <header>
        <div class="header-content">
            <div class="logo">
                <img src="https://i.hizliresim.com/ryiopc0.jpeg" alt="logo">
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Anasayfa</a></li>
                    <li><a href="seriler.php">Seriler</a></li>
                    <li><a href="anime-onerileri.php">Anime Önerileri</a></li>
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
            <div class="search-container">
                <form action="" method="GET">
                    <input type="text" name="search" placeholder="Anime ara..." value="<?php echo htmlspecialchars($searchQuery); ?>">
                    <button type="submit">Ara</button>
                </form>
            </div>

            <div class="kategori-listesi">
                <?php foreach ($kategori_listesi as $key => $label): ?>
                    <a href="?kategori=<?php echo urlencode($key); ?>" class="kategori-btn">
                        <?php echo $label; ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <div class="oneri-kategorisi">
                <h2>
                    <?php 
                    if (!empty($searchQuery)) {
                        echo "'$searchQuery' için Arama Sonuçları";
                    } elseif (!empty($kategori)) {
                        echo $kategori_listesi[$kategori] . " Kategorisi";
                    } else {
                        echo "Tüm Animeler";
                    }
                    ?>
                </h2>
                <div class="oneri-listesi">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($anime = $result->fetch_assoc()): ?>
                            <a href="anime.php?id=<?php echo $anime['id']; ?>" class="oneri-karti">
                                <img src="<?php 
                                    // Resim URL kontrolü
                                    echo !empty($anime['image_url']) ? $anime['image_url'] : 'default-anime.jpg'; 
                                ?>" alt="<?php echo htmlspecialchars($anime['name']); ?>">
                                <div class="oneri-karti-puan">★ <?php 
                                    // Rastgele puan ekledik
                                    echo number_format(mt_rand(70, 95) / 10, 1); 
                                ?></div>
                                <div class="oneri-karti-icerik">
                                    <h3><?php echo htmlspecialchars($anime['name']); ?></h3>
                                    <p class="oneri-karti-tur"><?php echo htmlspecialchars($anime['genre'] ?? 'Tür Belirtilmemiş'); ?></p>
                                </div>
                            </a>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>Bu kategoride veya aramada anime bulunamadı.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <aside class="sidebar">
          
                </ul>
            </div>
        </aside>
    </div>

       <footer>
        <div class="footer-content">
            <div class="footer-links">
                <a href="hakkimizda.php">Hakkımızda</a>
                <a href="iletisim.php">İletişim</a>
                <a href="gizlilikpolitikası.html">Gizlilik Politikası</a>
            </div>
            <div class="social-links">
                <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="#" target="_blank"><i class="fab fa-discord"></i></a>
                <a href="#" target="_blank"><i class="fab fa-youtube"></i></a>
            </div>
            <p>© 2025 FrostSubs Anime. Tüm hakları saklıdır.</p>
        </div>
    </footer>

    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const body = document.body;
        const icon = themeToggle.querySelector('i');

        // Varsayılan olarak dark mode'u etkinleştir
        document.addEventListener('DOMContentLoaded', () => {
            body.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark');
            icon.className = 'fas fa-sun';
        });

        // Tema değiştirme fonksiyonu
        themeToggle.addEventListener('click', () => {
            const currentTheme = body.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            body.setAttribute('data-theme', newTheme);
            icon.className = newTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
            
            localStorage.setItem('theme', newTheme);
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>
