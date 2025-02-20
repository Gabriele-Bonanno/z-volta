<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registra utente</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
<div>

ATTENZIONE: TUTTI I CAMPI SONO OBBILIGATORI

</div>

<div>

        Nome <input type="text" name="nome" required> <br>
        cognome <input type="text" name="cognome" required> <br>
        username <input type="text" name="username" required> <br>
        password <input type="password" name="password" required> <br>
        <input type="radio" value="gestore" name="ruolo"> Gestore 
        <input type="radio" value="coordinatore" name="ruolo"> Coordinatore 
        <input type="radio" value="utente" name="ruolo" checked> Utente  <br>
         <input type="submit" value="Invio" > <br>

</div>
    </form>
    <?php
    if($_POST){
        //preparo connessione al DB
        $host="localhost";
        $username="root";
        $password="";
        $db_name="z-volta";
        $conn=new mysqli($host, $username, $password, $db_name);
        if($conn -> connect_error){
            echo "errore di connessione al DB";
            die();
        }
        //acquisizione dati dal form

        $nome=$_POST["nome"];
        $cognome=$_POST["cognome"];
        $user=$_POST["username"];
        $ruolo=$_POST["ruolo"];
        $psw= password_hash ($_POST["password"], PASSWORD_DEFAULT);
        $sql="INSERT INTO utente VALUE ('$cognome', '$nome', '$ruolo', '$psw', '$user' )";
        if ($conn -> query($sql)){
            echo "Utente registrato correttamente";
        }
        else {
            echo "errore di registrazione". $conn->error;
        }
    }

    ?>
</body>
</html>