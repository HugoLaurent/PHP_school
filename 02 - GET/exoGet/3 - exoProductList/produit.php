<?php

session_start();
$id = $_GET['id'];
?>

<div style="display: flex;">
    Nom : <?php echo $_SESSION["produits"][$id - 1]["nom"]; ?>
    description : <?php echo $_SESSION["produits"][$id - 1]["description"]; ?>
    <img src="<?php echo $_SESSION["produits"][$id - 1]["image"]; ?>" alt="">
</div>