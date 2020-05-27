<?php ob_start(); ?>

<?php
while ($data = $posts->fetch())

{
    $texte = substr($data['content'], 0, 200).'...';
?>
<div id="articles_blog" class="container bg-white col-lg-7">
    <div class="row">
        <div id="news" class="col-lg-11">
            <h3>
                <?= $data['title'] ?>
                <em>publié le <?= $data['creation_date'] ?></em>
            </h3>
            
            <p>
                <?= $texte ?>
            </p>
                <br />
                <div class="text-center col-12">
                    <a href="index.php?action=post&id=<?= $data['id'] ?>" class="btn btn-primary mb-5" role="button">Lire la suite</a>
                </div>
                <hr class="limite_post">
        </div>
    </div>
</div>
<?php
}
$posts->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>