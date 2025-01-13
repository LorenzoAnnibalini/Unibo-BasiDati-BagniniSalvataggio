<?php
    include 'dbconnect.php';
    
    $cookie_name = "user";
    if(!isset($_COOKIE[$cookie_name])) {
            echo "<script>alert('Login Error'); window.location.href='index.html';</script>";
    }

    if(isset($_POST['submit'])){
        $db = new dbconnect();
        $id = $_REQUEST['id'];
        $descrizione = $_REQUEST['tipologia'];
        $sql = "INSERT INTO `ATTREZZATURA`(`Id`, `Nome`) VALUES ('".$id."', '".$descrizione."')";
        $result = $db->query($sql);
        echo "<script>window.location.href='attrezzatura.php';</script>";
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

        <title>Crea Attrezzatura</title>
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
            <h1 class="w-100 ">Crea Attrezzatura</h1>
            <form action='' id='form' method='POST'>
                <div class="form-floating">
                    <input type="number" class="form-control" name="id" placeholder="id">
                    <label for="floatingInput">Numero</label>
                </div>
                <div class="form-floating">
                    <select id="cars" name="tipologia" form="form" class="form-control">
                        <?php 
                            $db = new dbconnect();
                            $sql = "SELECT Nome FROM `TIPOLOGIA`;";
                            $result = $db->query($sql);
                            if ($result->num_rows > 0) {
                                            
                                // Stampa i dati in ogni riga
                                while($row = $result->fetch_assoc()) {
                                    echo "<option value='".$row["Nome"]."'>".$row["Nome"]."</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <button class="w-100 btn btn-lg btn-success" type="submit" name="submit">Aggiungi</button>
                <a href="attrezzatura.php" class="w-100 btn btn-lg btn-light">Indietro</a>
            </form>
        </main>
    </body>
</html>