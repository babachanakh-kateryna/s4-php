<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as DB;
use jeuxvideo\models as models;

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

echo "<h2>a. Lister les jeux dont le nom contient « Marine » :</h2>";
$jeuxLikeMarine = models\Game::where('name', 'like', '%Marine%')->get();
foreach ($jeuxLikeMarine as $game) {
    echo $game->name . "<br>";
}

echo "<h2>b. Lister les compagnies installées en France : </h2>";
$compagniesFrance = models\Company::where('location_country', 'France')->get();
foreach ($compagniesFrance as $company) {
    echo $company->name . "<br>";
}

echo "<h2>c. Lister les plateformes dont la base installée est >= 10 000 000 :</h2>";
$platformsBaseInstl = models\Platform::where('install_base', '>=', 10000000)->get();
foreach ($platformsBaseInstl as $platform) {
    echo $platform->name . "<br>";
}

echo "<h2>d. Lister 200 jeux à partir du 21173 ème :</h2>";
$startId = 21173;
$endId = $startId + 199;

$jeuxAPartir = models\Game::where('id', '>=', $startId)
    ->where('id', '<=', $endId)
    ->get();
foreach ($jeuxAPartir as $game) {
    echo $game->name . "<br>";
}