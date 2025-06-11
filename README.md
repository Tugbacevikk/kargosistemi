# kargosistemi
Bu proje, Web Tabanlı Programlama dersi kapsamında PHP, MySQL ve Bootstrap kullanılarak geliştirilmiş bir kargo takip sistemidir. Uygulama, kullanıcıların kayıt olabildiği, oturum açabildiği ve kendilerine ait kargo verilerini yönetebildiği bir sistem sunar.

## Proje Özeti
Sistem kullanıcılarına aşağıdaki işlevleri sunmaktadır:

Kayıt olma ve giriş yapma 

Oturum kontrolü 

Kargo oluşturma 

Kargo listesini görme 

Kargo bilgilerini güncelleme 

Kargo silme 

Kargo durumuna göre filtreleme (Bekliyor, Yolda, Teslim Edildi)

Şifre değiştirme özelliği

18 yaşından küçüklerin kayıt olmasını engelleyen doğum tarihi kontrolü

Canlıda çalışan sistem (sunucuya entegre edilmiştir)

## Kullanılan Teknolojiler
Backend: PHP (yalın PHP, herhangi bir framework kullanılmamıştır)

Veritabanı: MySQL

Frontend: HTML, Bootstrap 5

Sunucu: Apache (Ubuntu Hosting)

Veritabanı Yapısı
Projede kullanılan ana tablo:

kullanicilar

id (PRIMARY, AUTO_INCREMENT)

adsoyad

email

sifre (hash’lenmiş)

dogum_tarihi

kargolar

id (PRIMARY, AUTO_INCREMENT)

ad

soyad

adres

tarih

durum (Bekliyor, Yolda, Teslim Edildi)

kullanici_id (Foreign Key)

## Güvenlik
Şifreler veritabanında hash’lenmiş olarak saklanmaktadır (password_hash).

Tüm oturum işlemleri session ile kontrol edilmektedir.

Veritabanı bağlantısı güvenli yapıdadır (mysqli + hata kontrolü).



## Kullanım
Giriş sayfasından kayıt olabilir veya mevcut bilgilerle oturum açabilirsiniz.

Oturum açtıktan sonra sol menüden kargo oluşturabilir, mevcut kargolarınızı görebilir veya filtreleyebilirsiniz.

Kargo durumlarını güncelleyebilir veya silebilirsiniz.

Şifrenizi dilediğiniz zaman değiştirebilirsiniz.

5 dakikada bir otomatik sayfa yenileme özelliği bulunmaktadır.

Projede .htaccess dosyası kullanılmamıştır.

Herhangi bir dış PHP frameworkü kullanılmamıştır.

Arayüz Bootstrap ile tasarlanmış olup sade ve kullanıcı dostudur.
## Projeden Ekran alıntıları
![Ekran görüntüsü 2025-06-11 215028](https://github.com/user-attachments/assets/412f23be-9881-4baa-b81e-c0746d0418fc)
![Ekran görüntüsü 2025-06-11 214445](https://github.com/user-attachments/assets/56b93d1b-1686-493d-a97b-e82cc3de6cb6)
![Ekran görüntüsü 2025-06-11 214246](https://github.com/user-attachments/assets/3ff94335-1221-492d-bebe-a7d6d08df279)


 
## Bağlantılar
Canlı Demo : http://95.130.171.20/~st22360859074/index.php


Github Reposu: https://github.com/Tugbacevikk/kargosistemi

Tanıtım Videosu: https://www.youtube.com/watch?v=2xdLaeaQX2Q
