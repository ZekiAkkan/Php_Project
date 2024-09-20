<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Ürün Sepeti</title>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Zek Computer</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="anasayfa.php">Anasayfa</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Sepet</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Sepet İçeriği -->
    <section class="container my-5">
        <h2 class="text-center mb-4">Ürün Sepeti</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Ürün Adı</th>
                    <th scope="col">Fiyat</th>
                    <th scope="col">Adet</th>
                    <th scope="col">Toplam Fiyat</th>
                    <th scope="col">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Veritabanından ürün sepetini çek
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "teknolojidb";

                $conn = new mysqli($servername, $username, $password, $dbname);

                // Veritabanı bağlantısının başarısız olup olmadığını kontrol et
                if ($conn->connect_error) {
                    die("Bağlantı hatası: " . $conn->connect_error);
                }

                $kullaniciID = 1; // Kullanıcı kimliği örnek olarak 1 olarak varsayıldı, kullanıcı oturum açtığında burası değiştirilmelidir.

                $sql = "SELECT s.id, u.urunadi, u.urunfiyat, s.urunadet, (u.urunfiyat * s.urunadet) as toplamFiyat 
                        FROM urunsepet s
                        JOIN urunler u ON s.urunid = u.id
                        WHERE s.kullaniciID = '$kullaniciID'";
                $result = $conn->query($sql);

                // Sorgunun başarısız olup olmadığını ve sonuç kümesinin boş olup olmadığını kontrol et
                if (!$result) {
                    die("Sorgu hatası: " . $conn->error);
                }

                $totalTutar = 0; // Toplam tutarı başlat

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <th scope="row"></th>
                            <td><?php echo $row["urunadi"]; ?></td>
                            <td><?php echo $row["urunfiyat"]; ?> TL</td>
                            <td>
                                <input type="number" min="1" value="<?php echo $row["urunadet"]; ?>" onchange="adetiGuncelle(<?php echo $row["id"]; ?>, this)">
                            </td>
                            <td><?php echo $row["toplamFiyat"]; ?> TL</td>
                            <td>
                                <button class="btn btn-danger" onclick="urunuSil(<?php echo $row["id"]; ?>)">Sil</button>
                            </td>
                        </tr>
                        <?php
                        $totalTutar += $row["toplamFiyat"]; // Toplam tutarı güncelle
                    }
                } else {
                    echo "<tr><td colspan='6'>Sepetinizde ürün bulunmamaktadır.</td></tr>";
                }

                // Veritabanı bağlantısını kapat
                $conn->close();
                ?>
                <!-- Toplam tutarı göster -->
                <tr>
                    <td colspan="4" class="text-right"><strong>Toplam Tutar</strong></td>
                    <td colspan="2"><?php echo $totalTutar; ?> TL</td>
                </tr>
            </tbody>
        </table>
    </section>

    <?php include('footer.php'); ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JavaScript Kodları -->
    <script>
        function adetiGuncelle(urunID, input) {
            var yeniAdet = parseInt(input.value, 10);

            if (yeniAdet >= 1) {
                // Adet güncelleme AJAX işlemi
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        location.reload(); // Sayfayı yeniden yükle
                    }
                };
                xhr.open("POST", "urunsepet_ajax.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("urunID=" + urunID + "&adet=" + yeniAdet + "&action=adetGuncelle");
            } else {
                alert('Geçerli bir adet girin.');
                input.value = 1; // Geçerli olmayan bir adet girişi durumunda varsayılan değeri 1 olarak ayarlayabilirsiniz.
            }
        }

        function urunuSil(urunID) {
            // Ürünü silme AJAX işlemi
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    location.reload(); // Sayfayı yeniden yükle
                }
            };
            xhr.open("POST", "urunsepet_ajax.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("urunID=" + urunID + "&action=sil");
        }
    </script>

</body>

</html>
