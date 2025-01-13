<?php
	include 'dbconnect.php';
    $db = new dbconnect();
    
    $cookie_name = "user";
    if(!isset($_COOKIE[$cookie_name])) {
            echo "<script>alert('Login Error'); window.location.href='index.html';</script>";
    }

    if(isset($_POST['elimina'])){
        $id = $_POST['id_attrezzatura'];
        $nome = $_POST['nome_attrezzatura'];
        $sql = "DELETE FROM `MEZZIDISOCCORSO` WHERE `Id`='".$id."' AND `Nome`='".$nome."'";
        $result = $db->query($sql);
        echo "<script>window.location.href='mezzidisoccorso.php';</script>";
    }

    if(isset($_POST['aggiungi'])){
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $oggetto=$_POST['oggetto'];
        $id_torretta = $_POST['id_torretta'];
        if($oggetto == "remi"){
            $sql = "UPDATE `MEZZIDISOCCORSO` SET `Remi` = '1' WHERE `Id`='".$id."' AND `Nome`='".$nome."'";
        }else if($oggetto == "salvagente"){
            $sql = "UPDATE `MEZZIDISOCCORSO` SET `Salvagente` = '1' WHERE `Id`='".$id."' AND `Nome`='".$nome."'";
        }else if($oggetto == "ancorotto"){
            $sql = "UPDATE `MEZZIDISOCCORSO` SET `Ancorotto` = '1' WHERE `Id`='".$id."' AND `Nome`='".$nome."'";
        }
        $result = $db->query($sql);
        echo "<script>window.location.href='mezzidisoccorso.php';</script>";
    }

    if(isset($_POST['togli'])){
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $oggetto=$_POST['oggetto'];
        $id_torretta = $_POST['id_torretta'];
        if($oggetto == "remi"){
            $sql = "UPDATE `MEZZIDISOCCORSO` SET `Remi` = '0' WHERE `Id`='".$id."' AND `Nome`='".$nome."'";
        }else if($oggetto == "salvagente"){
            $sql = "UPDATE `MEZZIDISOCCORSO` SET `Salvagente` = '0' WHERE `Id`='".$id."' AND `Nome`='".$nome."'";
        }else if($oggetto == "ancorotto"){
            $sql = "UPDATE `MEZZIDISOCCORSO` SET `Ancorotto` = '0' WHERE `Id`='".$id."' AND `Nome`='".$nome."'";
        }
        $result = $db->query($sql);
        echo "<script>window.location.href='mezzidisoccorso.php';</script>";
    }


    $db->close();
