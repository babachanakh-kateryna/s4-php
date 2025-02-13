<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as DB;
use jeuxvideo\models as models;

// connexion à la base de données
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

// ajout du css
echo '<link rel="stylesheet" type="text/css" href="styles.css">';

// question a
echo "<div class='section'>";
echo "<button onclick='this.nextElementSibling.classList.toggle(\"open\")'>a. Lister les jeux dont le nom contient « Marine »</button>";
echo "<div class='content'>";

$jeuxLikeMarine = models\Game::where('name', 'like', '%Marine%')->get();
foreach ($jeuxLikeMarine as $game) {
    echo $game->name . "<br>";
}

echo "</div></div>";

// question b
echo "<div class='section'>";
echo "<button onclick='this.nextElementSibling.classList.toggle(\"open\")'>b. Lister les compagnies installées en France</button>";
echo "<div class='content'>";

$compagniesFrance = models\Company::where('location_country', 'France')->get();
foreach ($compagniesFrance as $company) {
    echo $company->name . "<br>";
}

echo "</div></div>";

// question c
echo "<div class='section'>";
echo "<button onclick='this.nextElementSibling.classList.toggle(\"open\")'>c. Lister les plateformes dont la base installée est >= 10 000 000</button>";
echo "<div class='content'>";

$platformsBaseInstl = models\Platform::where('install_base', '>=', 10000000)->get();
foreach ($platformsBaseInstl as $platform) {
    echo $platform->name . "<br>";
}

echo "</div></div>";

// question d
echo "<div class='section'>";
echo "<button onclick='this.nextElementSibling.classList.toggle(\"open\")'>d. Lister 200 jeux à partir du 21173 ème</button>";
echo "<div class='content'>";

$startId = 21173;
$endId = $startId + 199;

$jeuxAPartir = models\Game::where('id', '>=', $startId)
    ->where('id', '<=', $endId)
    ->get();
foreach ($jeuxAPartir as $game) {
    echo '<strong>ID : </strong> ' . $game->id . ' <strong>Name : </strong> ' . $game->name . "<br>";
}

echo "</div></div>";

// question e
echo "<div class='section'>";
echo "<button onclick='this.nextElementSibling.classList.toggle(\"open\")'>e. Lister les jeux, afficher leur nom et deck, en paginant (taille des pages à 300)</button>";
echo "<div class='content'>";

// ****** TO DO ********

echo "</div></div>";


// question f
echo "<div class='section'>";
echo "<button onclick='this.nextElementSibling.classList.toggle(\"open\")'>f. Afficher (name , deck) les personnages du jeu 12342</button>";
echo "<div class='content'>";

$characters = models\Game::find(12342)->characters()->select('name', 'deck')->get();
foreach ($characters as $character) {
    echo $character->name . " - " . $character->deck . "<br>";
}

echo "</div></div>";

// question g
echo "<div class='section'>";
echo "<button onclick='this.nextElementSibling.classList.toggle(\"open\")'>g. Afficher les personnages des jeux dont le nom (du jeu) débute par « Mario »</button>";
echo "<div class='content'>";

$marioCharacters = models\Character::whereHas('games', function($query) {
    $query->where('name', 'like', 'Mario%');
})->select('name', 'deck')->get();
foreach ($marioCharacters as $character) {
    echo $character->name . " - " . $character->deck . "<br>";
}

echo "</div></div>";

// question h
echo "<div class='section'>";
echo "<button onclick='this.nextElementSibling.classList.toggle(\"open\")'>h. Afficher les jeux développés par une compagnie dont le nom contient « Sony »</button>";
echo "<div class='content'>";

// ****** TO DO ********

echo "</div></div>";

// question i
echo "<div class='section'>";
echo "<button onclick='this.nextElementSibling.classList.toggle(\"open\")'>i. Afficher le rating initial (indiquer le rating board) des jeux dont le nom contient « Mario »</button>";
echo "<div class='content'>";

// ****** TO DO ********

echo "</div></div>";

// question j
echo "<div class='section'>";
echo "<button onclick='this.nextElementSibling.classList.toggle(\"open\")'>j. Afficher les jeux dont le nom débute par « Mario » et ayant plus de 3 personnages</button>";
echo "<div class='content'>";

// ****** TO DO ********

echo "</div></div>";

// question k
echo "<div class='section'>";
echo "<button onclick='this.nextElementSibling.classList.toggle(\"open\")'>k. Afficher les jeux dont le nom débute par « Mario » et dont le rating initial contient « 3+ »</button>";
echo "<div class='content'>";

// ****** TO DO ********

echo "</div></div>";

// question l
echo "<div class='section'>";
echo "<button onclick='this.nextElementSibling.classList.toggle(\"open\")'>l. Afficher les jeux dont le nom débute par « Mario », publiés par une compagnie dont le nom contient « Inc. » et dont le rating initial contient « 3+ »</button>";
echo "<div class='content'>";

// ****** TO DO ********

echo "</div></div>";

// question m
echo "<div class='section'>";
echo "<button onclick='this.nextElementSibling.classList.toggle(\"open\")'>m. Afficher les jeux dont le nom débute par « Mario », publiés par une compagnie dont le nom contient « Inc », dont le rating initial contient « 3+ » et ayant reçu un avis de la part du rating board nommé « CERO » </button>";
echo "<div class='content'>";

// ****** TO DO ********

echo "</div></div>";

// question n
echo "<div class='section'>";
echo "<button onclick='this.nextElementSibling.classList.toggle(\"open\")'>n. Ajouter un nouveau genre de jeu, et l'associer aux jeux 12, 56, 12, 345</button>";
echo "<div class='content'>";

// ****** TO DO ********

echo "</div></div>";