<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../include/db.php';

echo "Demarrage du programme \n";

$faker = Faker\Factory::create('fr_FR');
// boucle d'informations que l'on souhaite avoir ici 50 fausse data
for ($i = 0; $i < 5; $i++) {
    $name = $faker->firstName;
    $categories = [
        ':name' => $name
    ];
    // Requete Insert
    $requeteInsert = $pdo->prepare('INSERT INTO category (name) values (:name)');
    $requeteInsert->execute($categories);
}
echo "Fin du programme \n";
