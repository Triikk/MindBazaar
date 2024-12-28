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
        case 'venduti':
            usort($filteredArticles, function ($a, $b) {
                return $b['vendite'] - $a['vendite'];
            });
            break;
        case 'asc':
            usort($filteredArticles, function ($a, $b) {
                return $a['prezzo'] - $b['prezzo'];
            });
            break;
        case 'disc':
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
    } else if ($nItems > 10) {
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
    foreach ($articoli as $articolo) {
        if (strpos($articolo["nome"], $searchKey) !== false) {
            $outArticoli[] = $articolo;
        } else if (strpos($articolo["descrizione"], $searchKey) !== false) {
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
