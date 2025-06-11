<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eski_sifre = $_POST["eski_sifre"];
    $yeni_sifre = $_POST["yeni_sifre"];
    $yeni_sifre_tekrar = $_POST["yeni_sifre_tekrar"];
    $kullanici_id = $_SESSION["kullanici_id"];

    $sorgu = $baglanti->prepare("SELECT sifre FROM kullanicilar WHERE id = ?");
    $sorgu->bind_param("i", $kullanici_id);
    $sorgu->execute();
    $sonuc = $sorgu->get_result();

    if ($sonuc->num_rows === 1) {
        $row = $sonuc->fetch_assoc();
        if (password_verify($eski_sifre, $row["sifre"])) {
            if ($yeni_sifre === $yeni_sifre_tekrar) {
                $yeni_hashli = password_hash($yeni_sifre, PASSWORD_DEFAULT);
                $guncelle = $baglanti->prepare("UPDATE kullanicilar SET sifre = ? WHERE id = ?");
                $guncelle->bind_param("si", $yeni_hashli, $kullanici_id);
                $guncelle->execute();
                echo '<div class="alert alert-success">Şifre başarıyla güncellendi.</div>';
            } else {
                echo '<div class="alert alert-warning">Yeni şifreler eşleşmiyor.</div>';
            }
        } else {
            echo '<div class="alert alert-danger">Eski şifreniz yanlış.</div>';
        }
    }
}
?>

<h4>🔐 Şifre Değiştir</h4>
<form method="post">
    <div class="mb-3">
        <label>Eski Şifre:</label>
        <input type="password" name="eski_sifre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Yeni Şifre:</label>
        <input type="password" name="yeni_sifre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Yeni Şifre (Tekrar):</label>
        <input type="password" name="yeni_sifre_tekrar" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Şifreyi Güncelle</button>
</form>
