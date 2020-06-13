<?php ob_start(); ?>

<header id="posts_header" class="text-center my-5">
    <h2>LES DERNIERS ARTICLES</h2>
</header>

<?php
while ($data = $posts->fetch())

{
    $texte = substr($data['content'], 0, 200).'...';
?>

<div class="card mb-5 col-lg-6 text-center mx-auto">
    <h3 class="card-header"> <?= $data['title'] ?> </h3>
    <div class="card-body">
        <p class="card-text"> <?= $texte ?> </p>
        <a href="index.php?action=post&id=<?= $data['id'] ?>" class="btn text-white" role="button">Lire la suite</a>
    </div>
</div>


<?php
}
?>
<div id="pagination" class="text-center">
    <?php for($i = 1; $i<=$countPages; $i++) { ?>
        <a href="index.php?action=listPost&id_rubrique=<?= $_GET['id_rubrique']?>&page=<?= $i?>" class="btn btn-secondary mb-2"> <?=$i?> </a> 
    <?php } ?>
</div>
<?php
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>