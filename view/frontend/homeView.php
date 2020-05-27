<?php ob_start(); ?>

<div class="container-medium bg-white">

<section id="contenu_accueil" class="mx-auto mt-5">
    <h2 class="text-uppercase text-center">Bienvenue à Bourges !</h2>
    <p class="text-center">"Summa imperii penes Bituriges"</p>

    <div class="box-container col-8 mx-auto">
	<div class="box-item">
    <div class="flip-box">
        <div class="flip-box-front text-center" style="background-image: url('public/img/diapo1.jpg');">
        <div class="inner color-white">
            <h3 class="flip-box-header">Culture</h3>
            <p>Découvrez ce que Bourges a de plus précieux</p>
            <img src="https://s25.postimg.cc/65hsttv9b/cta-arrow.png" alt="" class="flip-box-img">
        </div>
        </div>
        <div class="flip-box-back text-center" style="background-image: url('public/img/diapo1.jpg');">
        <div class="inner color-white">
            <h3 class="flip-box-header">Culture</h3>
            <p>Découvrez ce que Bourges a de plus précieux</p>
            <form action="index.php?action=listPost&id_rubrique=1" method="post">
                <button class="flip-box-button" type="submit">En savoir plus</button>
            </form>
        </div>
        </div>
    </div>
	</div>
	<div class="box-item">
    <div class="flip-box">
        <div class="flip-box-front text-center" style="background-image: url('public/img/diapo2.jpg');">
        <div class="inner color-white">
            <h3 class="flip-box-header">Environnement</h3>
            <p>Du vert dans la ville</p>
            <img src="https://s25.postimg.cc/65hsttv9b/cta-arrow.png" alt="" class="flip-box-img">
        </div>
        </div>
        <div class="flip-box-back text-center" style="background-image: url('public/img/diapo2.jpg');">
        <div class="inner color-white">
            <h3 class="flip-box-header">Environnement</h3>
            <p>Du vert dans la ville</p>
            <form action="index.php?action=listPost&id_rubrique=3" method="post">
                <button class="flip-box-button" type="submit">En savoir plus</button>
            </form>
        </div>
        </div>
    </div>
	</div>
	<div class="box-item">
    <div class="flip-box">
        <div class="flip-box-front text-center filter-" style="background-image: url('public/img/diapo3.jpg');">
        <div class="inner color-white">
            <h3 class="flip-box-header">Sport</h3>
            <p>Suivez l'actu sportive</p>
            <img src="https://s25.postimg.cc/65hsttv9b/cta-arrow.png" alt="" class="flip-box-img">
        </div>
        </div>
        <div class="flip-box-back text-center" style="background-image: url('public/img/diapo3.jpg');">
        <div class="inner color-white">
            <h3 class="flip-box-header">Sport</h3>
            <p>Suivez l'actu sportive</p>
            <form action="index.php?action=listPost&id_rubrique=2" method="post">
                <button class="flip-box-button" type="submit">En savoir plus</button>
            </form>
        </div>
        </div>
    </div>
	</div>
</div>

</section>

</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>