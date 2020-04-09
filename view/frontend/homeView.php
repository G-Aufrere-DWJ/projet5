<?php ob_start(); ?>

<div class="container col-12">

<div id="diaporama" class="row">
    <img name="imagediapo" id="image_diapo">
</div>

</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>