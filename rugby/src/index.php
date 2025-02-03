<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as DB;
use rugby\models as models;

$config = parse_ini_file(__DIR__ . '/conf/conf.ini');

$db = new DB();
$db->addConnection([
    'driver' => $config['driver'],
    'host' => $config['host'],
    'database' => $config['dbname'],
    'username' => $config['username'],
    'password' => $config['password'],
    'charset' => $config['charset'],
    'collation' => $config['collation'],
    'prefix' => '',
]);
$db->setAsGlobal();
$db->bootEloquent();

echo"<h1>a - Donner la liste des équipes, des joueurs, des postes, des arbitres, des stades et des matchs</h1>";

echo "<h3>Liste des équipes:</h3>";
foreach (models\Equipe::all() as $equipe) {
    echo "<strong>ID : </strong> {$equipe->id}, <strong>Code : </strong> {$equipe->codeEquipe}, <strong>Pays : </strong> {$equipe->pays}, <strong> Couleur : </strong> {$equipe->couleur}, <strong> Entraîneur : </strong> {$equipe->entraineur}<br>";
}

echo "<h3>Liste des joueurs:</h3>";
foreach (models\Joueur::all() as $joueur) {
    echo "<strong>ID : </strong> {$joueur->numJoueur}, <strong>Prénom : </strong> {$joueur->prenom}, <strong> Nom : </strong> {$joueur->nom}, <strong> Poste ID : </strong> {$joueur->numPoste}, <strong> Équipe ID : </strong> {$joueur->numEquipe}<br>";
}

echo "<h3>Liste des postes:</h3>";
foreach (models\Poste::all() as $poste) {
    echo "<strong> Numéro : </strong> {$poste->numero}, <strong> Libellé : </strong>{$poste->libelle}<br>";
}

echo "<h3>Liste des arbitres:</h3>";
foreach (models\Arbitre::all() as $arbitre) {
    echo "<strong>ID : </strong> {$arbitre->numArbitre}, <strong>Nom : </strong>{$arbitre->nomArbitre}, <strong>Nationalité : </strong> {$arbitre->nationalite}<br>";
}

echo "<h3>Liste des stades:</h3>";
foreach (models\Stade::all() as $stade) {
    echo "<strong>ID : </strong> {$stade->numStade}, <strong>Ville : </strong>{$stade->ville}, <strong>Nom : </strong> {$stade->nomStade}, <strong>Capacité : </strong> {$stade->capacite}<br>";
}

echo "<h3>Liste des matchs:</h3>";
foreach (models\Matchs::all() as $match) {
    echo "<strong>ID : </strong> {$match->numMatch}, <strong>Date : </strong>{$match->dateMatch}, <strong>Spectateurs : </strong> {$match->nbSpect}, <strong> Stade ID : </strong> {$match->numStade}, <strong>Équipe R ID : </strong> {$match->numEquipeR}, <strong>Score R : </strong> {$match->scoreR}, <strong> Essais R : </strong> {$match->nbEssaisR}, <strong> Équipe D ID : </strong> {$match->numEquipeD}, <strong>Score D : </strong> {$match->scoreD}, <strong>Essais D: </strong> {$match->nbEssaisD}<br>";
}

echo"<h1>b - Rechercher tous les matchs qui se sont déroulés le 2007-09-22 et dans lesquels le score d'une des équipes a dépassé 30 points</h1>";

$matchsFilt = models\Matchs::where('dateMatch', '2007-09-22')
    ->where(function($query) {
        $query->where('scoreR', '>', 30)
            ->orWhere('scoreD', '>', 30);
    })
    ->get();
echo "<h3>Matchs du 2007-09-22 avec un score supérieur à 30 points:</h3>";
foreach ($matchsFilt as $match) {
    echo "<strong>ID : </strong> {$match->numMatch}, <strong>Date : </strong>{$match->dateMatch}, <strong>Spectateurs : </strong> {$match->nbSpect}, <strong> Stade ID : </strong> {$match->numStade}, <strong>Équipe R ID : </strong> {$match->numEquipeR}, <strong>Score R : </strong> {$match->scoreR}, <strong> Essais R : </strong> {$match->nbEssaisR}, <strong> Équipe D ID : </strong> {$match->numEquipeD}, <strong>Score D : </strong> {$match->scoreD}, <strong>Essais D: </strong> {$match->nbEssaisD}<br>";
}

echo"<h1>c - Donner le nombre de postes en 3ème ligne</h1>";
$count = models\Poste::where('libelle', 'like', 'Troisième ligne%')->count();
echo "<strong>Nombre de postes en 3ème ligne : </strong>{$count}";

echo"<h1>d - Donner la liste des stades dont la capacité dépasse 45000 places</h1>";

