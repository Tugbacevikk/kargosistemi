<?php
session_start();
include("db.php");

if (!isset($_SESSION["kullanici_id"])) {
    header("Location: giris.php");
    exit();
}

$kullanici_id = $_SESSION["kullanici_id"];
$kullanici_adi = $_SESSION["kullanici_adi"];
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - kargo_sistemi</title>
    <meta http-equiv="refresh" content="300"> <!-- 5 dakikada bir yenileme -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('img/arka-plan.jpg'); /* veya dashboard-arka.jpg */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .sayfa {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }
        .nav-link {
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sol Menü -->
        <div class="col-md-3 bg-light p-3">
            <div class="d-flex align-items-center mb-3">
                <img src="img/kamyonet-logo.png" alt="Logo" width="40" height="40" class="me-2">
                <h5 class="text-primary mb-0">Hoş geldiniz, <?= htmlspecialchars($kullanici_adi) ?></h5>
            </div>
            <ul class="nav flex-column mt-3">
                <li class="nav-item"><a href="dashboard.php?sayfa=anasayfa" class="nav-link">🏠 Anasayfa</a></li>
                <li class="nav-item"><a href="dashboard.php?sayfa=kargolar" class="nav-link">📦 Kargolarım</a></li>
                <li class="nav-item"><a href="dashboard.php?sayfa=bekliyor" class="nav-link">⏳ Bekleyenler</a></li>
                <li class="nav-item"><a href="dashboard.php?sayfa=yolda" class="nav-link">🚚 Yolda</a></li>
                <li class="nav-item"><a href="dashboard.php?sayfa=teslim" class="nav-link">✅ Teslim Edilen</a></li>
                <li class="nav-item"><a href="dashboard.php?sayfa=ekle" class="nav-link">➕ Yeni Kargo Oluştur</a></li>
                <li class="nav-item"><a href="dashboard.php?sayfa=sifre" class="nav-link">🔐 Şifre Değiştir</a></li>
                <li class="nav-item"><a href="dashboard.php?sayfa=iletisim" class="nav-link">📞 İletişim</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link text-danger">🚪 Çıkış</a></li>
            </ul>
        </div>

        <!-- İçerik Alanı -->
        <div class="col-md-9">
            <div class="sayfa">
                <?php
                if (isset($_GET["sayfa"])) {
                    $sayfa = $_GET["sayfa"];
                    if ($sayfa == "kargolar") {
                        include("kargolar_listesi.php");
                    } elseif ($sayfa == "bekliyor") {
                        include("kargolar_bekliyor.php");
                    } elseif ($sayfa == "yolda") {
                        include("kargolar_yolda.php");
                    } elseif ($sayfa == "teslim") {
                        include("kargolar_teslim.php");
                    } elseif ($sayfa == "ekle") {
                        include("kargo_ekle_form.php");
                    } elseif ($sayfa == "sifre") {
                        include("sifre_degistir.php");
                    } elseif ($sayfa == "iletisim") {
                        echo "<h4>İletişim</h4><p>Destek için: <strong>destek@kargosistemi.com</strong></p>";
                    } elseif ($sayfa == "anasayfa") {
                        echo "<h4>Tuğba Kargo Sistemine Hoş Geldiniz!</h4><p>Firmamız 2025 yılında WEB tabanlı programlama dersi için kurulmuştur  .</p>";
                    } else {
                        echo "<div class='alert alert-warning'>Sayfa bulunamadı.</div>";
                    }
                } else {
                    echo "<h4>Tuğba Kargo Sistemine Hoş Geldiniz!</h4><p>Panelden kargo işlemlerinizi yönetebilirsiniz.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>

