<?php ob_start(); ?>

<div class="login-box">
    <h2>Connexion</h2>
    <form action="index.php?action=connect" method="post">
        <div class="user-box">
            <input type="text" id="pseudo" name="pseudo" required="">
            <label for="pseudo">Pseudo</label>
        </div>
        <div class="user-box">
            <input type="password" id="mdp" name="mdp" required="">
            <label for="mdp">Mot de passe</label>
        </div>
        <button type="submit" name="formConnection">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Connexion
            </button>
    </form>
</div>

<?php $content = ob_get_clean(); ?>

<?php $title = 'Connexion' ?>

<?php require('view/frontend/template.php'); ?>