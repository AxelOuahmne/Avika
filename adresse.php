<?php
session_start();
$Titre = 'Notre Adresse';

include 'init.php'; ?>
<div class="container">
    <div class="row g-2">
        <h2 class="title">Notre boutique </h2>
        <div class="col-6 col-md-6">
            <div class="p-3 "><img src="img/boutique.png" alt="" class="img-fluid h-50"></div>
        </div>
        <div class="col-6  d-flex align-items-center">
            <div class="p-3  fw-light ">
                <address> <span class="fw-bold">Adresse :</span> 45 Rue des Bourets, 92150 Suresnes</address>
                <p><span class="fw-bold"> Horaires :</span>de lundi à vendredi (10:00h à 17h:30 )</p>
                <p><span class="fw-bold">Téléphone :</span> 01 47 72 83 24</p>
                <p><span class="fw-bold"> Services disponibles:</span> Achats en magasin</p>
                <p><span class="fw-bold">Santé et sécurité :</span> Masque obligatoire · Les employés portent des masques</p>
            </div>
        </div>
    </div>
    <section class="cards  mt-5 " id="equipe">
        <h2 class="avis-titre mb-3">Notre equipe</h2>
        <div class="content">
            <div class="card_equipe">
                <div class="icon">
                <img src="img/emilie.jpg" alt="img" class="img-thumbnail ">
                </div>
                <div class="info">
                    <h3>Emilie Ouahmane</h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit, illo harum dicta cupiditate hic </p>
                </div>
            </div>
            <div class="card_equipe">
                <div class="icon">
                <img src="img/EQ.jpg" alt="img" class="img-thumbnail ">
                </div>
                <div class="info">
                    <h3>Mostapha Ouahmane</h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit, illo harum dicta cupiditate hic exercitationem</p>
                </div>
            </div>
            <div class="card_equipe">
                <div class="icon">
                <img src="img/q1.jpg" alt="img" class="img-thumbnail ">
                </div>
                <div class="info">
                    <h3>Malika Ait Touil</h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit, illo harum dicta cupiditate hic exercitationem </p>
                </div>
            </div>
        </div>
    </section>

    <section class="cards boutique mt-5" id="contact">
        <h2 class="avis-titre mb-3">Contactez nous</h2>
        <div class="content">
            <div class="card_equipe">
                <div class="icon">
                    <i class="fas fa-phone text-black"></i>
                </div>
                <div class="info ">
                    <h3 class="text-black">Phone</h3>
                    <p> +33 7 66 39 77 44 </p>
                </div>
            </div>
            <div class="card_equipe">
                <div class="icon">
                    <i class="far fa-envelope text-black"></i>
                </div>
                <div class="info">
                    <h3 class="text-black">Email</h3>
                    <p>emilieouahmane.fashion@gmail.com</p>
                </div>
            </div>

        </div>
    </section>
</div>
<?php include  $tbl . 'footer.inc.php';

?>