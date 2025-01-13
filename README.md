# Unibo-BasiDati-BagniniSalvataggio
Progetto per una Base di Dati A.A. 2024/25

# Descrizione 
Si vuole realizzare un database per la gestione di un team di salvataggio.
Pertanto, la base di dati dovrà immagazzinare informazioni relative ai dipendenti, alle
torrette, alle attrezzature e al magazzino dell’azienda che gestisce il team.
I responsabili della gestione potranno consultare tutte le informazioni relative ai dipendenti,
torrette e materiale, potranno spostare, aggiungere e togliere il materiale dal magazzino,
torrette e dipendenti; potranno aggiungere e cambiare gli orari per ogni singola torretta
aggiungendo e togliendo i dipendenti a fasce orarie di un’ora l’una ed infine potranno gestire
lo storico degli interventi effettuati e visualizzare i relativi dati statistici.

# IMMAGINI
>[!WARNING] 
> Tutte le immagini presenti nel progetto sono state tolte, per utilizzare l'applicativo inserirle nuovamente nella cartella img.

# Istruzioni
Le credenziali di login sono user: "test" ; psw: "test" .

All'interno della cartella html è possibile trovare tutto il sorgente dell'applicativo, per eseguire il progetto bisogna predisporre un ambiente web >utilizzando XAMPP.
Il database (già popolato con qualche dato di prova) è presente nel file "create_database.sql" all'interno della cartella db.

# Credenziali DB
Bisogna modificare due file per far funzionare l'applicativo con il proprio db

Il primo file da modificare è dbconnect andando a completare le seguenti righe
>    private $dbhost = 'localhost or IPAddress';
>
>    private $username = 'user';
>
>    private $password = 'psw';
>
>    private $dbname = 'db_name';

Il secondo file è login.php sotto il commento "Connessione al database con PDO" completando la seguente riga
>    $db = new PDO("mysql:host=localhost;dbname=db_name", "", "");
