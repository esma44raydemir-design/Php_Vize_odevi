<?php
session_start();

// Oturum kontrolü
if (!isset($_SESSION['active_user'])) {
    header("Location: login.php");
    exit;
}

// Dizileri başlat (Eğer yoklarsa)
if (!isset($_SESSION['todo'])) { $_SESSION['todo'] = array(); }
if (!isset($_SESSION['sinema'])) { $_SESSION['sinema'] = array(); }

// 🛠️ HATA ÖNLEYİCİ SİGORTA KODU 🛠️
// Eğer tarayıcı hafızasında eski versiyondan kalan "düz yazı (string)" formatında notlar varsa,
// sayfanın çökmesini engellemek için onları anında yeni (dizili) formata dönüştürür.
foreach ($_SESSION['todo'] as $key => $item) {
    if (is_string($item)) {
        $_SESSION['todo'][$key] = array("metin" => $item, "tarih" => "Eski Kayıt");
    }
}

// Form İşlemleri
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // To-Do Ekleme
    if (isset($_POST['ekle_todo'])) {
        $gorev = trim($_POST['gorev']);
        if (!empty($gorev)) {
            $_SESSION['todo'][] = array("metin" => $gorev, "tarih" => date("H:i"));
        }
    }
    
    // Film/Dizi Ekleme
    if (isset($_POST['ekle_sinema'])) {
        $isim = trim($_POST['isim']);
        $tur = $_POST['tur']; // Film veya Dizi
        $durum = $_POST['durum']; // İzledim veya İzleyeceğim
        
        if (!empty($isim)) {
            $_SESSION['sinema'][] = array("isim" => $isim, "tur" => $tur, "durum" => $durum);
        }
    }
}

