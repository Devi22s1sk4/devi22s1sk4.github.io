<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "crud_makanan"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama_resep = $_POST['nama_resep'];
    $bahan = $_POST['bahan'];
    $langkah = $_POST['langkah'];
    $gambar = $_FILES['gambar']['name'];
    $target_file = "";

    if ($gambar) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($gambar);
        if (!move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            echo "<script>alert('Upload gambar gagal. Silakan coba lagi.');</script>";
        }
    } else {
        $target_file = $_POST['existing_image']; 
    }

    $query = $conn->prepare("UPDATE resep_db SET nama_resep=?, bahan=?, langkah=?, gambar=? WHERE id=?");
    $query->bind_param("ssssi", $nama_resep, $bahan, $langkah, $target_file, $id);
    
    if ($query->execute()) {
        echo "<script>alert('Resep berhasil diperbarui!'); window.location.href='webresep_baru.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat memperbarui resep. Silakan coba lagi.');</script>";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = $conn->prepare("SELECT * FROM resep_db WHERE id=?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resep</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> 
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: url('bg2.jpg');
            margin: 0;
            padding: 20px;
            color: #333;
        } 
        h1 {
            color: #003366;
            margin-bottom: 20px;
            text-align: center;
        }
        .edit-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px; 
            margin: auto; 
        }
        .edit-form label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        .edit-form input, .edit-form textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .edit-form input[type="submit"], .edit-form button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 15px;
            padding: 10px;
            font-size: 16px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .edit-form input[type="submit"]:hover, .edit-form button:hover {
            background-color: #0056b3;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
        .footer a {
            color: white;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .footer a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h1>Edit Resep</h1>

<div class="edit-form">
    <form method="POST" enctype="multipart/form-data" id="formEdit">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="hidden" name="existing_image" value="<?php echo $row['gambar']; ?>">
        
        <label>Nama Resep:</label>
        <input type="text" name="nama_resep" value="<?php echo $row['nama_resep']; ?>" required>

        <label>Bahan:</label>
        <textarea name="bahan" required><?php echo $row['bahan']; ?></textarea>

        <label>Cara Membuat:</label>
        <textarea name="langkah" required><?php echo $row['langkah']; ?></textarea>

        <input type="submit" name="edit" value="Perbarui Resep">
        <button onclick="window.location.href='webresep_baru.php'" type="button"><i class="fas fa-times"></i> Batal</button>
    </form>
</div>

<div class="footer">
    <a href="index.html"><i class="fas fa-home"></i> Kembali ke Halaman Utama</a>
</div>

</body>
</html>

<?php
$conn->close();
?>
