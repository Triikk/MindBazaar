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
