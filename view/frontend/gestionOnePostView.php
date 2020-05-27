<?php ob_start(); ?>

<div class="container">
    <div id="gestion_articles">
        <div id="titre_gestion_article" class="text-white text-center">
            <?php echo $post->title; ?>
        </div>
            <form action="index.php?action=modifyPost&id=<?= ($post->id)?>" method="post" id="tiny_form" class="col-10 offset-1">
                <div class="form-group">
                    <label for="title" class="text-black">Titre</label><br />
                    <input type="text" id="title" name="title" value="<?= ($post->title) ?>" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="content" class="text-black">Article</label><br />
                    <textarea id="content" name="content" class="form-control"><?= ($post->content) ?></textarea>
                </div>
                <div class="row">
                    <div class="form-group col text-center">
                        <button type="submit" class="btn btn-success">Modifier</button>
                    </div>
                    <div class="form-group col text-center">
                        <a href="index.php?action=deletePost&id=<?= ($post->id)?>" class="btn btn-danger">Supprimer l'article</a>
                    </div>
                </div>
            </form>
            <hr class="limite_admin">
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>