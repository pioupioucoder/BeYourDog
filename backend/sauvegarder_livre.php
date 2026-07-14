<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
if (!$data || !isset($data['fichier']) || !isset($data['contenu'])) {
    http_response_code(400);
    echo json_encode(['erreur' => 'Données invalides']);
    exit;
}
$fichier = $data['fichier'];
$chemin = '../livres/room/' . $fichier;
if (!preg_match('/\.txt$/', $fichier)) {
    http_response_code(400);
    echo json_encode(['erreur' => 'Nom de fichier invalide']);
    exit;
}
// On reconstitue le texte complet en joignant les pages avec le séparateur
$contenu = implode("---PAGE---\n", $data['contenu']);
file_put_contents($chemin, $contenu);
echo json_encode(['succès' => 'Sauvegardé']);
?>