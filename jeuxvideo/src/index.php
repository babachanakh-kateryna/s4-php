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

// requête
$jeuxLikeMarine = models\Game::where('name', 'like', '%Marine%')->get();

// affichage des resultats
foreach ($jeuxLikeMarine as $game) {
    echo htmlspecialchars($game->name) . "<br>";
}

echo "</div></div>";

// question b
echo "<div class='section'>";
echo "<button onclick='this.nextElementSibling.classList.toggle(\"open\")'>b. Lister les compagnies installées en France</button>";
echo "<div class='content'>";

// requête
$compagniesFrance = models\Company::where('location_country', 'France')->get();

// affichage des resultats
foreach ($compagniesFrance as $company) {
    echo "<strong>Nom : </strong>" . htmlspecialchars($company->name) . "<strong> Country :  </strong>" . htmlspecialchars($company->location_country) ."<br>";
}

echo "</div></div>";

// question c
echo "<div class='section'>";
echo "<button onclick='this.nextElementSibling.classList.toggle(\"open\")'>c. Lister les plateformes dont la base installée est >= 10 000 000</button>";
echo "<div class='content'>";

// requête
$platformsBaseInstl = models\Platform::where('install_base', '>=', 10000000)->get();

// affichage des resultats
foreach ($platformsBaseInstl as $platform) {
    echo htmlspecialchars($platform->name) . ", la base installée est " . htmlspecialchars($platform->install_base) ."<br>";
}

echo "</div></div>";

// question d
echo "<div class='section'>";
echo "<button onclick='this.nextElementSibling.classList.toggle(\"open\")'>d. Lister 200 jeux à partir du 21173 ème</button>";
echo "<div class='content'>";

// requête
$startId = 21173;
$endId = $startId + 199;

$jeuxAPartir = models\Game::where('id', '>=', $startId)
    ->where('id', '<=', $endId)
    ->get();

