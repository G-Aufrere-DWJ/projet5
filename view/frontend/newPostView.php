<?php ob_start(); ?>

<div class="container">
    <div id="ajout_post">
        <form action="index.php?action=ajoutePost" method="post" id="tiny_form" class="text-center mt-5">
            <div class="form-group">
                <label for="title" class="text-black mt-5">Titre</label><br />
                <input type="text" id="title" name="title" class="form-control" />
            </div>
            <div class="form-group">
                <label for="content" class="text-black">Article</label><br />
                <select name="id_rubrique" id="id_rubrique">
                    <option value="1">Culture</option>
                    <option value="2">Sport</option>
                    <option value="3">Environnement</option>
                </select>
                <input type="text" id="content" name="content" class="form-control" />
            </div>
            <div class="form-group pb-5">
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </form>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>