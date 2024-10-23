<<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Resep Makanan Sehat</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Arial', sans-serif;
    }

    body {
      position: relative;
      color: #333; 
      transition: background-color 0.5s, color 0.5s; 
    }

    body::before {
      content: ''; 
      position: absolute; 
      top: 0; 
      left: 0;
      right: 0;
      bottom: 0;
      background-image: url('bg3.jpg'); 
      background-size: cover; 
      background-position: center; 
      background-attachment: fixed; 
      filter: blur(8px); 
      z-index: -1; 
    }

    body.dark-mode {
      background-color: #333;
      color: #fff;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
      text-align: center;
    }

    header {
      background-color: #003366;
      padding: 20px;
      color: white;
    }

    nav ul {
      list-style: none;
      display: flex;
      justify-content: center;
      gap: 20px;
      padding: 10px 0;
    }

    nav ul li a {
      text-decoration: none;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      transition: background-color 0.3s ease, color 0.3s ease;
      font-weight: bold;
      background-color: #004080; 
    }

    nav ul li a.active {
      background-color: #004080; 
      color: #ffffff; 
    }

    nav ul li a:hover {
      background-color: #004080; 
      color: #003366; 
    }

    footer {
      background-color: #003366;
      color: white;
      text-align: center;
      padding: 10px;
    }

    body.dark-mode footer {
      background-color: #222;
    }

    .food-grid {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
    }

    .food-card {
      background-color: rgba(255, 255, 255, 0.9);
      padding: 20px;
      margin: 10px;
      border-radius: 10px;
      width: 250px;
      text-align: center;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      cursor: pointer;
    }

    body.dark-mode .food-card {
      background-color: rgba(50, 50, 50, 0.9);
    }

    .food-card img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
    }

    #add-recipe {
      display: block;
      margin: 20px auto;
      padding: 10px 20px;
      background-color: #003366;
      color: white;
      border-radius: 5px;
      text-decoration: none;
      width: fit-content;
      transition: background-color 0.3s;
    }

    #add-recipe:hover {
      background-color: #001f4d;
    }

    .toggle-button {
      margin: 20px;
      padding: 10px 20px;
      background-color: #003366;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .toggle-button:hover {
      background-color: #001f4d;
    }

    main i {
      display: block;
      text-align: center;
      margin: 10px 0;
    }
  </style>
</head>

<body>
  <header>
    <div class="container">
      <h1>RESEP MAKANAN SEHAT</h1>
      <button class="toggle-button" onclick="toggleDarkMode()">Toggle Dark Mode</button>
    </div>
  </header>

  <nav class="container">
    <ul>
      <li><a href="index.php" class="active">Home</a></li>
      <li><a href="about.php">About Me</a></li>
    </ul>
  </nav>

  <main class="container">
    <section id="home">
      <h2>Makanan Favorit Sehat</h2>
      <i><p>Berikut adalah beberapa makanan sehat favorit yang dapat membantu menjaga kesehatan Anda.</p></i>
    </section>

    <section class="container">
      <h2>Resep Makanan</h2>
      <div class="food-grid">
        <?php
          $foods = [
            [
              "title" => "Salad Sayuran",
              "image" => "Salad Sayuran.jpeg",
              "description" => "Bahan-bahan: <br>- Sayuran segar (selada, tomat, mentimun) <br>- Minyak zaitun <br>- Cuka <br>- Garam <br>- Lada <br><br>Cara membuat: <br>1. Cuci semua sayuran. <br>2. Potong-potong sayuran. <br>3. Campurkan semua bahan dalam mangkuk. <br>4. Sajikan segar."
            ],
            [
              "title" => "Smoothie Bowl",
              "image" => "Smoothie Bowl.jpeg",
              "description" => "Bahan-bahan: <br>- 1 pisang matang <br>- 1/2 cangkir yogurt <br>- 1/2 cangkir susu almond <br>- Buah-buahan segar (strawberry, blueberry) <br>- Granola <br><br>Cara membuat: <br>1. Campurkan pisang, yogurt, dan susu almond dalam blender. <br>2. Haluskan hingga kental. <br>3. Tuang dalam mangkuk dan hias dengan buah dan granola."
            ],
            [
              "title" => "Kimchi",
              "image" => "Kimchi.jpeg",
              "description" => "Bahan-bahan: <br>- 1 kubis napa <br>- 1/4 cangkir garam <br>- 1 cangkir air <br>- 3 siung bawang putih (cincang) <br>- 1 inci jahe (parut) <br>- 2 sdm bubuk cabai <br><br>Cara membuat: <br>1. Potong kubis dan rendam dalam air garam selama 2 jam. <br>2. Bilas dan campurkan dengan bawang putih, jahe, dan bubuk cabai. <br>3. Simpan dalam wadah kedap udara dan fermentasi selama 3-5 hari."
            ],
            [
              "title" => "Sup Sayuran",
              "image" => "Sup Sayuran.jpeg",
              "description" => "Bahan: <br>- Wortel <br>- Jamur <br>- Bakso Ikan <br>- Kentang <br>- Brokoli <br>- Buncis <br>- Jagung manis <br>- Telur rebus <br>- Bawang merah <br>- Bawang putih <br>- Kaldu sayuran <br>- Garam <br>- Lada<br><br>Cara Membuat: <br>1. Tumis bawang merah dan bawang putih hingga harum. <br>2. Tambahkan air dan kaldu sayuran, didihkan. <br>3. Masukkan wortel, kentang, dan brokoli, masak setengah matang. <br>4. Masukkan buncis, jagung manis, dan sawi."
            ]
          ];

          foreach ($foods as $food) {
            echo '<div class="food-card">';
            echo '<h3>' . $food['title'] . '</h3>';
            echo '<img src="' . $food['image'] . '" alt="' . $food['title'] . '" />';
            echo '<p>' . $food['description'] . '</p>';
            echo '</div>';
          }
        ?>
      </div>
    </section>
  </main>

  <footer>
    <div class="container">
      <p>© 2024 Resep Makanan Sehat | Dibuat dengan ❤️ oleh Devi Siska</p>
    </div>
  </footer>

  <script>
    function toggleDarkMode() {
      document.body.classList.toggle('dark-mode');
    }
  </script>
</body>
</html>
