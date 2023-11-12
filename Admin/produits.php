<?php

/**
 * =========================================================================
 * === Gérer la page des Produis
 * 
 * === tu peux :
 * || ajouter Des Produits 
 * || modifier les produits
 * || supréssion les  Produits
 * ==========================================================================
 */
session_start();
if (isset($_SESSION['admin'])) {
  $Titre = 'Produits';
  include 'init.php';
  $Titre = 'Produits';
  $Emilie = '';

  $Emilie = isset($_GET['Emilie']) ?  $_GET['Emilie'] : 'Accueil';
  if ($Emilie == 'Accueil') {  // page Accuiel members 
    echo '<h1 class="text-center">Produits Boutique</h1>';
    $stmt = $con->prepare("SELECT produits.*,categories.Nom as Categorie ,utilisateurs.Nom as Vendeur 
          FROM produits
          INNER JOIN categories ON 
          categories.ID = produits.Categories_ID
          INNER JOIN utilisateurs ON
          utilisateurs.Id_utilisateur = produits.Admin_ID
           ORDER BY Id_produit DESC ");
    $stmt->execute();
    $Accueil = $stmt->fetchAll();
?>
    <div class="container-fluid">
      <h2 class="cat-h2">Tableau des produits </h2>
      
      <a href="produits.php?Emilie=Ajouter" class="btn btn-primary "><i class="fa-solid fa-user-plus"></i> Ajouter un Produit</a>
      <hr>
      <div class="table-responsive w-100  members-table mt-3">
        <table class="table table-bordered main-table accueil-table  ">
          <tr>
            <td>#ID</td>
            <td>Produit</td>
            <td>Description</td>
            <td>Photo</td>
            <td>Lieu de Production</td>
            <td>Prix</td>
            <td>quantité</td>  
            <td>Solde</td> 
           <td>Taille</td>  
            <td>Categorie</td>
            <td>Vendeur</td>
            <td>Date de production</td>
            <td>Contrôler</td>
          </tr>
          <img src='' alt='' class=''>

          <?php foreach ($Accueil as $row) {
            echo "<tr class='text-center'>";
            echo "<td>" . $row['Id_produit'] . "</td>";
            echo "<td>" . $row['Nom'] . "</td>";
            echo "<td>" .  substr($row['Description'],0,40 ). "</td>";
            echo "<td>";
            echo " <img src='uploads/avatars/" . $row['Image'] . "' alt='img'/>";
            echo "</td>";

            echo "<td>" . $row['Pays_Production'] . "</td>";
            echo "<td>" . '<span class="badge prix">' . $row['Prix'] . ' € </span>' . "</td>";
            echo "<td>" . $row['Stock'] . "</td>";
            echo "<td>" ; 
          
            if(  $row['Solde']==0){
              echo " Solde <span class='bg-danger'>  désactivé </span>" ;
            }else {
              echo " Solde <span class='bg-success'>Activé</span> " ;
            }
            
            echo "</td>";
            echo "<td>" . $row['Taille'] . "</td>";
            echo "<td>" . $row['Categorie'] . "</td>";
            echo "<td>" . $row['Vendeur'] . "</td>";
            echo "<td>" . $row['Date_production'] . "</td>";
            echo "<td class='text-center'>
                          <a href='produits.php?Emilie=Edite&Prod_ID=" . $row['Id_produit'] . "'  class='btn btn-primary  mb-sm-2 '>Modifier</a>
                              <a href='produits.php?Emilie=Delete&Prod_ID=" . $row['Id_produit'] . "'  class='btn btn-danger confirm  '>Supprimer</a>";

            echo "</td>";
            echo "<tr>";
          } ?>

        </table>
       
      </div>

      <a href="produits.php?Emilie=Ajouter" class="btn btn-primary "><i class="fa-solid fa-user-plus"></i> Ajouter un Produit</a>

    </div>
  <?php
  } elseif ($Emilie == 'Ajouter') {
    echo '<h1 class="w-25 mx-auto"> Ajouter un Produit</h1>'; ?>
    <div class="container bootstrap snippets bootdey">
      <h2 class="cat-h2">Produits </h2>
      <hr>


      <!-- edit form column -->
      <div class="row  ">
        <form class="form-horizontal form-category " action="?Emilie=Insert" method="POST" enctype="multipart/form-data">
          <div class="form-group row mb-3 mt-3  ">
            <label class="col-2 control-label text-center">Nom</label>
            <div class="col-10  ">
              <input class="form-control " type="text" name="nom" placeholder="nom de Produit">
            </div>
          </div>
          <div class="form-group row  mb-3">
            <label class="col-2 control-label text-center">Description</label>
            <div class="col-10 ">
              <textarea class="form-control" name="description" rows="3" placeholder="Votre Description"></textarea>
            </div>
          </div>
          <div class="form-group mb-3 row">
            <label class="col-2 text-center control-label"> Production</label>
            <div class="col-10 ">
              <input class="form-control" type="text" name="Production" placeholder="Pays de Production Produit">
            </div>
          </div>
          <div class="form-group mb-3 row">
            <label class="col-2 text-center control-label"> Taille</label>
            <div class="col-10 ">
              <input class="form-control" type="text" name="taille" placeholder="les tailles  de Production Produit">
            </div>
          </div> 
          <div class="form-group mb-3 row">
            <label class="col-2 text-center control-label">Prix</label>
            <div class="col-10 ">
              <input class="form-control" type="number" name="prix" placeholder="Prix de produits">
            </div>
          </div>
          <div class="form-group mb-3 row">
            <label class="col-2 text-center control-label">quantite</label>
            <div class="col-10 ">
              <input class="form-control" type="number" name="quantite" placeholder="quantite de produits">
            </div>
          </div>
          <div class="form-group mb-3 row">
            <label class="col-2 text-center control-label">image</label>
            <div class="col-10 ">
              <input type="file" class="form-control" id="Image" name="Image">

            </div>
          </div>
          <div class="form-group mb-3 row">
            <!-- start Field solde -->
            <label for="" class="col-2 text-center control-label">SOLDE</label>
            <div class="col-10 ">
              <select name="solde">
              <option value="0">Solde désactive </option>
              <option value="1">Solde Activé</option>   
              </select>
            </div>
          </div>

    <!-- <div class="form-group mb-3 row"> -->
            <!-- start Field solde -->
            <!-- <label for="" class="col-2 text-center control-label">Taille </label>
            <div class="col-10 ">
              <select name="taille">
              <option value="0">.......... </option>
              <option value="1">XS</option> 
              <option value="2">S</option> 
              <option value="3">M</option>   
              <option value="4">L</option> 
              <option value="5">XL</option>
              <option value="6">XL</option>
              <option value="7">XL</option> 

              </select>
            </div>
          </div> -->

          <div class="form-group mb-3 row">
            <!-- start Field name -->
            <label for="" class="col-2 text-center control-label">vendeur</label>
            <div class="col-10 ">
              <select name="utilisature">
                <option value="0">....</option>
                <?php
                $stmt = $con->prepare("SELECT * FROM utilisateurs   WHERE GroupID =! 0");
                $stmt->execute();
                $admin = $stmt->fetchAll();
                foreach ($admin as $vendeur) {
                  echo " <option value='" . $vendeur['Id_utilisateur'] . "'>" . $vendeur['Nom'] . ' ' . $vendeur['Prenom'] . "</option>";
                }
                ?>

              </select>
            </div>
          </div>
          <div class="form-group mb-3 row">
            <!-- start Field name -->
            <label for="" class="col-2 text-center control-label">catégorie</label>
            <div class="col-10 ">
              <select name="categories">
                <option value="0">....</option>
                <?php
                $stmt = $con->prepare("SELECT * FROM categories ");
                $stmt->execute();
                $categories = $stmt->fetchAll();
                foreach ($categories as $cate) {
                  echo " <option value='" . $cate['ID'] . "'>" . $cate['Nom'] . "</option>";
                }
                ?>

              </select>
            </div>
          </div>
          <div class="form-group mb-3 row">
            <div class="col-10 mx-auto ">
              <input type="submit" value="Ajouter" class="btn btn-primary btn-lg">
            </div>
          </div>

        </form>
      </div>

    </div>


    <?php } elseif ($Emilie == 'Insert') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      echo '<h1 class="text-center">Insert  les Donnée  Produit  </h1>';
      // upload variables
      $avtarnom = $_FILES['Image']['name'];
      $avtarSize = $_FILES['Image']['size'];
      $avtarTmp = $_FILES['Image']['tmp_name'];
      $avtarType = $_FILES['Image']['type'];
      //le type autorise pour upload
      $avtarAllowedExtension = array("jpeg", "jpg", "png", "gif");
      // get avter Extension
      // strtolower() pour change maj à mns 
      // end() pour daire à la fin de
      //explode ()  تفسيم المصفوفة

      $imageExtension = explode('.', $avtarnom);
      $avtarExtension = strtolower(end($imageExtension));


      //get Vraiable 
      $nom = $_POST['nom'];
      $desc = $_POST['description'];
      $Production = $_POST['Production'];
      $taille = $_POST['taille'];
      $prix = $_POST['prix'];
      $quantite = $_POST['quantite'];
      $utilisature = $_POST['utilisature'];
      $categories = $_POST['categories'];
      $solde =$_POST['solde'];
      // $taille = $_POST['taille'];


      // validation de form 
      $ErrorsForm = array(); // arry vide pour stocke les message

      if (empty($nom)) {
        $ErrorsForm[] = "Vous avez laissé le champs  nom de produit vide ";
      }
      if (empty($desc)) {
        $ErrorsForm[] =  "Vous avez laissé le champs  description vide ";
      }
      if (empty($Production)) {
        $ErrorsForm[] = "Vous avez laissé le champs  Pays de production  vide ";
      }
      if (empty($prix)) {
        $ErrorsForm[] = "Vous avez laissé le champs  Prix vide ";
      }
      if (empty($quantite)) {
        $ErrorsForm[] = "Vous avez laissé le champs  qauntite  vide ";
      }

      if (empty($utilisature)) {
        $ErrorsForm[] = "il faut choiser le vendeure ";
      }
      if (empty($categories)) {
        $ErrorsForm[] = " champs categories obligatoire ";
      }
      if (!empty($avtarnom) && !in_array($avtarExtension, $avtarAllowedExtension)) {
        $ErrorsForm[] = "Vous devez télécharger  images de produit au format suivent  : jpeg / jpg / png / gif ";
      }
      if ($avtarSize > 4194304) {
        $ErrorsForm[] = "  le size de champs imag trés large 4MB ";
        //4 MB = 1024 P(payte) * 4 * 1024 pour payet
      }
      foreach ($ErrorsForm as $Error) {
        echo '<div class="container">';
        $message = "<div class=' alert alert-danger mx-auto  w-50 text-dark  shadow-lg  text-center '>$Error</div>";
        direction($message, 'back', 5);
        echo '</div>';
      }
      if (empty($ErrorsForm)) {
        $avatar = rand(0, 100000) . '_' . $avtarnom; //IDAFT AR9AM 3CHO2IYA TOMA _ 9BLA ISM SORA
        move_uploaded_file($avtarTmp, "uploads\avatars\\" . $avatar); //distinastion pour stocke les photoles photo
        //update les donne
        $stmt = $con->prepare(
          "INSERT INTO 
                        produits(Nom,Description,Image,Pays_Production,Taille,Prix,Stock,Solde,Categories_ID,Admin_ID,Date_production)
                         value(:nom,:Description,:avatar,:Pays_Production,:taille,:prix,:quantite,:solde,:categorie ,:vendeur,now())"
        );

        //Statut 1 car il ajouter par admin  
        $stmt->execute(array(
          ':nom' => $nom,
          ':Description' => $desc,
          ':avatar' => $avatar,
          ':Pays_Production' => $Production,
          ':taille' => $taille,
          ':prix' => $prix,
          ':quantite' => $quantite,
          ':solde' =>$solde,
          ':categorie' => $categories,
          ':vendeur' => $utilisature,
          
       
          
        ));
        //message success
        $message = "<div class='alert alert-success mx-auto w-25 shadow-lg bodre rounded-start tex-center text-blak'><strong> " . $stmt->rowCount() . "</strong> vous avez bien Ajouter un nouveu produit </div>";
        direction($message, 'back', 5);
        echo  '<div>';
      }
    } else {

      echo "<div class='container'>";
      $message = "<div class=' alert alert-danger mx-auto mt-5  text-dark text-center p-5'>Cette page est destinée aux administrateurs uniquement, vous devez être administrateur pour pouvoir accéder à cette page</div>";
      echo "</div>";
      direction($message, 5);
    }
  } elseif ($Emilie == 'Edite') {
    echo '<h1 class="w-50 mx-auto"> Modifier les informations de l\'utilisateur Produit</h1>';
    $Prod_ID = isset($_GET['Prod_ID']) && is_numeric($_GET['Prod_ID']) ? intval($_GET['Prod_ID']) : 0;
    // if(isset($_GET['Prod_ID']) && is_numeric($_GET['Prod_ID'])) {
    //     echo intval($_GET['Prod_ID']);
    // }else {
    //     echo 0;
    // }

    // select All DAta depend on this ID

    $stmt = $con->prepare(" SELECT * FROM produits   WHERE Id_produit =? ");

    $stmt->execute(array($Prod_ID));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($count > 0) { ?>
      <div class="row  "> 
        <form class="form-horizontal form-category " action="?Emilie=Update" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="prod-ID" value="<?php echo  $Prod_ID  ?>"> 
        <div class="form-group row mb-3 mt-3  ">
            <label class="col-2 control-label text-center">Nom</label>
            <div class="col-10  ">
              <input class="form-control " type="text" name="nom" placeholder="nom de Produit" value="<?php echo $row['Nom'] ?>">
            </div>
          </div>
          <div class="form-group row  mb-3">
            <label class="col-2 control-label text-center">Description</label>
            <div class="col-10 ">
              <textarea class="form-control" name="description" rows="3" placeholder="Votre Description"><?php echo $row['Description'] ?></textarea>
            </div>
          </div>
          <div class="form-group mb-3 row">
            <label class="col-2 text-center control-label">Production</label>
            <div class="col-10 ">
              <input class="form-control" type="text" name="Production" placeholder="Pays de Production Produit" value="<?php echo $row['Pays_Production'] ?>">
            </div>
          </div>
          <div class="form-group mb-3 row">
            <label class="col-2 text-center control-label">Prix</label>
            <div class="col-10 ">
              <input class="form-control" type="number" name="prix" value="<?php echo $row['Prix'] ?>" €>
            </div>
          </div>
          <div class="form-group mb-3 row">
            <label class="col-2 text-center control-label">Quantite</label>
            <div class="col-10 ">
              <input class="form-control" type="number" name="quantite" value="<?php echo $row['Stock'] ?>" >
            </div>
          </div>
          <div class="form-group mb-3 row">
            <!-- start Field solde -->
            <label for="" class="col-2 text-center control-label">SOLDE</label>
            <div class="col-10 ">
              <select name="solde">

              <option value="0"><?php if($row['Solde']==0){
                  echo 'selected';
              } ?>Solde désactivé</option>
              <option value="1"><?php if($row['Solde']==1){
                  echo 'selected';
              } ?>Solde activé</option>   
              </select>
            </div>
          </div>
          <div class="form-group mb-3 row">
            <label class="col-2 text-center control-label"> Taille</label>
            <div class="col-10 ">
              <input class="form-control" type="text" name="taille" value="<?php echo $row['Taille'] ?> ">
            </div>
          </div>
          
          <div class="form-group mb-3 row">
            <!-- start Field name -->
            <label for="" class="col-2 text-center control-label">vendeur</label>
            <div class="col-10 ">
              <select name="utilisature">
                <option value="0">....</option>
                <?php
                $stmt = $con->prepare("SELECT * FROM utilisateurs   WHERE GroupID =! 0");
                $stmt->execute();
                $admin = $stmt->fetchAll();
                foreach ($admin as $vendeur) {
                  echo " <option value='" . $vendeur['Id_utilisateur'] . "'";
                  if ($row['Admin_ID'] == $vendeur['Id_utilisateur']) {
                    echo 'selected';
                  }
                  echo  ">"  . $vendeur['Nom'] . ' ' . $vendeur['Prenom'] . "</option>";
                }
                ?>

              </select>
            </div>
          </div>
          <div class="form-group mb-3 row">
            <!-- start Field name -->
            <label for="" class="col-2 text-center control-label">catégorie</label>
            <div class="col-10 ">
              <select name="categories">
                <option value="0">....</option>
                <?php
                $stmt = $con->prepare("SELECT * FROM categories ");
                $stmt->execute();
                $categories = $stmt->fetchAll();
                foreach ($categories as $cate) {
                  echo " <option value='" . $cate['ID'] . "'";
                  if ($row['Categories_ID'] == $cate['ID']) {
                    echo 'selected';
                  }

                  echo ">" . $cate['Nom'] . "</option>";
                }
                ?>

              </select>
            </div>
          </div>
          <div class="form-group mb-3 row">
            <div class="col-10 mx-auto ">
              <input type="submit" value="modifier" class="btn btn-primary btn-lg">
            </div>
          </div>

        </form>
        <!-- ================================================================================================= -->

                  <!-- les commenatires de produits -->

        <!-- ================================================================================================== -->
        <?php 
        $stmt = $con->prepare("SELECT  commentaire.*,utilisateurs.Nom AS Client
     FROM  commentaire
   
      INNER JOIN  utilisateurs
      ON
      utilisateurs.Id_utilisateur = commentaire.Commentaire_Utilesateur
      WHERE Commentaire_Produit =?  ");
      // j'ai fait beaind entre id de get avec Commentaire_Produit dans la tabele commenatire
        $stmt->execute(array($Prod_ID));
        $Accueil = $stmt->fetchAll();
?>
     
            <h1 class="text-center text-danger fw-bold">Les commentaires de Produit [<?php echo $row['Nom'] ?>] </h1>
            <h2 class="cat-h2">Tableau des commentaires </h2>
            <hr>
            <div class="table-responsive w-100  members-table mt-3">
                <table class="table table-bordered main-table accueil-table ">
                    <tr>
                      
                        <td>Commentaire</td>
                        <td>Utilisateur</td>
                        <td>Date</td>
                        <td>côntroler</td>
                    </tr>

                    <?php foreach ($Accueil as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['Commentaire'] . "</td>";
                        echo "<td>" . $row['Client'] . "</td>";
                        echo " <td>" . $row['Commentaire_Date'] . "</td>";
                        echo "<td class='text-center'>
                        <a href='commentaire.php?Emilie=Edite&CommID=" . $row['Commentaire_Id'] . "'  class='btn btn-primary mb-sm-2'>Modifier
                        <i class='fa-solid fa-user-pen'></i></a>
                            <a href='commentaire.php?Emilie=Delete&CommID=" . $row['Commentaire_Id'] . "'  class='btn btn-danger confirm  mb-sm-2'>Supprimer
                             <i class='fa-solid fa-person-circle-minus'></i></a>";
                        if ($row['Satut'] == 0) {
                            echo "<a href='commentaire.php?Emilie=Approve&CommID=" . $row['Commentaire_Id'] .   " ' class='btn btn-success mb-sm-2 '>Aproved
                                    <i class='fa-solid fa-person-circle-check'></i></a>";
                        }

                        echo "</td>";
                        echo "<tr>";
                    } ?>

                </table>
            </div>

     
      </div>
<?php } else {
  echo "<div class='container'>";
  $message = "<div class=' alert alert-danger mx-auto mt-5  text-dark text-center p-5'>Cette page est destinée aux administrateurs uniquement, vous devez être administrateur pour pouvoir accéder à cette page</div>";
  echo "</div>";
  direction($message, 5);
    }
  } elseif ($Emilie == 'Update') {
    echo '<h1 class="w-50 mx-auto"> Mettre à jour les informations de Produit </h1>';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //get Vraiable 
      $id = $_POST['prod-ID'];
      $nom = $_POST['nom'];
      $desc = $_POST['description'];
      $production = $_POST['Production'];
      $prix = $_POST['prix'];
      $taille =$_POST['taille'];
      $quantite = $_POST['quantite'];
      $solde = $_POST['solde'];
      $vendeur = $_POST['utilisature'];
      $categories = $_POST['categories'];
   


      // j'ai crier un variable vide pour enregestre la valure de de Image qui choise mambers si le champs de image vide alors le mumbre il garde son image si il a choise une autre image

          //update les donne
          $stmt = $con->prepare("UPDATE  produits  SET Nom = ?,Description=?,Pays_Production = ?, Prix =?,Stock=?,Solde=?,Taille=?,Categories_ID=?,Admin_ID=? WHERE Id_produit=?");
          $stmt->execute(array($nom, $desc, $production, $prix,$quantite,$solde,$taille,$categories,$vendeur,$id));
  
          echo "<div class='container'>";
          $message = "<div class='alert alert-success mx-auto mt-5 w-50 text-dark  shadow-lg  text-center p-5'> Le nombre de modifications que vous avez apportées est :<strong>  " . $stmt->rowCount()  . "</strong></div>";
          echo "</div>";
          direction($message, 5);
      
  } else {
    echo "<div class='container'>";
    $message = "<div class=' alert alert-danger mx-auto mt-5  text-dark text-center p-5'>Cette page est destinée aux administrateurs uniquement, vous devez être administrateur pour pouvoir accéder à cette page</div>";
    echo "</div>";
    direction($message, 5);
  }
  } elseif ($Emilie == 'Delete') {
    echo '<h1 class="w-50 mx-auto">supréssion  de Produit </h1>';
       //check integer value
        // short if else
        $Prod_ID = isset($_GET['Prod_ID']) && is_numeric($_GET['Prod_ID']) ? intval($_GET['Prod_ID']) : 0;
        // if(isset($_GET['UtilID']) && is_numeric($_GET['UtilID'])) {
        //     echo intval($_GET['UtilID']);
        // }else {
        //     echo 0;
        // }

        // select All DAta depend on this ID
        // $stmt = $con->prepare(" SELECT * FROM utilisateurs  WHERE Id_utilisateur =? LIMIT 1");
        // $stmt->execute(array($Util_ID));
        // $count = $stmt->rowCount();
        //if($count>0){}
        // je veux utlise function chekItems a la place de requite sql normaln

        // select All DAta depend on this ID
        $tchek = checkItems('Id_produit', 'produits', $Prod_ID);
        if ($tchek  > 0) {
            $stmt = $con->prepare("DELETE FROM  produits  WHERE Id_produit = :Effacer");
            $stmt->bindParam(":Effacer", $Prod_ID);
            $stmt->execute();
            echo "<div class='container text-center'>";
            $message = "<div class=' alert alert-danger mx-auto mt-5  w-25 shadow-lg text-dark text-center '>" . $stmt->rowCount()  . " Le produit a été bien supprimé </div>";
            echo "</div>";
            direction($message, 5);
        } else {
          echo "<div class='container'>";
          $message = "<div class=' alert alert-danger mx-auto mt-5  text-dark shadow-lg  text-center p-5'> Ce Produit n'est pas exsite dans la base de données </div>";
          echo "</div>";
          direction($message, 5);
        }
  }
  include $tbl . 'footer.inc.php';
} else {
  header('Location : index.php');
  exit();
}



?>