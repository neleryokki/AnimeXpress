<?php
include 'db.php'; // Veritabanı bağlantısı

// Kullanıcı oturum açmışsa kullanıcı bilgilerini çekelim
session_start();
$user_id = $_SESSION['user_id'] ?? 1; // Burada oturumdan user_id alınıyor. Örnek olarak 1 verilmiştir.

// Kullanıcı bilgilerini çekelim
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $description = $_POST['description'];
    $profile_image_url = $_POST['profile_image_url'];

    // Eğer şifre boş bırakılırsa şifre güncellenmez
    if (!empty($password)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET email = ?, password = ?, description = ?, profile_image = ? WHERE id = ?");
        $stmt->execute([$email, $password, $description, $profile_image_url, $user_id]);
    } else {
        $stmt = $pdo->prepare("UPDATE users SET email = ?, description = ?, profile_image = ? WHERE id = ?");
        $stmt->execute([$email, $description, $profile_image_url, $user_id]);
    }

    // Bilgileri güncelledikten sonra yeniden yönlendirme (sayfayı yenileyelim)
    header('Location: settings.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayarlar - Kullanıcı Bilgileri</title>
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

        /* Container */
        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .form-container {
            background-color: var(--bg-dark);
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            color: var(--text-dark);
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.5rem;
            text-align: center;
        }

        .form-container h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background-color: var(--primary-color);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid transparent;
            border-radius: 0.5rem;
            background-color: var(--bg-light);
            color: var(--text-light);
            transition: var(--transition);
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        .form-group img {
            max-width: 150px;
            height: auto;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }

        .submit-btn {
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition);
            width: 100%;
        }

        .submit-btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
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
                    <li><a href="oneriler.php">Anime Önerileri</a></li>
                    <li><a href="iletisim.php">İletişim</a></li>
                    <li><a href="gizlilikpolitikası.html">Gizlilik Politikası</a></li>
                </ul>
            </nav>
            <button class="theme-toggle" id="theme-toggle">
                <i class="fas fa-moon"></i>
            </button>
        </div>
    </header>

    <div class="container">
        <div class="form-container">
            <h2>Hesap Ayarları</h2>

            <form action="settings.php" method="POST">
                <div class="form-group">
                    <label for="username">Kullanıcı Adı (Değiştirilemez)</label>
                    <input type="text" id="username" value="<?= htmlspecialchars($user['username']) ?>" disabled>
                </div>

                <div class="form-group">
                    <label for="email">E-posta</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="password">Yeni Şifre (Boş bırakılırsa şifre değiştirilmez)</label>
                    <input type="password" id="password" name="password" placeholder="Yeni Şifre">
                </div>

                <div class="form-group">
                    <label for="description">Kullanıcı Açıklaması</label>
                    <textarea id="description" name="description"><?= htmlspecialchars($user['description']) ?></textarea>
                </div>

                <div class="form-group">
                    <label>Mevcut Profil Resmi</label>
                    <img src="<?= htmlspecialchars($user['profile_image']) ?>" alt="Profil Resmi">
                </div>

                <div class="form-group">
                    <label for="profile_image_url">Profil Resmi URL</label>
                    <input type="url" id="profile_image_url" name="profile_image_url" value="<?= htmlspecialchars($user['profile_image']) ?>" placeholder="https://">
                </div>

                <button type="submit" class="submit-btn">Bilgileri Güncelle</button>
            </form>
        </div>
    </div>

    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const body = document.body;
        const icon = themeToggle.querySelector('i');

        // Check for saved theme preference
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            body.setAttribute('data-theme', savedTheme);
            icon.className = savedTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
        }

        themeToggle.addEventListener('click', () => {
            const currentTheme = body.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            body.setAttribute('data-theme', newTheme);
            icon.className = newTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
            
            // Save theme preference
            localStorage.setItem('theme', newTheme);
        });
    </script>
</body>
</html>
