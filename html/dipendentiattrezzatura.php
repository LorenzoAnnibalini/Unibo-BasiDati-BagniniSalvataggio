<?php
    $CodiceFiscale=$_REQUEST['submit'];
    include 'dbconnect.php';
    
    $cookie_name = "user";
    if(!isset($_COOKIE[$cookie_name])) {
            echo "<script>alert('Login Error'); window.location.href='index.html';</script>";
    }

    if(isset($_POST['elimina'])){
        $db = new dbconnect();
        $id = $_POST['id_attrezzatura'];
        $nome = $_POST['nome_attrezzatura'];
        $codice_fiscale = $_POST['codice_fiscale'];
        $sql = "DELETE FROM `USA` WHERE `IdAttrezzatura`='".$id."' AND `Nome`='".$nome."'";
        $result = $db->query($sql);
        echo "<script>window.location.href='dipendentiattrezzatura.php?submit=" . $codice_fiscale . "';</script>";
        $db->close();
    }
?>
    <!DOCTYPE html>
    <html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="theme-color" media="(prefers-color-scheme: light)" content="#d90000" />
        <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#910303" />
        <title>Attrezzatura del Dipendente</title>
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
            
            $sql = "SELECT Nome, Cognome FROM DIPENDENTE WHERE CodiceFiscale = '".$CodiceFiscale."' ;";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
                // Stampa i dati in ogni riga
                while($row = $result->fetch_assoc()) {
                    echo "<h1 class='mt-5'>Elenco Attrezzatura di ".$row["Nome"].$row["Cognome"]."</h1>";
                }
            }
           
            // Query per ottenere i dati dei dipendenti
            $sql = "SELECT `Nome`,`IdAttrezzatura` FROM `USA` WHERE `CodiceFiscale`='".$CodiceFiscale."';"; // Cambia 'dipendenti' con il tuo nome di tabella
            $result = $db->query($sql);
            
            echo "<table class='table table-striped mt-3'>";
            echo "<thead><tr><th>Nome</th><th>IdAttrezzatura</th></tr></thead><tbody>";
            // Controlla se ci sono risultati
            if ($result->num_rows > 0) {
                
                // Stampa i dati in ogni riga
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["Nome"] . "</td><td>" . $row["IdAttrezzatura"] ."</td><td><form action='' method='POST'><input type='hidden' name='id_attrezzatura' value='".$row['IdAttrezzatura']."'><input type='hidden' name='codice_fiscale' value='".$CodiceFiscale."'><input type='hidden' name='nome_attrezzatura' value='".$row['Nome']."'><button class='w-100 btn btn-lg btn-outline-danger' type='submit' name='elimina'><i class='bi bi-trash'></i></button></form></td></tr>";
                }
                echo"<tr><td><form action='assegnaattrezzaturadipendente.php' method='POST'><button class='w-100 btn btn-lg btn-primary' type='submit' name='CodiceFiscale' value='".$CodiceFiscale."'><i class='bi bi-cart-plus' style='color: white'></i><h4>Aggiungi</h4></button></form></td></tr>";
                
            } else {
                echo "<tr><td></td><td><h4>Nessun Materiale trovato</h4></td><td></td></tr>";
                echo"<tr><td><form action='assegnaattrezzaturadipendente.php' method='POST'><button class='w-100 btn btn-lg btn-primary' type='submit' name='CodiceFiscale' value='".$CodiceFiscale."'><i class='bi bi-cart-plus' style='color: white'></i><h4>Aggiungi</h4></button></form></td></tr>";
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
                    <a href="dipendenti.php" style="color: gray">
                    <i class="bi bi-house" style="color: gray"></i>
                    <h4>Indietro</h4>
                    </a>
                </div>
            </td>
            </tr>
        </table>
    </body>
    </html>
