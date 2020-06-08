<?php ob_start(); ?>

<?php if (isset($_SESSION['id'])) { ?>
<div id="change_avatar" class="container bg-white col-12 text-center my-5">
    <p>Bonjour <?= $name ?> </p>
    <img src="<?= $avatar ?>">
</div>
<?php 
} 
?>

<form method="POST" action="index.php?action=upload" enctype="multipart/form-data" class="col-lg-6 text-center mx-auto">
    <div class="form-group">
        <input type="hidden" name="MAX_FILE_SIZE" value="100000">
        Ajouter avatar : <input type="file" name="avatar">
        <br />
        <br />
        <input type="submit" name="envoyer" value="Envoyer le fichier" class="btn btn-success">
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>