?>
    <!DOCTYPE html>
    <html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="theme-color" media="(prefers-color-scheme: light)" content="#d90000" />
        <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#910303" />
        <title>Elenco Mezzi Di Soccorso</title>
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
            <h1 class="mt-5">Elenco Mezzi Di Soccorso</h1>
            
            <?php
            $db = new dbconnect();
            // Query per ottenere i dati dei dipendenti
            $sql = "SELECT M.Id AS Id, M.Nome AS Nome, M.Remi AS Remi, M.Ancorotto AS Ancorotto, M.Salvagente AS Salvagente, U.IdTorretta AS Torretta FROM MEZZIDISOCCORSO M LEFT JOIN UTILIZZO U ON U.IdMezzoDiSoccorso = M.Id AND U.Nome = M.Nome;";
            $result = $db->query($sql);

            // Inizia la tabella
            echo "<table class='table table-striped mt-3'>";
            echo "<thead><tr><th>Nome</th><th>Id</th><th>Assegnato a</th><th>Remi</th><th>Salvagente</th><th>Ancorotto</th><th>Info</th><th>Elimina</th></tr></thead><tbody>";
                
            // Controlla se ci sono risultati
            if ($result->num_rows > 0) {
                // Stampa i dati in ogni riga
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["Nome"] . "</td><td>" . $row["Id"]."</td>";

                    // Torretta
                    if($row["Torretta"]==NULL){
                        echo "<td>Nessuna Torretta Associata</td>";
                        
                     }else{
                         echo "<td>". $row["Torretta"] ."</td>";
                     }

                    //Componenti Moscone
                    if($row["Nome"] == "Moscone"){
                        if($row["Remi"] == 0){
                            echo "<td><form action='' method='POST'><input type='hidden' name='id' value='".$row['Id']."'><input type='hidden' name='nome' value='".$row['Nome']."'><input type='hidden' name='id_torretta' value='".$row["Torretta"]."'><input type='hidden' name='oggetto' value='remi'><button class='w-100 btn btn-lg btn-outline-primary' type='submit' name='aggiungi'><i class='material-icons'>rowing</i></button></form></td>";
                        }else{
                            echo "<td><form action='' method='POST'><input type='hidden' name='id' value='".$row['Id']."'><input type='hidden' name='nome' value='".$row['Nome']."'><input type='hidden' name='id_torretta' value='".$row["Torretta"]."'><input type='hidden' name='oggetto' value='remi'><button class='w-100 btn btn-lg btn-primary' type='submit' name='togli'><i class='material-icons'>rowing</i></button></form></td>";
                        }
                        if($row["Salvagente"] == 0){
                            echo "<td><form action='' method='POST'><input type='hidden' name='id' value='".$row['Id']."'><input type='hidden' name='nome' value='".$row['Nome']."'><input type='hidden' name='id_torretta' value='".$row["Torretta"]."'><input type='hidden' name='oggetto' value='salvagente'><button class='w-100 btn btn-lg btn-outline-primary' type='submit' name='aggiungi'><i class='material-icons'>support</i></button></form></td>";
                        }else{
                            echo "<td><form action='' method='POST'><input type='hidden' name='id' value='".$row['Id']."'><input type='hidden' name='nome' value='".$row['Nome']."'><input type='hidden' name='id_torretta' value='".$row["Torretta"]."'><input type='hidden' name='oggetto' value='salvagente'><button class='w-100 btn btn-lg btn-primary' type='submit' name='togli'><i class='material-icons'>support</i></button></form></td>";
                        }
                        if($row["Ancorotto"] == 0){
                            echo "<td><form action='' method='POST'><input type='hidden' name='id' value='".$row['Id']."'><input type='hidden' name='nome' value='".$row['Nome']."'><input type='hidden' name='id_torretta' value='".$row["Torretta"]."'><input type='hidden' name='oggetto' value='ancorotto'><button class='w-100 btn btn-lg btn-outline-primary' type='submit' name='aggiungi'><i class='material-icons'>anchor</i></button></form></td>";
                        }else{
                            echo "<td><form action='' method='POST'><input type='hidden' name='id' value='".$row['Id']."'><input type='hidden' name='nome' value='".$row['Nome']."'><input type='hidden' name='id_torretta' value='".$row["Torretta"]."'><input type='hidden' name='oggetto' value='ancorotto'><button class='w-100 btn btn-lg btn-primary' type='submit' name='togli'><i class='material-icons'>anchor</i></button></form></td>";
                        }
                    }else{
                        echo "<td></td><td></td><td></td>";
                    }
                
                    //Bottoni per accedere ai propietari dell'atrezzatura e al magazzino
                    if($row["Torretta"]!=NULL){
                        echo "<td><div type='button' class='btn btn-lg w-100 btn btn-secondary' style='color: white'><a href='visualizzamezzidisoccorso.php?submit=".$row["Torretta"]."' style='color: white'><i class='bi bi-building' style='color: white'></i></a></div></td>";
                    }else{
                        echo "<td></td>";
                    }
                    //Bottone eliminazione
                    echo "<td><form action='' method='POST'><input type='hidden' name='id_attrezzatura' value='".$row["Id"]."'><input type='hidden' name='nome_attrezzatura' value='".$row["Nome"]."'><button class='w-100 btn btn-lg btn-outline-danger' type='submit' name='elimina' value=''><i class='bi bi-trash'></i></button></form></td></tr>";
                }
                echo "<tr><td></td><td></td><td><div type='button' class='well btn btn-primary' style='color: white'><a href='aggiungimezzodisoccorso.php' style='color: white'><i class='bi bi-bag-plus' style='color: white'></i><h4>Aggiungi</h4></a></div></td>";
            }else {
                echo "<tr><td></td><td><h4>Nessun Mezzo trovato</h4></td><td></td></tr>";
                echo "<tr><td></td><td></td><td><div type='button' class='well btn btn-primary' style='color: white'><a href='aggiungimezzodisoccorso.php' style='color: white'><i class='bi bi-bag-plus' style='color: white'></i><h4>Aggiungi</h4></a></div></td>";
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
