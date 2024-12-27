<?php
class DatabaseHelper {
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port) {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getProducts() {
        $stmt = $this->db->prepare("SELECT * FROM PRODOTTI ORDER BY RAND()");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // bestseller viene inteso come il prodotto più venduto, senza considerare 
    // differenze di versioni. Si potrebbe considerare il bestseller come 
    // l'articolo più venduto
    public function getBestSellers($numBS) {
        $stmt = $this->db->prepare(
            "SELECT nome, descrizione, eta_minima, immagine, nome_categoria, id, SUM(quantita) AS numVendite
                    FROM PRODOTTI JOIN RICHIESTE ON id_prodotto = id 
                    GROUP BY id 
                    ORDER BY numVendite 
                    LIMIT ? "
        );

        $stmt->bind_param('i', $numBS);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategories() {
        $stmt = $this->db->prepare(
            "SELECT * FROM CATEGORIE"
        );
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getArticleNotificationsByUserId($userId) {
        $stmt = $this->db->prepare(
            "SELECT NOR.*, P.*, A.*
            FROM NOTIFICHE_ORDINI NOR JOIN UTENTI U ON NOR.username = U.username
            JOIN RICHIESTE R ON NOR.id_ordine = R.id_ordine
            JOIN ARTICOLI A ON A.id_prodotto = R.id_prodotto
            JOIN PRODOTTI P ON P.id = A.id_prodotto
            AND A.versione = R.versione_articolo
            WHERE U.username = ?
            ORDER BY data DESC "
        );

        $stmt->bind_param("s", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrderNotificationsByUserId($userId) {
        $stmt = $this->db->prepare(
            "SELECT NU.*, O.*
            FROM NOTIFICHE_ORDINI NU JOIN UTENTI U ON NU.username = U.username
            JOIN ORDINI O ON NU.id_ordine = O.id
            WHERE U.username = ?
            ORDER BY data DESC "
        );

        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrdersByUsername($username) {
        $stmt = $this->db->prepare(
            "SELECT O.*
            FROM ORDINI O
            WHERE O.username = ?"
        );

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getArticlesByOrderId($orderId) {
        $stmt = $this->db->prepare(
            "SELECT A.*, P.*, R.*, O.*
            FROM ARTICOLI A JOIN RICHIESTE R
            ON R.id_prodotto = A.id_prodotto
            JOIN PRODOTTI P ON P.id = A.id_prodotto
            JOIN ORDINI O ON O.id = R.id_ordine
            WHERE R.versione_articolo = A.versione
            AND R.id_ordine = ?"
        );
        $stmt->bind_param("s", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // public function getDetailedOrdersById($userId) {
    //     $stmt = $this->db->prepare("SELECT O.id, O.quantita, A.id_prodotto, A.versione 
    //                 FROM ORDINI O, RICHIESTE R, ARTICOLO A
    //                 WHERE username = ?
    //                 AND O.id = R.id_ordine
    //                 AND A.id_prodotto = R.id_prodotto
    //                 AND A.versione = R.versione_articolo
    //                 GROUP BY O.id
    //                 ORDER BY O.tempo_ordinazione DESC
    //     ");

    //     $stmt->bind_param("i", $userId);
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     return $result->fetch_all(MYSQLI_ASSOC);
    // }

    // public function getArticlesInBasketById($userId) {
    //     $stmt = $this->db->prepare("SELECT * FROM ARTICOLI_IN_CARRELLO WHERE username = ?");

    //     $stmt->bind_param("i", $userId);
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     return $result->fetch_all(MYSQLI_ASSOC);
    // }

    public function getArticlesByProductId($productId) {
        $stmt = $this->db->prepare("SELECT * FROM ARTICOLI WHERE id_prodotto = ?");

        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserInfo($userId) {
        $stmt = $this->db->prepare("SELECT * FROM UTENTI WHERE username = ?");

        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getArticles() {
        $stmt = $this->db->prepare("SELECT A.*, P.nome_categoria, IFNULL((SELECT SUM(RI.quantita)
                                FROM ARTICOLI AI, RICHIESTE RI
                                WHERE AI.versione = RI.versione_articolo 
                                    AND AI.id_prodotto = RI.id_prodotto
                                    AND AI.id_prodotto = A.id_prodotto
                                    AND AI.versione = A.versione 
                                GROUP BY AI.id_prodotto, AI.versione), 0) as vendite, P.nome, P.descrizione, P.eta_minima, P.immagine 
                FROM ARTICOLI A, PRODOTTI P
                WHERE A.id_prodotto = P.id
                GROUP BY A.id_prodotto, A.versione");

        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFormats() {
        $stmt = $this->db->prepare("SELECT DISTINCT formato FROM ARTICOLI");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCartArticles($userId) {
        $stmt = $this->db->prepare("SELECT A.*, AC.*, P.nome_categoria, P.nome, P.descrizione, P.eta_minima, P.immagine 
                FROM ARTICOLI_IN_CARRELLO AC, PRODOTTI P, ARTICOLI A
                WHERE AC.id_prodotto = P.id AND AC.username = ?
                AND A.id_prodotto = P.id AND A.versione = AC.versione_articolo");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkLogin($username, $password) {
        $stmt = $this->db->prepare("SELECT password FROM UTENTI WHERE username = ? LIMIT 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            return false;
        }
        $storedPassword = $result->fetch_all(MYSQLI_ASSOC)[0]["password"];
        return password_verify($password, $storedPassword);
    }

    public function checkUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM UTENTI WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }

    public function registerUser($username, $nome, $cognome, $data_nascita, $password) {
        $admin = 0;
        $stmt = $this->db->prepare("INSERT INTO UTENTI (username, nome, cognome, data_nascita, password, amministratore) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $username, $nome, $cognome, $data_nascita, $password, $admin);
        $result = $stmt->execute();

        return $result;
    }

    public function modifyCartAmount($id_prod, $quantita, $username, $versione_articolo) {
        $id_prod = (int)$id_prod;
        $quantita = (int)$quantita;
        $versione_articolo = (int)$versione_articolo;

        $stmt = $this->db->prepare("
            UPDATE ARTICOLI_IN_CARRELLO
            SET quantita = ?
            WHERE id_prodotto = ?
            AND versione_articolo = ?
            AND username = ?
        ");
        $stmt->bind_param("iiis", $quantita, $id_prod, $versione_articolo, $username);
        $stmt->execute();
    }

    public function getUserDataByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM UTENTI WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addToCart($username, $id_prodotto, $versione_articolo, $quantita) {
        $stmt = $this->db->prepare("SELECT quantita FROM ARTICOLI_IN_CARRELLO WHERE username = ? AND id_prodotto = ? AND versione_articolo = ?");
        $stmt->bind_param("sii", $username, $id_prodotto, $versione_articolo);
        $stmt->execute();
        $result = $stmt->get_result();

        // se l'articolo è già presente nel carrello, aggiorna la quantità
        if ($result && $result->num_rows > 0) {
            $quantita += $result->fetch_all(MYSQLI_ASSOC)[0]["quantita"];
            $this->modifyCartAmount($id_prodotto, $quantita, $username, $versione_articolo);
            return;
        }

        $stmt = $this->db->prepare("INSERT INTO ARTICOLI_IN_CARRELLO (username, id_prodotto, versione_articolo, quantita) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siii", $username, $id_prodotto, $versione_articolo, $quantita);
        $stmt->execute();
    }

    public function getArticleVersion($id_prodotto, $formato, $durata, $intensita) {
        $stmt = $this->db->prepare("SELECT versione FROM ARTICOLI WHERE id_prodotto = ? AND formato = ? AND durata = ? AND intensita = ?");
        $stmt->bind_param("issi", $id_prodotto, $formato, $durata, $intensita);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC)[0]["versione"];
    }
}
