<?php
session_start();

/* 

    EXERCICE GET : 
        Créer un tableau de gestion des utilisateurs back office 

            Etapes : 
                1 - Lancer l'instruction session_start(), cela vous donne accès à une superglobale nommée $_SESSION (c'est un array) qui peut stocker les données de votre choix et les transporter tout au long de la navigation 
                2 - Dans cette superglobale, à un indice [users], insérer des données fictives d'utilisateurs, par exemple, id, prenom, nom, email (cet array va représenter le retour d'une requête de selection en base de données)
                3 - Créer une base de page html pour créer un tableau html représentant les utilisateurs présents dans votre array session
                4 - Rajouter une colonne "actions" dans laquelle vous insérerez des boutons de votre choix pour les actions "Voir" "Modifier" "Supprimer"
                5 - Créer une communication de votre choix par GET via ces boutons pour amener sur une ou plusieurs autres pages pour chaque bouton
                6 - Une fois l'exercice terminé, lancer l'instruction session_destroy();

                

*/

$_SESSION['users'] = [
    ['id' => 1, 'nom' => 'Dupont', 'email' => 'dupont@example.com'],
    ['id' => 2, 'nom' => 'Durand', 'email' => 'durand@example.com'],
    ['id' => 3, 'nom' => 'Martin', 'email' => 'martin@example.com'],
];


function delete()
{
    echo '<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Modal body text goes here.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>';
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
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['users'] as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['nom']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td>
                        <a href="view.php?id=<?php echo $user['id']; ?>">Voir</a>
                        <a href="edit.php?id=<?php echo $user['id']; ?>">Modifier</a>
                        <a href="delete.php?id=<?php echo $user['id']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

</body>

</html>