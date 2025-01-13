<?php
    
    $cookie_name = "user";
    if(!isset($_COOKIE[$cookie_name])) {
            echo "<script>alert('Login Error'); window.location.href='index.html';</script>";
    }

    if(isset($_POST['submit'])){
        include 'dbconnect.php';
        $db = new dbconnect();
        $nome = $_REQUEST['nome'];
        $cognome = $_REQUEST['cognome'];
        $codicefiscale = $_REQUEST['codicefiscale'];
        $datanascita = $_REQUEST['datanascita'];
        $brevetto = $_REQUEST['brevetto'];
        $sql = "INSERT INTO `DIPENDENTE`(`Nome`, `Cognome`, `CodiceFiscale`, `Brevetto`, `DataNascita`) VALUES ('".$nome."', '".$cognome."', '".$codicefiscale."', '".$brevetto."', '".$datanascita."')";
        $result = $db->query($sql);
        echo "<script>window.location.href='dipendenti.php';</script>";
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

        <title>Crea Dipendente</title>
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
            <h1 class="w-100 ">Crea Dipendente</h1>
            <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='POST'>
                <div class="form-floating">
                    <input type="text" class="form-control" name="nome" placeholder="nome">
                    <label for="floatingInput">Nome</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" name="cognome" placeholder="cognome">
                    <label for="floatingInput">Cognome</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" name="codicefiscale" placeholder="codicefiscale">
                    <label for="floatingInput">CodiceFiscale</label>
                </div>
                <div class="form-floating">
                    <input type="date" class="form-control" name="datanascita" placeholder="datanascita" maxlength="30">
                    <label for="floatingInput">DataNascita</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" name="brevetto" placeholder="brevetto" maxlength="15">
                    <label for="floatingInput">Brevetto</label>
                </div>
                <button class="w-100 btn btn-lg btn-success" type="submit" name="submit">Aggiungi</button>
                <a href="dipendenti.php" class="w-100 btn btn-lg btn-light">Indietro</a>
            </form>
        </main>
    </body>
</html>