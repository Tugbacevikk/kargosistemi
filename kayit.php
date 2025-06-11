<?php
include("db.php");

$hata = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adsoyad = $_POST["adsoyad"];
    $email = $_POST["email"];
    $sifre = $_POST["sifre"];
    $dogum_tarihi = $_POST["dogum_tarihi"];

    $bugun = new DateTime();
    $dogum = new DateTime($dogum_tarihi);
    $yas = $bugun->diff($dogum)->y;

    if ($yas < 18) {
        $hata = "18 yaşından küçükler kayıt olamaz.";
    } else {
        $sifre_hashli = password_hash($sifre, PASSWORD_DEFAULT);

        $sorgu = $baglanti->prepare("SELECT * FROM kullanicilar WHERE email = ?");
        $sorgu->bind_param("s", $email);
        $sorgu->execute();
        $sonuc = $sorgu->get_result();

        if ($sonuc->num_rows > 0) {
            $hata = "Bu e-posta zaten kayıtlı.";
        } else {
            $ekle = $baglanti->prepare("INSERT INTO kullanicilar (adsoyad, email, sifre, dogum_tarihi) VALUES (?, ?, ?, ?)");
            $ekle->bind_param("ssss", $adsoyad, $email, $sifre_hashli, $dogum_tarihi);
            $ekle->execute();

            header("Location: index.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kayıt Ol - Kargo Sistemi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('img/arka-plan.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .kayit-kutu {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            max-width: 450px;
            margin: 80px auto;
        }
    </style>
</head>
<body>
    <div class="kayit-kutu">
        <h4 class="text-center mb-4">Kayıt Ol</h4>
        <?php if (!empty($hata)) { echo '<div class="alert alert-danger">'.$hata.'</div>'; } ?>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Ad Soyad:</label>
                <input type="text" name="adsoyad" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">E-posta:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Şifre:</label>
                <input type="password" name="sifre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Doğum Tarihi:</label>
                <input type="date" name="dogum_tarihi" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Kayıt Ol</button>
            <div class="mt-3 text-center">
                <a href="giris.php">Zaten hesabın var mı? Giriş yap</a>
            </div>
        </form>
    </div>
</body>
</html>
