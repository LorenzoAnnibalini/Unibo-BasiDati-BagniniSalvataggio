<?php
	include 'dbconnect.php';
    $IdTorretta=$_REQUEST['IdTorretta'];

    $db = new dbconnect();
   
    $cookie_name = "user";
    if(!isset($_COOKIE[$cookie_name])) {
            echo "<script>alert('Login Error'); window.location.href='index.html';</script>";
    }

    if(isset($_POST['aggiungi'])){
        $db = new dbconnect();
        $id_attrezzatura = $_POST['id_attrezzatura'];
        $nome = $_POST['nome_attrezzatura'];
        $id_torretta= $_POST['id_torretta'];
        $sql = "INSERT INTO `POSSIEDE`(`IdTorretta`, `Nome`, `IdAttrezzatura`) VALUES ('".$id_torretta."','".$nome."','".$id_attrezzatura."');";
        $result = $db->query($sql);
        echo "<script>window.location.href='visualizzatorretta.php?submit=" . $id_torretta . "';</script>";
    }

    $db->close();
?>
    <!DOCTYPE html>
    <html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="theme-color" media="(prefers-color-scheme: light)" content="#d90000" />
        <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#910303" />
        <title>Assegna Attrezzatura a Torretta</title>
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
            echo "<h1 class='mt-5'>Assegna attrezzatura a Torretta".$IdTorretta."</h1>";


            // Inizia la tabella

            $sql = "SELECT A.Id, A.Nome FROM `ATTREZZATURA` A LEFT JOIN `USA` U ON A.Id=U.IdAttrezzatura AND A.Nome=U.Nome LEFT JOIN `POSSIEDE` P ON A.Id=P.IdAttrezzatura AND A.Nome=P.Nome WHERE U.IdAttrezzatura IS NULL AND U.Nome IS NULL AND P.IdAttrezzatura IS NULL AND P.Nome IS NULL;";
            $result = $db->query($sql);
            echo "<table class='table table-striped mt-3'>";
            echo "<thead><tr><th>Attrezzatura</th><th>Numero</th></tr></thead><tbody>";
                
            // Controlla se ci sono risultati
            if ($result->num_rows > 0) {
                // Stampa i dati in ogni riga
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["Nome"] . "</td><td>" . $row["Id"] ."</td><td><form action='' method='POST'><input type='hidden' name='id_torretta' value='".$IdTorretta."'><input type='hidden' name='id_attrezzatura' value='".$row["Id"]."'><input type='hidden' name='nome_attrezzatura' value='".$row["Nome"]."'><button class='w-100 btn btn-lg btn-outline-success' type='submit' name='aggiungi' value=''><i class='bi bi-cart-plus'></i></button></form></td></tr>";
                }
            } else {
                echo "<tr><td></td><td><h4>Nessun Attrezzatura trovata</h4></td><td></td></tr>";
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
                    <?php echo "<a href='visualizzatorretta.php?submit=".$IdTorretta."' style='color: gray'>";?>
                    <i class="bi bi-house" style="color: gray"></i>
                    <h4>Indietro</h4>
                    </a>
                </div>
            </td>
            </tr>
        </table>
    </body>
    </html>
