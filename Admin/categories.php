<?php

/**
 * =========================================================================
 * === Gérer la page des Categories  
 * 
 * === tu peux :
 * || ajouter des Categories  
 * || modifier des Categories  
 * || supréssion des Categories    
 * ==========================================================================
 */
session_start();
if (isset($_SESSION['admin'])) {
  include 'init.php';
  $Titre = 'Catégories';
  $Emilie = '';

  $Emilie = isset($_GET['Emilie']) ?  $_GET['Emilie'] : 'Accueil';
  if ($Emilie == 'Accueil') {  // page Accuiel members 
    $order = 'ASC';
    $order_arry = array('ASC', 'DESC');
    if (isset($_GET['order']) && in_array($_GET['order'], $order_arry)) {
      $order = $_GET['order'];
    }
    $stm = $con->prepare("SELECT * FROM categories WHERE pere = 0 ORDER BY Classement $order ");
    $stm->execute();
    $categ = $stm->fetchAll();
    // print_r($categ);
?>
    <h1 class="text-center">Catégories boutique</h1>
    <div class="container">
      <div class="row">
        <div class="card card-default widget shadow-lg ">
          <div class="card-header d-flex  justify-content-between">
            <h2 class="card-tete">Les catégories</h2>
            <span class="ordering">
              <a href="?order=DESC"> <i class="fa-solid fa-arrow-down-z-a"></i> DESC </a>
              <a href="?order=ASC"><i class="fa-solid fa-arrow-up-a-z"></i> ASC</a>
            </span>
          </div>
          <div class="card-body category">
            <?php foreach ($categ as $cat) { ?>
              <div class="row">
                <div class=" col-md-6">
                  <div class="cat">
                    <?php
                    echo '<h2>' . $cat['Nom'] . '</h2>';
                    echo '<div class=" tous-voir">';
                    // get child Categorie 
                    $childcategories = getAllFrom("*", "categories", "WHERE pere = {$cat['ID']}", "", "ID", "ASC");
                    if (!empty($childcategories)) {
                      echo "<h6> facultatif categorie</h6>";
                      foreach ($childcategories as $child) {
                        echo '<div class="child-categorie">';
                        echo "<span class='child'>
                    <a  href='categories.php?Emilie=Edite&CatID=" . $child['ID'] . "'>" . $child['Nom'] . "</a>
                    <a  class='confirm delete-child' href='categories.php?Emilie=Delete&CatID=" . $child['ID'] .  "'>Dlete</a>";
                        echo " </span>";
                        echo '</div>';
                      }
                    }
                    echo '</div>';
                    ?>
                  </div>
                </div>
                <div class="col-md-6 d-flex justify-content-end widget hidden-btn">
                  <div class=" action ">
                    <a href="categories.php?Emilie=Edite&CatID=<?php echo $cat['ID'] ?>" class="btn btn-success btn-xs" title="Modifier">
                      <span  class="fa-solid fa-pen-to-square"></span>
                    </a>
                    <a href="categories.php?Emilie=Delete&CatID=<?php echo $cat['ID'] ?>" class="btn btn-danger btn-xs confirm" title="Effacer">
                      <span class="fa-solid fa-trash-can"></span>
                    </a>
                  </div>
                </div>
              </div>
              <hr>
            <?php } ?>
          </div>
        </div>
      </div>
      <a href="categories.php?Emilie=Ajouter" class="btn btn-primary mt-3 mb-3"><i class="fa-solid fa-plus"></i>ajouter une catégorie</a>
    </div>
  <?php } elseif ($Emilie == 'Ajouter') {  ?>
    <h1 class="w-50 mx-auto"> ajouter une catégorie</h1>
    <div class="container bootstrap snippets bootdey">
      <h2 class="cat-h2">Catégorie </h2>
      <hr>
      <div class="row  ">
        <form class="form-horizontal form-category " action="?Emilie=Insert" method="POST">
          <div class="form-group row mb-3 mt-3  ">
            <label class="col-2 control-label text-center">Nom</label>
            <div class="col-10  ">
              <input class="form-control " type="text" name="nom" placeholder="nom de categorie">
            </div>
          </div>
  
          <div class="form-group mb-3 row">
            <label class="col-2 text-center control-label">Classement</label>
            <div class="col-10 ">
              <input class="form-control" type="text" name="classment" placeholder=" numéro  EX: 1">
            </div>
          </div>
          <div class="form-group mb-3 row">
            <label class="col-2 text-center control-label">Type</label>
            <div class="col-10 ">
              <select name="pere">
                <option value="0">Principal</option>
                <?php
                $allcategories = getAllFrom("*", "categories", "WHERE pere = 0", "", "ID", "ASC");
                foreach ($allcategories as $cat) {
                  echo "<option value='" . $cat['ID'] . "'>" . $cat['Nom'] . "</option>";
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
    <hr>
    <?php } elseif ($Emilie == 'Insert') {
    echo '<h1 class="w-50 mx-auto">Insertion des données </h1>';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
      //get Vraiable 
      $nom = $_POST['nom'];

      $classement = $_POST['classment'];
      $pere = $_POST['pere'];
      //function pour tchek si Category  est déja existe déja 
      $tchek = checkItems("Nom", "categories", $nom);
      if ($tchek == 1) {
        echo "<div class='container'>";
        echo "<div class=' alert alert-danger mx-auto  text-black shadow-lg  text-center w-25> Catégorier  déja Existé</div>";
        echo "</div>";
      } else {
        //update les donne
          if(!empty($_POST['nom'])) {
            $stmt = $con->prepare("INSERT INTO 
            categories(Nom,Classement,pere )
           value(:nom,:classement,:pere)");
           //Status 1 car il ajouter par admin  
           $stmt->execute(array(
             ':nom' => $nom,
             ':classement' => $classement,
             ':pere' => $pere
           ));
   
   
           //message success
       
           $message = "<div class='alert alert-success mx-auto w-25 shadow-lg bodre rounded-start tex-center text-blak'><strong> " . $stmt->rowCount() . "</strong> vous avez bien Ajouter une nouvelle catégorie</div>";
           direction($message, 'back', 5);
           echo  '<div>';
          } else{
            $message = "<div class='alert alert-danger mx-auto w-25 shadow-lg bodre rounded-start tex-center text-blak'>vous ne avez pas Ajouter une nouvelle catégorie car le champs de nom est vide </div>";
            direction($message, 'back', 5);
            echo  '<div>';
          }
      }
    } else {
      echo "<div class='container'>";
      $message = "<div class=' alert alert-danger mx-auto mt-5  text-dark text-center p-5'>Cette page est destinée aux administrateurs uniquement, vous devez être administrateur pour pouvoir accéder à cette page</div>";
      echo "</div>";
      direction($message, 5);
    }
  } elseif ($Emilie == 'Edite') {
    echo '<h1 class="w-50 mx-auto"> Modifier les informations de categorie </h1>';
    $CatID = isset($_GET['CatID']) && is_numeric($_GET['CatID']) ? intval($_GET['CatID']) : 0;


    $stmt = $con->prepare(" SELECT * FROM  categories   WHERE ID = ? ");

    $stmt->execute(array($CatID));
    $cat = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($count > 0) { ?>
      <div class="row mx-auto  ">
        <form class="form-horizontal form-category " action="?Emilie=Update" method="POST">
          <input type="hidden" name="categoryID" value="<?php echo  $CatID //enrgestrement les valeurs de session 
                                                        ?>">
          <div class="form-group row mb-3 mt-3  ">
            <label class="col-4 control-label text-center">Nom</label>
            <div class="col-8  ">
              <input class="form-control " type="text" name="nom" placeholder="nom de categories" value="<?php echo $cat['Nom'] ?>">
            </div>
          </div>

          <div class="form-group mb-3 row">
            <label class="col-4 text-center control-label">Classement</label>
            <div class="col-8 ">
              <input class="form-control" type="text" name="classment" placeholder=" numéro de Classment de votre Category EX: 1" value="<?php echo $cat['Classement'] ?>">
            </div>
          </div>
          <div class="form-group mb-3 row">
            <label class="col-4 text-center control-label">Type Catégorie</label>
            <div class="col-8 ">
              <select name="pere">
                <option value="0">Prencipal </option>
                <?php
                $allcategories = getAllFrom("*", "categories", "WHERE pere = 0", "", "ID", "ASC");
                foreach ($allcategories as $categories) {
                  echo "<option value='" . $categories['ID'] . "'";
                  if($cat['pere'] == $categories['ID']){
                    echo "selected";
                  }
                  echo  ">" . $categories['Nom'] . "</option>";
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group mb-3 row">
            <div class="col-4 mx-auto ">
              <input type="submit" value="Modifier" class="btn btn-primary btn-lg">
            </div>
          </div>

        </form>
      </div>

      </div>
<?php

    } else {
      echo "<div class='container'>";
      $message = "<div class=' alert alert-danger mx-auto mt-5  text-dark text-center p-5'>Cette page est destinée aux administrateurs uniquement, vous devez être administrateur pour pouvoir accéder à cette page</div>";
      echo "</div>";
      direction($message, 5);
    }
  } elseif ($Emilie == 'Update') {
    echo '<h1 class="text-center">Mettre à jour les informations de  Categorie</h1>';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //get Vraiable 
      $id = $_POST['categoryID'];
      $nom = $_POST['nom'];
      $classment = $_POST['classment'];
      $pere =$_POST['pere'];


      //update les donne
      $stmt = $con->prepare("UPDATE  categories  SET Nom = ?,Classement=?,pere=? WHERE ID=?");
      $stmt->execute(array($nom, $classment,$pere, $id));
      //message success
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
    echo '<h1 class="text-center">supprimer la catégorie</h1>';

    $CatID = isset($_GET['CatID']) && is_numeric($_GET['CatID']) ? intval($_GET['CatID']) : 0;
    $tchek = checkItems('ID', 'categories', $CatID);
    if ($tchek  > 0) {
      $stmt = $con->prepare("DELETE FROM categories WHERE ID = :id");
      $stmt->bindParam(":id", $CatID);
      $stmt->execute();
      echo "<div class='container text-center'>";
      $message = "<div class=' alert alert-danger mx-auto mt-5  w-25 shadow-lg text-dark text-center '>" . $stmt->rowCount()  . " la catégorie a été bien supprimé </div>";
      echo "</div>";
      direction($message, 5);
    } else {
      echo "<div class='container'>";
      $message = "<div class=' alert alert-danger mx-auto mt-5  fw-bold message_alert shadow-lg  text-center p-5'> cette catégorie n'est pas exsiter dans la base de données </div>";
      echo "</div>";
      direction($message, 'back', 5);
    }
  }
  include $tbl . 'footer.inc.php';
} else {
  header('Location : index.php');
  exit();
}



?>