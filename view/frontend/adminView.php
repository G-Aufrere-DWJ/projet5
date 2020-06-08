<?php ob_start(); ?>
<div class="container my-5" id="container_gestion">
    <div class="row">
            <form action="index.php?action=gestionArticles" method="post" id="admin_posts_form" class="col text-center">
                <img src="public/img/article.svg" alt="image_article">
                <button class="btn" id="show_posts_admin">Gérer les articles</button>
            </form>
            <form action="index.php?action=listSignalComments" method="post" id="admin_comments_form" class="col text-center">
                <img src="public/img/blog.svg" alt="image_livre">
                <button class="btn" id="show_signalComments_admin">Gérer les commentaires</button>
            </form>

            <form action="index.php?action=writeArticle" method="post" id="new_post_form" class="col text-center">
                <img src="public/img/draw.svg" alt="image_article_ecrit">
                <button class="btn" id="show_posts_admin">Nouvel article</button>
            </form>
    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>