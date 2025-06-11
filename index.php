<?php
session_start();
include("db.php");

$hata = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $sifre = $_POST["sifre"];

    $sorgu = $baglanti->prepare("SELECT * FROM kullanicilar WHERE email = ?");
    $sorgu->bind_param("s", $email);
    $sorgu->execute();
    $sonuc = $sorgu->get_result();

    if ($sonuc->num_rows == 1) {
        $kullanici = $sonuc->fetch_assoc();
        if (password_verify($sifre, $kullanici["sifre"])) {
            $_SESSION["kullanici_id"] = $kullanici["id"];
            $_SESSION["kullanici_adi"] = $kullanici["adsoyad"];
            header("Location: dashboard.php");
            exit();
        } else {
            $hata = "Şifre hatalı.";
        }
    } else {
        $hata = "Bu e-posta adresine ait kullanıcı bulunamadı.";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap - Kargo Sistemi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('img/arka-plan.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .giris-kutu {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            max-width: 400px;
            margin: 80px auto;
        }
    </style>
</head>
<body>
    <div class="giris-kutu">
        <h4 class="text-center mb-4">Giriş Yap</h4>
        <?php if (!empty($hata)) { echo '<div class="alert alert-danger">'.$hata.'</div>'; } ?>
        <form method="post">
            <div class="mb-3">
                <label for="email" class="form-label">E-posta:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label for="sifre" class="form-label">Şifre:</label>
                <input type="password" class="form-control" name="sifre" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Giriş Yap</button>
            <div class="mt-3 text-center">
                <a href="kayit.php">Hesabınız yok mu? Kayıt olun</a>
            </div>
        </form>
    </div>
</body>
</html>
