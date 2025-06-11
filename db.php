<?php
$baglanti = new mysqli(
    "localhost",
    "dbusr22360859074",
    "qE3ZdJB7z6Um",
    "dbstorage22360859074"
);

$baglanti->set_charset("utf8");

if ($baglanti->connect_error) {
    die(" Veritabanı bağlantı hatası: " . $baglanti->connect_error);
} else {
    echo "✅ Veritabanı bağlantısı başarılı!";
}
?>
