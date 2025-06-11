<?php
$kullanici_id = $_SESSION["kullanici_id"];

// Kullanıcının tüm kargolarını çek
$sorgu = $baglanti->prepare("SELECT * FROM kargolar WHERE kullanici_id = ? ORDER BY tarih DESC");
$sorgu->bind_param("i", $kullanici_id);
$sorgu->execute();
$sonuc = $sorgu->get_result();
?>

<h4>Kargolarım</h4>

<?php if ($sonuc->num_rows > 0): ?>
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Gönderi Kodu</th>
                <th>Alıcı</th>
                <th>Adres</th>
                <th>Tarih</th>
                <th>Durum</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($kargo = $sonuc->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($kargo["gonderi_kodu"]) ?></td>
                    <td><?= htmlspecialchars($kargo["alici_adi"]) ?></td>
                    <td><?= htmlspecialchars($kargo["adres"]) ?></td>
                    <td><?= htmlspecialchars($kargo["tarih"]) ?></td>
                    <td>
                        <?php
                        $renk = "secondary";
                        if ($kargo["durum"] == "Bekliyor") $renk = "warning";
                        elseif ($kargo["durum"] == "Yolda") $renk = "info";
                        elseif ($kargo["durum"] == "Teslim Edildi") $renk = "success";
                        ?>
                        <span class="badge bg-<?= $renk ?>"><?= $kargo["durum"] ?></span>
                    </td>
                    <td>
                        <a href="kargo_duzenle.php?id=<?= $kargo['id'] ?>" class="btn btn-sm btn-outline-primary">Düzenle</a>
                        <a href="kargo_sil.php?id=<?= $kargo['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="alert alert-info">Henüz hiç kargo kaydınız yok.</div>
<?php endif; ?>
