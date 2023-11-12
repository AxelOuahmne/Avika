<?php
session_start();
$Titre = 'boutique';

include 'init.php';
$stmt = $con->prepare("SELECT produits.*,categories.Nom as Categorie ,utilisateurs.Nom as Vendeur 
FROM produits
INNER JOIN categories ON 
categories.ID = produits.Categories_ID
INNER JOIN utilisateurs ON
utilisateurs.Id_utilisateur = produits.Admin_ID WHERE Solde =! 1
ORDER BY  Id_produit ASC LIMIT 9 ");
$stmt->execute();
$boutique = $stmt->fetchAll();
?>

<div class="row mt-sm-0 ">
  <div class="col-12  ">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item  postion-text active ">
          <img src="img/CARenf.png" class="d-block w-100" alt="...">
          <a href="categories.php?pageid=5&pagenom=Enfants" class='boutique_carousel'>Enfants</a>
        </div>
        <div class="carousel-item postion-text ">
          <img src="img/carfame.png" class="d-block w-100" alt="...">
          <a href="categories.php?pageid=1&pagenom=Femmes" class='boutique_carousel'>Femmes</a>
        </div>
        <div class="carousel-item postion-text ">
          <img src="img/car.png" class="d-block w-100" alt="...">
          <a href="categories.php?pageid=7&pagenom=Parfums" class='boutique_carousel'>Parfums</a>
        </div>
        <div class="carousel-item postion-text ">
          <img src="img/caroszel/wsqfq.png" class="d-block w-100" alt="...">
          <a href="categories.php?pageid=8&pagenom=Mariage" class='boutique_carousel'>Mariage</a>
        </div>
        <div class="carousel-item postion-text ">
          <img src="img/Caraccessoires.png" class="d-block w-100" alt="...">
          <a href="categories.php?pageid=6&pagenom=Accessoires" class='boutique_carousel'>Accessoires</a>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <h1 class=" text-center promotion mt-5  mb-3"> Nouveautés </h1>
    <section class="boutique vedeo">

      <?php   ?>
      <div class="content">

        <?php
        foreach ($boutique as $produits) { ?>
          <div class="produit-card card-solde">
            <div class="produit-img">
              <?php echo " <img src='Admin/uploads/avatars/" . $produits['Image'] . "' alt='img' class='img-fluid'/>"; ?>
              <a href="fiche_produit.php?idProduit=<?php echo $produits['Id_produit'] ?>"> <i class="fa-solid fa-heart "></i></a>
              <a href="fiche_produit.php?idProduit=<?php echo $produits['Id_produit'] ?>"><i class="fa-solid fa-cart-shopping"></i></a>
            </div>
            <div class="produis-info">

              <p class="produis-categorie">
                <?php echo substr($produits['Description'], 0, 50) . ' ...  '; ?>
              </p>
              <strong class="produis-title">
                <span> <?php echo $produits['Nom'] ?></span>

                <a href="fiche_produit.php?idProduit=<?php echo $produits['Id_produit'] ?>" class="voir-plus  "> je découvre</a>

              </strong>
            </div>


          </div>

        <?php }

        ?>
     
    </section>
    <h2 class="promotion">Notre Promotions </h2>
    <section class="boutique vedeo">

      <?php   ?>
      <div class="content">

        <?php
        $stmt = $con->prepare("SELECT produits.*,categories.Nom as Categorie ,utilisateurs.Nom as Vendeur 
        FROM produits 
        INNER JOIN categories ON 
        categories.ID = produits.Categories_ID
        INNER JOIN utilisateurs ON
        utilisateurs.Id_utilisateur = produits.Admin_ID WHERE Solde = 1 ");
        $stmt->execute();
        $solde = $stmt->fetchAll();
        foreach ($solde as $produits) { ?>
          <div class="produit-card card-solde">
            <div class="produit-img">
              <?php echo " <img src='Admin/uploads/avatars/" . $produits['Image'] . "' alt='img' class='img-fluid'/>"; ?>
              <a href="fiche_produit.php?idProduit=<?php echo $produits['Id_produit'] ?>"> <i class="fa-solid fa-heart "></i></a>
              <a href="fiche_produit.php?idProduit=<?php echo $produits['Id_produit'] ?>"><i class="fa-solid fa-cart-shopping"></i></a>
            </div>
            <div class="produis-info">

              <p class="produis-categorie">
                <?php echo substr($produits['Description'], 0, 50) . ' ...  '; ?>
              </p>
              <strong class="produis-title">
                <span> <?php echo $produits['Nom'] ?></span>

                <a href="fiche_produit.php?idProduit=<?php echo $produits['Id_produit'] ?>" class="voir-plus  "> je découvre</a>

              </strong>
            </div>
            <?php if ($produits['Solde'] == 1) {
              echo '<span class="solde"> Solde <span class="porsontage"> -25% </span> </span>';
            } ?>

          </div>

        <?php }

        ?>
   <div class="loader-container">
          <video autoplay="autoplay" muted="" src="Layout/video/ved.mp4"></video>
        </div>
    </section>
    <?php include  $tbl . 'footer.inc.php';

    ?>