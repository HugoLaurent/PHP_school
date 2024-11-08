<?php

/*

    EXERCICE SESSION :
            Page de produits et ajout panier + page panier : 

                Etapes : 
                    - 1 Initialiser la session en lançant l'instruction session_start()
                    - 2 Créer un array $products qui contient des produits fictifs (id, name, price)
                    - 3 Afficher ces produits sur la page avec un bouton Ajout panier géré avec GET 
                    - 4 Traiter le GET pour récupérer les informations produits et l'ajouter à $_SESSION['cart'] ainsi qu'un indice "quantity"
                    - 5 Traiter le fait que ce produit est peut être déjà présent en ajoutant simplement 1 à la quantité déjà présente
                    - 6 Vérifier le contenu de la session
                    - 7 Créer une page panier.php dans laquelle seront affichés les produits présents dans le panier avec un calcul du prix en rapport à leur quantité, prix par produit, prix total 
                    - 8 Permettre de modifier la quantité produit dans le panier 
                    - 9 Permettre de supprimer un produit du panier
                    - 10 Permettre de vider le panier entier 

*/

session_start();


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}


$products = [
    ['id' => 1, 'name' => 'Product 1', 'price' => 10],
    ['id' => 2, 'name' => 'Product 2', 'price' => 20],
    ['id' => 3, 'name' => 'Product 3', 'price' => 30],
];


foreach ($products as $product) {
    echo "<p>{$product['name']} - \${$product['price']} <a href='exoPanier.php?action=add&id={$product['id']}'>Add to cart</a></p>";
}


if (isset($_GET['action']) && $_GET['action'] == 'add' && isset($_GET['id'])) {
    $productId = $_GET['id'];


    foreach ($products as $product) {
        if ($productId == $product["id"]) {

            if (isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId]['quantity']++;
            } else {

                $_SESSION['cart'][$productId] = $product;
                $_SESSION['cart'][$productId]['quantity'] = 1;
            }
        }
    }
}



var_dump($_SESSION['cart']);

?>

<a href="panier.php">See the cart</a>