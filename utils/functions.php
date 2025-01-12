<?php
function getFilteredArticles($articlesList, $categories, $minPrice, $maxPrice, $formats, $ordinamento) {
    $filteredArticles = [];


    foreach ($articlesList as $article) {
        if (in_array($article['nome_categoria'], $categories) && $article['prezzo'] >= $minPrice && $article['prezzo'] <= $maxPrice && in_array($article['formato'], $formats)) {
            $filteredArticles[] = $article;
        }
        // echo "article_cat: " . $article['nome_categoria'];
        // var_dump($categories);

        // if (in_array($article['nome_categoria'], $categories)) {
        //     $filteredArticles[] = $article;
        // }
    }

    switch ($ordinamento) {
        case 'vendite':
            usort($filteredArticles, function ($a, $b) {
                return intval($b['vendite']) - intval($a['vendite']);
            });
            break;
        case 'prezzoAsc':
            usort($filteredArticles, function ($a, $b) {
                return $a['prezzo'] - $b['prezzo'];
            });
            break;
        case 'prezzoDesc':
            usort($filteredArticles, function ($a, $b) {
                return $b['prezzo'] - $a['prezzo'];
            });
            break;
        default:
            break;
    }

    return $filteredArticles;
}

function showAvailability($nItems) {
    if ($nItems > 20) {
        return "Disponibile";
    } else if ($nItems > 0) {
        return "Ultimi pezzi: " . $nItems;
        // } else if ($nItems > 0) {
        //     return "Sta per terminare";
    } else {
        return "Non disponibile";
    }
}

function logInUser($username) {
    $_SESSION["username"] = $username;
}

function logOutUser() {
    if (isset($_SESSION["username"])) {
        unset($_SESSION["username"]);
    }
    header("location: index.php");
}

function searchArticles($articoli, $searchKey) {
    $outArticoli = [];
    $searchKey = strtolower($searchKey);
    foreach ($articoli as $articolo) {
        if (strpos(strtolower($articolo["nome"]), $searchKey) !== false) {
            $outArticoli[] = $articolo;
        } else if (strpos(strtolower($articolo["descrizione"]), $searchKey) !== false) {
            $outArticoli[] = $articolo;
        }
    }
    return $outArticoli;
}

function calculateTotal($articles) {
    $total = 0;
    foreach ($articles as $article) {
        $total += $article["prezzo"] * $article["quantita"];
    }
    return $total;
}

function getImagePath($category, $imageName) {
    return getImageDir($category) . "/" . $imageName;
}

function getImageDir($category) {
    switch ($category) {
        case "Sogno":
            return DREAMS_DIR;
        case "Ispirazione":
            return INSPIRATIONS_DIR;
        case "Emozione":
            return EMOTIONS_DIR;
        case "Nozione":
            return NOTIONS_DIR;
        default:
            die("Categoria non valida");
    }
}

function getAdminImagePath($action) {
    switch ($action) {
        case "addArticle":
            return ADMIN_DIR . "aggiungi-articolo.png";
        case "modifyArticle":
            return ADMIN_DIR . "modifica-articolo.png";
        case "deleteArticle":
            return ADMIN_DIR . "cancella-articolo.png";
        default:
            die("Azione non valida");
    }
}

function getCategoryImagePath($category) {
    switch ($category) {
        case "Sogno":
            return DREAMS_DIR . "/" . "sogno.png";
        case "Ispirazione":
            return INSPIRATIONS_DIR . "/" . "ispirazione.png";
        case "Emozione":
            return EMOTIONS_DIR . "/" . "emozione.png";
        case "Nozione":
            return NOTIONS_DIR . "/" . "nozione.png";
        default:
            die("Categoria non valida");
    }
}

function checkUserLoggedIn() {
    $ret = isset($_SESSION["username"]);
    if (!$ret) {
        echo json_encode(array("error" => "Not logged in"));
    }
    return $ret;
}

function getTimeInterval($type) {
    switch ($type) {
        case "spedizione":
            return "10 seconds";
        case "consegna":
            return "10 seconds";
        default:
            return "";
    }
}

// https://gist.github.com/james2doyle/33794328675a6c88edd6
// wrapper for json responses
function jsonResponse($code, $message) {
    http_response_code($code);
    header('Content-Type: application/json');
    $status = array(
        200 => '200 OK',
        400 => '400 Bad Request',
        500 => '500 Internal Server Error'
    );
    header('Status: ' . $status[$code]);
    return json_encode(array(
        'status' => $code < 300,
        'message' => $message
    ));
}

function getOrderState($tempo_spedizione, $tempo_consegna) {
    // Ottieni la data e ora attuale
    $now = new DateTime();
    $offset = $now->getOffset(); // Ottieni l'offset del fuso orario
    $offsetDate = (clone $now)->modify("-$offset seconds"); // Applica l'offset
    $data = new DateTime($offsetDate->format('Y-m-d H:i:s')); // Ottieni la data corretta

    // Converte le date in oggetti DateTime
    $tempo_spedizione = new DateTime(str_replace(' ', 'T', $tempo_spedizione));
    $tempo_consegna = new DateTime(str_replace(' ', 'T', $tempo_consegna));

    $result = "";

    // Confronta le date
    if ($data < $tempo_spedizione) {
        $result = "L'ordine è in fase di preparazione";
    } elseif ($data < $tempo_consegna) {
        $result = "L'ordine è in fase di spedizione";
    } else {
        $result = "L'ordine è stato consegnato";
    }

    return $result;
}
