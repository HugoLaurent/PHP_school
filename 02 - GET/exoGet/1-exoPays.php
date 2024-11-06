<?php

/* 

    EXERCICE : 
        La base de la manipulation de GET 
        
            Etapes :
                - Créer 4 liens indiquant 4 pays différents 
                - Sur chaque lien, créer une valeur GET à transmettre sur la même page
                - En fonction de la valeur transmise, afficher un message (par exemple pour un choix "France", afficher "Vous êtes français")

*/

$flag = null;
$countryArray = ["france", "allemagne", "angleterre"];
if (isset($_GET["pays"])) {
    $pays = $_GET["pays"];

    if ($pays == "france") $flag = "https://upload.wikimedia.org/wikipedia/commons/c/c3/Flag_of_France.svg";
    else if ($pays == "allemagne") $flag = "https://upload.wikimedia.org/wikipedia/commons/b/ba/Flag_of_Germany.svg";
    else if ($pays == "angleterre") $flag = "https://cdn.futura-sciences.com/buildsv6/images/largeoriginal/0/9/0/090467c5ac_50168321_drapeau-angleterre-lidiia-adobe-stock.jpg";
    else $categorie = "N/C";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div style="display: flex; gap: 10px;">
        <?php
        foreach ($countryArray as $country) {
            echo "<a href='?pays=$country'>$country</a><br>";
        }
        ?>
    </div>
    <?php
    if (!in_array($pays, $countryArray)) {
        echo "<p>Nous n'avons pas ce pays sur terre</p>";
    } else {
        echo "<img style='width: 50px;' src='$flag'></img>";
    }
    ?>
</body>

</html>