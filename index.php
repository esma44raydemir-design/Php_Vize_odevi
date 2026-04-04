<?php session_start(); ?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esma Raydemir | Portfolyo</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #f5f2eb;
            --text-dark: #1a1a1a;
            --text-light: #666;
            --accent-gold: #cfa772;
            --btn-dark: #1c1b19;
            --border-color: #e5e0d3;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; background-color: var(--bg-color); color: var(--text-dark); line-height: 1.6; }
        
        /* Navbar */
        header { position: sticky; top: 0; background: rgba(245, 242, 235, 0.95); display: flex; justify-content: space-between; align-items: center; padding: 20px 5%; border-bottom: 1px solid var(--border-color); z-index: 100; }
        .logo { font-family: 'Playfair Display', serif; font-size: 24px; font-weight: 900; text-decoration: none; color: var(--text-dark); }
        .logo span { color: var(--accent-gold); }
        nav { display: flex; gap: 30px; }
        nav a { text-decoration: none; color: var(--text-light); font-weight: 500; text-transform: uppercase; font-size: 14px; letter-spacing: 1px; transition: 0.3s; }
        nav a:hover { color: var(--text-dark); }
        .auth-btns { display: flex; gap: 10px; }
        .btn-giris { background: var(--btn-dark); color: white; padding: 10px 20px; border-radius: 30px; text-decoration: none; font-weight: 600; font-size: 14px; transition: 0.3s; }
        .btn-giris:hover { background: var(--accent-gold); }
        .btn-kayit { background: transparent; color: var(--btn-dark); border: 1px solid var(--btn-dark); padding: 10px 20px; border-radius: 30px; text-decoration: none; font-weight: 600; font-size: 14px; transition: 0.3s; }
        .btn-kayit:hover { background: var(--btn-dark); color: white; }
        
        section { padding: 80px 5%; max-width: 1000px; margin: 0 auto; border-bottom: 1px solid var(--border-color); }
        h2.section-title { font-family: 'Playfair Display', serif; font-size: 40px; margin-bottom: 30px; color: var(--accent-gold); }
        
        /* Hero */
        .badge { display: inline-block; padding: 8px 16px; border: 1px solid var(--accent-gold); border-radius: 30px; color: var(--accent-gold); font-size: 12px; font-weight: 600; letter-spacing: 1px; margin-bottom: 20px; }
        h1 { font-family: 'Playfair Display', serif; font-size: 64px; line-height: 1.1; margin-bottom: 20px; }
        .subtitle { font-size: 20px; color: var(--text-light); margin-bottom: 30px; }
        
        /* Blog Cards */
        .blog-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; }
        .blog-card { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.02); transition: transform 0.3s; border: 1px solid transparent; }
        .blog-card:hover { transform: translateY(-5px); border-color: var(--accent-gold); }
        .blog-card h3 { font-family: 'Playfair Display', serif; font-size: 24px; margin-bottom: 10px; color: var(--text-dark); }
        .blog-card p { color: var(--text-light); font-size: 15px; }
        
        /* Contact */
        .contact-form input, .contact-form textarea { width: 100%; padding: 15px; margin-bottom: 15px; border: 1px solid var(--border-color); border-radius: 8px; font-family: 'Inter'; font-size: 15px; outline: none; }
        .contact-form input:focus, .contact-form textarea:focus { border-color: var(--accent-gold); }
        .contact-form button { background: var(--btn-dark); color: white; padding: 15px 30px; border: none; border-radius: 30px; font-weight: 600; cursor: pointer; transition: 0.3s; font-size: 16px; }
        .contact-form button:hover { background: var(--accent-gold); }
    </style>
</head>
<body>

    <header>
        <a href="#" class="logo">ER<span>.</span></a>
        <nav>
            <a href="#hero">Ana Sayfa</a>
            <a href="#hakkimda">Hakkımda</a>
            <a href="#blog">Blog</a>
            <a href="#iletisim">İletişim</a>
        </nav>
        <div class="auth-btns">
            <?php if(isset($_SESSION['active_user'])): ?>
                <a href="dashboard.php" class="btn-kayit">Panele Git</a>
                <a href="logout.php" class="btn-giris">Çıkış Yap</a>
            <?php else: ?>
                <a href="login.php" class="btn-giris">Giriş Yap</a>
                <a href="register.php" class="btn-kayit">Kayıt Ol</a>
            <?php endif; ?>
        </div>
    </header>

    <section id="hero" style="border: none;">
        <div class="badge">● BİLGİSAYAR PROGRAMCILIĞI · 1. SINIF</div>
        <h1>Merhaba, <br>ben Esma.</h1>
        <p class="subtitle">Veri, yapay zeka ve donanım dünyasında üretmeyi seven bir öğrenciyim. Bu site hem portfolyom hem de vize projem.</p>
    </section>

    <section id="hakkimda">
        <h2 class="section-title">Hikayem</h2>
        <p style="font-size: 18px; color: #666; margin-bottom: 15px;">İstanbul Silivri'de doğdum, aslen Malatyalıyım. 10 yaşımda Malatya'ya gelip Atatürk Ortaokulu'nda okurken bilgisayar dünyasına ilk adımlarımı attım. Lisede Yazılım Geliştirme bölümünü bitirdim.</p>
        <p style="font-size: 18px; color: #666;">Şu an İnönü Üniversitesi Bilgisayar Programcılığı 1. sınıf öğrencisiyim. Havacılık ve uzay alanına ve yapay zeka alanına büyük ilgi duyuyorum.</p>
    </section>

    <section id="blog">
        <h2 class="section-title">Blog & Hobilerim</h2>
        <div class="blog-grid">
            <div class="blog-card">
                <h3>🐈 Uzun Tüylü Dostlar</h3>
                <p>Kod yazarken bana eşlik eden, klavyemin üzerinde uyumayı seven iki harika kedim var. İsimleri badem ile duman. biri 5 biri 6 yaşında scotish ve british cinsi.</p>
            </div>
            <div class="blog-card">
                <h3>🎸 Müzik Molası</h3>
                <p>Algoritmalar zihnimi yorduğunda gitar çalmak, notalarla sıfırlanmamı sağlıyor.</p>
            </div>
            <div class="blog-card">
                <h3>🍳 Mutfak Algoritması</h3>
                <p>Yemek yapmak da kod yazmak gibi; doğru malzemeler ve sıralama harika sonuçlar verir.</p>
            </div>
            <div class="blog-card">
                <h3>🫂 Yakın Arkadaşım</h3>
                <p>En çok vakit geçirdiğim kişi, aynı zamanda en yakın arkadaşım olan kardeşim belinayım <3 . Onunla birlikte gülmek, film izlemek ve mahallede oturmak çok değerli.</p>
            </div>
        </div>
    </section>

    <section id="iletisim" style="border: none;">
        <h2 class="section-title">İletişime Geç</h2>
        <form class="contact-form" onsubmit="event.preventDefault(); alert('Mesaj iletildi!');">
            <a href="index.php" class="alt-link" style="font-size: 12px; color: #999;">← Ana Sayfaya Dön</a>
            <input type="text" placeholder="Adınız Soyadınız" required>
            <input type="email" placeholder="E-posta Adresiniz" required>
            <textarea rows="4" placeholder="Mesajınız" required></textarea>
            <button type="submit">Gönder</button>
        </form>
    </section>

</body>
</html>