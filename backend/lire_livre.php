<?php
header('Content-Type: application/json');
$fichier = isset($_GET['fichier']) ? $_GET['fichier'] : '';
$chemin = '../livres/room/' . $fichier;
if (!file_exists($chemin) || !preg_match('/\.txt$/', $fichier)) {
    http_response_code(404);
    echo json_encode(['erreur' => 'Livre introuvable']);
    exit;
}
$contenu = file_get_contents($chemin);
// Découpage en pages (soit par séparateur "---PAGE---", soit toutes les 1000 caractères)
if (strpos($contenu, '---PAGE---') !== false) {
    $pages = array_map('trim', explode('---PAGE---', $contenu));
} else {
    // Découpage automatique toutes les 1000 caractères
    $pages = [];
    $longueur = strlen($contenu);
    $taillePage = 1000;
    for ($i = 0; $i < $longueur; $i += $taillePage) {
        $pages[] = substr($contenu, $i, $taillePage);
    }
}
// On ajoute un numéro à chaque page
$pages = array_map(function($texte, $index) {
    return ['numero' => $index+1, 'contenu' => $texte];
}, $pages, array_keys($pages));
echo json_encode(['titre' => basename($fichier, '.txt'), 'pages' => $pages]);
?>