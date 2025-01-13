<?php
	include 'dbconnect.php';
    $db = new dbconnect();
    
    $cookie_name = "user";
    if(!isset($_COOKIE[$cookie_name])) {
            echo "<script>alert('Login Error'); window.location.href='index.html';</script>";
    }

    if(isset($_POST['elimina'])){
        $db = new dbconnect();
        $nome = $_REQUEST['nome'];
        echo "<script>alert('".$nome."');</script>";
        $sql = "DELETE FROM `TIPOLOGIA` WHERE `Nome`='".$nome."'";
        $result = $db->query($sql);
        echo "<script>window.location.href='visualizzatipologiaattrezzatura.php';</script>";
    }

    $db->close();
?>
    <!DOCTYPE html>
    <html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="theme-color" media="(prefers-color-scheme: light)" content="#d90000" />
        <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#910303" />
        <title>Elenco Tipologia Attrezzatura</title>
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
            <h1 class="mt-5">Elenco Tipologia Attrezzatura</h1>
            
            <?php
            $db = new dbconnect();
            // Query per ottenere i dati dei dipendenti
            $sql = "SELECT * FROM TIPOLOGIA;";
            $result = $db->query($sql);

            // Inizia la tabella
            echo "<table class='table table-striped mt-3'>";
            echo "<thead><tr><th>Tipologia</th><th></th</tr></thead><tbody>";
                
            // Controlla se ci sono risultati
            if ($result->num_rows > 0) {
                // Stampa i dati in ogni riga
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["Nome"] . "</td>";
                    //Bottone eliminazione
                    echo "<td><form action='' method='POST'><input type='hidden' name='nome' value='".$row["Nome"]."'><button class='w-100 btn btn-lg btn-outline-danger' type='submit' name='elimina' value=''><i class='bi bi-trash'></i></button></form></td></tr>";
                }
            }
            echo "<tr><td><div type='button' class='well btn btn-primary' style='color: white'><a href='aggiungitipologiaattrezzatura.php' style='color: white'><i class='bi bi-bag-plus' style='color: white'></i><h4>Aggiungi</h4></a></div></td></td></tr>";
            echo "</tbody></table>";
            // Chiudi la connessione
            $db->close();
            ?>
        </div>
            <table class="table table-striped mt-3">
            <tr>
            <td>
                <div type="button" class="well btn btn-light" style="color: gray">
                    <a href="attrezzatura.php" style="color: gray">
                    <i class="bi bi-house" style="color: gray"></i>
                    <h4>Indietro</h4>
                    </a>
                </div>
            </td>
            </tr>
        </table>
    </body>
    </html>
