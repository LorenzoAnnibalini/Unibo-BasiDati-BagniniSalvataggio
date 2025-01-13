<?php
    
    $cookie_name = "user";
    if(!isset($_COOKIE[$cookie_name])) {
            echo "<script>alert('Login Error'); window.location.href='index.html';</script>";
    }

    if(isset($_POST['submit'])){
        include 'dbconnect.php';
        $db = new dbconnect();
        $id = $_REQUEST['id'];
        $anno = $_REQUEST['anno'];
        $luogo = $_REQUEST['luogo'];
        $descrizione = $_REQUEST['descrizione'];
        $risultato = $_REQUEST['risultato'];
        $sql = "INSERT INTO `INTERVENTO`(`Id`, `Anno`, `Luogo`, `Descrizione`, `Risultato`) VALUES ('".$id."','".$anno."','".$luogo."','".$descrizione."','".$risultato."')";
        $result = $db->query($sql);

        echo "<script>window.location.href='interventi.php';</script>";
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

        <title>Crea Intervento</title>
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
            <h1 class="w-100 ">Crea Intervento</h1>
            <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='POST'>
                <div class="form-floating">
                    <input type="number" class="form-control" name="id" placeholder="id">
                    <label for="floatingInput">Id</label>
                </div>
                <div class="form-floating">
                    <input type="number" class="form-control" name="anno" placeholder="anno">
                    <label for="floatingInput">Anno</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" name="luogo" placeholder="luogo" maxlength="50">
                    <label for="floatingInput">Luogo</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" name="descrizione" placeholder="descrizione" maxlength="100">
                    <label for="floatingInput">Descrizione</label>
                </div>
                <div class="form-floating">
                    <select name="risultato" class="form-select">
                        <option value="vivo">Vivo</option>
                        <option value="mortomare">Morto al mare</option>
                        <option value="mortoospedale">Morto in ospedale</option>
                    </select>
                </div>
                <button class="w-100 btn btn-lg btn-success" type="submit" name="submit">Aggiungi</button>
                <a href="interventi.php" class="w-100 btn btn-lg btn-light">Indietro</a>
            </form>
        </main>
    </body>
</html>