<?php
	include 'dbconnect.php';
    $IdTorretta = $_REQUEST['submit'];
    $db = new dbconnect();
    
    $cookie_name = "user";
    if(!isset($_COOKIE[$cookie_name])) {
            echo "<script>alert('Login Error'); window.location.href='index.html';</script>";
    }

    if(isset($_POST['elimina'])){
        $db = new dbconnect();
        $orario = $_POST['ora'];
        $giorno = $_POST['giorno'];
        $torretta = $_POST['id_torretta'];
        $sql = "DELETE FROM `ORARIO` WHERE `Ora`='".$orario."' AND `Giorno`='".$giorno."' AND `IdTorretta`='".$torretta."'";
        $result = $db->query($sql);
        echo "<script>window.location.href='orariotorretta.php?submit=".$torretta."';</script>";
    }

    $db->close();
?>
    <!DOCTYPE html>
    <html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="theme-color" media="(prefers-color-scheme: light)" content="#d90000" />
        <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#910303" />
        <title>Orario della Torretta</title>
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
            echo "<h1 class='mt-5'>Orario Torretta ".$IdTorretta."</h1>";
            $db = new dbconnect();
            // Query per ottenere i dati dei dipendenti
            $sql = "SELECT O.Ora AS Ora , O.Giorno AS Giorno, D.Nome AS Nome , D.Cognome AS Cognome FROM ORARIO O LEFT JOIN LAVORA L ON O.Ora =L.Ora AND O.Giorno = L.Giorno AND O.IdTorretta = L.IdTorretta LEFT JOIN DIPENDENTE D ON L.CodiceFiscale =D.CodiceFiscale WHERE O.IdTorretta = '".$IdTorretta."' ORDER BY O.Giorno, O.Ora;";
            $result = $db->query($sql);

            // Inizia la tabella
            echo "<table class='table table-striped mt-3'>";
            echo "<thead><tr><th>Giorno</th><th>Ora</th><th>Dipendente</th><th>Elimina</th></tr></thead><tbody>";
                
            // Controlla se ci sono risultati
            if ($result->num_rows > 0) {
                // Stampa i dati in ogni riga
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["Giorno"] . "</td><td>" . $row["Ora"]."</td><td>".$row["Nome"].$row["Cognome"]."</td>";
                    //Bottoni per eliminare orario
                    echo "<td><form action='' method='post'><input type='hidden' name='id_torretta' value='".$IdTorretta."'><input type='hidden' name='giorno' value='".$row["Giorno"]."'><input type='hidden' name='ora' value='".$row["Ora"]."'><button type='submit' name='elimina' class='btn btn-outline-danger'><i class='bi bi-trash'></i></button></form></td></tr>";
                }
                echo "<tr><td></td><td></td><td><div type='button' class='well btn btn-primary' style='color: white'><a href='aggiungiorario.php?submit=".$IdTorretta."' style='color: white'><i class='bi bi-clock-history' style='color: white'></i><h4>Aggiungi</h4></a></div></td>";
            }else {
                echo "<tr><td></td><td><h4>Nessun Orario Trovato</h4></td><td></td></tr>";
                echo "<tr><td></td><td></td><td><div type='button' class='well btn btn-primary' style='color: white'><a href='aggiungiorario.php?submit=".$IdTorretta."' style='color: white'><i class='bi bi-clock-history' style='color: white'></i><h4>Aggiungi</h4></a></div></td>";
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
                    <a href="torrette.php" style="color: gray">
                    <i class="bi bi-house" style="color: gray"></i>
                    <h4>Indietro</h4>
                    </a>
                </div>
            </td>
            </tr>
        </table>
    </body>
    </html>
