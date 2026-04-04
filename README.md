# 🚀 Esma Raydemir - Web Portfolyo ve Yönetim Paneli

Bu proje, İnönü Üniversitesi Bilgisayar Programcılığı bölümü 1. sınıf vize ödevi kapsamında geliştirilmiş kişisel bir web portfolyosu ve dinamik yönetim panelidir. 

Tasarımda modern, minimalist ve premium (krem, altın sarısı, koyu gri) renk paletleri kullanılmış olup; arka planda veritabanı (SQL) gerektirmeyen, **PHP Session** mantığına dayalı çalışan bir üyelik ve veri yönetim sistemi kurgulanmıştır.

## 🛠️ Projede Kullanılan Teknolojiler
* **Frontend:** HTML5, CSS3 (Modern Flexbox/Grid mimarisi)
* **Backend:** PHP 8 (Session Yönetimi)
* **Veritabanı:** Local PHP Sessions (SQL kullanılmamıştır)

## ✨ Öne Çıkan Özellikler

- **Modern Portfolyo Arayüzü:** Hakkımda, hobilerim ve iletişim bölümlerini barındıran şık, tek sayfa (one-page) yapısı.
- **Kullanıcı Kimlik Doğrulama:** Tarayıcı oturumu bazlı (Session), hatalı girişleri denetleyen güvenli kayıt ol ve giriş yap modülü.
- **Dinamik Yönetim Paneli (Dashboard):** Sadece giriş yapan kullanıcıların erişebildiği özel alan.
- **Günlük Görevler (To-Do List):** Görev ekleme, listeleme ve tekli silme yeteneğine sahip görev yöneticisi.
- **Sinema Arşivi:** Dizi ve Filmleri izlenme durumuna göre kategorize ederek tablo halinde sunan kayıt modülü.
- **Hata Önleyici Sigorta Mimarisi:** Oturum verilerinin bozulmasına karşı otomatik format dönüştürücü algoritma.

## ⚙️ Kurulum ve Çalıştırma (Geliştiriciler İçin)

Projenin içinde PHP kodları bulunduğu için doğrudan tarayıcıda çalıştırılamaz. Yerel bir sunucuya ihtiyaç vardır.

1. Bilgisayarınıza **WampServer** veya **XAMPP** kurun.
2. Yerel sunucu motorunu (Apache) başlatın.
3. Bu depodaki tüm dosyaları `www` (WampServer) klasörünün içerisine aktarın.
4. Tarayıcınızın adres çubuğuna `http://localhost/klasor_adiniz/index.php` yazarak projeyi görüntüleyin.

---
