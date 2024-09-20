<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Responsive Teknoloji Mağazası</title>
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
                <li class="nav-item active">
                    <a class="nav-link" href="anasayfa.php">Anasayfa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="urunsepet.php">Sepet</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Header -->
    <header class="header-text bg-dark">
        <h1>TEKNOLOJİ MAĞAZASI</h1>
    </header>

    <!-- Ürünler -->
    <section class="container my-5">
        <h2 class="text-center mb-4">Ürünlerimiz</h2>
        <div class="row">
            <?php
            // Veritabanından ürünleri çek
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "teknolojidb";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Bağlantı hatası: " . $conn->connect_error);
            }

            $sql = "SELECT id, urunadi, urunbilgi, urunfiyat, urunresim FROM urunler";
            $result = $conn->query($sql);
            /*Kart oluşumu*/
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="<?php echo $row["urunresim"]; ?>" class="card-img-top" alt="<?php echo $row["urunadi"]; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row["urunadi"]; ?></h5>
                                <p class="card-text"><?php echo $row["urunbilgi"]; ?></p>
                                <p class="card-text">Fiyat: <?php echo $row["urunfiyat"]; ?> TL</p>
                                <a href="#" class="btn btn-primary" onclick="sepeteEkle(<?php echo $row["id"]; ?>)">Satın Al</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "Ürün bulunamadı.";
            }

            $conn->close();
            ?>
        </div>
    </section>

    <?php include('footer.php'); ?>
    <script src="main.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
