<?php

/*

    EXERCICE POST :
            Formulaire inscription utilisateur : 

                Etapes : 
                    - 1 Initialiser la session en lançant l'instruction session_start()
                    - 2 Créer un formulaire POST pour une inscription utilisateur (pseudo, email, password, confirm password)
                    - 3 Controler ces informations reçues dans POST (taille pseudo, format email, longueur password et correspondance avec le confirm, vérifier si le pseudo n'est pas déjà pris)
                    - 4 Si tout est ok, crypter le mot de passe avec password_hash et l'insérer dans  $_SESSION['users'] puis afficher un message de confirmation d'inscription
                    - 5 Si pas ok, afficher des messages d'erreur en rapport avec les problèmes de saisies

*/

session_start();
$pseudoTaken = ["DavidTesPoches", "PipoBimboBobiBobJr", "CrazyPusher"];

$content = null;
$error = null;
$formOn = true;


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["pseudo"], $_POST["email"], $_POST["password"], $_POST["passwordverif"])) {

        $pseudo = trim($_POST["pseudo"]);
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);
        $passwordverif = trim($_POST["passwordverif"]);

        if (empty($pseudo)) {
            $error = "Le pseudo est requis.";
        } elseif (in_array($pseudo, $pseudoTaken)) {
            $error = "Le pseudo est déjà pris.";
        } elseif (strlen($pseudo) > 50) {
            $error = "Le pseudo ne doit pas dépasser 50 caractères.";
        }

        if (empty($email)) {
            $error = "L'email est requis.";
        } elseif (strlen($email) > 255) {
            $error = "L'email ne doit pas dépasser 255 caractères.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Le format de l'email est invalide.";
        }

        if (empty($password)) {
            $error = "Le password est requis.";
        } elseif ($password !== $passwordverif) {
            $error = "Les password doivent être similaire.";
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
        }

        if ($error == null) {
            $_SESSION['users'] = [
                [
                    'id' => 1,
                    'pseudo' => $pseudo,
                    'email' => $email,
                    '$password' => $password
                ],
            ];
            $formOn = false;
        }
    }
}

?>

<form method="post" style='display: <?= $formOn ? "block" : "none" ?>'>
    <div class="form-group">
        <label for="exampleInputPseudo">Pseudo</label>
        <input type="pseudo" class="form-control" id="exampleInputPseudo" placeholder="Enter pseudo" name="pseudo">

    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email">

    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
    </div>
    <div class="form-group">
        <label for="exampleInputPasswordVerif">Password</label>
        <input type="password" class="form-control" id="exampleInputPasswordVerif" placeholder="Password verif" name="passwordverif">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?= ($error == null && $formOn == false) ?
    "Vous êtes bien login mister $pseudo"
    : $error ?>