// affichage des resultats
foreach ($jeuxAPartir as $game) {
    echo '<strong>ID : </strong> ' . htmlspecialchars($game->id) . ' <strong>Name : </strong> ' . htmlspecialchars($game->name) . "<br>";
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

// requête
$characters = models\Game::find(12342)->characters()->select('name', 'deck')->get();

// affichage des resultats
foreach ($characters as $character) {
    echo htmlspecialchars($character->name) . " - " . htmlspecialchars($character->deck) . "<br>";
}

echo "</div></div>";

// question g
echo "<div class='section'>";
echo "<button onclick='this.nextElementSibling.classList.toggle(\"open\")'>g. Afficher les personnages des jeux dont le nom (du jeu) débute par « Mario »</button>";
echo "<div class='content'>";

// requête
$personnagesMario = models\Character::whereHas('games', function ($query) {
    $query->where('name', 'like', 'Mario%'); // on filtre les jeux dont le nom commence par "Mario"
})
    ->with(['games' => function ($query) {
        $query->where('name', 'like', 'Mario%'); // on charge uniquement les jeux "Mario"
    }])
    ->get();

// affichage des resultats
if ($personnagesMario->isEmpty()) {
    echo "Aucun personnage trouve";
} else {
    foreach ($personnagesMario as $character) {
        echo "<br><strong>Nom du personnage:</strong> " . htmlspecialchars($character->name) . "<br>";

        foreach ($character->games as $game) {
            echo "<strong>Apparaît dans:</strong> " . htmlspecialchars($game->name) . "<br>";
        }
    }
}

echo "</div></div>";

// question h
echo "<div class='section'>";
echo "<button onclick='this.nextElementSibling.classList.toggle(\"open\")'>h. Afficher les jeux développés par une compagnie dont le nom contient « Sony »</button>";
echo "<div class='content'>";

// requête
$games_q_h = models\Game::whereHas('developers', function ($query) {
    $query->where('name', 'like', '%Sony%'); // on filtre les compagnies contenant "Sony"
})
    ->with(['developers' => function ($query) {
        $query->where('name', 'like', '%Sony%'); // on charge uniquement les développeurs "Sony"
    }])
    ->get();

// affichage des resultats
if ($games_q_h->isEmpty()) {
    echo "Aucun jeu trouve";
} else {
    foreach ($games_q_h as $game) {
        echo "<br><strong>Nom du jeu:</strong> " . htmlspecialchars($game->name) . "<br>";

        // Affichage des développeurs du jeu
        foreach ($game->developers as $developer) {
            echo "<strong>Développé par:</strong> " . htmlspecialchars($developer->name) . "<br>";
        }
    }
}


echo "</div></div>";

// question i
echo "<div class='section'>";
echo "<button onclick='this.nextElementSibling.classList.toggle(\"open\")'>i. Afficher le rating initial (indiquer le rating board) des jeux dont le nom contient « Mario »</button>";
echo "<div class='content'>";

// requête
$games_q_i = models\Game::where('name', 'like', '%Mario%')
    ->with(['ratings.ratingBoard'])
    ->get();

// affichage des resultats
if ($games_q_i->isEmpty()) {
    echo "Aucun jeu trouve";
} else {
    foreach ($games_q_i as $game) {
        if ($game->ratings->isNotEmpty()) {
            foreach ($game->ratings as $rating) {
                echo "<strong>Nom du jeu:</strong> " . htmlspecialchars($game->name) . "<br>";
                echo "<strong>Rating:</strong> " . htmlspecialchars($rating->name) . "<br>";
                echo "<strong>Organisme de classification:</strong> " . htmlspecialchars($rating->ratingBoard->name ?? 'N/A') . "<br><br>";
            }
        } else {
            echo "<strong>Nom du jeu:</strong> " . htmlspecialchars($game->name) . "<br>";
            echo "<em>Aucun rating disponible</em><br><br>";
        }
    }
}

echo "</div></div>";

// question j
echo "<div class='section'>";
echo "<button onclick='this.nextElementSibling.classList.toggle(\"open\")'>j. Afficher les jeux dont le nom débute par « Mario » et ayant plus de 3 personnages</button>";
echo "<div class='content'>";

// requête
$games_q_j = models\Game::where('name', 'like', 'Mario%')
    ->whereHas('characters', function ($query) {
        $query->havingRaw('COUNT(*) > 3'); // plus de 3 personnages
    }, '>=', 4)
    ->get();

// affichage des resultats
if ($games_q_j ->isEmpty()) {
    echo "Aucun jeu trouve";
} else {
    foreach ($games_q_j as $game) {
        echo $game->name . "<br>";
    }
}

echo "</div></div>";

// question k
echo "<div class='section'>";
echo "<button onclick='this.nextElementSibling.classList.toggle(\"open\")'>k. Afficher les jeux dont le nom débute par « Mario » et dont le rating initial contient « 3+ »</button>";
echo "<div class='content'>";

// requête
$games_q_k = models\Game::where('name', 'like', 'Mario%')
    ->whereHas('ratings', function ($query) { // filtre les jeux dont le rating contient '3+'
        $query->where('name', 'like', '%3+%');
    })
    ->with(['ratings' => function ($query) { // on charge uniquement les ratings qui contiennent '3+'
        $query->where('name', 'like', '%3+%');
    }, 'ratings.ratingBoard'])
    ->get();

// affichage des resultats
if ($games_q_k->isEmpty()) {
    echo "Aucun jeu trouve";
} else {
    foreach ($games_q_k as $game) {
        echo "<br><strong>Nom du jeu:</strong> " . htmlspecialchars($game->name) . "<br>";

        foreach ($game->ratings as $rating) {
            echo "<strong>Rating:</strong> " . htmlspecialchars($rating->name) . "<br>";
            echo "<strong>Organisme de classification:</strong> " . htmlspecialchars($rating->ratingBoard->name ?? 'N/A') . "<br>";
        }
    }
}

echo "</div></div>";

// question l
echo "<div class='section'>";
echo "<button onclick='this.nextElementSibling.classList.toggle(\"open\")'>l. Afficher les jeux dont le nom débute par « Mario », publiés par une compagnie dont le nom contient « Inc. » et dont le rating initial contient « 3+ »</button>";
echo "<div class='content'>";

// requête
$games_q_l = models\Game::where('name', 'like', 'Mario%')
    ->whereHas('publishers', function ($query) {
        $query->where('name', 'like', '%Inc.%'); // la compagnie contient "Inc."
    })
    ->whereHas('ratings', function ($query) { // filtre les jeux dont le rating contient '3+'
        $query->where('name', 'like', '%3+%');
    })
    ->with([
        'publishers' => function ($query) {
            $query->where('name', 'like', '%Inc.%'); // on charge uniquement les compagnies contenant "Inc."
        },
        'ratings' => function ($query) {
            $query->where('name', 'like', '%3+%'); // on charge uniquement les ratings qui contiennent '3+'
        },
        'ratings.ratingBoard'
    ])
    ->get();

// affichage des resultats
if ($games_q_l->isEmpty()) {
    echo "Aucun jeu trouve";
} else {
    foreach ($games_q_l as $game) {
        echo "<br><strong>Nom du jeu:</strong> " . htmlspecialchars($game->name) . "<br>";

        // nom de l'editeur
        foreach ($game->publishers as $publisher) {
            echo "<strong>Publié par:</strong> " . htmlspecialchars($publisher->name) . "<br>";
        }

        // Affichage du premier rating contenant "3+"
        if ($game->ratings->isNotEmpty()) {
            $firstRating = $game->ratings->first();
            echo "<strong>Rating:</strong> " . htmlspecialchars($firstRating->name) . "<br>";
            echo "<strong>Organisme de classification:</strong> " . htmlspecialchars($firstRating->ratingBoard->name ?? 'N/A') . "<br>";
        }
    }
}

echo "</div></div>";

// question m
echo "<div class='section'>";
echo "<button onclick='this.nextElementSibling.classList.toggle(\"open\")'>m. Afficher les jeux dont le nom débute par « Mario », publiés par une compagnie dont le nom contient « Inc », dont le rating initial contient « 3+ » et ayant reçu un avis de la part du rating board nommé « CERO » </button>";
echo "<div class='content'>";

// requête
$games_q_m = models\Game::where('name', 'like', 'Mario%')
    ->whereHas('publishers', function ($query) {
        $query->where('name', 'like', '%Inc%'); // la compagnie contient "Inc."
    })
    ->whereHas('ratings', function ($query) { // filtre les jeux dont le rating contient '3+'
        $query->where('name', 'like', '%3+%')
            ->whereHas('ratingBoard', function ($subQuery) { // le rating provient de "CERO"
                $subQuery->where('name', 'CERO');
            });
    })
    ->with([
        'publishers' => function ($query) {
            $query->where('name', 'like', '%Inc%'); // on charge uniquement les compagnies contenant "Inc."
        },
        'ratings' => function ($query) {
            $query->where('name', 'like', '%3+%') // on charge uniquement les ratings qui contiennent '3+'
            ->whereHas('ratingBoard', function ($subQuery) {
                $subQuery->where('name', 'CERO');
            });
        },
        'ratings.ratingBoard'
    ])
    ->get();

// affichage des resultats
if ($games_q_m->isEmpty()) {
    echo "Aucun jeu trouve";
} else {
    foreach ($games_q_m as $game) {
        echo "<br><strong>Nom du jeu:</strong> " . htmlspecialchars($game->name) . "<br>";

        // Affichage du nom de l'éditeur
        foreach ($game->publishers as $publisher) {
            echo "<strong>Publié par:</strong> " . htmlspecialchars($publisher->name) . "<br>";
        }

        // Affichage du premier rating contenant "3+" attribué par "CERO"
        if ($game->ratings->isNotEmpty()) {
            $firstRating = $game->ratings->first();
            echo "<strong>Rating:</strong> " . htmlspecialchars($firstRating->name) . "<br>";
            echo "<strong>Organisme de classification:</strong> " . htmlspecialchars($firstRating->ratingBoard->name ?? 'N/A') . "<br>";
        }
    }
}

echo "</div></div>";

// question n
echo "<div class='section'>";
echo "<button onclick='this.nextElementSibling.classList.toggle(\"open\")'>n. Ajouter un nouveau genre de jeu, et l'associer aux jeux 12, 56, 12, 345</button>";
echo "<div class='content'>";

// ****** TO DO ********
//$newGenre = new models\Genre();
//$newGenre->name = 'Action-RPG';
//$newGenre->deck = 'Un genre combinant action et éléments de RPG.';
//$newGenre->description = 'Les jeux Action-RPG combinent des combats en temps réel avec des mécaniques de progression inspirées des RPG.';
//$newGenre->save();
//
//$gameIds = [12, 56, 12, 345];
//foreach ($gameIds as $gameId) {
//    $game = models\Game::find($gameId);
//    if ($game) {
//        $game->genres()->attach($newGenre->id);
//    }
//}


echo "</div></div>";