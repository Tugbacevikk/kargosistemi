<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $alici_adi = $_POST["alici_adi"];
    $adres = $_POST["adres"];
    $aciklama = $_POST["aciklama"];
    $tarih = $_POST["tarih"];
    $durum = $_POST["durum"];
    $kullanici_id = $_SESSION["kullanici_id"];

    // Otomatik gönderi kodu oluştur (örnek: GK-20250605-XYZ)
    $gonderi_kodu = "GK-" . date("Ymd") . "-" . substr(str_shuffle("0123456789"), 0, 5);

    $ekle = $baglanti->prepare("INSERT INTO kargolar (kullanici_id, alici_adi, adres, gonderi_kodu, tarih, durum, aciklama) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $ekle->bind_param("issssss", $kullanici_id, $alici_adi, $adres, $gonderi_kodu, $tarih, $durum, $aciklama);
    $ekle->execute();

    // PRG yöntemi: Tekrar gönderimi engeller
    header("Location: dashboard.php?sayfa=kargolar");
    exit();
}
?>

<h4>Yeni Kargo Oluştur</h4>
<form method="post">
    <div class="mb-3">
        <label>Alıcı Adı:</label>
        <input type="text" name="alici_adi" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Adres:</label>
        <textarea name="adres" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label>Açıklama:</label>
        <textarea name="aciklama" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label>Gönderim Tarihi:</label>
        <input type="date" name="tarih" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Durum:</label>
        <select name="durum" class="form-control" required>
            <option value="Bekliyor">Bekliyor</option>
            <option value="Yolda">Yolda</option>
            <option value="Teslim Edildi">Teslim Edildi</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Kaydet</button>
</form>
