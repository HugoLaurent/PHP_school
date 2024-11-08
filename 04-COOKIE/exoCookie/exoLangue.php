<?php

    /*

    EXERCICE COOKIE :
            Mémorisation d'un choix de langue par l'utilisateur : 

                Etapes : 
                    - 1 Créer 4 liens HTML représentant des langues 
                    - 2 Via le GET, transmettre les informations de la langue cliquée
                    - 3 En fonction de la langue cliquée, créer un cookie correspondant
                    - 4 Vérifier le fonctionnement en revenant sur la page pour voir si la langue a été mémorisée (afficher la langue sélectionnée ou une phrase dans la langue en question)
                    - 5 Bien faire en sorte que le choix de langue soit cohérent (quelle serait la priorité entre le cookie, le choix utilisateur, le choix par défaut)

*/;


$content = [
    "fr" => "Salut toi, comment ça va?",
    "en" => "Hey you, how you doing?",
    "az" => "qsd, fgdsfd fdsfsdf !"
];

if (isset($_GET["lang"])) {
    $lang = $_GET["lang"];
    setcookie("lang", $lang, time() + (365 * 24 * 60 * 60));
} elseif (isset($_COOKIE["lang"])) {
    $lang = $_COOKIE["lang"];
} else {
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    setcookie("lang", $lang, time() + (365 * 24 * 60 * 60));
}

echo '<div>' . ($content[$lang] ?? $content["en"]) . '</div>';

?>

<div style="display: flex; gap: 30px; margin-top: 20px;">
    <a href="?lang=fr">fr</a>
    <a href="?lang=en">en</a>
    <a href="?lang=az">az</a>
</div>