<?php
session_start();
include("db.php");

if (!isset($_SESSION["kullanici_id"])) {
    header("Location: giris.php");
    exit();
}

$kullanici_id = $_SESSION["kullanici_id"];

if (!isset($_GET["id"])) {
    header("Location: dashboard.php?sayfa=kargolar");
    exit();
}

$kargo_id = intval($_GET["id"]);

// Kargo gerçekten bu kullanıcıya mı ait?
$sorgu = $baglanti->prepare("SELECT * FROM kargolar WHERE id = ? AND kullanici_id = ?");
$sorgu->bind_param("ii", $kargo_id, $kullanici_id);
$sorgu->execute();
$sonuc = $sorgu->get_result();

if ($sonuc->num_rows != 1) {
    header("Location: dashboard.php?sayfa=kargolar");
    exit();
}

$kargo = $sonuc->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $alici_adi = $_POST["alici_adi"];
    $adres = $_POST["adres"];
    $tarih = $_POST["tarih"];
    $durum = $_POST["durum"];
    $aciklama = $_POST["aciklama"];

    $guncelle = $baglanti->prepare("UPDATE kargolar SET alici_adi=?, adres=?, tarih=?, durum=?, aciklama=? WHERE id=? AND kullanici_id=?");
    $guncelle->bind_param("ssssssi", $alici_adi, $adres, $tarih, $durum, $aciklama, $kargo_id, $kullanici_id);
    $guncelle->execute();

    header("Location: dashboard.php?sayfa=kargolar");
    exit();
}
?>

<h4>Kargo Bilgilerini Güncelle</h4>
<form method="post">
    <div class="mb-3">
        <label>Alıcı Adı:</label>
        <input type="text" name="alici_adi" class="form-control" value="<?= htmlspecialchars($kargo['alici_adi']) ?>" required>
    </div>
    <div class="mb-3">
        <label>Adres:</label>
        <textarea name="adres" class="form-control" required><?= htmlspecialchars($kargo['adres']) ?></textarea>
    </div>
    <div class="mb-3">
        <label>Gönderim Tarihi:</label>
        <input type="date" name="tarih" class="form-control" value="<?= $kargo['tarih'] ?>" required>
    </div>
    <div class="mb-3">
        <label>Durum:</label>
        <select name="durum" class="form-control" required>
            <option value="Bekliyor" <?= $kargo['durum'] == 'Bekliyor' ? 'selected' : '' ?>>Bekliyor</option>
            <option value="Yolda" <?= $kargo['durum'] == 'Yolda' ? 'selected' : '' ?>>Yolda</option>
            <option value="Teslim Edildi" <?= $kargo['durum'] == 'Teslim Edildi' ? 'selected' : '' ?>>Teslim Edildi</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Açıklama:</label>
        <textarea name="aciklama" class="form-control" required><?= htmlspecialchars($kargo['aciklama']) ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Güncelle</button>
    <a href="dashboard.php?sayfa=kargolar" class="btn btn-secondary">İptal</a>
</form>
