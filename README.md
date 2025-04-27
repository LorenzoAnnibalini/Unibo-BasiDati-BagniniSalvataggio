# Unibo-BasiDati-BagniniSalvataggio
**Progetto di Basi di Dati**  
_A.A. 2024/25 – Università di Bologna – Campus di Cesena – Ingegneria e Scienze Informatiche_

---

## 📖 Descrizione

Il progetto consiste nella realizzazione di una **base di dati** per la gestione di un **team di salvataggio**.  
Il sistema permette di:

- Gestire informazioni su **dipendenti**, **torrette**, **attrezzature** e **magazzino**.
- 📦 Aggiungere, spostare o rimuovere materiale tra il magazzino e le torrette.
- 🛠️ Assegnare e modificare **orari di lavoro** dei dipendenti su fasce orarie di un'ora per torretta.
- 📈 Consultare **storici degli interventi** ed estrarre **statistiche** operative.

---

## 🖼️ Immagini

> [!WARNING]  
> **Attenzione:** Tutte le immagini sono state rimosse.  
> Per utilizzare correttamente l'applicativo, è necessario reinserirle nella cartella `/img/`.

---

## 🛠️ Istruzioni per l'uso

1. **Clona o scarica** il progetto.
2. **Predisponi un ambiente web** (es. tramite **XAMPP**).
3. Inserisci tutto il contenuto della cartella `/html/` nella cartella `htdocs/` di XAMPP.
4. Importa il database:

   - Trovi il file `create_database.sql` all'interno della cartella `/db/`.
   - Usa phpMyAdmin o altro strumento per importarlo.

5. Avvia Apache e MySQL da XAMPP.

---

## 🔐 Credenziali di accesso

- **Username:** `test`
- **Password:** `test`

---

## 🗃️ Configurazione Database

Per collegare correttamente il progetto al database, **modifica i seguenti file**:

### 1. `dbconnect.php`

Sostituisci i valori nelle seguenti righe:

```php
private $dbhost = 'localhost'; // oppure IP del server
private $username = 'nome_utente';
private $password = 'password';
private $dbname = 'nome_database';
