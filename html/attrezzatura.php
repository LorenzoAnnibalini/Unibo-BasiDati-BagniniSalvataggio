<?php
	include 'dbconnect.php';
    $db = new dbconnect();
    
    $cookie_name = "user";
    if(!isset($_COOKIE[$cookie_name])) {
            echo "<script>alert('Login Error'); window.location.href='index.html';</script>";
    }

    if(isset($_POST['elimina'])){
        $db = new dbconnect();
        $id = $_POST['id_attrezzatura'];
        $nome = $_POST['nome_attrezzatura'];
        $sql = "DELETE FROM `ATTREZZATURA` WHERE `Id`='".$id."' AND `Nome`='".$nome."'";
        $result = $db->query($sql);
        echo "<script>window.location.href='attrezzatura.php';</script>";
    }

    $db->close();
?>
    <!DOCTYPE html>
    <html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="theme-color" media="(prefers-color-scheme: light)" content="#d90000" />
        <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#910303" />
        <title>Elenco Attrezzatura Totale</title>
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
            <h1 class="mt-5">Elenco Attrezzatura Totale</h1>
            
            <?php
            $db = new dbconnect();
            // Query per ottenere i dati dei dipendenti
            $sql = "SELECT A.Nome AS Attrezzatura,A.Id AS NumeroAttrezzatura, M.Descrizione AS Magazzino, M.Id AS IdMagazzino, U.CodiceFiscale AS Dipendente , P.IdTorretta AS Torretta FROM ATTREZZATURA A  LEFT JOIN CONTIENE C ON A.Nome = C.Nome AND A.Id = C.IdAttrezzatura LEFT JOIN USA U ON A.Nome = U.Nome AND A.Id = U.IdAttrezzatura LEFT JOIN POSSIEDE P ON A.Id = P.IdAttrezzatura AND A.Nome = P.Nome LEFT JOIN MAGAZZINO M ON C.IdMagazzino = M.Id ORDER BY A.Nome;";
            $result = $db->query($sql);

            // Inizia la tabella
            echo "<table class='table table-striped mt-3'>";
            echo "<thead><tr><th>Attrezzatura</th><th>Numero</th><th>Magazzino</th><th>Assegnato a</th><th>Scorciatoie</th><th>Elimina</th></tr></thead><tbody>";
                
            // Controlla se ci sono risultati
            if ($result->num_rows > 0) {
                // Stampa i dati in ogni riga
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["Attrezzatura"] . "</td><td>" . $row["NumeroAttrezzatura"]."</td>";
                    if($row["Magazzino"]==NULL){
                       echo "<td>Nessun Magazzino Associato</td>";
                       
                    }else{
                        echo "<td>" . $row["Magazzino"] ."</td>";
                    }
                    if($row["Dipendente"]!=NULL){
                        echo "<td>" . $row["Dipendente"] ."</td>";
                    }else{
                        if($row["Torretta"]!=NULL){
                            echo "<td>Torretta " . $row["Torretta"] ."</td>";
                        }else{
                            echo "<td>Materiale non assegnatto</td>";
                        }
                    }

                    //Bottoni per accedere ai propietari dell'atrezzatura e al magazzino
                    echo "<td>";
                    if($row["Magazzino"]!=NULL){
                        echo "<div type='button' class='well btn btn-secondary' style='color: white'><a href='visualizzamagazzino.php?submit=".$row["IdMagazzino"]."' style='color: white'><i class='bi bi-house' style='color: white'></i></a></div>";
                     }
                     if($row["Dipendente"]!=NULL){
                        echo "<div type='button' class='well btn btn-secondary' style='color: white'><a href='dipendentiattrezzatura.php?submit=".$row["Dipendente"]."' style='color: white'><i class='bi bi-person-circle' style='color: white'></i></a></div>";
                     }else{
                        if($row["Torretta"]!=NULL){
                             echo "<div type='button' class='well btn btn-secondary' style='color: white'><a href='visualizzatorretta.php?submit=".$row["Torretta"]."' style='color: white'><i class='bi bi-building' style='color: white'></i></a></div>";
                        }
                     }
                     echo "</td>";
                    //Bottone eliminazione
                    echo "<td><form action='' method='POST'><input type='hidden' name='id_attrezzatura' value='".$row["NumeroAttrezzatura"]."'><input type='hidden' name='nome_attrezzatura' value='".$row["Attrezzatura"]."'><button class='w-100 btn btn-lg btn-outline-danger' type='submit' name='elimina' value=''><i class='bi bi-trash'></i></button></form></td></tr>";
                }
                echo "<tr><td></td><td></td><td><div type='button' class='well btn btn-primary' style='color: white'><a href='aggiungiattrezzatura.php' style='color: white'><i class='bi bi-bag-plus' style='color: white'></i><h4>Aggiungi</h4></a></div></td>";
            }else {
                echo "<tr><td></td><td><h4>Nessun Attrezzatura trovata.</h4></td><td></td></tr>";
                echo "<tr><td></td><td></td><td><div type='button' class='well btn btn-primary' style='color: white'><a href='aggiungiattrezzatura.php' style='color: white'><i class='bi bi-bag-plus' style='color: white'></i><h4>Aggiungi</h4></a></div></td>";
            }
            echo "<td><div type='button' class='well btn btn-primary' style='color: white'><a href='visualizzatipologiaattrezzatura.php' style='color: white'><i class='bi bi-list-task' style='color: white'></i><h4>Tipologia</h4></a></div></td></tr>";
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
