<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "crud_makanan"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

function uploadImage($file) {
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    $check = getimagesize($file["tmp_name"]);
    if($check === false) {
        return ["success" => false, "message" => "File bukan gambar."];
    }
    
    if ($file["size"] > 5000000) {
        return ["success" => false, "message" => "Ukuran file terlalu besar."];
    }
    
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        return ["success" => false, "message" => "Hanya file JPG, JPEG, PNG & GIF yang diizinkan."];
    }
    
    $new_file_name = uniqid() . "." . $imageFileType;
    $target_file = $target_dir . $new_file_name;
    
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return ["success" => true, "file_path" => $target_file];
    } else {
        return ["success" => false, "message" => "Gagal mengupload file."];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah'])) {
    $nama_resep = $_POST['nama_resep'];
    $bahan = $_POST['bahan'];
    $langkah = $_POST['langkah'];
    $gambar = $_FILES['gambar'];
    
    $upload_result = uploadImage($gambar);
    if ($upload_result['success']) {
        $target_file = $upload_result['file_path'];
    } else {
        echo "<script>alert('Upload gambar gagal: " . $upload_result['message'] . "');</script>";
        $target_file = "uploads/default_image.jpg";
    }

    $query = $conn->prepare("INSERT INTO resep_db (nama_resep, bahan, langkah, gambar) VALUES (?, ?, ?, ?)");
    $query->bind_param("ssss", $nama_resep, $bahan, $langkah, $target_file);
    
    if ($query->execute()) {
        echo "<script>alert('Resep berhasil ditambahkan!'); window.location.href='webresep_baru.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menambahkan resep. Silakan coba lagi.');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Resep</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: url('bg1.jpg'); 
            background-size: cover; 
            margin: 0;
            padding: 20px;
            color: #333; 
        }
        h1 {
            text-align: center;
            color: #003366;
            margin-bottom: 20px;
        }
        form {
            background-color: rgba(255, 255, 255, 0.9); 
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin: auto;
            max-width: 400px;
        }
        .gambar-resep {
            max-width: 100%;
            height: auto;   
            display: block;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
            color: #003366;
        }
        input[type="text"], textarea, input[type="file"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 2px solid #003366; 
            border-radius: 5px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus, textarea:focus {
            border-color: #002244; 
            outline: none;
        }
        input[type="submit"] {
            background-color: #003366;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #002244;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #003366;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h1>Tambah Resep</h1>

    <form method="POST" enctype="multipart/form-data">
        <label>Nama Resep:</label>
        <input type="text" name="nama_resep" required>

        <label>Bahan:</label>
        <textarea name="bahan" rows="4" required></textarea>

        <label>Cara Membuat:</label>
        <textarea name="langkah" rows="4" required></textarea>

        <label>Upload Gambar:</label>
        <input type="file" name="gambar" required>

        <input type="submit" name="tambah" value="Tambah Resep">
    </form>

    <a href="webresep_baru.php"><strong>Kembali ke Daftar Resep</strong></a>

</body>
</html>
