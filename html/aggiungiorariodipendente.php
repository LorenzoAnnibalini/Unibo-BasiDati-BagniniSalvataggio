<?php
	include 'dbconnect.php';
    $CodiceFiscale=$_REQUEST['submit'];

    $db = new dbconnect();
   
    $cookie_name = "user";
    if(!isset($_COOKIE[$cookie_name])) {
            echo "<script>alert('Login Error'); window.location.href='index.html';</script>";
    }

    if(isset($_POST['aggiungi'])){
        $db = new dbconnect();
        $ora = $_POST['Ora'];
        $giorno = $_POST['Giorno'];
        $torretta = $_POST['Torretta'];
        $codice_fiscale= $_POST['codice_fiscale'];
        $sql = "INSERT INTO `LAVORA`(`IdTorretta`, `Ora`, `Giorno`, `CodiceFiscale`) VALUES ('".$torretta."','".$ora."','".$giorno."','".$codice_fiscale."');";
        $result = $db->query($sql);
        echo "<script>window.location.href='orariodipendenti.php?submit=" . $codice_fiscale . "';</script>";
    }

    $db->close();
?>
    <!DOCTYPE html>
    <html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="theme-color" media="(prefers-color-scheme: light)" content="#d90000" />
        <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#910303" />
        <title>Assegna Orario a Dipendente</title>
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
            $db = new dbconnect();
            // Query per ottenere i dati dei dipendenti
            $sql = "SELECT Nome FROM DIPENDENTE WHERE CodiceFiscale = '".$CodiceFiscale."';";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
                // Stampa i dati in ogni riga
                while($row = $result->fetch_assoc()) {
                    echo "<h1 class='mt-5'>Assegna Orario a ".$row["Nome"]."</h1>";
                }
            }


            // Inizia la tabella

            $sql = "SELECT O.Ora, O.Giorno, O.IdTorretta FROM ORARIO AS O LEFT JOIN LAVORA AS L ON O.Ora = L.Ora AND O.Giorno = L.Giorno AND O.IdTorretta = L.IdTorretta WHERE L.CodiceFiscale IS NULL AND O.Ora NOT IN ( SELECT Ora FROM LAVORA WHERE Giorno = O.Giorno AND CodiceFiscale = '".$CodiceFiscale."' ) ORDER BY O.Giorno, O.Ora, O.IdTorretta;";
            $result = $db->query($sql);
            echo "<table class='table table-striped mt-3'>";
            echo "<thead><tr><th>Giorno</th><th>Ora</th><th>Torretta</th><th></th></tr></thead><tbody>";
                
            // Controlla se ci sono risultati
            if ($result->num_rows > 0) {
                // Stampa i dati in ogni riga
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["Giorno"] . "</td><td>" . $row["Ora"] ."</td><td>".$row["IdTorretta"]."</td><td><form action='' method='POST'><input type='hidden' name='codice_fiscale' value='".$CodiceFiscale."'><input type='hidden' name='Ora' value='".$row["Ora"]."'><input type='hidden' name='Giorno' value='".$row["Giorno"]."'><input type='hidden' name='Torretta' value='".$row["IdTorretta"]."'><button class='w-100 btn btn-lg btn-success' type='submit' name='aggiungi' value=''><i class='bi bi-cart-plus'></i></button></form></td></tr>";
                }
            } else {
                echo "<tr><td></td><td><h4>Nessun Orario trovato</h4></td><td></td></tr>";
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
                    <?php echo "<a href='orariodipendenti.php?submit=".$CodiceFiscale."' style='color: gray'>";?>
                    <i class="bi bi-house" style="color: gray"></i>
                    <h4>Indietro</h4>
                    </a>
                </div>
            </td>
            </tr>
        </table>
    </body>
    </html>
