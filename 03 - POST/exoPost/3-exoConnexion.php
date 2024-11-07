<?php

/*

    EXERCICE POST :
            Formulaire connexion utilisateur : 

                Etapes : 
                    - 1 Initialiser la session en lançant l'instruction session_start()
                    - 2 Créer un formulaire POST pour une connexion utilisateur (pseudo, password)
                    - 3 Controler ces informations reçues dans POST pour un contexte de connexion, c'est à dire de vérifier si l'utilisateur existe bien, et dans un second temps de vérifier la correspondance du mot de passe saisi avec le mot de passe crypté via la fonction password_verify()
                    - 4 Si tout est ok, afficher un message à l'utilisateur et stocker dans $_SESSION['connected_user']  les informations de l'utilisateur actuellement connecté
                    - 5 Si pas ok, afficher un message d'erreur indiquant que la saisie est incorrecte

*/

session_start();
$_SESSION['users'] = [
    [
        'id' => 1,
        'pseudo' => "DavidTesPoches",
        'email' => "david@example.com",
        'password' => password_hash("az", PASSWORD_DEFAULT)
    ],
    [
        'id' => 2,
        'pseudo' => "PipoBimboBobiBobJr",
        'email' => "pipo@example.com",
        'password' => password_hash("qs", PASSWORD_DEFAULT)
    ],
    [
        'id' => 3,
        'pseudo' => "CrazyPusher",
        'email' => "crazy@example.com",
        'password' => password_hash("wx", PASSWORD_DEFAULT)
    ]
];

$_SESSION['connected_user'] = [];

$content = null;
$error = null;
$formOn = true;
$pseudoExists = false;
$connectedUser = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["pseudo"], $_POST["password"])) {
        $pseudo = trim($_POST["pseudo"]);
        $password = trim($_POST["password"]);


        if (empty($pseudo) || empty($password)) {
            $error = "Tous les champs sont obligatoires.";
        } else {

            foreach ($_SESSION['users'] as $user) {
                if ($user['pseudo'] === $pseudo) {
                    $pseudoExists = true;
                    $connectedUser = $user;
                    break;
                }
            }


            if ($pseudoExists) {
                if (!password_verify($password, $connectedUser["password"])) {
                    $error = "Mauvais mot de passe.";
                }
            } else {
                $error = "Le pseudo n'existe pas.";
            }
        }


        if ($error == null) {
            $_SESSION['connected_user'] = $connectedUser;
            $formOn = false;
        }
    }
}
?>

<form method="post" style='display: <?= $formOn ? "block" : "none" ?>'>
    <div class="form-group">
        <label for="exampleInputPseudo">Pseudo</label>
        <input type="text" class="form-control" id="exampleInputPseudo" placeholder="Enter pseudo" name="pseudo">
    </div>

    <div class="form-group">
        <label for="exampleInputPasswordVerif">Password</label>
        <input type="password" class="form-control" id="exampleInputPasswordVerif" placeholder="Password" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?= ($error == null && !$formOn) ? "Vous êtes bien connecté, Mister {$connectedUser['pseudo']}" : $error ?>