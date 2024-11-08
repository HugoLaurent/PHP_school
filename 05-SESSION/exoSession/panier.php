<?php

session_start();
var_dump($_SESSION['cart']);
$products = $_SESSION['cart'];

function getPrice($x)
{
    return $x["quantity"] * $x["price"];
}

$total = 0;
foreach ($products as $item) {
    $total += getPrice($item);
}


if (isset($_GET['action'])  && isset($_GET['id'])) {
    $productId = $_GET['id'];
    foreach ($products as $product) {
        if ($productId == $product["id"]) {

            if (isset($products[$productId]) && $_GET['action'] == 'delete') {
                $products[$productId]['quantity']--;
            }

            if (isset($products[$productId]) && $_GET['action'] == 'add') {
                $products[$productId]['quantity']++;
            }
        }
    }
}

if (isset($_GET['action']) &&  $_GET['action'] == 'deleteAll') {
    $_SESSION['cart'] = array();
};

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        .cart-item {
            display: flex;
            gap: 30px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h1>Shopping Cart</h1>
    <?php foreach ($products as $item): ?>
        <div class="cart-item">
            <p><?php echo htmlspecialchars($item['name']); ?></p>
            <p><?php echo htmlspecialchars($item['price']); ?>€</p>
            <p><?php echo htmlspecialchars($item['quantity']); ?></p>
            <a href='panier.php?action=add&id=<?php echo $item['id']; ?>'>+</a>
            <a href='panier.php?action=delete&id=<?php echo $item['id']; ?>'>-</a>
        </div>
    <?php endforeach; ?>
    <a href='panier.php?action=deleteAll'>delete all</a>
    <p>Total price: $<?php echo $total; ?></p>
</body>

</html>
<?php
