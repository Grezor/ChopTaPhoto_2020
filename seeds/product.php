<?php
//recupere la librairie
require __DIR__ . "/../vendor/autoload.php";
// recupere le fichier connexion bdd
require __DIR__ . "/../include/db.php";

echo "Demarrage du programme \n";

$faker = Faker\Factory::create('fr_FR');
// boucle d'informations que l'on souhaite avoir ici 50 fausse data
for ($i = 0; $i < 10; $i++) {
    //les champs de bdd
    $name = $faker->firstName;
    $description = $faker->text(50);
    $price = $faker->numberBetween(20, 2000);
    $quantity = $faker->numberBetween(1,20);
    $ref = 'ref_' . $faker->numberBetween(1, 200);
    // $is_location = $faker->numberBetween(0, 1);
   
    // tableau des divers informations
    $product = [
        ':name' => $name,
        ':description' => $description,
        ':price' => $price,
        ':quantity' => $quantity,
        ':ref' => $ref,
        'is_location' => $is_location
    ];
    // Requete Insert
    $requeteInsert = $pdo->prepare('INSERT INTO product (name, description, price, quantity, ref, is_location) values (:name, :description, :price, :quantity, :ref, :is_location)');
    // execute requete
    $requeteInsert->execute($product);
}
echo "Fin du programme \n";