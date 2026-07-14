<?php
$chemin = '../livres/room/mon_livre.json';
$data = json_decode(file_get_contents('php://input'), true);
if ($data === null) {
    http_response_code(400);
    echo json_encode(['erreur' => 'Données invalides']);
    exit;
}
file_put_contents($chemin, json_encode($data, JSON_PRETTY_PRINT));
echo json_encode(['succès' => 'Sauvegardé']);
?>