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
    public function getBestSeller($numBS) {
        $stmt = $this->db->prepare(
            "SELECT nome, descrizione, eta_minima, immagine, nome_categoria, id, numVendite 
                    FROM PRODOTTI, RICHIESTE ON id_prodotto = id 
                    GROUP BY id 
                    HAVING SUM(quantita) AS numVendite
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

    public function getNotificationsByUserId($userId) {
        $stmt = $this->db->prepare(
            "(SELECT NA.lettoYN, NA.data AS data, NA.tipologia, NA.id 
                    FROM NOTIFICHE_ARTICOLI NA, UTENTI U ON NA.username = U.username 
                    WHERE U.username = ?) 
                    UNION 
                    (SELECT NU.lettoYN, NU.data AS data, NU.tipologia, NU.id 
                    FROM NOTIFICHE_UTENTI NU, UTENTI U ON NU.username = U.username 
                    WHERE U.username = ?) 
                    ORDER BY data DESC "
        );

        $stmt->bind_param("ii", $userId, $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrdersById($userId) {
        $stmt = $this->db->prepare("SELECT * FROM ORDINI WHERE username = ?");

        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getDetailedOrdersById($userId) {
        $stmt = $this->db->prepare("SELECT O.id, O.quantita, A.id_prodotto, A.versione 
                    FROM ORDINI O, RICHIESTE R, ARTICOLO A
                    WHERE username = ?
                    AND O.id = R.id_ordine
                    AND A.id_prodotto = R.id_prodotto
                    AND A.versione = R.versione_articolo
                    GROUP BY O.id
                    ORDER BY O.tempo_ordinazione DESC
        ");

        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getArticlesInBasketById($userId) {
        $stmt = $this->db->prepare("SELECT * FROM ARTICOLI_IN_CARRELLO WHERE username = ?");

        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

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
        $stmt = $this->db->prepare("SELECT A.*, P.nome_categoria, (SELECT IFNULL(SUM(R.quantita), 0)
                                FROM ARTICOLI A, RICHIESTE R
                                WHERE A.versione = R.versione_articolo 
                                    AND P.id = R.id_prodotto
                                GROUP BY A.id_prodotto, A.versione) as vendite, P.nome, P.descrizione, P.eta_minima, P.immagine 
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
}
