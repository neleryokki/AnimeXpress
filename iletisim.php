<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime İzleme Sitesi - İletişim</title>
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

        /* Form Container */
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
            animation: slideUp 0.5s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-container h3 {
            color: var(--text-dark);
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .form-container h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
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

        .submit-btn {
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition);
        }

        .submit-btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        /* Footer */
        footer {
            background-color: var(--bg-dark);
            color: var(--text-dark);
            padding: 1rem;
            text-align: center;
            margin-top: 1rem;
        }

        .footer-content {
            max-width: 30px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 2rem;
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

        @media (max-width: 70px) {
            nav ul {
                display: none;
            }

            .header-content {
                flex-wrap: wrap;
                gap: 1rem;
            }

            .footer-content {
                flex-direction: column;
                text-align: center;
            }

            .social-links {
                justify-content: center;
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
                    <span>Merhaba, <?php echo strtoupper($username); ?>!</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="user-menu-content">
                    <a href="settings.php"><i class="fas fa-cog"></i> Ayarlar</a>
                    <a href="user.php?id=<?php echo $user_id; ?>"><i class="fas fa-user-circle"></i> Profil</a>
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Çıkış Yap</a>
                </div>
            </div>
            <button class="theme-toggle" id="theme-toggle">
                <i class="fas fa-moon"></i>
            </button>
        </div>
    </header>

    <div class="container">
        <div class="form-container">
            <h3>İletişim Formu</h3>
            <?php if ($message): ?>
                <p class="message"><?php echo $message; ?></p>
            <?php endif; ?>
            <form action="iletisim.php" method="POST">
                <div class="form-group">
                    <label for="name">Adınız</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">E-posta Adresiniz</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Telefon (isteğe bağlı)</label>
                    <input type="tel" id="phone" name="phone">
                </div>
                <div class="form-group">
                    <label for="reason">Sebep</label>
                    <input type="text" id="reason" name="reason" required>
                </div>
                <div class="form-group">
                    <label for="description">Mesajınız</label>
                    <textarea id="description" name="description" rows="5" required></textarea>
                </div>
                <button type="submit" class="submit-btn">Gönder</button>
            </form>
        </div>
    </div>

  <footer>
    <div class="footer-content">
        <p>© 2025 AnimeXpress. BY  <a href="https://github.com/neleryokki"> Tüm hakları saklıdır.</p>
        <div class="social-links">
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-discord"></i></a>
        </div>
    </div>
</footer>
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
