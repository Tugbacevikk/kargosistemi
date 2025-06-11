<?php
session_start();
include("db.php");

if (!isset($_SESSION["kullanici_id"])) {
    header("Location: giris.php");
    exit();
}

if (isset($_GET["id"])) {
    $kargo_id = intval($_GET["id"]);
    $kullanici_id = $_SESSION["kullanici_id"];

    // Kargo gerçekten bu kullanıcıya mı ait?
    $kontrol = $baglanti->prepare("SELECT * FROM kargolar WHERE id = ? AND kullanici_id = ?");
    $kontrol->bind_param("ii", $kargo_id, $kullanici_id);
    $kontrol->execute();
    $sonuc = $kontrol->get_result();

    if ($sonuc->num_rows > 0) {
        // Sil
        $sil = $baglanti->prepare("DELETE FROM kargolar WHERE id = ?");
        $sil->bind_param("i", $kargo_id);
        $sil->execute();
    }
}

header("Location: dashboard.php?sayfa=kargolar");
exit();
?>