// Temizleme İşlemleri
if (isset($_GET['sil_todo'])) {
    unset($_SESSION['todo'][$_GET['sil_todo']]);
    header("Location: dashboard.php");
    exit;
}
if (isset($_GET['temizle_sinema'])) {
    $_SESSION['sinema'] = array();
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yönetim Paneli | Portfolyo</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root { --bg-color: #f5f2eb; --text-dark: #1a1a1a; --accent-gold: #cfa772; --btn-dark: #1c1b19; --border-color: #e5e0d3; }
        body { font-family: 'Inter', sans-serif; background: var(--bg-color); margin: 0; padding: 40px 5%; color: var(--text-dark); }
        
        .ust-bar { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid var(--border-color); padding-bottom: 20px; margin-bottom: 40px; }
        .ust-bar h1 { font-family: 'Playfair Display', serif; font-size: 32px; }
        .ust-bar h1 span { color: var(--accent-gold); }
        .btn-cikis { background: #d9534f; color: white; padding: 10px 22px; border-radius: 30px; text-decoration: none; font-weight: 600; font-size: 14px; transition: 0.3s; }
        .btn-cikis:hover { background: #c9302c; }
        
        /* Yatay Bölüm Yapısı */
        .bolum { display: flex; gap: 40px; background: white; padding: 35px; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.02); border: 1px solid var(--border-color); margin-bottom: 35px; }
        .form-tarafi { flex: 1; border-right: 1px dashed var(--border-color); padding-right: 40px; }
        .liste-tarafi { flex: 2; }
        
        h2 { font-family: 'Playfair Display', serif; font-size: 26px; margin-bottom: 25px; color: var(--accent-gold); }
        
        label { display: block; font-size: 12px; font-weight: 700; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px; color: #888; }
        input, select { width: 100%; padding: 14px; margin-bottom: 20px; border: 1px solid var(--border-color); border-radius: 10px; font-family: 'Inter'; outline: none; background: #fafafa; }
        input:focus, select:focus { border-color: var(--accent-gold); background: #fff; }
        
        .btn-ekle { width: 100%; background: var(--btn-dark); color: white; padding: 15px; border: none; border-radius: 30px; font-weight: 600; cursor: pointer; transition: 0.3s; }
        .btn-ekle:hover { background: var(--accent-gold); transform: translateY(-2px); }

        /* To-Do Tasarımı */
        .todo-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px; }
        .todo-item { background: #fdfcf8; padding: 15px; border-radius: 12px; border-left: 4px solid var(--accent-gold); position: relative; box-shadow: 0 4px 6px rgba(0,0,0,0.02); }
        .todo-item p { font-size: 14px; font-weight: 500; margin-bottom: 5px; padding-right: 15px;}
        .todo-item span { font-size: 11px; color: #aaa; }
        .btn-sil { position: absolute; top: 10px; right: 10px; text-decoration: none; color: #ccc; font-size: 20px; font-weight: bold; line-height: 1;}
        .btn-sil:hover { color: #d9534f; }

        /* Sinema Tablo Tasarımı */
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; padding: 15px; border-bottom: 2px solid var(--bg-color); font-size: 14px; color: #888; text-transform: uppercase; }
        td { padding: 15px; border-bottom: 1px solid var(--border-color); font-size: 15px; font-weight: 500; }
        .etiket { padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; }
        .film { background: #eef2ff; color: #4338ca; }
        .dizi { background: #fef2f2; color: #b91c1c; }
        .izlendi { color: #16a34a; }
        .izlenecek { color: var(--accent-gold); }

        .bos-durum { text-align: center; padding: 40px; color: #bbb; font-style: italic; }
        .temizle-link { display: inline-block; float: right; margin-top: 20px; color: #d9534f; text-decoration: none; font-size: 13px; font-weight: 600; padding: 8px 15px; border: 1px solid #d9534f; border-radius: 20px; transition: 0.3s;}
        .temizle-link:hover { background: #d9534f; color: white;}
    </style>
</head>
<body>

    <div class="ust-bar">
        <h1>Hoş geldin, <span><?= htmlspecialchars($_SESSION['active_user']) ?></span></h1>
        <div>
            <a href="index.php" style="margin-right: 25px; text-decoration: none; color: var(--text-light); font-weight: 600;">← Ana Sayfa</a>
            <a href="logout.php" class="btn-cikis">Güvenli Çıkış</a>
        </div>
    </div>

    <div class="bolum">
        <div class="form-tarafi">
            <h2>Günlük Planım</h2>
            <form method="POST">
                <label>Yeni Not / Görev</label>
                <input type="text" name="gorev" placeholder="Bugün ne yapacaksın?" required>
                <button type="submit" name="ekle_todo" class="btn-ekle">Listeye Ekle</button>
            </form>
        </div>
        <div class="liste-tarafi">
            <div class="todo-grid">
                <?php if (empty($_SESSION['todo'])): ?>
                    <div class="bos-durum" style="grid-column: 1/-1;">Henüz bir plan eklemedin.</div>
                <?php else: ?>
                    <?php foreach ($_SESSION['todo'] as $index => $item): ?>
                        <div class="todo-item">
                            <a href="dashboard.php?sil_todo=<?= $index ?>" class="btn-sil" title="Görevi Sil">×</a>
                            <p><?= htmlspecialchars($item['metin']) ?></p>
                            <span>Eklendi: <?= $item['tarih'] ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <?php if (!empty($_SESSION['todo'])): ?>
                <div style="clear: both;"></div>
            <?php endif; ?>
        </div>
    </div>

    <div class="bolum">
        <div class="form-tarafi">
            <h2>Sinema Arşivi</h2>
            <form method="POST">
                <label>Film / Dizi Adı</label>
                <input type="text" name="isim" placeholder="Örn: Inception, Dark..." required>
                
                <label>Tür</label>
                <select name="tur">
                    <option value="Film">Film</option>
                    <option value="Dizi">Dizi</option>
                </select>

                <label>Durum</label>
                <select name="durum">
                    <option value="İzlenecek">İzlenecekler Listesine Ekle</option>
                    <option value="İzledim">İzlediklerime Ekle</option>
                </select>

                <button type="submit" name="ekle_sinema" class="btn-ekle">Arşive Kaydet</button>
            </form>
        </div>
        <div class="liste-tarafi">
            <?php if (empty($_SESSION['sinema'])): ?>
                <div class="bos-durum">Arşivin henüz boş görünüyor.</div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Yapım İsmi</th>
                            <th>Tür</th>
                            <th>Durum</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['sinema'] as $eser): ?>
                            <tr>
                                <td><?= htmlspecialchars($eser['isim']) ?></td>
                                <td><span class="etiket <?= strtolower($eser['tur']) == 'film' ? 'film' : 'dizi' ?>"><?= $eser['tur'] ?></span></td>
                                <td class="<?= $eser['durum'] == 'İzledim' ? 'izlendi' : 'izlenecek' ?>">
                                    <?= $eser['durum'] == 'İzledim' ? '✓ İzledim' : '⏲ İzlenecek' ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="dashboard.php?temizle_sinema=1" class="temizle-link">Tüm Arşivi Temizle</a>
                <div style="clear: both;"></div>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>