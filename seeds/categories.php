<?php
//recupere la librairie
require __DIR__ . "/../vendor/autoload.php";
// recupere le fichier connexion bdd
require __DIR__ . "/../include/db.php";


echo "Demarrage du programme \n";

$faker = Faker\Factory::create('fr_FR');
// boucle d'informations que l'on souhaite avoir ici 50 fausse data
for ($i = 0; $i < 5; $i++) {
    //les champs de bdd
    
    $name = $faker->firstName;
    
   
    // tableau des divers informations
    $categories = [

        ':name' => $name
    ];
    // Requete Insert
    $requeteInsert = $pdo->prepare('INSERT INTO category (name) values (:name)');
    // execute requete
    $requeteInsert->execute($categories);
}
echo "Fin du programme \n";