<?php
// Hata raporlamayı açalım
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Veritabanı bağlantısı
$host = 'localhost';
$db = 'frostsub_anime';
$user = 'frostsub_anime'; // MySQL kullanıcı adını girin
$pass = 'frostsub3123123123'; // MySQL şifresini girin

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// Oturum başlatma
session_start();

$error_message = ''; // Hata mesajını saklayacağız
$form_type = 'login'; // Varsayılan olarak giriş formunu açık tutalım

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        // Kayıt işlemi
        $form_type = 'register'; // Kayıt formunu açık tutalım
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Şifreyi hashleyerek sakla
        $role = 'user'; // Rolü otomatik olarak "user" olarak ayarla

        // Kullanıcı kaydını veritabanına ekle
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $password, $role); // Rolü de ekle

        if ($stmt->execute()) {
            $error_message = "Kayıt başarıyla tamamlandı!";
        } else {
            $error_message = "Kayıt hatası: " . $stmt->error;
        }
        $stmt->close();

    } elseif (isset($_POST['login'])) {
        // Giriş işlemi
        $form_type = 'login'; // Giriş formunu açık tutalım
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Kullanıcıyı veritabanında bul ve şifreyi doğrula
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            // Giriş başarılı, oturumu başlat
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];  // Kullanıcının rolü oturumda saklanıyor
            header("Location: index.php"); // Anasayfaya yönlendir
            exit();
        } else {
            $error_message = "E-posta veya şifre yanlış!";
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime İzleme Sitesi - Giriş / Kayıt</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background: url('https://i.hizliresim.com/psob9ww.jpg') no-repeat center center fixed; /* Arka plan resmi */
            background-size: cover;
        }

        header {
            background-color: rgba(30, 41, 59, 0.8); /* Karanlık temalı şeffaf başlık */
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
        }

        nav ul {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        nav a {
            color: #f1f5f9; /* Açık renkli metin */
            text-decoration: none;
            font-weight: 500;
            position: relative;
            padding: 0.5rem 0;
        }

        .container {
            max-width: 400px; /* Genişliği sınırla */
            margin: 5rem auto; /* Üstte biraz boşluk ver */
            background-color: rgba(30, 41, 59, 0.8); /* Karanlık temalı şeffaf konteyner */
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            color: #f1f5f9; /* Metin rengi */
            display: none; /* Başlangıçta sakla */
        }

        .container.active {
            display: block; /* Aktif olduğu zaman göster */
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 15px;
            margin: 12px 0;
            border: none;
            border-radius: 5px;
            outline: none;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #7c3aed; /* Giriş/Kayıt butonu rengi */
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #5b21b6; /* Hover durumu rengi */
        }

        .error-message {
            background-color: rgba(255, 0, 0, 0.7);
            color: white;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 16px;
        }

        footer {
            background-color: rgba(30, 41, 59, 0.8); /* Footer için şeffaf arka plan */
            color: #f1f5f9; /* Açık renk metin */
            padding: 2rem;
            text-align: center;
            margin-top: 3rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-links a {
            color: #f1f5f9;
            font-size: 1.5rem;
        }

        .social-links a:hover {
            color: #7c3aed; /* Hover durumu rengi */
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
        </div>
    </header>

    <div class="container active" id="loginFormContainer">
        <!-- Hata mesajını göster -->
        <?php if ($error_message): ?>
            <div class="error-message">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <!-- Giriş Yap Formu -->
        <form method="POST" action="login.php">
            <h2>Giriş Yap</h2>
            <input type="email" name="email" placeholder="E-posta" required>
            <input type="password" name="password" placeholder="Şifre" required>
            <input type="submit" name="login" value="Giriş Yap">
            <p><a href="#" id="showRegister">Hesabın Yok mu? <strong>Kayıt Ol</strong></a></p>
        </form>
    </div>

    <div class="container" id="registerFormContainer">
        <!-- Kayıt Ol Formu -->
        <form method="POST" action="login.php">
            <h2>Kayıt Ol</h2>
            <input type="text" name="username" placeholder="Kullanıcı Adı" required>
            <input type="email" name="email" placeholder="E-posta" required>
            <input type="password" name="password" placeholder="Şifre" required>
            <div class="terms">
                <input type="checkbox" name="terms" required> <span>Şartları kabul ediyorum</span>
            </div>
            <input type="submit" name="register" value="Kayıt Ol">
            <p><a href="#" id="showLogin">Zaten Hesabın var mı? <strong>Giriş Yap</strong></a></p>
        </form>
    </div>

    <footer>
        <div class="footer-content">
            <p>© 2025 Anime İzle. Tüm hakları saklıdır.</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-discord"></i></a>
            </div>
        </div>
    </footer>

    <script>
        const showRegister = document.getElementById('showRegister');
        const showLogin = document.getElementById('showLogin');
        const loginFormContainer = document.getElementById('loginFormContainer');
        const registerFormContainer = document.getElementById('registerFormContainer');

        showRegister.addEventListener('click', function(e) {
            e.preventDefault();
            loginFormContainer.classList.remove('active');
            registerFormContainer.classList.add('active');
        });

        showLogin.addEventListener('click', function(e) {
            e.preventDefault();
            registerFormContainer.classList.remove('active');
            loginFormContainer.classList.add('active');
        });
    </script>
</body>
</html>
