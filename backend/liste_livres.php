<?php
header('Content-Type: application/json');
$dossier = '../livres/room/';
$fichiers = glob($dossier . '*.txt');
$livres = array_map(function($chemin) {
    return [
        'titre' => basename($chemin, '.txt'),
        'fichier' => basename($chemin)
    ];
}, $fichiers);
echo json_encode($livres);
?>