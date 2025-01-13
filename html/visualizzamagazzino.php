<?php

    include 'dbconnect.php';
    
    $cookie_name = "user";
    if(!isset($_COOKIE[$cookie_name])) {
            echo "<script>alert('Login Error'); window.location.href='index.html';</script>";
    }

    if(isset($_POST['elimina'])){
        $db = new dbconnect();
        $id = $_POST['id_attrezzatura'];
        $nome = $_POST['nome_attrezzatura'];
        $id_magazzino = $_POST['id_magazzino'];
        $sql = "DELETE FROM `CONTIENE` WHERE `IdAttrezzatura`='".$id."' AND `Nome`='".$nome."'";
        $result = $db->query($sql);
        echo "<script>window.location.href='visualizzamagazzino.php?submit=" . $id_magazzino . "';</script>";
        $db->close();
    }
?>
    <!DOCTYPE html>
    <html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="theme-color" media="(prefers-color-scheme: light)" content="#d90000" />
        <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#910303" />
        <title>Visualizza materiale Magazzino</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@latest/font/bootstrap-icons.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@latest/dist/css/bootstrap.min.css" crossorigin="anonymous">
    </head>
    <header>
        <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand mb-0 h1" href="#" style="color: #d90000;">
                        <img src="./img/logo.png" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">
                        Gestionale Servizio Salvataggio
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <body class="text-center">
        <div class="container">
            <h1 class="mt-5">Elenco Materiale</h1>
            
            <?php
            $db = new dbconnect();
            $id=$_REQUEST['submit'];
            // Query per ottenere i dati dei dipendenti
            $sql = "SELECT `Nome`,`IdAttrezzatura` FROM `CONTIENE` WHERE `IdMagazzino`='".$id."';"; // Cambia 'dipendenti' con il tuo nome di tabella
            $result = $db->query($sql);
            echo "<table class='table table-striped mt-3'>";
            echo "<thead><tr><th>Nome</th><th>IdAttrezzatura</th></tr></thead><tbody>";
            // Controlla se ci sono risultati
            if ($result->num_rows > 0) {
                
                // Stampa i dati in ogni riga
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["Nome"] . "</td><td>" . $row["IdAttrezzatura"] ."</td><td><form action='' method='POST'><input type='hidden' name='id_attrezzatura' value='".$row['IdAttrezzatura']."'><input type='hidden' name='id_magazzino' value='".$id."'><input type='hidden' name='nome_attrezzatura' value='".$row['Nome']."'><button class='w-100 btn btn-lg btn-outline-danger' type='submit' name='elimina'><i class='bi bi-trash'></i></button></form></td></tr>";
                }
                echo"<tr><td><form action='assegnaattrezzatura.php' method='POST'><button class='w-100 btn btn-lg btn-primary' type='submit' name='IdMagazzino' value='".$id."'><i class='bi bi-hammer' style='color: white'></i><h4>Aggiungi</h4></button></form></td></tr>";
                
            } else {
                echo "<tr><td></td><td><h4>Nessun Materiale trovato</h4></td><td></td></tr>";
                echo"<tr><td><form action='assegnaattrezzatura.php' method='POST'><button class='w-100 btn btn-lg btn-primary' type='submit' name='IdMagazzino' value='".$id."'><i class='bi bi-hammer' style='color: white'></i><h4>Aggiungi</h4></button></form></td></tr>";
            }
            echo "</tbody></table>";

            // Chiudi la connessione
            $db->close();
            ?>
        </div>
            <table class="table table-striped mt-3">
            <tr>
            <td>
                <div type="button" class="well btn btn-light" style="color: gray">
                    <a href="magazzini.php" style="color: gray">
                    <i class="bi bi-house" style="color: gray"></i>
                    <h4>Indietro</h4>
                    </a>
                </div>
            </td>
            </tr>
        </table>
    </body>
    </html>
