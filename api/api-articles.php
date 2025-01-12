<?php
require_once '../bootstrap.php';
header('Content-Type: application/json');

if (isset($_REQUEST["query"])) {
    // var_dump($_REQUEST);
    foreach ($_REQUEST as $key => $value) {
        $_SESSION[$key] = $value;
    }
    switch ($_REQUEST["query"]) {
        case "getProducts":
            $prodotti = $dbh->getProducts();
            echo jsonResponse(200, $prodotti);
            break;
        case "addArticle":
            if (isset($_REQUEST["id_prodotto"]) && isset($_REQUEST["formato"]) && isset($_REQUEST["durata"]) && isset($_REQUEST["prezzo"]) && isset($_REQUEST["intensita"]) && isset($_REQUEST["disponibilita"]) && isset($_REQUEST["versione"])) {
                $id_prodotto = $_REQUEST["id_prodotto"];
                $formato = $_REQUEST["formato"];
                $durata = $_REQUEST["durata"];
                $prezzo = $_REQUEST["prezzo"];
                $intensita = $_REQUEST["intensita"];
                $disponibilita = $_REQUEST["disponibilita"];
                $versione = $_REQUEST["versione"];
                if ($dbh->isArticlePresent($id_prodotto, $versione)) {
                    echo jsonResponse(400, "Articolo già presente");
                } else {
                    $dbh->addArticle($id_prodotto, $formato, $durata, $intensita, $prezzo, $disponibilita, $versione);
                    echo jsonResponse(200, "Articolo aggiunto con successo");
                }
            } else {
                echo jsonResponse(400, "Missing parameters");
            }
            break;
        case "addProduct":
            if (isset($_FILES["immagine"]) && isset($_REQUEST["nome_categoria"])) {
                $uploadPath = "../" . getCategoryImageDir($_REQUEST["nome_categoria"]);
                $imageName = basename($_FILES["immagine"]["name"]);
                $tmpName = $_FILES["immagine"]["tmp_name"];

                $maxMB = 8;
                $imageSize = getimagesize($tmpName);
                if ($imageSize === false) {
                    echo jsonResponse(400, "File non valido (non è un'immagine)");
                    return;
                }
                if ($_FILES["immagine"]["size"] > $maxMB * 1024 * 1024) {
                    echo jsonResponse(400, "File di dimensione superata a quella massima consentita ($maxMB MB)");
                    return;
                }
                $acceptedExtensions = array("jpg", "jpeg", "png", "gif");
                $imageFileType = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
                if (!in_array($imageFileType, $acceptedExtensions)) {
                    echo jsonResponse(400, "L'estensione dell'immagine non è tra quelle consentite: " . implode(",", $acceptedExtensions));
                }
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                if (move_uploaded_file($tmpName, $uploadPath . $imageName)) {
                    echo jsonResponse(200, "Immagine salvata con successo");
                } else {
                    echo jsonResponse(400, "Errore durante il salvataggio dell'immagine");
                }
            } else if (isset($_REQUEST["nome"]) && isset($_REQUEST["descrizione"]) && isset($_REQUEST["immagine"]) && isset($_REQUEST["nome_categoria"]) && isset($_REQUEST["eta_minima"])) {
                $nome = $_REQUEST["nome"];
                $descrizione = $_REQUEST["descrizione"];
                $immagine = $_REQUEST["immagine"];
                $nome_categoria = $_REQUEST["nome_categoria"];
                $eta_minima = $_REQUEST["eta_minima"];
                if ($dbh->isProductPresent($nome)) {
                    echo jsonResponse(400, "Prodotto già presente " . " nome: " . $nome);
                    // TODO cancellare l'immagine se presente (non lo faro')
                } else {
                    $dbh->addProduct($nome, $descrizione, $immagine, $nome_categoria, $eta_minima);
                    echo jsonResponse(200, "Prodotto aggiunto con successo");
                }
            } else {
                echo jsonResponse(400, "Missing parameters");
            }
            break;
        case "getArticleVersion":
            if (isset($_REQUEST["id_prodotto"]) && isset($_REQUEST["formato"]) && isset($_REQUEST["durata"]) && isset($_REQUEST["intensita"])) {
                $id_prodotto = $_REQUEST["id_prodotto"];
                $formato = $_REQUEST["formato"];
                $durata = $_REQUEST["durata"];
                $intensita = $_REQUEST["intensita"];
                $versione = $dbh->getArticleVersion($id_prodotto, $formato, $durata, $intensita);
                echo jsonResponse(200, $versione);
            } else {
                echo jsonResponse(400, "Missing parameters");
            }
            break;
        default:
            echo jsonResponse(400, "Invalid query");
            break;
    }
} else {
    echo jsonResponse(400, "`query` field not set");
}
