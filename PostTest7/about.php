<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tentang Saya</title>
    <link rel="stylesheet" href="style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background-color: #fff;
            color: #333;
            transition: background-color 0.5s, color 0.5s;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background-color: #003366;
            padding: 20px;
            text-align: center;
            color: white;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        nav ul li a {
            text-decoration: none;
            color: black;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
            font-weight: bold;
        }

        nav ul li a.active {
            background-color: #003366;
            color: white;
        }

        nav ul li a:hover {
            background-color: rgba(0, 51, 102, 0.8);
            color: white;
        }

        main {
            padding: 20px;
            text-align: center;
        }

        .biodata-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .biodata-section {
            display: flex;
            justify-content: center;
            gap: 50px;
            flex-wrap: wrap;
        }

        .biodata-card {
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid #003366;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(34, 34, 34, 0.2);
            transition: transform 0.3s;
            width: 45%;
            min-width: 280px;
        }

        .biodata-card:hover {
            transform: scale(1.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #003366;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #a1c6eb;
            color: white;
        }

        td {
            background-color: #f9f9f9;
        }

        table th, table td {
            color: #333; 
        }

        .dark-mode table th {
            background-color: #111;
            color: #fff; 
        }

        .dark-mode table td {
            background-color: #222;
            color: #ddd; 
        }

        footer {
            background-color: #003366;
            color: white;
            text-align: center;
            padding: 10px;
        }

        .dark-mode {
            background-color: #333;
            color: white;
        }

        .dark-mode header, .dark-mode footer {
            background-color: #111;
        }

        .dark-mode .biodata-card {
            background-color: rgba(50, 50, 50, 0.6);
        }

        .dark-mode nav ul li a {
            color: #ddd;
        }

        @media (max-width: 768px) {
            .biodata-section {
                flex-direction: column;
                align-items: center;
            }

            .biodata-card {
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <header>
        <div class="container">
            <h1>Tentang Saya</h1>
            <button id="theme-toggle">Toggle Dark Mode</button>
        </div>
    </header>

    <nav>
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php" class="active">About Me</a></li>
            </ul>
        </div>
    </nav>

    <main class="container">
        <section id="about">
            <h2>Halo, Saya Devi Siska!</h2>
            <p>Saya seorang mahasiswa Informatika yang memiliki passion dalam teknologi dan inovasi. Saya juga seorang food blogger yang fokus pada makanan sehat dan gaya hidup sehat.</p>

            <section class="biodata-section">
                <div class="biodata-card">
                    <h3>Biodata</h3>
                    <table>
                        <tr>
                            <th>Nama</th>
                            <td>Devi Siska</td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td>Informatika</td>
                        </tr>
                        <tr>
                            <th>Hobi</th>
                            <td>Memasak, Mendengarkan musik, dan Bernyanyi</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><a href="mailto:devisiska989@gmail.com">devisiska989@gmail.com</a></td>
                        </tr>
                    </table>
                </div>
            </section>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>© 2024 Resep Makanan Sehat | Dibuat dengan ❤️ oleh Devi Siska</p>
        </div>
    </footer>

    <script>
        const themeToggleButton = document.getElementById('theme-toggle');
        const body = document.body;

        themeToggleButton.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            themeToggleButton.textContent = body.classList.contains('dark-mode') ? 'Toggle Light Mode' : 'Toggle Dark Mode';
        });
    </script>

</body>
</html>
