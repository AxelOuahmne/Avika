<?php
ob_start();
session_start();
if (isset($_SESSION['admin'])) {
    $Titre = 'Dashbord';
    include 'init.php';
    $Titre = '';
    $Emilie = '';
    if (isset($_GET['Emilie'])) {
        $Emilie = $_GET['Emilie'];
    } else {
        $Emilie = 'Accueil';
    }
    // si la page est la page principale
    if ($Emilie == 'Accueil') {
        $stmt = $con->prepare("SELECT  commentaire.*, produits.Nom AS Prduit,utilisateurs.Nom AS Client
     FROM  commentaire
     INNER JOIN  produits
     ON
      produits.Id_produit = commentaire.Commentaire_Produit
      INNER JOIN  utilisateurs
      ON
      utilisateurs.Id_utilisateur = commentaire.Commentaire_Utilesateur ORDER BY Commentaire_Id  DESC ");
        $stmt->execute();
        $Accueil = $stmt->fetchAll();
?>
        <div class="container-fluid">
            <h1 class="text-center">commentaire de produit boutique </h1>
            <h2 class="cat-h2">Tableau des commentaires </h2>
            <hr>
            <div class="table-responsive w-100  members-table mt-3">
                <table class="table table-bordered main-table accueil-table ">
                    <tr>
                        <td>#ID</td>
                        <td>Commentaire</td>
                        <td>Produit</td>
                        <td>Utilisateur</td>
                        <td>Date</td>
                        <td>Contrôler</td>>
                    </tr>

                    <?php foreach ($Accueil as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['Commentaire_Id'] . "</td>";
                        echo "<td>" . $row['Commentaire'] . "</td>";
                        echo "<td>" . $row['Prduit'] . "</td>";
                        echo "<td>" . $row['Client'] . "</td>";
                        echo " <td>" . $row['Commentaire_Date'] . "</td>";
                        echo "<td class='text-center'>
                        <a href='commentaire.php?Emilie=Edite&CommID=" . $row['Commentaire_Id'] . "'  class='btn btn-primary mb-sm-2 me-2 '>Modifier
                        <i class='fa-solid fa-comment'></i></a>
                            <a href='commentaire.php?Emilie=Delete&CommID=" . $row['Commentaire_Id'] . "'  class='btn btn-danger confirm me-2 '>Supprimer <i class='fa-solid fa-trash-can'></i></a>";
                        if ($row['Satut'] == 0) {
                            echo "<a href='commentaire.php?Emilie=Approve&CommID=" . $row['Commentaire_Id'] .   " ' class='btn btn-success mb-sm-2 mt-sm-2'>approuvé
                            <i class='fa-solid fa-thumbs-up'></i></a>";
                        }

                        echo "</td>";
                        echo "<tr>";
                    } ?>

                </table>
            </div>

        </div>
        <?php  } elseif ($Emilie == 'Edite') {
        //check integer value
        // short if else
        $CommID = isset($_GET['CommID']) && is_numeric($_GET['CommID']) ? intval($_GET['CommID']) : 0;
        // if(isset($_GET['UtilID']) && is_numeric($_GET['UtilID'])) {
        //     echo intval($_GET['UtilID']);
        // }else {
        //     echo 0;
        // }

        // select All DAta depend on this ID

        $stmt = $con->prepare(" SELECT * FROM commentaire  WHERE Commentaire_Id =? ");
        $stmt->execute(array($CommID));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
        if ($count > 0) { ?>
            <h1 class="w-50 mx-auto"">Modifier les commentaire </h1>
            <div class=" container">
                <form class="form-horizontal form-members ml-5 mt-5 text-center " action="?Emilie=Update" method="POST">
                    <input type="hidden" name="commentaireID" value="<?php echo $CommID  ?>">
                    <!-- Commentaire  -->
                    <div class="mb-3 row from-group from-group-lg">
                        <label for="commentaire" class="form-label">Votre commentaire</label>
                        <textarea class="form-control" id="commentaire" name="comment" rows="3"><?php echo $row['Commentaire'] ?></textarea>
                    </div>
                    <!-- btn pour Envoyer  -->
                    <div class="from-group from-group-lg">
                        <div class="col-sm-offset-2 col-sm-10 col-md-5 ">
                            <input type="submit" value="Envoiyer" class="btn btn-primary btn-lg">
                        </div>
                    </div>
                </form>
                </div>

    <?php } else {
            echo "<div class='container'>";
            $message = "<div class=' alert alert-danger mx-auto mt-5  text-dark text-center p-5'>Cette page est destinée aux administrateurs uniquement, vous devez être administrateur pour pouvoir accéder à cette page</div>";
            echo "</div>";
            direction($message, 5);
        }
    } elseif ($Emilie == 'Update') {
        //Update  commentaire
        echo '<h1 class="text-center">Mettre à jour les informations de commentaire  </h1>';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //get Vraiable 
            $id = $_POST['commentaireID'];
            $commentaire = $_POST['comment'];


            //update les donne
            $stmt = $con->prepare("UPDATE commentaire SET Commentaire = ? WHERE Commentaire_Id = ? ");
            $stmt->execute(array($commentaire, $id));
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

        echo '<h1 class="text-center">supprimer le commentaire</h1>' ;
        //check integer value
        // short if else
        $CommID = isset($_GET['CommID']) && is_numeric($_GET['CommID']) ? intval($_GET['CommID']) : 0;
        // if(isset($_GET['CommID']) && is_numeric($_GET['CommID'])) {
        //     echo intval($_GET['CommID']);
        // }else {
        //     echo 0;
        // }

        $tchek = checkItems('Commentaire_Id', 'commentaire', $CommID);
        if ($tchek  > 0) {
            $stmt = $con->prepare("DELETE FROM commentaire WHERE Commentaire_Id = :id");
            $stmt->bindParam(":id", $CommID);
            $stmt->execute();
            echo "<div class='container text-center'>";
            $message = "<div class=' alert alert-danger mx-auto mt-5  w-25 shadow-lg text-dark text-center '><strong >" . $stmt->rowCount()  . " </strong> le commentaire a été bien supprimé </div>";
            echo "</div>";
            direction($message, 5);
        } else {
            echo "<div class='container'>";
            $message = "<div class=' alert alert-danger mx-auto mt-5  fw-bold message_alert shadow-lg  text-center p-5'> cette commenatire n'est pas exsiter dans la base de données </div>";
            echo "</div>";
            direction($message, 'back', 5);
        }
    } elseif ($Emilie == 'Approve') {
        //Active  utilisateurs
        echo '<h1 class="text-center">l\'approbation  de  commentaire </h1>';
        $CommID = isset($_GET['CommID']) && is_numeric($_GET['CommID']) ? intval($_GET['CommID']) : 0;
        $tchek = checkItems('Commentaire_Id', 'commentaire', $CommID);
        if ($tchek  > 0) {
            $stmt = $con->prepare("UPDATE  commentaire SET Satut = 1 WHERE Commentaire_Id = ?");
            $stmt->execute(array($CommID));
        
            echo "<div class='container'>";
            $message = "<div class='alert alert-success mx-auto mt-5 w-50  shadow-lg  text-center p-5'> le commentaire est bien Approuvé  </div>";
            echo "</div>";
            direction($message, 10);
        } else {
            echo "<div class='container'>";
            $message = "<div class=' alert alert-danger mx-auto  w-25 text-dark shadow-lg  text-center p-5'> Ce commentaire n'exsite  pas dans la base de données </div>";
            echo "</div>";
            direction($message, 'back', 5);
        }
    } else {
        header('Location : index.php');
        exit();
    }
}


include $tbl . 'footer.inc.php';
ob_end_flush();
    ?>