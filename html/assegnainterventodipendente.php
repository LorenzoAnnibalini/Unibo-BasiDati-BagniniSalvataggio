<?php
	include 'dbconnect.php';
    
    //Id Intervento
    $Id=$_REQUEST['submit'];
    
    $db = new dbconnect();
    
    $cookie_name = "user";
    if(!isset($_COOKIE[$cookie_name])) {
            echo "<script>alert('Login Error'); window.location.href='index.html';</script>";
    }

    if(isset($_POST['aggiungi'])){
        $db = new dbconnect();
        $id = $_REQUEST['id'];
        $codicefiscale = $_REQUEST['codicefiscale'];
        $sql = "INSERT INTO `EFFETTUA`(`IdIntervento`, `CodiceFiscale`) VALUES ('".$id."','".$codicefiscale."');";
        $result = $db->query($sql);
        echo "<script>window.location.href='infointervento.php?submit=" . $id . "';</script>";
    }

    $db->close();
?>
    <!DOCTYPE html>
    <html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="theme-color" media="(prefers-color-scheme: light)" content="#d90000" />
        <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#910303" />
        <title>Assegna Intervento</title>
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
            
            <?php

            echo "<h1 class='mt-5'>Aggiungi Dipendente all'Intervento</h1>";

            $db = new dbconnect();

            // Inizia la tabella

            $sql = "SELECT * FROM DIPENDENTE WHERE DIPENDENTE.CodiceFiscale NOT IN ( SELECT EFFETTUA.CodiceFiscale FROM EFFETTUA WHERE EFFETTUA.IdIntervento='".$Id."');";
            $result = $db->query($sql);
            echo "<table class='table table-striped mt-3'>";
            echo "<thead><tr><th>Nome</th><th>Cognome</th><th>CodiceFiscale</th><th>Aggiungi</th></tr></thead><tbody>";
                
            // Controlla se ci sono risultati
            if ($result->num_rows > 0) {
                // Stampa i dati in ogni riga
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["Nome"] . "</td><td>" . $row["Cognome"] ."</td><td>" . $row["CodiceFiscale"] ."</td><td><form action='' method='POST'><input type='hidden' name='id' value='".$Id."'><input type='hidden' name='codicefiscale' value='".$row["CodiceFiscale"]."'><button class='w-100 btn btn-lg btn-outline-success' type='submit' name='aggiungi' value=''><i class='bi bi-person-fill-add'></i></button></form></td></tr>";
                }
            } else {
                echo "<tr><td></td><td><h4>Nessun Dipendente trovata</h4></td><td></td></tr>";
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
                    <?php echo "<a href='infointervento.php?submit=".$Id."' style='color: gray'>";?>
                    <i class="bi bi-house" style="color: gray"></i>
                    <h4>Indietro</h4>
                </div>
            </td>
            </tr>
        </table>
    </body>
    </html>
