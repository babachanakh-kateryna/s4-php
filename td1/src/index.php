<?php

require_once __DIR__ . '/../vendor/autoload.php';

use mywishlist\models\Item;
use mywishlist\models\Liste;
use Illuminate\Database\Capsule\Manager as DB;

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

//Lister les listes de souhaits
echo "<h2>Listes de souhaits :</h2>";
$listes = Liste::all();
foreach ($listes as $liste) {
    echo "ID : {$liste->no}, Titre : {$liste->titre}, Description : {$liste->description}<br>";
}

//Lister les items
echo "<h2>Elements :</h2>";
$items = Item::all();
foreach ($items as $item) {
    echo "ID : {$item->id}, Nom : {$item->nom}, Prix : {$item->tarif}<br>";
}

//Afficher un item en particulier, dont l'id est passé en paramètre dans l'url
//(test.php?id=1
if (isset($_GET['id'])) {
    $itemId = $_GET['id'];
    $item = Item::find($itemId);

    if ($item) {
        echo "<h2>Elements :</h2>";
        echo "ID : {$item->id}, Nom : {$item->nom}, Description : {$item->descr}, Prix : {$item->tarif}<br>";
    } else {
        echo "Element avec ID {$itemId} non trouve";
    }
}

$newItem = Item::create([
    'nom' => 'New element',
    'descr' => 'Description du nouvel element',
    'img' => null,
    'url' => '',
    'tarif' => 100.00,
    'liste_id' => 1
]);

if ($newItem) {
    echo "<h2>element cree :</h2>";
    echo "ID : {$newItem->id}, Nom : {$newItem->nom}<br>";
} else {
    echo "Erreur lors de la creation de l'element";
}
//
//try {
//    $pdo = new PDO(
//        "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4",
//        $config['username'],
//        $config['password']
//    );
//
//    $stmt = $pdo->query("SELECT * FROM item");
//    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
//    foreach ($items as $item) {
//        echo "ID: {$item['id']}, NOM: {$item['nom']}, PRIX: {$item['tarif']}<br>";
//    }
//    echo "super!";
//} catch (PDOException $e) {
//    echo "err: " . $e->getMessage();
//}