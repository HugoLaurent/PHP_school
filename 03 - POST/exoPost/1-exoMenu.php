<?php

/*

    EXERCICE POST :
            Choix plat au restaurant : 

                Etapes : 
                    - 1 Créer un form en POST avec simplement un champ select (liste deroulante) avec plusieurs choix de plat possible puis un bouton de validation
                    - 2 Traiter la réponse en exploitant POST puis en affichant un message indiquant le choix de l'utilisateur

*/
$content = null;


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["choice"])) {

        $choice = trim($_POST["choice"]);

        $content = '
        <div class="card">
  <div class="card-header">
    Voici vos coordonnées et votre message
  </div>
  <div class="card-body">
    <p class="card-text">Vous avez fait ' . $choice . ' wahou choix</p>
    
</div>
    ';
    }
}

?>

<form method="post" action="">
    <select name="choice" id="">
        <option value="1" <?= isset($choice) && $choice == '1' ? 'selected' : '' ?>>Wahou choix n°1</option>
        <option value="2" <?= isset($choice) && $choice == '2' ? 'selected' : '' ?>>Wahou choix n°2</option>
        <option value="3" <?= isset($choice) && $choice == '3' ? 'selected' : '' ?>>Wahou choix n°3</option>
        <option value="4" <?= isset($choice) && $choice == '4' ? 'selected' : '' ?>>Wahou choix n°4</option>
        <option value="5" <?= isset($choice) && $choice == '5' ? 'selected' : '' ?>>Wahou choix n°5</option>
    </select>
    <button type="submit">J'ai fais mon wahou choix</button>
</form>

<?= $content ?>