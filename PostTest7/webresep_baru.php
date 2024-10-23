<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "crud_makanan"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = $conn->prepare("SELECT gambar FROM resep_db WHERE id=?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    $row = $result->fetch_assoc();
    $gambar = $row['gambar'];

    $query = $conn->prepare("DELETE FROM resep_db WHERE id=?");
    $query->bind_param("i", $id);
    
    if ($query->execute()) {
        if ($gambar && file_exists($gambar)) {
            unlink($gambar);
        }
        echo "<script>alert('Resep berhasil dihapus!'); window.location.href='webresep_baru.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menghapus resep. Silakan coba lagi.');</script>";
    }
}

$query = "SELECT * FROM resep_db";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Resep</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> 
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: url('bg3.jpg');
            margin: 0;
            padding: 20px;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #003366;
            margin-bottom: 20px;
        }
        .recipe-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 10px 0;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        a {
            text-decoration: none;
            margin-right: 10px;
            font-size: 16px; 
        }
        a.edit {
            color: blue;
        }
        a.delete {
            color: red;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            
        }
        .action-buttons i {
            margin-right: 5px; 
        }
    </style>
</head>
<body>

    <h1>Daftar Resep</h1>

    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="recipe-card">
                <h2><?php echo $row['nama_resep']; ?></h2>
                <img src="<?php echo $row['gambar']; ?>" alt="<?php echo $row['nama_resep']; ?>">
                <p><strong>Bahan:</strong></p>
                <p><?php echo nl2br($row['bahan']); ?></p>
                <p><strong>Cara Membuat:</strong></p>
                <p><?php echo nl2br($row['langkah']); ?></p>
                <div class="action-buttons">
                    <a href="webresep_baru.php?action=delete&id=<?php echo $row['id']; ?>" class="delete" onclick="return confirm('Apakah Anda yakin ingin menghapus resep ini?');">
                        <i class="fas fa-trash-alt"></i> Hapus
                    </a>
                    <a href="edit_resep.php?id=<?php echo $row['id']; ?>" class="edit">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Tidak ada resep yang ditemukan.</p>
    <?php endif; ?>

    <div class="footer">
<a href="index.html" style="color: white;"><strong>Kembali ke Halaman Utama</strong></a>
    </div>

</body>
</html>

<?php
$conn->close();
?>