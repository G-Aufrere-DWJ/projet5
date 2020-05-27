<?php ob_start(); ?>

<div id="error_message" class="col-lg-3 mx-auto bg-dark rounded text-light">
    <p><span class="text-danger font-weight-bold">Erreur :</span> <?= $errorMessage?></p>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>