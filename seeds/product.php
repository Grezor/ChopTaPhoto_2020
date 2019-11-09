<?php
//recupere la librairie
require __DIR__ . "/../vendor/autoload.php";
// recupere le fichier connexion bdd
require __DIR__ . "/../include/db.php";

echo "Demarrage du programme \n";

$faker = Faker\Factory::create('fr_FR');
// boucle d'informations que l'on souhaite avoir ici 50 fausse data
for ($i = 0; $i < 50; $i++) {
    //les champs de bdd
    $name = $faker->firstName;
    $description = $faker->text(50);
    $price = $faker->numberBetween(20, 2000);
   
    // tableau des divers informations
    $product = [
        ':name' => $name,
        ':description' => $description,
        ':price' => $price,
    ];
    // Requete Insert
    $requeteInsert = $pdo->prepare('INSERT INTO products (name, description, price) values (:name, :description, :price)');
    // execute requete
    $requeteInsert->execute($product);
}
echo "Fin du programme \n";