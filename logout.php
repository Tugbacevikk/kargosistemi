<?php
session_start();

// Oturum verilerini temizle
session_unset();
session_destroy();

// Önbelleği temizle (güvenlik için)
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jan 2000 00:00:00 GMT");

// Giriş sayfasına yönlendir
header("Location: index.php"); // Eğer giriş dosyanın adı giris.php ise burayı giris.php yap
exit();
?>
