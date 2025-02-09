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

echo '<link rel="stylesheet" type="text/css" href="style.css">';

echo"<div class='question'><h1>a - Donner la liste des équipes, des joueurs, des postes, des arbitres, des stades et des matchs</h1>";

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

echo "</div>";


echo"<div class='question'><h1>b - Rechercher tous les matchs qui se sont déroulés le 2007-09-22 et dans lesquels le score d'une des équipes a dépassé 30 points</h1>";

$matchsFilt = models\Matchs::where('dateMatch', '2007-09-22')
    ->where(function($query) {
        $query->where('scoreR', '>', 30)
            ->orWhere('scoreD', '>', 30);
    })
    ->get();
foreach ($matchsFilt as $match) {
    echo "<strong>ID : </strong> {$match->numMatch}, <strong>Date : </strong>{$match->dateMatch}, <strong>Spectateurs : </strong> {$match->nbSpect}, <strong> Stade ID : </strong> {$match->numStade}, <strong>Équipe R ID : </strong> {$match->numEquipeR}, <strong>Score R : </strong> {$match->scoreR}, <strong> Essais R : </strong> {$match->nbEssaisR}, <strong> Équipe D ID : </strong> {$match->numEquipeD}, <strong>Score D : </strong> {$match->scoreD}, <strong>Essais D: </strong> {$match->nbEssaisD}<br>";
}

echo "</div>";

echo"<div class='question'><h1>c - Donner le nombre de postes en 3ème ligne</h1>";
$count = models\Poste::where('libelle', 'like', 'Troisième ligne%')->count();
echo "<strong>Nombre de postes en 3ème ligne : </strong>{$count}";
echo "</div>";

echo"<div class='question'><h1>d - Donner la liste des stades dont la capacité dépasse 45000 places</h1>";
$stades = models\Stade::where('capacite', '>', 45000)->get();
foreach ($stades as $stade) {
    echo "<strong>ID : </strong> {$stade->numStade}, <strong>Ville : </strong>{$stade->ville}, <strong>Nom : </strong> {$stade->nomStade}, <strong>Capacite : </strong> {$stade->capacite}<br>";
}
echo "</div>";

echo "<div class='question'><h1>e. Donner la liste des joueurs qui occupent le poste de pilier gauche de la première ligne</h1>";
$joueurs = models\Joueur::whereHas('poste', function($query) {
    $query->where('libelle', 'Premiere ligne - Pilier gauche');
})->get();
foreach ($joueurs as $joueur) {
    echo "<strong>ID : </strong> {$joueur->numJoueur}, <strong>Prenom : </strong> {$joueur->prenom}, <strong> Nom : </strong> {$joueur->nom}, <strong> Poste ID : </strong> {$joueur->poste->libelle}, <strong> Equipe ID : </strong> {$joueur->equipe->pays}<br>";
}
echo "</div>";


echo "<div class='question'><h1>f. Donner le poste du joueur Woodcock</h1>";
$joueur = models\Joueur::where('nom', 'Woodcock')->first();
if ($joueur) {
    echo "<strong>Poste du joueur Woodcock : </strong>{$joueur->poste->libelle}";
} else {
    echo "Woodcock n'est pas trouvé.";
}
echo "</div>";

echo "<div class='question'><h1>g. Donner les postes de chaque joueur</h1>";
$joueurs = models\Joueur::with('poste')->get();
foreach ($joueurs as $joueur) {
    echo "<strong>Nom et prenom: </strong>{$joueur->prenom} {$joueur->nom}, <strong>Poste: </strong> {$joueur->poste->libelle}<br>";
}
echo "</div>";

echo "<div class='question'><h1>h. Créer un match dont la date est 2022-12-12 et qui se tiendra au Stade de France</h1>";
$stadeDeFrance = models\Stade::where('nomStade', 'Stade de France')->first();

