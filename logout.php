<?php
session_start();
session_unset(); // Tüm session değişkenlerini temizle
session_destroy(); // Oturumu tamamen yok et

// Çıkış yaptıktan sonra saf HTML olan ana sayfaya yönlendir
header("Location: index.html");
exit;
?>