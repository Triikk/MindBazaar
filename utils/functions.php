<?php
function getFilteredArticles($articlesList, $categories, $minPrice, $maxPrice, $formats, $ordine) {
    $filteredArticles = [];
    
    
    foreach ($articlesList as $article) {
        if (in_array($article['category'], $categories) && $article['price'] >= $minPrice && $article['price'] <= $maxPrice && in_array($article['format'], $formats)) {
            $filteredArticles[] = $article;
        }
    }
    
    switch ($ordine) {
        case 'venduti':
            usort($filteredArticles, function($a, $b) {
                return $b['vendite'] - $a['vendite'];
            });
            break;
        case 'asc':
            usort($filteredArticles, function($a, $b) {
                return $a['price'] - $b['price'];
            });
            break;
        case 'disc':
            usort($filteredArticles, function($a, $b) {
                return $b['price'] - $a['price'];
            });
            break;
        default:
            break;
    }

    return $filteredArticles;
}
?>