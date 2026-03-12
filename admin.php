<?php
include 'db.php';


$action = isset($_GET['action']) ? $_GET['action'] : '';
$anime_id = isset($_GET['anime_id']) ? (int)$_GET['anime_id'] : 0;
$episode_id = isset($_GET['episode_id']) ? (int)$_GET['episode_id'] : 0;
$fansub_id = isset($_GET['fansub_id']) ? (int)$_GET['fansub_id'] : 0;
$fansub_link_id = isset($_GET['fansub_link_id']) ? (int)$_GET['fansub_link_id'] : 0;
$comment_id = isset($_GET['comment_id']) ? (int)$_GET['comment_id'] : 0;
$user_id = isset($_GET['user_id']) ? (int)$_GET['user_id'] : 0;

// Silme işlemleri
if (isset($_GET['delete']) && isset($_GET['type'])) {
    $id = (int)$_GET['delete'];
    $type = $_GET['type'];

    if ($type == 'anime') {
        $stmt = $pdo->prepare("DELETE FROM animes WHERE id = ?");
        $stmt->execute([$id]);
    } elseif ($type == 'episode') {
        $stmt = $pdo->prepare("DELETE FROM episodes WHERE id = ?");
        $stmt->execute([$id]);
    } elseif ($type == 'fansub') {
        $stmt = $pdo->prepare("DELETE FROM fansubs WHERE id = ?");
        $stmt->execute([$id]);
    } elseif ($type == 'fansub_link') {
        $stmt = $pdo->prepare("DELETE FROM fansub_links WHERE id = ?");
        $stmt->execute([$id]);
    } elseif ($type == 'comment') {
        $stmt = $pdo->prepare("DELETE FROM comments WHERE id = ?");
        $stmt->execute([$id]);
    } elseif ($type == 'user') {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    } elseif ($type == 'form') {
        $stmt = $pdo->prepare("DELETE FROM form WHERE id = ?");
        $stmt->execute([$id]);
    }
    header('Location: admin.php');
    exit;
}

