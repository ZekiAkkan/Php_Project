<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "teknolojidb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    $urunID = $_POST["urunID"];

    

    if (isset($_POST["action"])) {
        $action = $_POST["action"];

        if ($action == "ekle") {
            

            
            $kullaniciID = 1; 
            $insertQuery = "INSERT INTO urunsepet (kullaniciID, urunid, urunadet) VALUES ('$kullaniciID', '$urunID', '1')";
            if ($conn->query($insertQuery) === TRUE) {
                echo "Ürün başarıyla sepete eklendi.";
            } else {
                echo "Hata: " . $conn->error;
            }
        } elseif ($action == "sil") {
            
            $deleteQuery = "DELETE FROM urunsepet WHERE id = '$urunID'";
            if ($conn->query($deleteQuery) === TRUE) {
                echo "Ürün başarıyla silindi.";
            } else {
                echo "Hata: " . $conn->error;
            }
        } elseif ($action == "adetGuncelle") {
            
            $yeniAdet = $_POST["adet"];
            $updateQuery = "UPDATE urunsepet SET urunadet = '$yeniAdet' WHERE id = '$urunID'";
            if ($conn->query($updateQuery) === TRUE) {
                echo "Adet başarıyla güncellendi.";
            } else {
                echo "Hata: " . $conn->error;
            }
        }
    }

    // Veritabanı bağlantınızı kapatın
    $conn->close();
}
?>
