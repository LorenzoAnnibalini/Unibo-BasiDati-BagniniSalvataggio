<?php
	include 'dbconnect.php';
    $db = new dbconnect();
    
    $cookie_name = "user";
    if(!isset($_COOKIE[$cookie_name])) {
            echo "<script>alert('Login Error'); window.location.href='index.html';</script>";
    }

    if(isset($_POST['elimina'])){
        $id_intervento = $_POST['id'];
        $codicefiscale = $_POST['codicefiscale'];
        $sql = "DELETE FROM `EFFETTUA` WHERE `IdIntervento`='".$id_intervento."' AND `CodiceFiscale`='".$codicefiscale."'";
        $result = $db->query($sql);
        echo "<script>window.location.href='infointervento.php?submit=".$id_intervento."';</script>";
    }


    $db->close();
?>
    <!DOCTYPE html>
    <html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="theme-color" media="(prefers-color-scheme: light)" content="#d90000" />
        <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#910303" />
        <title>Info Intervento</title>
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
            
            <?php
            $db = new dbconnect();

            // Ottieni l'ID dell'intervento
            $Id=$_REQUEST['submit'];

            // Query per ottenere i dati dei dipendenti
            $sql = "SELECT * FROM `INTERVENTO` WHERE Id='".$Id."';";
            $result = $db->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<table class='table table-striped mt-3'>";
                    echo "<thead><tr><th>Intervento</th><th>Anno</th><th>Luogo</th><th>Descrizione</th><th>Risultato</th></tr></thead>";
                    echo "<tbody><tr>";
                    echo "<td>Intervento ".$row['Id']."</td>";
                    echo "<td>Anno: ".$row['Anno']."</td>";
                    echo "<td>Luogo: ".$row['Luogo']."</td>";
                    echo "<td>Risultato: ".$row['Risultato']."</td>";
                    echo "</tr>";
                    echo "<tr><td>Descrizione: ".$row['Descrizione']."</td></tr>";
                    echo"</tbody></table>";
                }
            } else {
                echo "<h1>ERRORE CARICAMENTO</h1>";
            }

            $sql = "SELECT * FROM EFFETTUA E LEFT JOIN DIPENDENTE D ON E.CodiceFiscale=D.CodiceFiscale WHERE E.IdIntervento='".$Id."';";
            $result = $db->query($sql);
            // Inizia la tabella
            echo "<h1 class='mt-5'>Dipendenti Presenti</h1>";
            echo "<table class='table table-striped mt-3'>";
            echo "<thead><tr><th>Nome</th><th>Cognome</th><th>CodiceFiscale</th><th>Elimina</th></tr></thead><tbody>";
                
            // Controlla se ci sono risultati
            if ($result->num_rows > 0) {
                // Stampa i dati in ogni riga
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["Nome"] . "</td><td>" . $row["Cognome"]."</td><td>" . $row["CodiceFiscale"]."</td>";

                    //Bottone eliminazione
                    echo "<td><form action='' method='POST'><input type='hidden' name='id' value='".$Id."'><input type='hidden' name='codicefiscale' value='".$row["CodiceFiscale"]."'><button class='w-100 btn btn-lg btn-outline-danger' type='submit' name='elimina' value=''><i class='bi bi-trash'></i></button></form></td></tr>";
                }
                echo "<tr><td></td><td></td><td><div type='button' class='well btn btn-primary' style='color: white'><a href='assegnainterventodipendente.php?submit=".$Id."' style='color: white'><i class='bi bi-bag-plus' style='color: white'></i><h4>Aggiungi</h4></a></div></td>";
            }else {
                echo "<tr><td></td><td><h4>Nessun Dipendente trovato</h4></td><td></td></tr>";
                echo "<tr><td></td><td></td><td><div type='button' class='well btn btn-primary' style='color: white'><a href='assegnainterventodipendente.php?submit=".$Id."' style='color: white'><i class='bi bi-bag-plus' style='color: white'></i><h4>Aggiungi</h4></a></div></td>";
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
                    <a href="interventi.php" style="color: gray">
                    <i class="bi bi-house" style="color: gray"></i>
                    <h4>Indietro</h4>
                    </a>
                </div>
            </td>
            </tr>
        </table>
    </body>
    </html>
