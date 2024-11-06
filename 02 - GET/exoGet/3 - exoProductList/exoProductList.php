<?php
session_start();

/* 

    EXERCICE GET : 
        Créer une page d'accueil de site ecommerce avec une liste de produit et page produit

            Etapes : 
                1 - Lancer l'instruction session_start(), cela vous donne accès à une superglobale nommée $_SESSION (c'est un array) qui peut stocker les données de votre choix et les transporter tout au long de la navigation 
                2 - Dans cette superglobale, à un indice [produits], insérer des données fictives dde produits, par exemple, id, nom, description, categorie, image (utilisez picsum pour générer des photos aléatoires) (cet array va représenter le retour d'une requête de selection en base de données)
                3 - Créer une base de page html pour créer un affichage de liste des produits représentant les produits présents dans votre array session
                4 - Rajouter un menu de votre choix permettant de choisir la catégorie de produits
                5 - Créer une communication de votre choix par GET via ce menu ou filtre pour n'afficher que les produits d'une certaine catégorie
                6 - Sur chaque affichage produit, créer un bouton qui amènera sur la fiche produit (autre page) pour n'avoir que ce produit là d'affiché (utilisation de GET ici aussi)
                7 - Une fois l'exercice terminé, lancer l'instruction session_destroy();


*/

$_SESSION['produits'] = [
    [
        "id" => 1,
        "nom" => "Laptop Ultrabook",
        "description" => "Un ordinateur portable puissant et léger pour les professionnels.",
        "categorie" => "Informatique",
        "image" => "https://cataas.com/cat/gif?id=1",
    ],
    [
        "id" => 2,
        "nom" => "Smartphone Pro",
        "description" => "Un smartphone avec des fonctionnalités avancées et une grande autonomie.",
        "categorie" => "Téléphonie",
        "image" => "https://cataas.com/cat/gif?id=2",
    ],
    [
        "id" => 3,
        "nom" => "Casque Bluetooth",
        "description" => "Casque sans fil avec une excellente qualité sonore et réduction de bruit.",
        "categorie" => "Accessoires",
        "image" => "https://cataas.com/cat/gif?id=3",
    ],
    [
        "id" => 4,
        "nom" => "Tablette Graphique",
        "description" => "Une tablette graphique idéale pour les créateurs et les designers.",
        "categorie" => "Informatique",
        "image" => "https://cataas.com/cat/gif?id=4",
    ],
    [
        "id" => 5,
        "nom" => "Montre Connectée",
        "description" => "Une montre connectée avec de nombreuses fonctionnalités sportives.",
        "categorie" => "Accessoires",
        "image" => "https://cataas.com/cat/gif?id=5",
    ]
];

$categories = ["informatique", "accessoires", "telephonie"];

$produits = $_SESSION['produits'];

$categorie_choisie = isset($_GET['categorie']) ? strtolower($_GET['categorie']) : 'all';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste de Produits</title>
</head>

<body>
    <h1>Produits</h1>


    <form method="GET" action="">
        <label for="categorie">Catégorie :</label>
        <select name="categorie" id="categorie" onchange="this.form.submit()">
            <option value="all">Toutes</option>
            <?php foreach ($categories as $categorie) : ?>
                <option value="<?= strtolower($categorie); ?>" <?= $categorie_choisie == strtolower($categorie) ? 'selected' : ''; ?>>
                    <?= ucfirst($categorie); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>


    <div style="display: flex; flex-wrap: wrap;">
        <?php foreach ($produits as $produit) : ?>
            <?php
            if ($categorie_choisie === 'all' || strtolower($produit['categorie']) === $categorie_choisie) :
            ?>
                <div style="width: 25%; border: 1px solid #ccc; padding: 10px; margin: 10px;">
                    <h3><?= $produit['nom']; ?></h3>
                    <p><?= $produit['description']; ?></p>
                    <p><strong>Catégorie:</strong> <?= $produit['categorie']; ?></p>
                    <img src="<?= $produit['image']; ?>" alt="<?= $produit['nom']; ?>" style="width: 100%;">
                    <br>
                    <a href="produit.php?id=<?= $produit['id']; ?>">Voir le produit</a>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</body>

</html>