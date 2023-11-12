<?php
ob_start();
session_start();

$Titre = 'Profile';

include 'init.php';
if (isset($_SESSION['utilisateur'])) {
  $profile = $con->prepare("SELECT * FROM utilisateurs WHERE Email=?");
  $profile->execute(array($_SESSION['utilisateur']));
  $info = $profile->fetch();


?>




  <div class="mt-5">
    <h2 class="avis-titre avis-titre-font_profil  w-25"><?php echo $info["Nom"] . ' profil' ?></h2>
    <div class="main-body w-75 mx-auto shawdow mt-5">
      <div class="row gutters-sm">
        <div class="col-md-4 mb-3">
          <div class="card_afichier">
            <div class="card-body">
              <div class="d-flex flex-column align-items-center text-center">
                <?php if (empty($info['Avatar'])) { ?>
                  <img src="Admin/uploads/avatars/profil.jpg"class="rounded-circle" width="300" />
               <?php } else { 
                echo " <img src='Admin/uploads/avatars/" . $info['Avatar'] . "' alt='img' class=' img-thumbnail img-fluid' />";
                } ?>
                <div class="mt-3">
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="col-md-8 mt-5 ">
          <div class="card mb-3">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0 prix-titre"> Nom  : </h6>
                </div>
                <div class="col-sm-9 text-secondary prix-fiche">
                  <?php echo  $info["Nom"] ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0 prix-titre">Prenom : </h6>
                </div>
                <div class="col-sm-9 text-secondary prix-fiche">
                  <?php echo $info["Prenom"] ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0 prix-titre">mote de passe : </h6>
                </div>
                <div class="col-sm-9 text-secondary prix-fiche">
                  *******************************
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0 prix-titre">Date d'inscription </h6>
                </div>
                <div class="col-sm-9 text-secondary prix-fiche">
                  <?php echo $info['Date'] ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0 prix-titre">L'état de compte :</h6>
                </div>
                <div class="col-sm-9 text-secondary prix-fiche">
                  <?php if ($info['Statut'] == 1) {
                    echo '<div class="alert alert-success text-center fw-bold " role="alert">votre compte est bien active</div>';
                  } else {
                    echo '<div class="alert alert-danger text-center fw-bold " role="alert">Votre compte n\'a pas encore été activé</div>';
                  } ?>
                </div>
                <a class=" btn btn-outline-secondary w-25 mx-auto btn-profil" href="edite_profil.php?Emilie=Edite&UtilID=<?php echo $info['Id_utilisateur']  ?>"> modifie profil</a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  <?php } else {
  header('location: connecter.php');
}
include  $tbl . 'footer.inc.php';

ob_end_flush();
  ?>