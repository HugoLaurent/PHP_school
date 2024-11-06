<?php
session_start();
$id = $_GET['id'];
$name = $_SESSION["users"][$id - 1]["nom"];
$mail = $_SESSION["users"][$id - 1]["email"];
?>

<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <p>Voulez vous vraiment supprimez <?php echo $name ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>