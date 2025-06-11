<?php
$kullanici_id = $_SESSION["kullanici_id"];

$sorgu = $baglanti->prepare("SELECT * FROM kargolar WHERE kullanici_id = ? AND durum = 'Teslim Edildi' ORDER BY tarih DESC");
$sorgu->bind_param("i", $kullanici_id);
$sorgu->execute();
$sonuc = $sorgu->get_result();
?>

<h4>Teslim Edilen Kargolar</h4>

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
                    <td><span class="badge bg-success">Teslim Edildi</span></td>
                    <td>
                        <a href="kargo_duzenle.php?id=<?= $kargo['id'] ?>" class="btn btn-sm btn-outline-primary">Düzenle</a>
                        <a href="kargo_sil.php?id=<?= $kargo['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="alert alert-info">Teslim edilen kargo bulunamadı.</div>
<?php endif; ?>
