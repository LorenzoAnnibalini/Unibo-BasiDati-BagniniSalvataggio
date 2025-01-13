<?php
    include 'dbconnect.php';
    
    $cookie_name = "user";
    if(!isset($_COOKIE[$cookie_name])) {
            echo "<script>alert('Login Error'); window.location.href='index.html';</script>";
    }

    if(isset($_POST['submit'])){
        $db = new dbconnect();
        $id = $_POST['id'];
        $nome = $_POST['mezzo'];
        $remi = $_POST['remi'];
        $ancorotto = $_POST['ancorotto'];
        $salvagente = $_POST['salvagente'];
        if ($remi == NULL) {
            $remi = 0;
        }
        if ($ancorotto == NULL) {
            $ancorotto = 0;
        }
        if ($salvagente == NULL) {
            $salvagente = 0;
        }
        $sql = "INSERT INTO `MEZZIDISOCCORSO`(`Id`, `Nome`, `Salvagente`, `Ancorotto`, `Remi`) VALUES ('".$id."','".$nome."','".$salvagente."','".$ancorotto."','".$remi."');";
        $result = $db->query($sql);
        echo "<script>window.location.href='mezzidisoccorso.php';</script>";
        $db->close();
    }
?>


<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">

        <!-- Gestione colore barra navigazione browser -->
        <meta name="theme-color" media="(prefers-color-scheme: light)" content="#d90000" />
        <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#910303" />

        <title>Aggiungi Mezzi di Soccorso</title>
        <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@latest/font/bootstrap-icons.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@latest/dist/css/bootstrap.min.css" crossorigin="anonymous">
        <link href="css/aggiungidipendenti.css" rel="stylesheet">
    </head>

    <header>
        <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
            <div class="container-fluid">
                <a class="navbar-brand mb-0 h1" style="color: #d90000;">
                    <img src="./img/logo.png" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">
                    Gestionale Servizio Salvataggio
                </a>
            </div>
        </nav>
    </header>

    <body class="text-center">
    <main class="form-signin">
        <div class="container mt-5">
            <h1 class="w-100 ">Aggiungi Mezzi di Soccorso</h1>
            <form action='' method='POST'>
                <div class="form-floating">
                    <input type="number" class="form-control" name="id" id="id" placeholder="Inserisci ID">
                    <label for="id">Numero</label>
                </div>

                <!-- Campo Select -->
                <div class="form-floating">
                    <select class="form-control" name="mezzo" id="mezzo">
                        <option value="RescueBoard">Rescue Board</option>
                        <option value="Moscone">Moscone</option>
                    </select>
                </div>

                <!-- Campi Aggiuntivi -->
                <div id="additionalFields" class="d-none form-floating">
                    <div class="input-group mb-3">
                        <div clasS="input-group-text">
                            <input type="checkbox" class="form-check-input" id="remi" name="remi" value="1">
                        </div>
                        <label for="remi" class="form-control">Remi</label>
                    </div>
                    <div class="input-group mb-3">
                        <div clasS="input-group-text">
                            <input type="checkbox" class="form-check-input" id="ancorotto" name="ancorotto" value="1">
                        </div>
                        <label for="ancorotto" class="form-control">Ancorotto</label>
                    </div>
                    <div class="input-group mb-3">
                        <div clasS="input-group-text">
                            <input type="checkbox" class="form-check-input" id="salvagente" name="salvagente" value="1">
                        </div>
                        <label for="salvagente" class="form-control">Salvagente</label>
                    </div>
                </div>
                <div class="form-floating">
                    <button class="w-100 btn btn-lg btn-success" type="submit" name="submit">Aggiungi</button>
                    <a href="mezzidisoccorso.php" class="w-100 btn btn-lg btn-light">Indietro</a>
                </div>
            </form>
        </div>
    </main>

    <!-- Script JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectElement = document.getElementById('mezzo');
            const additionalFields = document.getElementById('additionalFields');

            selectElement.addEventListener('change', function() {
                if (this.value === 'Moscone') {
                    additionalFields.classList.remove('d-none');  // Mostra i campi
                } else {
                    additionalFields.classList.add('d-none');  // Nasconde i campi
                }
            });
        });
    </script>

    <!-- Link a Bootstrap JS e dipendenze -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
