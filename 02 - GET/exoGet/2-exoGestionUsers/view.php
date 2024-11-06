<?php

session_start();
$id = $_GET['id'];
?>

<div style="display: flex;">
    Name : <?php echo $_SESSION["users"][$id - 1]["nom"]; ?>
    Mail : <?php echo $_SESSION["users"][$id - 1]["email"]; ?>
</div>