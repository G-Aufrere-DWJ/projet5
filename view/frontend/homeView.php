<?php ob_start(); ?>

<div class="container-medium bg-white">

<section id="contenu_accueil" class="mx-auto mt-5">
    <h2 class="text-uppercase text-center">Bienvenue à Bourges !</h2>
    <p class="text-center">"Summa imperii penes Bituriges"</p>

<div class="container">
    <div id="carouselExampleControls" class="carousel slide mb-5" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="public/img/diapo4.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="public/img/diapo5.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="public/img/diapo6.jpg" alt="Third slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="public/img/diapo7.jpg" alt="Fourth slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="public/img/diapo8.png" alt="Fifth slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<div id="transition_accueil" class="text-center">
    <p class="text-center mb-5">Retrouvez ici les dernières actus concernant la capitale du Berry !</p>
    <img class="mb-5" src="public/img/arrow_bottom.svg" alt="fleche_bas">
</div>


    <div class="box-container col-lg-8 col-xl-10 mx-auto">
    <?php while($data = $rubrique2->fetch()) { ?>
	<div class="box-item">
    <div class="flip-box">
        <div class="flip-box-front text-center" style="background-image: url('<?= $data['img'] ?>');">
        <div class="inner color-white">
            <h3 class="flip-box-header"> <?= $data['libelle'] ?> </h3>
            <p> <?= $data['texte'] ?> </p>
            <img src="https://s25.postimg.cc/65hsttv9b/cta-arrow.png" alt="" class="flip-box-img">
        </div>
        </div>
        <div class="flip-box-back text-center" style="background-image: url('<?= $data['img'] ?>');">
        <div class="inner color-white">
            <h3 class="flip-box-header"> <?= $data['libelle'] ?> </h3>
            <p> <?= $data['texte'] ?> </p>
            <form action="index.php?action=listPost&id_rubrique=<?= $data['id'] ?>" method="post">
                <button class="flip-box-button" type="submit">En savoir plus</button>
            </form>
        </div>
        </div>
    </div>
	</div>
    <?php } ?>
</div>

</section>

</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>