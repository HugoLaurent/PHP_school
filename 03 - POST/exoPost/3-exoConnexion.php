<?php
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