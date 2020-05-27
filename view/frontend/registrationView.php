<?php ob_start(); ?>

<div class="login-box">
    <h2>Inscription</h2>
    <form action="index.php?action=registration" method="post">
        <div class="user-box">
            <input type="text" id="pseudo" name="pseudo" required="">
            <label for="pseudo">Pseudo</label>
        </div>
        <div class="user-box">
            <input type="password" id="mdp" name="mdp" required="">
            <label for="mdp">Mot de passe</label>
        </div>
        <button type="submit" name="formInscription">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Inscription
            </button>
    </form>
</div>


<?php $content = ob_get_clean(); ?>

<?php $title = 'Inscription' ?>

<?php require('view/frontend/template.php'); ?>