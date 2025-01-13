<?php
    include 'dbconnect.php';

    $IdTorretta=$_REQUEST['submit'];

    $cookie_name = "user";
    if(!isset($_COOKIE[$cookie_name])) {
            echo "<script>alert('Login Error'); window.location.href='index.html';</script>";
    }

    if(isset($_POST['aggiungi'])){
        $db = new dbconnect();
        $id = $_POST['ora'];
        $descrizione = $_POST['giorno'];
        $sql = "INSERT INTO `ORARIO`(`Ora`, `Giorno`, `IdTorretta`) VALUES ('".$id."', '".$descrizione."', '".$IdTorretta."')";
        $result = $db->query($sql);
        echo "<script>window.location.href='orariotorretta.php?submit=".$IdTorretta."';</script>";
        $db->close();
    }
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">

        <!-- Gestione colore barra navigazione browser -->
        <meta name="theme-color" media="(prefers-color-scheme: light)" content="#d90000" />
        <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#910303" />

        <title>Aggiunta Orario</title>
        <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@latest/font/bootstrap-icons.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@latest/dist/css/bootstrap.min.css" crossorigin="anonymous">
        <link href="css/aggiungidipendenti.css" rel="stylesheet">
    </head>
    <header>
        <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
            <div class="container-fluid">
                <a class="navbar-brand mb-0 h1" style="color: #d90000;">
                    <img src="./img/logo.png" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">
                    Gestionale Servizio Salvataggio
                </a>
            </div>
        </nav>
    </header>
    <body class="text-center">
        <main class="form-signin">
            <?php echo "<h1 class='w-100'>Aggiungi Orario Torretta ".$IdTorretta."</h1>"; ?>
            <form action='' id='form' method='POST'>
                <div class="form-floating">
                    <input type="text" class="form-control" name="ora" placeholder="Ora" value="10:00">
                    <label for="floatingInput">Ora</label>
                </div>
                <div class="form-floating">
                    <select class="form-control" id="giorno" name="giorno">
                    <option value="Lunedì">Lunedì</option>
                    <option value="Martedì">Martedì</option>
                    <option value="Mercoledì">Mercoledì</option>
                    <option value="Giovedì">Giovedì</option>
                    <option value="Venerdì">Venerdì</option>
                    <option value="Sabato">Sabato</option>
                    <option value="Domenica">Domenica</option>
                    </select>
                </div>
                <button class="w-100 btn btn-lg btn-success" type="submit" name="aggiungi">Aggiungi</button>
                <?php echo "<a href='orariotorretta.php?submit=".$IdTorretta."' class='w-100 btn btn-lg btn-light'>Indietro</a>";?>
            </form>
        </main>
    </body>
</html>