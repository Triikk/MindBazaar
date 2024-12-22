<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }        
    }

    public function getProducts(){
        $stmt = $this->db->prepare("SELECT * FROM PRODOTTI ORDER BY RAND()");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // bestseller viene inteso come il prodotto più venduto, senza considerare 
    // differenze di versioni. Si potrebbe considerare il bestseller come 
    // l'articolo più venduto
    public function getBestSeller($numBS){
        $stmt = $this->db->prepare(
            "SELECT nome, descrizione, eta_minima, immagine, nome_categoria, id, numVendite 
                    FROM PRODOTTI, RICHIESTE ON id_prodotto = id 
                    GROUP BY id 
                    HAVING SUM(quantita) AS numVendite
                    ORDER BY numVendite 
                    LIMIT ? ");

        $stmt->bind_param('i',$numBS);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategories(){
        $stmt = $this->db->prepare(
            "SELECT * FROM CATEGORIE");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNotificationsByUserId($userId){
        $stmt = $this->db->prepare(
            "(SELECT NA.lettoYN, NA.data AS data, NA.tipologia, NA.id 
                    FROM NOTIFICHE_ARTICOLI NA, UTENTI U ON NA.username = U.username 
                    WHERE U.username = ?) 
                    UNION 
                    (SELECT NU.lettoYN, NU.data AS data, NU.tipologia, NU.id 
                    FROM NOTIFICHE_UTENTI NU, UTENTI U ON NU.username = U.username 
                    WHERE U.username = ?) 
                    ORDER BY data DESC ");

        $stmt->bind_param("ii", $userId, $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
        
    }

    public function getOrdersById($userId){
        $stmt = $this->db->prepare("SELECT * FROM ORDINI WHERE username = ?");

        $stmt->bind_param("ii", $userId, $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getArticlesInBasketById($userId){
        $stmt = $this->db->prepare("SELECT * FROM ARTICOLI_IN_CARRELLO WHERE username = ?");

        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getArticlesByProductId($productId){
        $stmt = $this->db->prepare("SELECT * FROM ARTICOLI WHERE id_prodotto = ?");

        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserInfo($userId){
        $stmt = $this->db->prepare("SELECT * FROM UTENTI WHERE username = ?");

        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getArticles(){
        $stmt = $this->db->prepare("SELECT A.*, P.categoria, SUM(R.quantita) as vendite
                                    FROM ARTICOLI as A, PRODOTTI as P, RICHIESTE as R
                                    WHERE A.id_prodotto = P.id
                                        AND A.id_richiesta = R.id
                                    GROUP BY A.id_prodotto, A.versione");

        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    

    }
?>