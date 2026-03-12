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

// Sayfalandırma ve arama ayarları
$items_per_page = 12;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $items_per_page;
$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';

// Anime listesini çekme
if (!empty($searchQuery)) {
    $sql = "SELECT id, name, episode_count, description, image_url, created_at 
            FROM animes 
            WHERE name LIKE ? 
            ORDER BY created_at DESC 
            LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%{$searchQuery}%";
    $stmt->bind_param('sii', $searchTerm, $items_per_page, $offset);
} else {
    $sql = "SELECT id, name, episode_count, description, image_url, created_at 
            FROM animes 
            ORDER BY created_at DESC 
            LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $items_per_page, $offset);
}

$stmt->execute();
$result = $stmt->get_result();

// Toplam anime sayısını hesaplama
$total_sql = empty($searchQuery) 
    ? "SELECT COUNT(*) FROM animes" 
    : "SELECT COUNT(*) FROM animes WHERE name LIKE ?";
$total_stmt = $conn->prepare($total_sql);

if (!empty($searchQuery)) {
    $searchTerm = "%{$searchQuery}%";
    $total_stmt->bind_param('s', $searchTerm);
}

$total_stmt->execute();
$total_stmt->bind_result($total_items);
$total_stmt->fetch();
$total_stmt->close();

$total_pages = ceil($total_items / $items_per_page);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FrostSubs - Seriler</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Önceki kodda verdiğim tüm stil kodunu buraya yapıştırın */
        :root {
            --primary-color: #7c3aed;
            --secondary-color: #5b21b6;
            --bg-light: #f8fafc;
            --text-light: #334155;
            --bg-dark: #1e293b;
            --text-dark: #f1f5f9;
            --transition: all 0.3s ease;
        }

        /* Önceki stilin tamamı buraya gelecek */
        [data-theme="dark"] {
            --primary-color: #8b5cf6;
            --secondary-color: #7c3aed;
            --bg-light: #1e293b;
            --text-light: #f1f5f9;
            --bg-dark: #0f172a;
            --text-dark: #f8fafc;
        }

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

    /* Anime Section */
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
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        text-decoration: none;
        color: var(--text-dark);
    }

    .anime-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }

    .anime-item img {
        width: 100%;
        height: 300px;
        object-fit: cover;
    }

    .anime-item-content {
        padding: 1rem;
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

    /* Sidebar */
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

    /* Pagination */
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
        gap: 0.5rem;
    }

    .pagination a {
        padding: 0.5rem 1rem;
        background-color: var(--bg-dark);
        color: var(--text-dark);
        text-decoration: none;
        border-radius: 0.25rem;
        transition: background-color 0.3s ease;
    }

    .pagination a:hover,
    .pagination a.active {
        background-color: var(--primary-color);
        color: white;
    }

    /* Footer */
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

        .anime-list {
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
</style>

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
            <div class="anime-section-header">Seriler</div>
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

            <?php if ($total_pages > 1): ?>
                <div class="pagination">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="seriler.php?page=<?php echo $i; ?><?php echo !empty($searchQuery) ? '&search=' . urlencode($searchQuery) : ''; ?>" 
                           class="<?php echo ($i == $page) ? 'active' : ''; ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        </section>

        <aside class="sidebar">
            <div class="search-container">
                <form action="seriler.php" method="GET">
                    <input type="text" name="search" placeholder="Anime ara..." value="<?php echo htmlspecialchars($searchQuery); ?>">
                    <button type="submit">Ara</button>
                </form>
            </div>

            <div class="popular-section">
                <h3>Popüler Animeler</h3>
                <ul class="popular-list">
                    <li class="popular-item">
                        <img src="https://m.media-amazon.com/images/I/71f-ESzYLXL._AC_UF894,1000_QL80_.jpg" alt="One Piece">
                        <div>
                            <span>One Piece</span>
                            <span class="rating">⭐ 92</span>
                        </div>
                    </li>
                    
                    </li>
                    <li class="popular-item">
                        <img src="https://m.media-amazon.com/images/I/61z9EGuPagL._AC_UF894,1000_QL80_.jpg" alt="BLEACH: Sennen Kessen-hen">
                        <div>
                            <span>BLEACH: Sennen Kessen-hen</span>
                            <span class="rating">⭐ 87</span>
                        </div>
                    </li>
                    <li class="popular-item">
                        <img src="https://m.media-amazon.com/images/I/71KuAco6+kL._AC_UF894,1000_QL80_.jpg" alt="Sword Art Online">
                        <div>
                            <span>Sword Art Online</span>
                            <span class="rating">⭐ 75</span>
                        </div>
                    </li>
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
