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

Kullanıcı girişi ve form işlemleri temel düzeyde XSS korumalıdır (htmlspecialchars()).





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


 
## Bağlantılar
Canlı Demo 

Github Reposu (Kendi kullanıcı adınıza göre değiştirin)

Tanıtım Videosu
