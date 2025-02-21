<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Utente Home - Z-Volta</title>
  <link rel="stylesheet" href="utente.css">
</head>
<body>
  <!-- Logos -->
  <div class="logo1">
    <img src="Immagine 2025-02-07 131427.png" alt="Logo Z-Volta">
  </div>
  <div class="logo2">
    <img src="Immagine 2025-02-07 131915.png" alt="Logo Z-Volta">
  </div>

  <!-- Main Container -->
  <div class="container">
    <div class="logo">
      <img src="Immagine 2025-02-07 121441.png" alt="Logo Z-Volta">
    </div>
    <h1>Benvenuto, <?php echo $_SESSION['username']; ?></h1>
    <p>Questa è la pagina utente di Z-Volta.</p>
    <a href="logout.php" class="logout-btn">Logout</a>
  </div>

  <script src="utente.js"></script>
</body>
</html>
