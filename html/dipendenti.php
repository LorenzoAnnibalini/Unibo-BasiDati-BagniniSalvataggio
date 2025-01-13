<?php
	include 'dbconnect.php';
    $db = new dbconnect();
    
    $cookie_name = "user";
    if(!isset($_COOKIE[$cookie_name])) {
            echo "<script>alert('Login Error'); window.location.href='index.html';</script>";
    }

    if(isset($_POST['elimina'])){
        $codicefiscale = $_POST['elimina'];
        $sql = "DELETE FROM `DIPENDENTE` WHERE `CodiceFiscale`='".$codicefiscale."'";
        $result = $db->query($sql);
        echo "window.location.href='dipendenti.php';</script>";
        
    }
    
    $db->close();
?>
    <!DOCTYPE html>
    <html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="theme-color" media="(prefers-color-scheme: light)" content="#d90000" />
        <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#910303" />
        <title>Elenco Dipendenti</title>
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
            <h1 class="mt-5">Elenco Dipendenti</h1>
            
            <?php
            $db = new dbconnect();
            // Query per ottenere i dati dei dipendenti
            $sql = "SELECT D.*, COUNT(E.CodiceFiscale) AS TotSalvataggi FROM DIPENDENTE D LEFT JOIN EFFETTUA E ON E.CodiceFiscale = D.CodiceFiscale GROUP BY D.CodiceFiscale;"; // Cambia 'dipendenti' con il tuo nome di tabella
            $result = $db->query($sql);

            // Inizia la tabella
            echo "<table class='table table-striped mt-3'>";
            echo "<thead><tr><th>Nome</th><th>Cognome</th><th>CodiceFiscale</th><th>Brevetto</th><th>DataNascita</th><th>Tot.Salvataggi</th><th>Attrezzatura</th><th>Orario</th><th>Elimina</th></tr></thead><tbody>";
                
            // Controlla se ci sono risultati
            if ($result->num_rows > 0) {
                // Stampa i dati in ogni riga
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["Nome"] . "</td><td>" . $row["Cognome"] . "</td><td>" . $row["CodiceFiscale"] . "</td><td>" . $row["Brevetto"] . "</td><td>" . $row["DataNascita"] . "</td><td>" . $row["TotSalvataggi"] . "</td><td><form action='dipendentiattrezzatura.php' method='POST'><button class='w-100 btn btn-lg btn-primary' type='submit' name='submit' value='".$row["CodiceFiscale"]."'><i class='bi bi-backpack-fill'></i></button></form></td><td><form action='orariodipendenti.php' method='POST'><button class='w-100 btn btn-lg btn-primary' type='submit' name='submit' value='".$row["CodiceFiscale"]."'><i class='bi bi-clock-history'></i></button></form></td><td><form action='' method='POST'><button class='w-100 btn btn-lg btn-outline-danger' type='submit' name='elimina' value='".$row["CodiceFiscale"]."'><i class='bi bi-trash'></i></button></form></td></tr>";
                }
                echo "<tr><td></td><td></td><td><div type='button' class='well btn btn-primary' style='color: white'><a href='aggiungidipendenti.php' style='color: white'><i class='bi bi-person-fill-add' style='color: white'></i><h4>Aggiungi</h4></a></div></td><td></td><td></td><td></td><td></td></tr>";
            } else {
                echo "<tr><td></td><td><h4>Nessun dipendente trovato</h4></td><td></td></tr>";
                echo "<tr><td></td><td></td><td><div type='button' class='well btn btn-primary' style='color: white'><a href='aggiungidipendenti.php' style='color: white'><i class='bi bi-person-fill-add' style='color: white'></i><h4>Aggiungi</h4></a></div></td><td></td><td></td><td></td><td></td></tr>";
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
