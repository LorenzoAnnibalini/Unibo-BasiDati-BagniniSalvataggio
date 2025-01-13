<?php
	include 'dbconnect.php';
    $db = new dbconnect();

    $cookie_name = "user";
    if(!isset($_COOKIE[$cookie_name])) {
            echo "<script>alert('Login Error'); window.location.href='index.html';</script>";
    }

    if(isset($_POST['ricerca'])){
        $anno = $_REQUEST['anno'];
        $dipendente = $_REQUEST['dipendente'];
        $risultato = $_REQUEST['risultato'];
    }else{
        $anno = "";
        $dipendente = "";
        $risultato = "";
    }

    if(isset($_POST['elimina'])){
        $id = $_REQUEST['id'];
        $sql = "DELETE FROM INTERVENTO WHERE Id='".$id."';";
        $result = $db->query($sql);
    }

    $db->close();
?>
    <!DOCTYPE html>
    <html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="theme-color" media="(prefers-color-scheme: light)" content="#d90000" />
        <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#910303" />
        <title>Elenco Interventi</title>
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
            <h1 class="mt-5">Elenco Interventi</h1>
            <!-- Tabella per visualizzare i filtri -->
            <table>
                <tr>
                    <td>
                        <form action="" method="POST">
                            <input type="text" name="anno" placeholder="Anno..." class="form-control">
                            <input type="text" name="dipendente" placeholder="Dipendente CF..." class="form-control">
                            <select name="risultato" class="form-select">
                                <option value="">Tutto...</option>
                                <option value="vivo">Vivo</option>
                                <option value="mortomare">Morto al mare</option>
                                <option value="mortoospedale">Morto in ospedale</option>
                            </select>
                            <button type="submit" name="ricerca" class="btn btn-primary mt-2">Cerca</button>
                        </form>
                    </td>
                </tr>
            </div>
            
            <?php
            $db = new dbconnect();

            // Query per ottenere i dati della ricerca
            if(($anno == "Anno..." || $anno =="" ) && ($dipendente == "Dipendente CF..." || $dipendente=="") && $risultato == ""){
                $sql = "SELECT * FROM INTERVENTO I";
            }else{
                if($dipendente == "Dipendente CF..." || $dipendente == ""){
                    $sql = "SELECT * FROM INTERVENTO I WHERE ";
                }else{
                    $sql = "SELECT * FROM INTERVENTO I LEFT JOIN EFFETTUA E ON I.Id=E.IdIntervento WHERE ";
                    $sql = $sql."E.CodiceFiscale = '".$dipendente."'";
                }
                if($anno == "Anno..." || $anno == "" ){
                }else{
                    if($dipendente == "Dipendente CF..." || $dipendente ==""){
                        $sql = $sql."I.Anno = '".$anno."'";
                    }else{
                        $sql = $sql." AND I.Anno = '".$anno."'";
                    }
                }
                if($risultato == ""){
                }else{
                    if(($anno == "Anno..." || $anno == "" ) && ($dipendente == "Dipendente CF..." || $dipendente =="")){
                        $sql = $sql." I.Risultato = '".$risultato."'";
                    }else{
                        $sql = $sql." AND I.Risultato = '".$risultato."'";
                    }
                }
            }
            $sql = $sql.";";
            $result = $db->query($sql);

            // Inizia la tabella
            echo "<table class='table table-striped mt-3'>";
            echo "<thead><tr><th>Id</th><th>Anno</th><th>Luogo</th><th>Risultato</th><th>Descrizione</th><th>Info</th><th>Elimina</th></tr></thead><tbody>";
                
            // Controlla se ci sono risultati
            if ($result->num_rows > 0) {
                // Stampa i dati in ogni riga
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["Id"] . "</td><td>" . $row["Anno"]."</td><td>".$row["Luogo"]."</td><td>".$row["Risultato"]."</td><td>".$row["Descrizione"]."</td>";

                    //Bottone Info
                    echo "<td><form action='infointervento.php?submit=".$row["Id"]."' method='POST'><input type='hidden' name='id_intervento' value='".$row["Id"]."'><button class='w-100 btn btn-lg btn-primary' type='submit' name='info' value=''><i class='bi bi-info-circle'></i></button></form></td>";
                    //Bottone eliminazione
                    echo "<td><form action='' method='POST'><input type='hidden' name='id' value='".$row["Id"]."'><button class='w-100 btn btn-lg btn-outline-danger' type='submit' name='elimina' value=''><i class='bi bi-trash'></i></button></form></td></tr>";
                }
                echo "<tr><td></td><td></td><td><div type='button' class='well btn btn-primary' style='color: white'><a href='aggiungiintervento.php' style='color: white'><i class='bi bi-bag-plus' style='color: white'></i><h4>Aggiungi</h4></a></div></td>";
            }else {
                echo "<tr><td></td><td><h4>Nessun Intervento trovato</h4></td><td></td></tr>";
                echo "<tr><td></td><td></td><td><div type='button' class='well btn btn-primary' style='color: white'><a href='aggiungiintervento.php' style='color: white'><i class='bi bi-bag-plus' style='color: white'></i><h4>Aggiungi</h4></a></div></td>";
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
