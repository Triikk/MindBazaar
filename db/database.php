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
            "SELECT NA.*, P.*, A.*
            FROM NOTIFICHE_ARTICOLI NA
            JOIN ARTICOLI A ON A.versione = NA.versione_articolo
            JOIN PRODOTTI P ON P.id = NA.id_prodotto
            WHERE NA.username = ?
            AND A.id_prodotto = P.id
            ORDER BY data DESC "
        );

        $stmt->bind_param("s", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrderNotificationsByUserId($userId) {
        $stmt = $this->db->prepare(
            "SELECT NO.*, O.*
            FROM NOTIFICHE_ORDINI NO
            JOIN ORDINI O ON NO.id_ordine = O.id
            WHERE NO.username = ?
                AND NO.data < NOW()
            ORDER BY data DESC "
        );

        $stmt->bind_param("s", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrdersByUsername($username) {
        $stmt = $this->db->prepare(
            "SELECT O.*
            FROM ORDINI O
            WHERE O.username = ?
            ORDER BY O.tempo_ordinazione DESC"
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
        $stmt->bind_param("s", $userId);
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
        if ($stmt->affected_rows <= 0) {
            return false;
        }
        // select articles with quantity <= 0
        $stmt = $this->db->prepare("SELECT * FROM ARTICOLI_IN_CARRELLO WHERE quantita <= 0");
        $stmt->execute();
        $result = $stmt->get_result();
        $articles = $result->fetch_all(MYSQLI_ASSOC);
        if (count($articles) > 0) {
            // delete articles with quantity <= 0
            foreach ($articles as $article) {
                $stmt = $this->db->prepare("DELETE FROM ARTICOLI_IN_CARRELLO WHERE id_prodotto = ? AND versione_articolo = ? AND username = ?");
                $stmt->bind_param("iis", $article["id_prodotto"], $article["versione_articolo"], $article["username"]);
                $stmt->execute();
                if ($stmt->affected_rows === FALSE) {
                    return false;
                }
            }
        }
        return true;
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

    public function removeFromCart($username, $id_prodotto, $versione_articolo) {
        $stmt = $this->db->prepare("DELETE FROM ARTICOLI_IN_CARRELLO WHERE username = ? AND id_prodotto = ? AND versione_articolo = ?");
        $stmt->bind_param("sii", $username, $id_prodotto, $versione_articolo);
        $stmt->execute();
    }

    public function getArticleVersion($id_prodotto, $formato, $durata, $intensita) {
        $stmt = $this->db->prepare("SELECT versione FROM ARTICOLI WHERE id_prodotto = ? AND formato = ? AND durata = ? AND intensita = ?");
        $stmt->bind_param("issi", $id_prodotto, $formato, $durata, $intensita);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC)[0]["versione"];
    }

    public function getArticleInfo($id_prodotto, $formato, $durata, $intensita) {
        $stmt = $this->db->prepare("SELECT * FROM ARTICOLI WHERE id_prodotto = ? AND formato = ? AND durata = ? AND intensita = ?");
        $stmt->bind_param("issi", $id_prodotto, $formato, $durata, $intensita);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            return false;
        }

        return $result->fetch_all(MYSQLI_ASSOC)[0];
    }

    public function getArticle($id_prodotto, $versione) {
        $stmt = $this->db->prepare("SELECT * FROM ARTICOLI JOIN PRODOTTI WHERE id_prodotto = ? AND versione = ? AND id = id_prodotto");
        $stmt->bind_param("ii", $id_prodotto, $versione);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC)[0];
    }

    public function getUsersWithArticleInCart($id_prodotto, $versione) {
        $stmt = $this->db->prepare("SELECT username FROM ARTICOLI_IN_CARRELLO WHERE id_prodotto = ? AND versione_articolo = ?");
        $stmt->bind_param("ii", $id_prodotto, $versione);
        $stmt->execute();
        $result = $stmt->get_result();
        $users = $result->fetch_all(MYSQLI_ASSOC);
        return array_filter(array_column($users, 'username'), function ($username) {
            return !empty($username);
        });
    }

    public function getAdmins() {
        $stmt = $this->db->prepare("SELECT username FROM UTENTI WHERE amministratore = 'Y' || amministratore = 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $users = $result->fetch_all(MYSQLI_ASSOC);
        return array_filter(array_column($users, 'username'), function ($username) {
            return !empty($username);
        });
    }

    public function checkout($username, $articles) {
        // get user cart articles
        /*
        $stmt = $this->db->prepare("SELECT * FROM ARTICOLI_IN_CARRELLO WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $articles = $stmt->get_result();
        $articles = $articles->fetch_all(MYSQLI_ASSOC);
        */
        if (count($articles) == 0) {
            return false;
        }
        $admins = $this->getAdmins();
        // check each products disponibility
        $flag = true;
        foreach ($articles as $article) {
            $stmt = $this->db->prepare("SELECT disponibilita FROM ARTICOLI WHERE id_prodotto = ? AND versione = ?");
            $stmt->bind_param("ii", $article["id_prodotto"], $article["versione_articolo"]);
            $stmt->execute();
            $flag = $stmt->get_result();
            $flag = $flag->fetch_all(MYSQLI_ASSOC)[0]["disponibilita"] >= $article["quantita"];
            if (!$flag) {
                return false;
            }
        }
        // update article disponibility
        foreach ($articles as $article) {
            $stmt = $this->db->prepare("UPDATE articoli SET disponibilita = disponibilita - ? WHERE id_prodotto = ? AND versione = ?");
            $stmt->bind_param("iii", $article["quantita"], $article["id_prodotto"], $article["versione_articolo"]);
            $stmt->execute();
            if ($stmt->affected_rows <= 0) {
                return false;
            }

            // check disponibility and create notification
            $articleInfo = $this->getArticleInfo($article["id_prodotto"], $article["formato"], $article["durata"], $article["intensita"]);
            if ($articleInfo["disponibilita"] <= 0) {
                $users = $this->getUsersWithArticleInCart($articleInfo["id_prodotto"], $articleInfo["versione"]);
                var_dump($users);
                array_merge($users, $admins);
                var_dump($users);
                array_unique($users);
                var_dump($users);
                $this->generateArticleNotificationOnCartTo($articleInfo["id_prodotto"], $articleInfo["versione"], 0, $users);
            }
        }
        // update user cart
        foreach ($articles as $article) {
            $stmt = $this->db->prepare("DELETE FROM ARTICOLI_IN_CARRELLO WHERE username = ? AND id_prodotto = ? AND versione_articolo = ?");
            $stmt->bind_param("sii", $username, $article["id_prodotto"], $article["versione_articolo"]);
            $stmt->execute();
            if ($stmt->affected_rows <= 0) {
                return false;
            }
        }
        // create order
        $stmt = $this->db->prepare("INSERT INTO ORDINI (tempo_ordinazione, tempo_spedizione, tempo_consegna, username) VALUES (?, ?, ?, ?)");
        $tempo_ordinazione = date("Y-m-d H:i:s");
        $tempo_spedizione = date_format(date_add(date_create($tempo_ordinazione), date_interval_create_from_date_string(getTimeInterval("spedizione"))), "Y-m-d H:i:s");
        $tempo_consegna = date_format(date_add(date_create($tempo_ordinazione), date_interval_create_from_date_string(getTimeInterval("consegna"))), "Y-m-d H:i:s");
        $stmt->bind_param("ssss", $tempo_ordinazione, $tempo_spedizione, $tempo_consegna, $username);
        $stmt->execute();
        if ($stmt->affected_rows <= 0) {
            return false;
        }
        // get order id
        $stmt = $this->db->prepare("SELECT id FROM ORDINI WHERE username = ? AND tempo_ordinazione = ?");
        $stmt->bind_param("ss", $username, $tempo_ordinazione);
        $stmt->execute();
        $orderId = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]["id"];
        // create order requests
        foreach ($articles as $article) {
            $stmt = $this->db->prepare("INSERT INTO RICHIESTE (id_ordine, id_prodotto, versione_articolo, quantita) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiii", $orderId, $article["id_prodotto"], $article["versione_articolo"], $article["quantita"]);
            $stmt->execute();
            if ($stmt->affected_rows <= 0) {
                return false;
            }
        }
        // create admin order notification
        foreach ($admins as $user) {
            $stmt = $this->db->prepare("INSERT INTO NOTIFICHE_ORDINI (id_ordine, username, data, lettoYN, tipologia) VALUES (?, ?, ?, 'N', 3)");
            $date = date("Y-m-d H:i:s");
            $stmt->bind_param("iss", $orderId, $user, $date);
            $stmt->execute();
        }
        // create user order notification "spedizione"
        $stmt = $this->db->prepare("INSERT INTO NOTIFICHE_ORDINI (id_ordine, username, data, lettoYN, tipologia) VALUES (?, ?, ?, 'N', 0)");
        $date = date("Y-m-d H:i:s");
        $stmt->bind_param("iss", $orderId, $username, $date);
        $stmt->execute();
        if ($stmt->affected_rows <= 0) {
            return array("msg" => "Error while generating order notification of type 0");
        }
        // create user order notification "consegna"
        $newDate = new DateTime();
        $newDate->modify('+10 seconds');
        $date = $newDate->format('Y-m-d H:i:s');
        $stmt = $this->db->prepare("INSERT INTO NOTIFICHE_ORDINI (id_ordine, username, data, lettoYN, tipologia) VALUES (?, ?, ?, 'N', 1)");
        $stmt->bind_param("iss", $orderId, $username, $date);
        $stmt->execute();
        if ($stmt->affected_rows <= 0) {
            return array("msg" => "Error while generating order notification of type 1");
        }
        return true;
    }

    public function isAdmin($username) {
        $stmt = $this->db->prepare("SELECT amministratore FROM UTENTI WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC)[0]["amministratore"] == 1;
    }

    public function getUnreadANotificationsByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM NOTIFICHE_ARTICOLI WHERE username = ? AND lettoYN = 'N' AND data < NOW()");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getUnreadONotificationsByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM NOTIFICHE_ORDINI WHERE username = ? AND lettoYN = 'N' AND data < NOW()");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function generateOrderNotifications($username) {
        // generate orders notification of type 0: article is sent
        $nNotifications = 0;
        $stmt = $this->db->prepare("
            SELECT *
            FROM ORDINI O
            WHERE O.id NOT IN (SELECT NO.id_ordine AS id FROM NOTIFICHE_ORDINI NO)
            AND O.username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $orders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if (count($orders) > 0) {
            foreach ($orders as $order) {
                if ($order["tempo_spedizione"] <= date("Y-m-d H:i:s")) {
                    $stmt = $this->db->prepare("INSERT INTO NOTIFICHE_ORDINI (id_ordine, username, data, lettoYN, tipologia) VALUES (?, ?, ?, 'N', 0)");
                    $date = date("Y-m-d H:i:s");
                    $stmt->bind_param("iss", $order["id"], $username, $date);
                    $stmt->execute();
                    if ($stmt->affected_rows <= 0) {
                        return array("msg" => "Error while generating order notification of type 0", "nNotifications" => $nNotifications);
                    } else {
                        $nNotifications = $nNotifications + $stmt->affected_rows;
                    }
                }
            }
        }
        // generate order notification of type 1: order has arrived
        $stmt = $this->db->prepare("
            SELECT *
            FROM NOTIFICHE_ORDINI NO, ORDINI O
            WHERE NO.username = ?
            AND NO.id_ordine = O.id
            AND NOT EXISTS (SELECT *
	        FROM NOTIFICHE_ORDINI NORD
            WHERE NORD.username = NO.username
            AND NORD.id_ordine = NO.id_ordine
            AND NORD.tipologia = 1);");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $orders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if (count($orders) > 0) {
            foreach ($orders as $order) {
                if ($order["tempo_consegna"] <= date("Y-m-d H:i:s")) {
                    $stmt = $this->db->prepare("INSERT INTO NOTIFICHE_ORDINI (id_ordine, username, data, lettoYN, tipologia) VALUES (?, ?, ?, 'N', 1)");
                    $date = date("Y-m-d H:i:s");
                    $stmt->bind_param("iss", $order["id"], $username, $date);
                    $stmt->execute();
                    if ($stmt->affected_rows <= 0) {
                        return array("msg" => "Error while generating order notification of type 1", "nNotifications" => $nNotifications);
                    } else {
                        $nNotifications = $nNotifications + $stmt->affected_rows;
                    }
                }
            }
        }
        return array("msg" => "Notifications generated successfully", "nNotifications" => $nNotifications);
    }

    public function readUserNotifications($username) {
        $stmt = $this->db->prepare("UPDATE NOTIFICHE_ARTICOLI SET lettoYN = 'Y' WHERE username = ? AND data < NOW()");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result["nReadANotifications"] = $stmt->affected_rows;

        $stmt = $this->db->prepare("UPDATE NOTIFICHE_ORDINI SET lettoYN = 'Y' WHERE username = ? AND data < NOW()");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = array("nReadONotifications" => $stmt->affected_rows);

        return $result;
    }

    public function addArticle($id_prodotto, $formato, $durata, $intensita, $prezzo, $disponibilita, $versione) {
        $stmt = $this->db->prepare("INSERT INTO ARTICOLI (id_prodotto, formato, durata, intensita, prezzo, disponibilita, versione) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issidii", $id_prodotto, $formato, $durata, $intensita, $prezzo, $disponibilita, $versione);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    public function deleteArticle($id_prodotto, $versione) {

        $stmt = $this->db->prepare("DELETE FROM RICHIESTE WHERE id_prodotto = ? AND versione_articolo = ?");
        $stmt->bind_param("ii", $id_prodotto, $versione);
        $stmt->execute();

        $stmt = $this->db->prepare("DELETE FROM ARTICOLI WHERE id_prodotto = ? AND versione = ?");
        $stmt->bind_param("ii", $id_prodotto, $versione);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    public function isArticlePresent($id_prodotto, $versione) {
        $stmt = $this->db->prepare("SELECT * FROM ARTICOLI WHERE id_prodotto = ? AND versione = ?");
        $stmt->bind_param("ii", $id_prodotto,  $versione);
        $stmt->execute();

        return $stmt->get_result()->num_rows > 0;
    }

    public function addProduct($nome, $descrizione, $immagine, $nome_categoria, $eta_minima) {
        $stmt = $this->db->prepare("INSERT INTO PRODOTTI (nome, descrizione, immagine, nome_categoria, eta_minima) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $nome, $descrizione, $immagine, $nome_categoria, $eta_minima);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    public function isProductPresent($nome) {
        $stmt = $this->db->prepare("SELECT * FROM PRODOTTI WHERE nome = ?");
        $stmt->bind_param("s", $nome);
        $stmt->execute();

        return $stmt->get_result()->num_rows > 0;
    }

    public function updateArticle($id_prodotto, $versione, $disponibilita, $prezzo) {
        // looks if the article is not available
        $articleInfo = $this->getArticle($id_prodotto, $versione);
        $unavailable = false;
        if ($articleInfo["disponibilita"] <= 0) {
            $unavailable = true;
        }

        $stmt = $this->db->prepare("UPDATE ARTICOLI SET disponibilita = ?, prezzo = ? WHERE id_prodotto = ? AND versione = ?");
        $stmt->bind_param("idii", $disponibilita, $prezzo, $id_prodotto, $versione);
        $stmt->execute();

        // if it wasn't available and now it is, create a notification
        if ($unavailable && $disponibilita > 0) {
            $this->generateArticleNotificationOnCart($id_prodotto, $versione, 1);
        } else if (!$unavailable && $disponibilita <= 0) {
            $this->generateArticleNotificationOnCart($id_prodotto, $versione, 0);
        }

        return $stmt->affected_rows > 0;
    }

    public function generateArticleNotificationOnCartTo($id_prodotto, $versione, $tipologia, $users) {
        array_filter($users, function ($username) {
            return !empty($username) || $username != "";
        });
        foreach ($users as $user) {
            $stmt = $this->db->prepare("INSERT INTO NOTIFICHE_ARTICOLI (id_prodotto, versione_articolo, username, data, lettoYN, tipologia) VALUES (?, ?, ?, ?, 'N', ?)");
            $date = date("Y-m-d H:i:s");
            $stmt->bind_param("iissi", $id_prodotto, $versione, $user, $date, $tipologia);
            $stmt->execute();
        }
    }

    public function generateArticleNotificationOnCart($id_prodotto, $versione, $tipologia) {
        $users = $this->getUsersWithArticleInCart($id_prodotto, $versione);
        $this->generateArticleNotificationOnCartTo($id_prodotto, $versione, $tipologia, $users);
    }
}
