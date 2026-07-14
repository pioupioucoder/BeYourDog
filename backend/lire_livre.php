<?php
header('Content-Type: application/json');
$chemin = '../livres/room/mon_livre.json';
if (file_exists($chemin)) {
    echo file_get_contents($chemin);
} else {
    $default = ['pages' => [['numero' => 1, 'contenu' => 'Bienvenue !']]];
    file_put_contents($chemin, json_encode($default, JSON_PRETTY_PRINT));
    echo json_encode($default);
}
?>