<?php
	include 'dbconnect.php';
    $db = new dbconnect();
    
    $cookie_name = "user";
    if(!isset($_COOKIE[$cookie_name])) {
            echo "<script>alert('Login Error'); window.location.href='index.html';</script>";
    }

    if(isset($_POST['submit'])){
        $db = new dbconnect();
        $id = $_POST['submit'];
        $sql = "DELETE FROM `MAGAZZINO` WHERE `Id`='".$id."'";
        $result = $db->query($sql);
        echo "<script>window.location.href='magazzini.php';</script>";
        $db->close();
    }

    $db->close();
?>
    <!DOCTYPE html>
    <html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="theme-color" media="(prefers-color-scheme: light)" content="#d90000" />
        <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#910303" />
        <title>Elenco Magazzini</title>
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
            <h1 class="mt-5">Elenco Magazzini</h1>
            
            <?php
            $db = new dbconnect();
            // Query per ottenere i dati dei dipendenti
            $sql = "SELECT M.*, COUNT(C.IdMagazzino) AS Materiale FROM `MAGAZZINO` M LEFT JOIN CONTIENE C ON C.IdMagazzino=M.Id GROUP BY M.Id;"; // Cambia 'dipendenti' con il tuo nome di tabella
            $result = $db->query($sql);

            // Inizia la tabella
            echo "<table class='table table-striped mt-3'>";
            echo "<thead><tr><th>Id</th><th>Nome</th></tr></thead><tbody>";
            // Controlla se ci sono risultati
            if ($result->num_rows > 0) {
                // Stampa i dati in ogni riga
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["Id"] . "</td><td>" . $row["Descrizione"] ."</td><td><form action='visualizzamagazzino.php' method='POST'><button class='w-100 btn btn-lg btn-secondary' type='submit' name='submit' value='".$row["Id"]."'><i class='bi bi-door-open'></i></button></td><td></form><form action='' method='POST'><button class='w-100 btn btn-lg btn-outline-danger' type='submit' name='submit' value='".$row["Id"]."'><i class='bi bi-trash'></i></button></form></td></tr>";
                }
                echo "<tr><td><div type='button' class='well btn btn-primary' style='color: white'><a href='aggiungimagazzino.php' style='color: white'><i class='bi bi-house-add-fill' style='color: white'></i><h4>Aggiungi</h4></a></div></td></tr>";
            } else {
                echo "<tr><td></td><td><h4>Nessun Magazzino trovato</h4></td><td></td></tr>";
                echo "<tr><td><div type='button' class='well btn btn-primary' style='color: white'><a href='aggiungimagazzino.php' style='color: white'><i class='bi bi-house-add-fill' style='color: white'></i><h4>Aggiungi</h4></a></div></td></tr>";
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