// Düzenleme işlemleri
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit_anime'])) {
        $name = $_POST['name'];
        $genre = $_POST['genre'];
        $description = $_POST['description'];
        $image_url = $_POST['image_url'];
        $episode_count = $_POST['episode_count'];

        $stmt = $pdo->prepare("UPDATE animes SET name = ?, genre = ?, description = ?, image_url = ?, episode_count = ? WHERE id = ?");
        $stmt->execute([$name, $genre, $description, $image_url, $episode_count, $anime_id]);

        header('Location: admin.php');
        exit;
    }

    if (isset($_POST['edit_user'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $description = $_POST['description'];

        $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, role = ?, description = ? WHERE id = ?");
        $stmt->execute([$username, $email, $role, $description, $user_id]);

        header('Location: admin.php?action=view_users');
        exit;
    }

    if (isset($_POST['edit_comment'])) {
        $comment = $_POST['comment'];

        $stmt = $pdo->prepare("UPDATE comments SET comment = ? WHERE id = ?");
        $stmt->execute([$comment, $comment_id]);

        header('Location: admin.php?action=view_comments');
        exit;
    }

    // Ekleme işlemleri
    if (isset($_POST['add_anime'])) {
        $name = $_POST['name'];
        $genre = $_POST['genre'];
        $description = $_POST['description'];
        $image_url = $_POST['image_url'];
        $episode_count = $_POST['episode_count'];

        $stmt = $pdo->prepare("INSERT INTO animes (name, genre, description, image_url, episode_count) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $genre, $description, $image_url, $episode_count]);

        header('Location: admin.php');
        exit;
    }

    if (isset($_POST['add_episode'])) {
        $episode_number = $_POST['episode_number'];
        $video_url = $_POST['video_url'];

        $stmt = $pdo->prepare("INSERT INTO episodes (anime_id, episode_number, video_url) VALUES (?, ?, ?)");
        $stmt->execute([$anime_id, $episode_number, $video_url]);

        header("Location: admin.php?action=view_episodes&anime_id=$anime_id");
        exit;
    }

    if (isset($_POST['add_fansub'])) {
        $name = $_POST['name'];

        $stmt = $pdo->prepare("INSERT INTO fansubs (episode_id, anime_id, name) VALUES (?, ?, ?)");
        $stmt->execute([$episode_id, $anime_id, $name]);

        header("Location: admin.php?action=view_fansubs&episode_id=$episode_id");
        exit;
    }

    if (isset($_POST['add_fansub_link'])) {
        $link = $_POST['link'];
        $link_name = $_POST['link_name'];

        $stmt = $pdo->prepare("INSERT INTO fansub_links (fansub_id, link, name) VALUES (?, ?, ?)");
        $stmt->execute([$fansub_id, $link, $link_name]);

        header("Location: admin.php?action=view_fansub_links&fansub_id=$fansub_id");
        exit;
    }

    if (isset($_POST['add_user'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $description = $_POST['description'];

        $stmt = $pdo->prepare("INSERT INTO users (username, email, role, password, description) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$username, $email, $role, $password, $description]);

        header('Location: admin.php?action=view_users');
        exit;
    }

    if (isset($_POST['add_comment'])) {
        $anime_id = $_POST['anime_id'];
        $user_id = $_POST['user_id'];
        $comment = $_POST['comment'];

        $stmt = $pdo->prepare("INSERT INTO comments (anime_id, user_id, comment) VALUES (?, ?, ?)");
        $stmt->execute([$anime_id, $user_id, $comment]);

        header('Location: admin.php?action=view_comments');
        exit;
    }

    // Form ekleme işlemi
    if (isset($_POST['add_form'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $reason = $_POST['reason'];
        $description = $_POST['description'];

        $stmt = $pdo->prepare("INSERT INTO form (name, email, phone, reason, description) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $reason, $description]);

        header('Location: admin.php?action=view_forms');
        exit;
    }
}

// İşlem türü belirleme ve veri çekme
if ($action == '') {
    // Ana ekran: Animeleri listele
    $stmt = $pdo->query("SELECT * FROM animes");
    $animes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} elseif ($action == 'view_episodes' && $anime_id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM animes WHERE id = ?");
    $stmt->execute([$anime_id]);
    $anime = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT * FROM episodes WHERE anime_id = ?");
    $stmt->execute([$anime_id]);
    $episodes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} elseif ($action == 'view_fansubs' && $episode_id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM episodes WHERE id = ?");
    $stmt->execute([$episode_id]);
    $episode = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT * FROM fansubs WHERE episode_id = ?");
    $stmt->execute([$episode_id]);
    $fansubs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} elseif ($action == 'view_fansub_links' && $fansub_id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM fansubs WHERE id = ?");
    $stmt->execute([$fansub_id]);
    $fansub = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT * FROM fansub_links WHERE fansub_id = ?");
    $stmt->execute([$fansub_id]);
    $fansub_links = $stmt->fetchAll(PDO::FETCH_ASSOC);
} elseif ($action == 'view_users') {
    $stmt = $pdo->query("SELECT * FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} elseif ($action == 'view_comments') {
    $stmt = $pdo->query("SELECT comments.*, animes.name AS anime_name, users.username AS user_name FROM comments JOIN animes ON comments.anime_id = animes.id JOIN users ON comments.user_id = users.id");
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} elseif ($action == 'edit_anime' && $anime_id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM animes WHERE id = ?");
    $stmt->execute([$anime_id]);
    $anime = $stmt->fetch(PDO::FETCH_ASSOC);
} elseif ($action == 'edit_episode' && $episode_id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM episodes WHERE id = ?");
    $stmt->execute([$episode_id]);
    $episode = $stmt->fetch(PDO::FETCH_ASSOC);
} elseif ($action == 'edit_fansub' && $fansub_id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM fansubs WHERE id = ?");
    $stmt->execute([$fansub_id]);
    $fansub = $stmt->fetch(PDO::FETCH_ASSOC);
} elseif ($action == 'edit_fansub_link' && $fansub_link_id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM fansub_links WHERE id = ?");
    $stmt->execute([$fansub_link_id]);
    $fansub_link = $stmt->fetch(PDO::FETCH_ASSOC);
} elseif ($action == 'edit_user' && $user_id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} elseif ($action == 'edit_comment' && $comment_id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM comments WHERE id = ?");
    $stmt->execute([$comment_id]);
    $comment = $stmt->fetch(PDO::FETCH_ASSOC);
} elseif ($action == 'view_forms') {
    $stmt = $pdo->query("SELECT * FROM form");
    $forms = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
    <style>
    /* Dark Modern Tema */
    body {
        background-color: #121212;
        color: #e0e0e0;
        font-family: 'Inter', sans-serif;
    }
    
    /* Glassmorphism Sidebar */
    .sidebar {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-right: 1px solid rgba(255, 255, 255, 0.125);
    }
    
    /* Neon Butonlar */
    .btn-primary {
        background: linear-gradient(45deg, #6a11cb 0%, #2575fc 100%);
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: scale(1.05);
        box-shadow: 0 0 15px rgba(37, 117, 252, 0.7);
    }
    
    /* Gradient Tablo */
    .table {
        background: linear-gradient(45deg, #1a1a2e, #16213e);
    }
    
    /* Modern Form Elemanları */
    .form-control {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #e0e0e0;
    }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .logout-btn {
            padding: 10px 20px;
            background-color: #ff4444;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        .logout-btn:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Admin Panel</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
 * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', 'Arial', sans-serif;
    background-color: #121212;
    color: #e0e0e0;
    display: flex;
    height: 100vh;
}

.container {
    display: flex;
    width: 100%;
}

.sidebar {
    width: 250px;
    background-color: #1e1e2e;
    padding: 20px;
    border-right: 1px solid rgba(255,255,255,0.1);
    box-shadow: 5px 0 15px rgba(0,0,0,0.2);
}

.sidebar h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #4a54f1;
}

.sidebar nav ul {
    list-style: none;
}

.sidebar nav ul li {
    margin: 15px 0;
}

.sidebar nav ul li a {
    color: #a0a0a0;
    text-decoration: none;
    display: flex;
    align-items: center;
    padding: 10px;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.sidebar nav ul li a:hover {
    background-color: rgba(74,84,241,0.1);
    color: #4a54f1;
}

.main-content {
    flex: 1;
    padding: 20px;
    background-color: #181828;
    overflow-y: auto;
}

h2 {
    font-size: 24px;
    margin-bottom: 20px;
    border-bottom: 2px solid rgba(255,255,255,0.1);
    padding-bottom: 10px;
    color: #4a54f1;
}

.table-wrapper {
    margin-top: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table, th, td {
    border: 1px solid rgba(255,255,255,0.1);
}

th, td {
    padding: 12px;
    text-align: left;
    color: #e0e0e0;
}

th {
    background-color: rgba(74,84,241,0.1);
    color: #4a54f1;
}

.btn {
    background-color: #4a54f1;
    color: white;
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-bottom: 10px;
    transition: all 0.3s ease;
}

.btn:hover {
    background-color: #3a44d1;
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0,0,0,0.2);
}

.btn.delete {
    background-color: #ff4054;
}

.btn.delete:hover {
    background-color: #d1303f;
}

.form-container {
    background-color: #1e1e2e;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    border: 1px solid rgba(255,255,255,0.1);
    box-shadow: 0 4px 6px rgba(0,0,0,0.2);
}

input[type="text"], 
input[type="number"], 
input[type="email"], 
textarea {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 5px;
    background-color: #121212;
    color: #e0e0e0;
    transition: all 0.3s ease;
}

input[type="text"]:focus, 
input[type="number"]:focus, 
input[type="email"]:focus, 
textarea:focus {
    outline: none;
    border-color: #4a54f1;
    box-shadow: 0 0 0 2px rgba(74,84,241,0.2);
}

textarea {
    height: 120px;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
}

    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <h2>Admin Panel</h2>
            <nav>
                <ul>
                    <li><a href="admin.php"><i class="fas fa-film"></i> Animeler</a></li>
                    <li><a href="admin.php?action=view_users"><i class="fas fa-users"></i> Kullanıcılar</a></li>
                    <li><a href="admin.php?action=view_comments"><i class="fas fa-comments"></i> Yorumlar</a></li>
                    <li><a href="admin.php?action=view_forms"><i class="fas fa-file-alt"></i> Form Verileri</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <section class="content">
                <!-- Animeler ekranı -->
                <?php if ($action == ''): ?>
                    <h2>Animeler</h2>
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ad</th>
                                    <th>Tür</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($animes as $anime): ?>
                                <tr>
                                    <td><?= $anime['id'] ?></td>
                                    <td><?= htmlspecialchars($anime['name']) ?></td>
                                    <td><?= htmlspecialchars($anime['genre']) ?></td>
                                    <td>

                                        <a href="admin.php?action=view_episodes&anime_id=<?= $anime['id'] ?>" class="btn">Görüntüle</a>
                                         <div>.</div>
                                        <a href="admin.php?delete=<?= $anime['id'] ?>&type=anime" class="btn delete">Sil</a>
                                        <div>.</div>
                                        <a href="admin.php?action=edit_anime&anime_id=<?= $anime['id'] ?>" class="btn">Düzenle</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="form-container">
                        <h3>Yeni Anime Ekle</h3>
                        <form action="admin.php" method="POST">
                            <input type="text" name="name" placeholder="Anime Adı" required><br>
                            <input type="text" name="genre" placeholder="Tür" required><br>
                            <textarea name="description" placeholder="Açıklama" required></textarea><br>
                            <input type="text" name="image_url" placeholder="Görsel URL" required><br>
                            <input type="number" name="episode_count" placeholder="Bölüm Sayısı" required><br>
                            <div class="form-actions">
                                <button type="submit" name="add_anime" class="btn">Anime Ekle</button>
                            </div>
                        </form>
                    </div>

                <!-- Anime Düzenleme Formu -->
                <?php elseif ($action == 'edit_anime' && $anime_id > 0): ?>
                    <h2>Anime Düzenle</h2>
                    <div class="form-container">
                        <form action="admin.php?action=edit_anime&anime_id=<?= $anime['id'] ?>" method="POST">
                            <input type="text" name="name" value="<?= htmlspecialchars($anime['name']) ?>" placeholder="Anime Adı" required><br>
                            <input type="text" name="genre" value="<?= htmlspecialchars($anime['genre']) ?>" placeholder="Tür" required><br>
                            <textarea name="description" placeholder="Açıklama" required><?= htmlspecialchars($anime['description']) ?></textarea><br>
                            <input type="text" name="image_url" value="<?= htmlspecialchars($anime['image_url']) ?>" placeholder="Görsel URL" required><br>
                            <input type="number" name="episode_count" value="<?= $anime['episode_count'] ?>" placeholder="Bölüm Sayısı" required><br>
                            <div class="form-actions">
                                <button type="submit" name="edit_anime" class="btn">Kaydet</button>
                            </div>
                        </form>
                    </div>

                <!-- Bölümler ekranı -->
                <?php elseif ($action == 'view_episodes' && $anime_id > 0): ?>
                    <h2><?= htmlspecialchars($anime['name']) ?> - Bölümler</h2>
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Bölüm No</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($episodes as $episode): ?>
                                <tr>
                                    <td><?= $episode['id'] ?></td>
                                    <td><?= $episode['episode_number'] ?></td>
                                    <td>
                                        <a href="admin.php?action=view_fansubs&episode_id=<?= $episode['id'] ?>&anime_id=<?= $anime_id ?>" class="btn">Fansubları Görüntüle</a>
                                        <a href="admin.php?delete=<?= $episode['id'] ?>&type=episode" class="btn delete">Sil</a>
                                        <a href="admin.php?action=edit_episode&episode_id=<?= $episode['id'] ?>&anime_id=<?= $anime_id ?>" class="btn">Düzenle</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="form-container">
                        <h3>Yeni Bölüm Ekle</h3>
                        <form action="admin.php?action=view_episodes&anime_id=<?= $anime_id ?>" method="POST">
                            <input type="number" name="episode_number" placeholder="Bölüm Numarası" required><br>
                            <input type="text" name="video_url" placeholder="Video URL" required><br>
                            <div class="form-actions">
                                <button type="submit" name="add_episode" class="btn">Bölüm Ekle</button>
                            </div>
                        </form>
                    </div>

                <!-- Bölüm Düzenleme Formu -->
                <?php elseif ($action == 'edit_episode' && $episode_id > 0): ?>
                    <h2>Bölüm Düzenle</h2>
                    <div class="form-container">
                        <form action="admin.php?action=edit_episode&episode_id=<?= $episode['id'] ?>&anime_id=<?= $anime_id ?>" method="POST">
                            <input type="number" name="episode_number" value="<?= $episode['episode_number'] ?>" placeholder="Bölüm Numarası" required><br>
                            <input type="text" name="video_url" value="<?= htmlspecialchars($episode['video_url']) ?>" placeholder="Video URL" required><br>
                            <div class="form-actions">
                                <button type="submit" name="edit_episode" class="btn">Kaydet</button>
                            </div>
                        </form>
                    </div>

                <!-- Fansub ekranı -->
                <?php elseif ($action == 'view_fansubs' && $episode_id > 0): ?>
                    <h2>Bölüm <?= $episode['episode_number'] ?> - Fansublar</h2>
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fansub Adı</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($fansubs as $fansub): ?>
                                <tr>
                                    <td><?= $fansub['id'] ?></td>
                                    <td><?= htmlspecialchars($fansub['name']) ?></td>
                                    <td>
                                        <a href="admin.php?action=view_fansub_links&fansub_id=<?= $fansub['id'] ?>&episode_id=<?= $episode_id ?>&anime_id=<?= $anime_id ?>" class="btn">Linkleri Görüntüle</a>
                                        <a href="admin.php?delete=<?= $fansub['id'] ?>&type=fansub" class="btn delete">Sil</a>
                                        <a href="admin.php?action=edit_fansub&fansub_id=<?= $fansub['id'] ?>&episode_id=<?= $episode_id ?>&anime_id=<?= $anime_id ?>" class="btn">Düzenle</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="form-container">
                        <h3>Yeni Fansub Ekle</h3>
                        <form action="admin.php?action=view_fansubs&episode_id=<?= $episode_id ?>&anime_id=<?= $anime_id ?>" method="POST">
                            <input type="text" name="name" placeholder="Fansub Adı" required><br>
                            <div class="form-actions">
                                <button type="submit" name="add_fansub" class="btn">Fansub Ekle</button>
                            </div>
                        </form>
                    </div>

                <!-- Fansub Düzenleme Formu -->
                <?php elseif ($action == 'edit_fansub' && $fansub_id > 0): ?>
                    <h2>Fansub Düzenle</h2>
                    <div class="form-container">
                        <form action="admin.php?action=edit_fansub&fansub_id=<?= $fansub['id'] ?>&episode_id=<?= $episode_id ?>&anime_id=<?= $anime_id ?>" method="POST">
                            <input type="text" name="name" value="<?= htmlspecialchars($fansub['name']) ?>" placeholder="Fansub Adı" required><br>
                            <div class="form-actions">
                                <button type="submit" name="edit_fansub" class="btn">Kaydet</button>
                            </div>
                        </form>
                    </div>

                <!-- Fansub link ekranı -->
                <?php elseif ($action == 'view_fansub_links' && $fansub_id > 0): ?>
                    <h2>Fansub <?= htmlspecialchars($fansub['name']) ?> - Linkler</h2>
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Link</th>
                                    <th>Ad</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($fansub_links as $link): ?>
                                <tr>
                                    <td><?= $link['id'] ?></td>
                                    <td><a href="<?= htmlspecialchars($link['link']) ?>" target="_blank"><?= htmlspecialchars($link['link']) ?></a></td>
                                    <td><?= htmlspecialchars($link['name']) ?></td>
                                    <td>
                                        <a href="admin.php?action=edit_fansub_link&fansub_link_id=<?= $link['id'] ?>&fansub_id=<?= $fansub_id ?>&episode_id=<?= $episode_id ?>&anime_id=<?= $anime_id ?>" class="btn">Düzenle</a>
                                        <a href="admin.php?delete=<?= $link['id'] ?>&type=fansub_link" class="btn delete">Sil</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="form-container">
                        <h3>Yeni Fansub Linki Ekle</h3>
                        <form action="admin.php?action=view_fansub_links&fansub_id=<?= $fansub_id ?>&episode_id=<?= $episode_id ?>&anime_id=<?= $anime_id ?>" method="POST">
                            <input type="text" name="link" placeholder="Link" required><br>
                            <input type="text" name="link_name" placeholder="Link Adı" required><br>
                            <div class="form-actions">
                                <button type="submit" name="add_fansub_link" class="btn">Link Ekle</button>
                            </div>
                        </form>
                    </div>

                <!-- Fansub Link Düzenleme Formu -->
                <?php elseif ($action == 'edit_fansub_link' && $fansub_link_id > 0): ?>
                    <h2>Fansub Link Düzenle</h2>
                    <div class="form-container">
                        <form action="admin.php?action=edit_fansub_link&fansub_link_id=<?= $fansub_link['id'] ?>&fansub_id=<?= $fansub_id ?>&episode_id=<?= $episode_id ?>&anime_id=<?= $anime_id ?>" method="POST">
                            <input type="text" name="link" value="<?= htmlspecialchars($fansub_link['link']) ?>" placeholder="Link" required><br>
                            <input type="text" name="link_name" value="<?= htmlspecialchars($fansub_link['name']) ?>" placeholder="Link Adı" required><br>
                            <div class="form-actions">
                                <button type="submit" name="edit_fansub_link" class="btn">Kaydet</button>
                            </div>
                        </form>
                    </div>

                <!-- Kullanıcılar ekranı -->
                <?php elseif ($action == 'view_users'): ?>
                    <h2>Kullanıcılar</h2>
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kullanıcı Adı</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= $user['id'] ?></td>
                                    <td><?= htmlspecialchars($user['username']) ?></td>
                                    <td><?= htmlspecialchars($user['email']) ?></td>
                                    <td><?= htmlspecialchars($user['role']) ?></td>
                                    <td>
                                        <a href="admin.php?action=edit_user&user_id=<?= $user['id'] ?>" class="btn">Düzenle</a>
                                        <a href="admin.php?delete=<?= $user['id'] ?>&type=user" class="btn delete">Sil</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="form-container">
                        <h3>Yeni Kullanıcı Ekle</h3>
                        <form action="admin.php?action=view_users" method="POST">
                            <input type="text" name="username" placeholder="Kullanıcı Adı" required><br>
                            <input type="email" name="email" placeholder="Email" required><br>
                            <input type="text" name="role" placeholder="Rol (user/admin)" required><br>
                            <input type="password" name="password" placeholder="Şifre" required><br>
                            <textarea name="description" placeholder="Açıklama"></textarea><br>
                            <div class="form-actions">
                                <button type="submit" name="add_user" class="btn">Kullanıcı Ekle</button>
                            </div>
                        </form>
                    </div>

                <!-- Kullanıcı Düzenleme Formu -->
                <?php elseif ($action == 'edit_user' && $user_id > 0): ?>
                    <h2>Kullanıcı Düzenle</h2>
                    <div class="form-container">
                        <form action="admin.php?action=edit_user&user_id=<?= $user['id'] ?>" method="POST">
                            <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" placeholder="Kullanıcı Adı" required><br>
                            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" placeholder="Email" required><br>
                            <input type="text" name="role" value="<?= htmlspecialchars($user['role']) ?>" placeholder="Rol (user/admin)" required><br>
                            <textarea name="description" placeholder="Açıklama"><?= htmlspecialchars($user['description']) ?></textarea><br>
                            <div class="form-actions">
                                <button type="submit" name="edit_user" class="btn">Kaydet</button>
                            </div>
                        </form>
                    </div>

                <!-- Yorumlar ekranı -->
                <?php elseif ($action == 'view_comments'): ?>
                    <h2>Yorumlar</h2>
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Anime</th>
                                    <th>Kullanıcı</th>
                                    <th>Yorum</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($comments as $comment): ?>
                                <tr>
                                    <td><?= $comment['id'] ?></td>
                                    <td><?= htmlspecialchars($comment['anime_name']) ?></td>
                                    <td><?= htmlspecialchars($comment['user_name']) ?></td>
                                    <td><?= htmlspecialchars($comment['comment']) ?></td>
                                    <td>
                                        <a href="admin.php?action=edit_comment&comment_id=<?= $comment['id'] ?>" class="btn">Düzenle</a>
                                        <a href="admin.php?delete=<?= $comment['id'] ?>&type=comment" class="btn delete">Sil</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="form-container">
                        <h3>Yeni Yorum Ekle</h3>
                        <form action="admin.php?action=view_comments" method="POST">
                            <input type="number" name="anime_id" placeholder="Anime ID" required><br>
                            <input type="number" name="user_id" placeholder="Kullanıcı ID" required><br>
                            <textarea name="comment" placeholder="Yorum" required></textarea><br>
                            <div class="form-actions">
                                <button type="submit" name="add_comment" class="btn">Yorum Ekle</button>
                            </div>
                        </form>
                    </div>

                <!-- Yorum Düzenleme Formu -->
                <?php elseif ($action == 'edit_comment' && $comment_id > 0): ?>
                    <h2>Yorum Düzenle</h2>
                    <div class="form-container">
                        <form action="admin.php?action=edit_comment&comment_id=<?= $comment['id'] ?>" method="POST">
                            <textarea name="comment" placeholder="Yorum" required><?= htmlspecialchars($comment['comment']) ?></textarea><br>
                            <div class="form-actions">
                                <button type="submit" name="edit_comment" class="btn">Kaydet</button>
                            </div>
                        </form>
                    </div>

                <!-- Form verileri ekranı -->
                <?php elseif ($action == 'view_forms'): ?>
                    <h2>Form Verileri</h2>
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>İsim</th>
                                    <th>Email</th>
                                    <th>Telefon</th>
                                    <th>Neden</th>
                                    <th>Açıklama</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($forms as $form): ?>
                                <tr>
                                    <td><?= $form['id'] ?></td>
                                    <td><?= htmlspecialchars($form['name']) ?></td>
                                    <td><?= htmlspecialchars($form['email']) ?></td>
                                    <td><?= htmlspecialchars($form['phone']) ?></td>
                                    <td><?= htmlspecialchars($form['reason']) ?></td>
                                    <td><?= htmlspecialchars($form['description']) ?></td>
                                    <td>
                                        <a href="admin.php?delete=<?= $form['id'] ?>&type=form" class="btn delete">Sil</a>
                                        <a href="admin.php?action=view_form_details&form_id=<?= $form['id'] ?>" class="btn">Görüntüle</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </section>
        </main>
    </div>
</body>
</html>
