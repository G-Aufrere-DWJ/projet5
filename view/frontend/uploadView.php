<?php ob_start(); ?>

<?php if (isset($_SESSION['id'])) { ?>
<div id="change_avatar">
    <img src="<?= "public/upload/". $_SESSION['id']; ?>">
</div>
<?php 
} 
?>









<form method="POST" action="index.php?action=upload" enctype="multipart/form-data">
    <div class="form-group">
        <input type="hidden" name="MAX_FILE_SIZE" value="100000">
        Fichier : <input type="file" name="avatar">
        <input type="submit" name="envoyer" value="Envoyer le fichier">
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>