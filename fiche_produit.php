<?php
ob_start();
session_start();
$Titre = 'boutique';

include 'init.php';
// Je récupère mon paramètre $_GET["id_produit"]
// je requête en base avec la valeur de id_produit récupérée
if (isset($_GET["idProduit"])) {
    $stmt = $con->prepare("SELECT produits.*,categories.Nom as Categorie ,utilisateurs.Nom as Vendeur 
    FROM produits
    INNER JOIN categories ON 
    categories.ID = produits.Categories_ID
    INNER JOIN utilisateurs ON
    utilisateurs.Id_utilisateur = produits.Admin_ID WHERE Id_produit  = ? ");

    $stmt->execute(array($_GET["idProduit"]));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($count > 0) { ?>
        
            <h2 class="Aficher_produit "><?php echo $row["Nom"] ?></h2>
            <div class="main-body">
                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card_afichier">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <?php echo " <img src='Admin/uploads/avatars/" . $row['Image'] . "' alt='img' width='100%'/>"; ?>
                                    <div class="mt-3">

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-8 mt-5">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0 prix-titre">Nom de produits : </h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary prix-fiche">
                                        <?php echo  $row["Nom"] ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0 prix-titre mt-3">Description : </h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary prix-fiche">
                                        <?php echo $row["Description"] ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0 prix-titre">Catégorie : </h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary prix-fiche">
                                        <?php echo $row["Categorie"] ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0 prix-titre">Production in : </h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary prix-fiche">
                                        <?php echo $row["Pays_Production"] ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0 prix-titre">Date de Production :</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary prix-fiche">
                                        <?php echo $row["Date_production"] ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0 prix-titre">Prix de Produit : </h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary prix-fiche">
                                        <?php echo $row["Prix"] . ' €' ?>
                                    </div>
                                    <hr>
                                    <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0 prix-titre">Taille de Produit : </h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary prix-fiche ">
                                        <?php echo "<strong>".$row["Taille"] . "</strong>" ?>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0 prix-titre">Vendre par :</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary prix-fiche">
                                            <?php echo $row["Vendeur"] ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mt-3 d-flex justify-content-center  align-items-center">
                                                <form method="POST" action="panier.php?id=<?php echo $row['Id_produit'] ?>" class=" me-3">
                                                    <input type="hidden" name="nom" value="<?= $row["Nom"] ?>">
                                                    <input type="hidden" name="categorie" value="<?= $row["Categorie"] ?>">
                                                    <input type="hidden" name="prix" value="<?= $row["Prix"]  ?>">
                                                    <input type="hidden" name="id_prosuit" value="<?= $row["Id_produit"] ?>">
                                                    <div class="d-flex justify-content-evenly">
                                                    <select name="quantite">
                                                            <option selected> Choisir une quantité </option>
                                                            <?php for ($i = 1; $i <= $row["Stock"]; $i++) { ?>
                                                                <option value="<?= $i ?>"> <?= $i ?> </option>
                                                            <?php } ?>
                                                        </select>

                                                        <input class="btn  btn-dark " type="submit" value="Ajouter au Panier" name="Ajouter" id="ajouter" style="margin-left:15px">
                                                    </div>

                                                </form>
                                                <form method="POST" action="Favorie.php?id=<?php echo $row['Id_produit'] ?>">
                                                    <input type="hidden" name="nom" value="<?= $row["Nom"] ?>">
                                                    <input type="hidden" name="categorie" value="<?= $row["Categorie"] ?>">
                                                    <input type="hidden" name="prix" value="<?= $row["Prix"] ?>">
                                                    <input type="hidden" name="id_prosuit" value="<?= $row["Id_produit"] ?>">
                                                    <input class="btn btn-favoir " type="submit" value="ajouter au favoris" name="Ajouter" id="ajouter">
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
          

            <?php if (isset($_SESSION['utilisateur'])) {  ?>
                <section class="boutique">
                    <div class="row w-75 mx-auto">
                        <div class="col-md-12">
                            <form action="<?php echo $_SERVER['PHP_SELF'] . '?idProduit=' . $row['Id_produit'] ?>" method="POST">
                                <div class="mb-3">
                                    <label for="commentaire" class="form-label prix">Votre comentaire</label>
                                    <textarea class="form-control" id="commentaire" name="commentaire" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <input class="btn btn-favoir" type="submit" value="Ajouter Commentaire">
                                </div>
                            </form>

                        <?php

                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                            $comment = filter_var($_POST['commentaire'], FILTER_SANITIZE_STRING);
                            $client =  $_SESSION['ID'];
                            $Produit = $row['Id_produit'];


                            if (!empty($comment)) {
                                $stmt = $con->prepare(" INSERT INTO commentaire( Commentaire, Satut ,Commentaire_Date ,Commentaire_Utilesateur,Commentaire_Produit ) VALUES(:commentaire,0,NOW(),:client,:produit) ");
                                $stmt->execute(array(
                                    ':commentaire' => $comment,
                                    ':client' => $client,
                                    ':produit' => $Produit
                                ));


                                if ($stmt) {
                                    echo '<div class="alert alert-success text-center" role="alert">
                                    Votre avis est important ! Chaque évaluation aide les autres acheteurs à commander en ligne en toute connaissance de cause . Merci de prendre une minute pour évaluer votre achat sur notre plateforme
                                        </div>';
                                }
                            }
                        }
                    } else {
                        echo '<div class="d-flex justify-content-end"><div class="alert alert-info w-50 text-center " role="alert">
                        Vous ne pouvez pas laisser des commentaires sur les produits si vous n\'êtes pas inscrit' . '<a href="connecter.php " class="btn bg-white mt-2 me-3"> Connexion </a> <a href="connecter.php " class="btn btn-dark mt-2  "> Inscription </a> ' . '
                    </div></div>';
                    }
                    $stmt = $con->prepare("SELECT  commentaire.*,utilisateurs.Nom AS  Member ,utilisateurs.Avatar AS image_uil FROM commentaire  INNER JOIN  utilisateurs ON utilisateurs.Id_utilisateur = commentaire.Commentaire_Utilesateur WHERE Commentaire_Produit =?  AND Satut  = 1 ORDER BY Commentaire_Date DESC");
                    // j'ai fait beaind entre id de get avec Commentaire_Produit dans la tabele commenatire 
                    $stmt->execute(array($row['Id_produit']));
                    $Comment = $stmt->fetchAll(); ?>
                    <hr>
                        <h3 class="sub-heading"></h3>
                        <h1 class="avis-titre">Avis Clients</h1>
                        <?php foreach ($Comment as $commentaire) { ?>
                            <div class="review mt-3" id="review">
                                <div class="swiper-container review-slider ">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide slide">
                                            <i class="fas fa-quote-right"></i>
                                                <div class="user">
                                                    <?php if (!empty($commentaire['image_uil'])) {
                                                        echo '<img src="Admin/uploads/avatars/' . $commentaire["image_uil"] . '" alt="">';
                                                    } else { ?>
                                                        <img src="img/1.png" alt="">
                                                    <?php } ?>
                                                    <div class="user-info ">
                                                        <h3 class="mb-0"> <?php echo $commentaire['Member'] ?></h3>
                                                        <p class="text-secondary prix-fiche mt-0"> <?php echo $commentaire['Commentaire'] ?></p>
                                                    </div>
                                           
                                                 </div>
                                                 <div>
                                                <span> <?php echo $commentaire['Commentaire_Date'] ?></span>
                                                    <div class="stars">
                                                        <i class="fas fa-star "></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                    </div>
                                                </div>
                                           
                                        </div>

                                    </div>

                                </div>

                            </div>

                        <?php } ?>
                        </div>
                    </div>
                </section>
        <?php  } else {
        header("location:index.php"); // Si le produit n'éxiste pas en base je redirige
        exit();
    }
} else {
    header("location:index.php"); // je suis redirigé vers index.php
    exit();
}

include  $tbl . 'footer.inc.php';

ob_end_flush();
        ?>