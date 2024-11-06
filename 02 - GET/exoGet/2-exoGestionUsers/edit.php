<?php

session_start();
$id = $_GET['id'];
$name = $_SESSION["users"][$id - 1]["nom"];
$mail = $_SESSION["users"][$id - 1]["email"];

function onChange($id)
{
    $_SESSION["users"][$id - 1]["nom"] = $_POST['name'];
}

?>



<form method="submit" style="display: flex;">
    <input type="text" placeholder="<?php echo $name; ?>  " name='name'>
    <button type="submit">Modifier</button>
</form>

<div style="display: flex;">
    <input type="text" placeholder="<?php echo $mail; ?>">
    <button>Modifier</button>
</div>