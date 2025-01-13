<?php

$user=$_POST['user'];
$password=$_POST['password'];
$cookie_name = "user";

 // Connessione al database con PDO
try {
    $db = new PDO("mysql:host=localhost;dbname=db_name", "", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Errore di connessione: " . $e->getMessage();
    exit;
}

// Query preparata
$sql = "SELECT ID FROM USERS WHERE Username = :username AND Password = :password";
$stmt = $db->prepare($sql);

// Bind dei parametri
$stmt->bindParam(':username', $user, PDO::PARAM_STR);
$stmt->bindParam(':password', $password, PDO::PARAM_STR);

// Esecuzione della query
$stmt->execute();

// Verifica se ci sono risultati
if ($stmt->rowCount() > 0) {
    header('Location: homepage.php');
    setcookie($cookie_name, $user, time() + (1 * 300), "/");
    exit;
} else {
    echo "<script>alert('Login Error'); window.location.href='index.html';</script>";
}


?>