if ($stadeDeFrance) {
    $match = new models\Matchs;
    $match->dateMatch = '2022-12-12';
    $match->numStade = $stadeDeFrance->numStade;
    $match->save();
    echo "Match créé avec succes";
} else {
    echo "Stade de France n'est pas trouve";
}
echo "</div>";


echo "<div class='question'><h1>i. Afficher les matchs (nummatch, dateMatch et le nom du stade) arbitrés par Marius Jonker</h1>";
$matchs = models\Matchs::whereHas('arbitres', function($query) {
    $query->where('nomArbitre', 'Marius Jonker');
})->get();
foreach ($matchs as $match) {
    echo "<strong>ID : </strong> {$match->numMatch}, <strong>Date : </strong>{$match->dateMatch}, <strong>Stade : </strong> {$match->stade->nomStade}<br>";
}
echo "</div>";

echo "<div class='question'><h1>j. Rechercher les équipes qui recevaient et qui ont été arbitrés par Wayne Barnes</h1>";
$matches = models\Matchs::whereHas('arbitres', function ($query) {
    $query->where('nomArbitre', '=', 'Wayne Barnes');
})->with(['equipeReceveuse'])->get();

foreach ($matches as $match) {
    echo "<strong>ID : </strong> {$match->numMatch}, <strong>Date : </strong>{$match->dateMatch}, <strong>EquipeR : </strong> {$match->equipeReceveuse->pays}<br>";
}
echo "</div>";

echo "<div class='question'><h1>k. Rechercher tous les joueurs de l'équipe Néo-Zélandaise qui ont débuté le match du 2007-09-23 contre l’Ecosse</h1>";
$match = models\Matchs::where('dateMatch', '2007-09-23')
    ->whereHas('equipeDeplacee', function ($query) {
        $query->where('codeEquipe', 'NZL');
    })
    ->whereHas('equipeReceveuse', function ($query) {
        $query->where('codeEquipe', 'SCO');
    })->first();

if ($match) {
    $joueurs = $match->equipeDeplacee->joueurs;
    foreach ($joueurs as $joueur) {
        echo "<strong>ID : </strong> {$joueur->numJoueur}, <strong>Prénom : </strong> {$joueur->prenom}, <strong> Nom : </strong> {$joueur->nom}<br>";
    }
} else {
    echo "Match non trouvé";
}

echo "</div>";

echo "<div class='question'><h1>l. Rechercher les joueurs de l'équipe Néo-Zélandaise qui sont entrés en cours de jeu au cours de la coupe du monde</h1>";
$nzJoueurs = models\Joueur::whereHas('equipe', function ($query) {
    $query->where('codeEquipe', 'NZL');
})->whereHas('jouer', function ($query) {
    $query->where('titulaire', false);
})->get();

foreach ($nzJoueurs as $player) {
    echo "{$player->prenom} {$player->nom}<br>";
}

echo "</div>";

echo "<div class='question'><h1>m. Afficher le nom des joueurs de l'équipe Néo-Zélandaise qui ont joué à la fois contre l’Italie et le Portugal</h1>";
$joueursContreItlPort = models\Joueur::whereHas('equipe', function ($query) {
    $query->where('codeEquipe', 'NZL');
})->whereHas('jouer', function ($query) {
    $query->whereIn('numMatch', function ($subQuery) {
        $subQuery->select('numMatch')->from('matchs')
            ->where('numEquipeD', function ($subQuery) {
                $subQuery->select('id')->from('equipe')
                    ->where('codeEquipe', 'ITA');
            })
            ->orWhere('numEquipeD', function ($subQuery) {
                $subQuery->select('id')->from('equipe')
                    ->where('codeEquipe', 'POR');
            });
    })->groupBy('numJoueur')->havingRaw('COUNT(DISTINCT numMatch) = 2');
})->get();

foreach ($joueursContreItlPort as $player) {
    echo "{$player->prenom} {$player->nom}<br>";
}
echo "</div>";
