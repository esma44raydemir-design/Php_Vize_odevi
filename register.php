<?php
session_start();
$mesaj = "";

// Form gönderildiyse işlemleri yap
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kayit_ol'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Kullanıcılar dizisi yoksa oluştur
    if (!isset($_SESSION['users'])) {
        $_SESSION['users'] = array();
    }

    // Boş alan kontrolü ve kayıt işlemi
    if (empty($username) || empty($password)) {
        $mesaj = "<div class='bildirim hata'>Lütfen tüm alanları doldurun.</div>";
    } elseif (isset($_SESSION['users'][$username])) {
        $mesaj = "<div class='bildirim hata'>Bu kullanıcı adı zaten alınmış!</div>";
    } else {
        $_SESSION['users'][$username] = $password;
        $mesaj = "<div class='bildirim basari'>Kayıt başarılı! Girişe yönlendiriliyorsunuz...</div>";
        header("Refresh: 2; url=login.php");
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kayıt Ol | Portfolyo</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root { --bg-color: #f5f2eb; --text-dark: #1a1a1a; --accent-gold: #cfa772; --btn-dark: #1c1b19; --border-color: #e5e0d3; }
        body { font-family: 'Inter', sans-serif; background-color: var(--bg-color); display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .auth-card { background: white; padding: 50px 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); width: 100%; max-width: 400px; text-align: center; border: 1px solid var(--border-color); }
        h2 { font-family: 'Playfair Display', serif; font-size: 32px; color: var(--text-dark); margin-bottom: 10px; }
        p { color: #666; font-size: 14px; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; text-align: left; }
        label { display: block; font-size: 13px; font-weight: 600; color: var(--text-dark); margin-bottom: 8px; text-transform: uppercase; }
        input { width: 100%; padding: 15px; border: 1px solid var(--border-color); border-radius: 10px; font-family: 'Inter'; font-size: 15px; outline: none; box-sizing: border-box; }
        input:focus { border-color: var(--accent-gold); }
        button { width: 100%; background: var(--btn-dark); color: white; padding: 16px; border: none; border-radius: 30px; font-weight: 600; font-size: 16px; cursor: pointer; margin-top: 10px; }
        .alt-link { display: inline-block; margin-top: 20px; color: #666; text-decoration: none; font-size: 14px; }
        .bildirim { padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; font-weight: 500; }
        .hata { background: #fdf2f2; color: #d9534f; border: 1px solid #fadcdc; }
        .basari { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
    </style>
</head>
<body>
    <div class="auth-card">
        <h2>Aramıza Katıl</h2>
        <p>Hemen yeni bir hesap oluştur.</p>
        <?= $mesaj ?>
        <form method="POST" action="">
            <div class="form-group">
                <label>Kullanıcı Adı</label>
                <input type="text" name="username" placeholder="Örn: esma" required>
            </div>
            <div class="form-group">
                <label>Şifre</label>
                <input type="password" name="password" placeholder="Şifreni belirle" required>
            </div>
            <button type="submit" name="kayit_ol">Kayıt Ol</button>
        </form>
        <a href="login.php" class="alt-link">Zaten hesabın var mı? Giriş yap</a><br>
        <a href="index.html" class="alt-link" style="font-size: 12px; color: #999;">← Ana Sayfaya Dön</a>
    </div>
</body>
</html>