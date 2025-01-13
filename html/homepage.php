<?php

    $cookie_name = "user";
    if(!isset($_COOKIE[$cookie_name])) {
            echo "<script>alert('Login Error'); window.location.href='index.html';</script>";
    }
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="theme-color" media="(prefers-color-scheme: light)" content="#d90000" />
    <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#910303" />
    <title>Home Page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@latest/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@latest/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link href="css/homepage.css" rel="stylesheet">
   
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="button-grid">
                    <div class="button-item">
                        <a href="torrette.php" class="custom-button">
                            <i class="bi bi-map"></i>
                            <h4>Torrette</h4>
                        </a>
                    </div>
                    <div class="button-item">
                        <a href="dipendenti.php" class="custom-button">
                            <i class="bi bi-people-fill"></i>
                            <h4>Dipendenti</h4>
                        </a>
                    </div>
                    <div class="button-item">
                        <a href="magazzini.php" class="custom-button">
                            <i class="bi bi-shop"></i>
                            <h4>Magazzini</h4>
                        </a>
                    </div>
                    <div class="button-item">
                        <a href="attrezzatura.php" class="custom-button">
                            <i class="bi bi-hammer"></i>
                            <h4>Attrezzatura</h4>
                        </a>
                    </div>
                    <div class="button-item">
                        <a href="mezzidisoccorso.php" class="custom-button">
                            <i class="bi bi-truck"></i>
                            <h4>Mezzi Di Soccorso</h4>
                        </a>
                    </div>
                    <div class="button-item">
                        <a href="interventi.php" class="custom-button">
                        <i class='material-icons'>medical_information</i>
                            <h4>Interventi</h4>
                        </a>
                    </div>
                    <div class="button-item">
                        <a href="statisticheinterventi.php" class="custom-button">
                            <i class="bi bi-clipboard2-data"></i>
                            <h4>Statistiche Interventi</h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
