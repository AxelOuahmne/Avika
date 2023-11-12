<?php

$Titre = 'Catégories';
include 'init.php';
//
?>
 <h1 class="categorie mt-5"> <?php echo $_GET['pagenom']?></h1>
    <section class="boutique ">
    <div class="content">
        <?php
        foreach (GetProduits($_GET['pageid']) as $produits) { ?>
            <div class="produit-card">
                <div class="produit-img">
                    <?php echo " <img src='Admin/uploads/avatars/" . $produits['Image'] . "' alt='img' class='img-fluid'/>"; ?>
                     <a href="fiche_produit.php?idProduit=<?php echo $produits['Id_produit'] ?>" >  <i class="fa-solid fa-heart "></i></a>
                    <a href="fiche_produit.php?idProduit=<?php echo $produits['Id_produit'] ?>"><i class="fa-solid fa-cart-shopping"></i></a>
                </div>
                <div class="produis-info">
                    <p class="produis-categorie">
                    <?php echo substr($produits['Description'],0,50).' ...  ';?> 
                    </p>
                    <strong class="produis-title">
                    <span> <?php echo $produits['Nom']?></span>
                        <a href="fiche_produit.php?idProduit=<?php echo $produits['Id_produit'] ?>" class=" card-btn btn btn-primary">Achete</a>
    
                    </strong>
                    <div class="d-flex justify-content-between align-items-center">
                        <?php //if(!empty($produits['Taille'])){
                            //echo ' <span class="prix"> Taille : '. $produits['Taille'].'</span>';
                        //} ?>
                        <span class="prix"><?php echo $produits['Prix'] ?> €</span>
                        <div class="start mt-3 align-items-center">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                        </div>
                    </div>

                 </div>

                </div> 
           
            <?php }

            ?>

  </div>
</section>



<?php
include  $tbl . 'footer.inc.php';
?>