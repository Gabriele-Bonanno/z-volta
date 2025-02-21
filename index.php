<?php
session_start();

if ($_POST) {
    // Connessione al database
    $conn = new mysqli("localhost", "root", "", "z-volta");
    if ($conn->connect_error) {
        die("Errore di connessione: " . $conn->connect_error);
    }
    
    // Recupera username e password inviati dal form.
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Prepara la query per ottenere la password hashata e il ruolo dell'utente
    $sql = "SELECT password, ruolo FROM utente WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    // Se l'username non è presente
    if ($stmt->num_rows == 0) {
        echo "Username non presente";
        exit;
    }
    
    $stmt->bind_result($passwordHash, $ruolo);
    $stmt->fetch();
    
    // Verifica della password
    if (password_verify($password, $passwordHash)) {
        $_SESSION['username'] = $username;
        // Reindirizza in base al ruolo
        if ($ruolo == "utente") {
            header("Location: utente.html");
            exit;
        } elseif ($ruolo == "coordinatore") {
            header("Location: coordinatore.html");
            exit;
        } elseif ($ruolo == "gestore") {
            header("Location: gestore.html");
            exit;
        } else {
            echo "Ruolo non riconosciuto.";
            exit;
        }
    } else {
        echo "Password sbagliata";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Z-Volta Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-- Loghi -->
  <div class="logo1">
    <img src="Immagine 2025-02-07 131427.png" alt="Logo Z-Volta">
  </div>
  <div class="logo2">
    <img src="Immagine 2025-02-07 131915.png" alt="Logo Z-Volta">
  </div>
  
  <!-- Contenitore principale -->
  <div class="container">
    <div class="logo">
      <img src="Immagine 2025-02-07 121441.png" alt="Logo Z-Volta">
    </div>
    <div class="login-btn">
      <button id="open-login">Login</button>
    </div>
  </div>

  <!-- Popup del login -->
  <div id="overlay"></div>
  <div id="login-popup">
    <h2>Login</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <input type="text" name="username" id="username" placeholder="Username" required>
      <input type="password" name="password" id="password" placeholder="Password" required>
      <!-- CAPTCHA lato client -->
      <div id="captcha-container">
        <canvas id="captcha" width="200" height="50"></canvas>
        <input type="text" id="captcha-input" placeholder="Inserisci CAPTCHA" required>
      </div>
      <button type="submit" id="submit-login">Submit</button>
    </form>
  </div>

  <script src="script.js"></script>
</body>
</html>
