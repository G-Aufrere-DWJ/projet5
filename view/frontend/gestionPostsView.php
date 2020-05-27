<?php ob_start(); ?>



<div id="container_articles">
    <h2 class="text-black text-center pb-5">GESTION DES ARTICLES</h2>
    <div class="container col-12">
        <div class="row">
            <div id="article_form_gestion" class="col-lg-6 mb-5">
            <?php
            while ($data = $posts->fetch())
            {
            ?>
                <div id="titre_article_seul" class="col text-black text-center pb-2 mt-4">
                    <?= ($data['title']) ?>
                </div>
                <a href="index.php?action=displayGestionArticle&id=<?= ($data['id'])?>" class="btn btn-success">Modifier l'article</a>
                <a href="index.php?action=deletePost&id=<?= ($data['id'])?>" class="btn btn-danger">Supprimer l'article</a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>



<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>