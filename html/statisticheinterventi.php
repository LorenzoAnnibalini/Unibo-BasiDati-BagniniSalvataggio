<?php
	include 'dbconnect.php';
    $db = new dbconnect();

    $cookie_name = "user";
    if(!isset($_COOKIE[$cookie_name])) {
            echo "<script>alert('Login Error'); window.location.href='index.html';</script>";
    }

    if(isset($_POST['ricerca'])){
        $anno = $_REQUEST['anno'];
        $dipendente = $_REQUEST['dipendente'];
        $risultato = $_REQUEST['risultato'];
    }else{
        $anno = "";
        $dipendente = "";
        $risultato = "";
    }

    if(isset($_POST['elimina'])){
        $id = $_REQUEST['id'];
        $sql = "DELETE FROM INTERVENTO WHERE Id='".$id."';";
        $result = $db->query($sql);
    }

    $db->close();
?>
    <!DOCTYPE html>
    <html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="theme-color" media="(prefers-color-scheme: light)" content="#d90000" />
        <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#910303" />
        <title>Statistiche Interventi</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
            <h1 class="mt-5">Statistiche Interventi</h1>
            <?php
            $db = new dbconnect();

           
            // Query per ottenere i dati
            $sql = "SELECT i.Risultato, COUNT(*) AS NumeroInterventi FROM INTERVENTO i GROUP BY i.Risultato ORDER BY NumeroInterventi DESC;";
            $result = $db->query($sql);
            // Statistiche Risultato
            echo "<div class='border'>  <h4 class='text-primary'>Statistiche Risultati Totali</h4>";
            echo "<table class='table table-striped mt-3'>";
            echo "<thead><tr><th></th><th>Risultato</th><th>Numero Interventi</th></thead><tbody>";
                
            // Controlla se ci sono risultati
            if ($result->num_rows > 0) {
                $cont=0;
                // Stampa i dati in ogni riga
                while($row = $result->fetch_assoc()) {
                    $cont++;
                    echo "<tr><th>".$cont."</th><td>" . $row["Risultato"] . "</td><td>" . $row["NumeroInterventi"]."</td></tr>";
                }
            }else {
                echo "<tr><td></td><td><h4>Nessun Intervento trovato</h4></td><td></td></tr>";
            }
            echo "</tbody></table></div><br>";

           
            // Query per ottenere i dati
            $sql = "SELECT i.Anno, SUM(i.Risultato = 'vivo') AS Vivo, SUM(i.Risultato = 'mortomare') AS MortoInMare, SUM(i.Risultato = 'mortoospedale') AS MortoInOspedale FROM INTERVENTO i GROUP BY i.Anno ORDER BY i.Anno DESC;";
            $result = $db->query($sql);
            // Statistiche Anno
            echo "<div class='border'> <h4 class='text-primary'>Statistiche Anno</h4>";
            echo "<table class='table table-striped mt-3'>";
            echo "<thead><tr><th></th><th>Anno</th><th>Vivo</th><th>Morto in Mare</th><th>Morto in Ospedale</th></thead><tbody>";
                
            // Controlla se ci sono risultati
            if ($result->num_rows > 0) {
                $cont=0;
                // Stampa i dati in ogni riga
                while($row = $result->fetch_assoc()) {
                    $cont++;
                    echo "<tr><th>".$cont."</th><td>" . $row["Anno"] . "</td><td>" . $row["Vivo"]."</td><td>".$row["MortoInMare"]."</td><td>".$row["MortoInOspedale"]."</td></tr>";
                }
            }else {
                echo "<tr><td></td><td><h4>Nessun Intervento trovato</h4></td><td></td></tr>";
            }
            echo "</tbody></table></div>";

            
            // Query per ottenere i dati
            $sql = "SELECT D.Nome, D.Cognome, SUM(I.Risultato = 'vivo') AS NumeroVivi FROM DIPENDENTE D LEFT JOIN EFFETTUA E ON D.CodiceFiscale = E.CodiceFiscale LEFT JOIN INTERVENTO I ON E.IdIntervento = I.Id WHERE I.Risultato = 'vivo' GROUP BY D.CodiceFiscale, D.Nome, D.Cognome ORDER BY NumeroVivi DESC LIMIT 10;";
            $result = $db->query($sql);
            // Statistiche dipendenti + vivi
            echo "<div class='border'> <h4 class='text-primary'>Primi 10 Dipendenti - Risultati Vivi</h4>";
            echo "<table class='table table-striped mt-3'>";
            echo "<thead><tr><th></th><th>Nome</th><th>Cognome</th><th>NumeroVivi</th></thead><tbody>";
                
            // Controlla se ci sono risultati
            if ($result->num_rows > 0) {
                $cont=0;
                // Stampa i dati in ogni riga
                while($row = $result->fetch_assoc()) {
                    $cont++;
                    echo "<tr><th>".$cont."</th><td>" . $row["Nome"] . "</td><td>" . $row["Cognome"]."</td><td>".$row["NumeroVivi"]."</td></tr>";
                }
            }else {
                echo "<tr><td></td><td><h4>Nessun Intervento trovato</h4></td></tr>";
            }
            echo "</tbody></table></div>";


            // Query per ottenere i dati
            $sql = "SELECT D.Nome, D.Cognome, SUM(I.Risultato IN ('mortomare', 'mortoospedale')) AS NumeroMorti, SUM(I.Risultato = 'mortomare') AS MortoInMare, SUM(I.Risultato = 'mortoospedale') AS MortoInOspedale FROM DIPENDENTE D LEFT JOIN EFFETTUA E ON D.CodiceFiscale = E.CodiceFiscale LEFT JOIN INTERVENTO I ON E.IdIntervento = I.Id WHERE I.Risultato IN ('mortomare', 'mortoospedale') GROUP BY D.CodiceFiscale, D.Nome, D.Cognome ORDER BY NumeroMorti DESC LIMIT 10;";
            $result = $db->query($sql);
            // Statistiche dipendenti + morto
            echo "<div class='border'> <h4 class='text-primary'>Primi 10 Dipendenti - Risultati Morti</h4>";
            echo "<table class='table table-striped mt-3'>";
            echo "<thead><tr><th></th><th>Nome</th><th>COgnome</th><th>Morti Totali</th><th>Morti in mare</th><th>Morti in ospedale</th></thead><tbody>";
                 
            // Controlla se ci sono risultati
            if ($result->num_rows > 0) {
                $cont=0;
                // Stampa i dati in ogni riga
                while($row = $result->fetch_assoc()) {
                    $cont++;
                    echo "<tr><th>".$cont."</th><td>" . $row["Nome"] . "</td><td>" . $row["Cognome"]."</td><td>".$row["NumeroMorti"]."</td><td>".$row["MortoInMare"]."</td><td>".$row["MortoInOspedale"]."</td></tr>";
                }
            }else {
                echo "<tr><td></td><td></td><td><h4>Nessun Intervento trovato</h4></td><td></td></tr>";
            }
            echo "</tbody></table></div>";

            
            
            // Chiudi la connessione
            $db->close();
            ?>
        </div>
            <table class="table table-striped mt-3">
            <tr>
            <td>
                <div type="button" class="well btn btn-light" style="color: gray">
                    <a href="homepage.php" style="color: gray">
                    <i class="bi bi-house" style="color: gray"></i>
                    <h4>Indietro</h4>
                    </a>
                </div>
            </td>
            </tr>
        </table>
    </body>
    </html>
