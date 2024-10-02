<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']);
    $age = htmlspecialchars($_POST['age']);
    $recipe = htmlspecialchars($_POST['recipe']);
    $password = htmlspecialchars($_POST['password']);

    $inputDisplay = true;
} else {
    $inputDisplay = false;
}
?>

<?php if ($inputDisplay): ?>
<section class="container" id="result-section">
  <h2>Hasil Input Anda:</h2>
  <p><strong>Nama:</strong> <?php echo $name; ?></p>
  <p><strong>Usia:</strong> <?php echo $age; ?></p>
  <p><strong>Resep Favorit:</strong> <?php echo $recipe; ?></p>
</section>
<?php endif; ?>
