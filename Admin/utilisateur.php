<?php

/**
 * =========================================================================
 * === Gérer la page des membres
 * 
 * === tu peux :
 * || ajouter utilisateurs et Admin 
 * || modifier admin et utilisateurs 
 * || supréssion de admin et utilisateurs
 * ==========================================================================
 */
ob_start();
session_start();
if (isset($_SESSION['admin'])) {
            $Titre = 'Dashbord';
            include 'init.php';
            $Titre = 'Utilisateurs';
            $Emilie = '';
            // if (isset($_GET['Emilie'])) {
            //     $Emilie = $_GET['Emilie'];
            // } else {
            //     $Emilie = 'Accueil';
            // }
            $Emilie = isset($_GET['Emilie']) ?  $_GET['Emilie'] : 'Accueil';
            // si la page est la page principale
            if ($Emilie == 'Accueil') {  // page Accuiel members 

                $query = '';
                if (isset($_GET['page']) && ($_GET['page'] == "actif")) {
                    $query = 'AND Statut = 0';
                }
                $stmt = $con->prepare("SELECT * FROM utilisateurs WHERE GroupID != 1 $query ORDER BY  Id_utilisateur DESC");
                $stmt->execute();
                $Accueil = $stmt->fetchAll();
                ?>
                <div class="container-fluid">
                    <h1 class="text-center">utilisateurs Boutique</h1>
                    <h2 class="cat-h2">tableau d'utilisateurs </h2>
                    <hr>
                    <div class="table-responsive w-100  members-table mt-3">
                        <table class="table table-bordered main-table accueil-table ">
                            <tr>
                                <td>#ID</td>
                                <td>Photo</td>
                                <td>Nom</td>
                                <td>Prénom</td>
                                <td>Email</td>
                                <td>Date d'inscription</td>
                                <td>Contrôler</td>
                            </tr>

                            <?php foreach ($Accueil as $row) {
                                echo "<tr>";
                                echo "<td>#" . $row['Id_utilisateur'] . "</td>";
                                echo "<td>";
                                if (empty($row['Avatar'])) {
                                    echo "  <img src='uploads/avatars/profil.jpg' alt='img'/>";
                                } else {
                                    echo " <img src='uploads/avatars/" . $row['Avatar'] . "' alt='img'/>";
                                }

                                echo "</td>";
                                echo "<td>" . $row['Nom'] . "</td>";
                                echo "<td>" . $row['Prenom'] . "</td>";
                                echo "<td>" . $row['Email'] . "</td>";
                                echo " <td>" . $row['Date'] . "</td>";

                                echo "<td>
                                    <a href='utilisateur.php?Emilie=Edite&UtilID=" . $row['Id_utilisateur'] . "'  class='btn btn-primary '>Modifier</a>
                                        <a href='utilisateur.php?Emilie=Delete&UtilID=" . $row['Id_utilisateur'] . "'  class='btn btn-danger confirm   me-2 '>Supprimer
                                        </a>";
                                if ($row['Statut'] == 0) {
                                    echo "<a href='utilisateur.php?Emilie=Active&UtilID=" . $row['Id_utilisateur'] .   " ' class='btn btn-success  me-2 '>Active</a>";
                                }

                                echo "</td>";
                                echo "<tr>";
                            } ?>

                        </table>
                    </div>

                    <a href="utilisateur.php?Emilie=Ajouter" class="btn btn-primary "><i class="fa-solid fa-user-plus"></i> Ajouter un utilisateur</a>

                </div>

            <?php } elseif ($Emilie == 'Ajouter') { ?>

            
                <div class="container">
            
                    <!-- ------------------------------------------ -->
                    <!-- 
                            Nous allons récupérer les données de utilisateurs  dqns  base de données 
                            on va utilisé form
                            -->
                    <!-- --------------------------------------------- -->

                
                    <form class="form-horizontal form-members mx-auto  " action="?Emilie=Insert"    method="POST" enctype="multipart/form-data">
                    <h1 class=" w-50 mx-auto">Ajouter Utilisateurs </h1>
                        <!-- nom utilisateurs -->
                        <div class="mb-3 row from-group from-group-lg mt-5">
                            <label class="col-sm-2 control-label ">Nom</label>
                            <div class="col-sm-10 col-md-5 from-asterisk">
                                <input type="text" class="form-control" id="Username" name="Nom" autocomplete="off" required="required">
                            </div>
                        </div>
                        <!-- prénom utilisateurs -->
                        <div class="mb-3 row from-group from-group-lg">
                            <label class="col-sm-2 control-label">Prénom </label>
                            <div class="col-sm-10 col-md-5 from-asterisk">
                                <input type="text" class="form-control" id="Userprenom" name="Prenom" required="required">
                            </div>
                        </div>
                        <!-- image utilisateur -->
                        <div class="mb-3 row from-group from-group-lg">
                            <label class="col-sm-2 control-label">image</label>
                            <div class="col-sm-10 col-md-5 from-asterisk">
                                <input type="file" class="form-control" id="Avater" name="Avater">
                            </div>
                        </div>
                        <!-- Email utilisateurs -->
                        <div class="mb-3 row from-group from-group-lg">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10 col-md-5 from-asterisk" required="required">
                                <input type="Email" class="form-control" id="Email" name="Email" required="required">
                            </div>
                        </div>
                        <!-- Mdp utilisateurs -->
                        <div class="mb-3 row  from-group from-group-lg">
                            <label class="col-sm-2 control-label">Mot de passe</label>
                            <div class="col-sm-10 col-md-5 from-asterisk">
                            <input type="password" class=" password form-control" name="Mdp" value="" required="required">
                                <i class=" show-password fa-solid fa-eye fa-2x"></i>
                            </div>
                        </div>

                        <!-- btn pour Envoiyer  -->
                        <div class="from-group from-group-lg">
                            <div class="col-sm-offset-2 col-sm-10 col-md-5 ">
                                <input type="submit" value="Ajouter" class="btn btn-primary btn-lg">
                            </div>
                        </div>
                    </form>


                </div>


                <?php } elseif ($Emilie == 'Insert') {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    echo '<h1 class="w-50 mx-auto">Insertion des données </h1>';

                    // upload variables
                    $avtarnom = $_FILES['Avater']['name'];
                    $avtarSize = $_FILES['Avater']['size'];
                    $avtarTmp = $_FILES['Avater']['tmp_name'];
                    $avtarType = $_FILES['Avater']['type'];
                    //le type autorise pour upload
                    $avtarAllowedExtension = array("jpeg", "jpg", "png", "gif");
                    // get avter Extension
                    // strtolower() pour change maj à mns 
                    // end() pour daire à la fin de
                    //explode ()  تفسيم المصفوفة

                    $tmp = explode('.', $avtarnom);
                    $avtarExtension = strtolower(end($tmp));
                    //get Vraiable 
                    $nom = $_POST['Nom'];
                    $prenom = $_POST['Prenom'];
                    $email = $_POST['Email'];
                    $pass = $_POST['Mdp'];
                    $hashPass = sha1($_POST['Mdp']);


                    // validation de form 
                    $ErrorsForm = array(); // arry vide pour stocke les message
                    if (strlen($pass) <= 5) {
                        $ErrorsForm[] = " Mot de passe doit faire au moins 5 caractères!";
                    }
                    if (empty($pass)) {
                        $ErrorsForm[] = " Vous avez laissé le champs Mot de passe vide ";
                    }
                    if (empty($prenom)) {
                        $ErrorsForm[] = "Vous avez laissé le champs  Prénom vide ";
                    }
                    if (empty($nom)) {
                        $ErrorsForm[] = " Vous avez laissé le champs  Nom vide ";
                    }
                    if (empty($email)) {
                        $ErrorsForm[] = " Vous avez laissé le champs  Email vide";
                    }
                    if (!empty($avtarnom) && !in_array($avtarExtension, $avtarAllowedExtension)) {
                        $ErrorsForm[] = " Vous devez télécharger vos images au format suivent  : jpeg / jpg / png / gif ";
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
                        move_uploaded_file($avtarTmp, "uploads\avatars\\" . $avatar); //distinastion pour stocke les photo

                        //function pour tchek si email est déja existe déja 

                        $tchek = checkItems("Email", "utilisateurs", $email);

                        if ($tchek == 1) {
                            echo "<div class='container'>";

                            echo "<div class=' alert alert-danger mx-auto shadow-lg  text-center w-25 '> Email est déja utlisé</div>";
                            echo "</div>";
                        } else {
                            // update les donne
                            $stmt = $con->prepare("INSERT INTO 
                                                            utilisateurs(Nom,Prenom,Email,Mdp,Statut,Avatar,Date)
                                                            value(:nom,:prenom,:email,:pass,1, :img,now())");
                            //Statut 1 car il ajouter par admin  
                            $stmt->execute(array(
                                ':nom' => $nom,
                                ':prenom' => $prenom,
                                ':email' => $email,
                                ':pass' => $hashPass,
                                ':img' => $avatar
                            ));
                            //     //message success


                            echo '<div class="container">'; ?>


                    <?php
                            $message = "<div class='alert alert-success mx-auto w-75 shadow-lg bodre rounded-start'><strong> " . $stmt->rowCount() . "</strong> vous avez bien Ajouter</div>";
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
                //check integer value
                // short if else
                $Util_ID = isset($_GET['UtilID']) && is_numeric($_GET['UtilID']) ? intval($_GET['UtilID']) : 0;
                // if(isset($_GET['UtilID']) && is_numeric($_GET['UtilID'])) {
                //     echo intval($_GET['UtilID']);
                // }else {
                //     echo 0;
                // }

                // select All DAta depend on this ID

                $stmt = $con->prepare(" SELECT * FROM utilisateurs  WHERE Id_utilisateur =? LIMIT 1");
                $stmt->execute(array($Util_ID));
                $row = $stmt->fetch();
                $count = $stmt->rowCount();
                if ($count > 0) { ?>


            <h1 class="w-50 mx-auto">Modifier les informations de l'utilisateur </h1>
                    <div class="container ">
                        <!-- ------------------------------------------ -->
                        <!-- 
                            Nous allons récupérer les données de utilisateurs  dans  base de données 
                            on va utilisé form
                            -->
                        <!-- --------------------------------------------- -->
                        <form class="form-horizontal form-members ml-5 mt-5 text-center " action="?Emilie=Update" method="POST">
                            <input type="hidden" name="Utila" value="<?php echo  $Util_ID  ?>">
                            <!-- nom utilisateurs -->
                            <div class="mb-3 row from-group from-group-lg">
                                <label class="col-sm-2 control-label ">Nom</label>
                                <div class="col-sm-10 col-md-5 from-asterisk">
                                    <input type="text" class="form-control" id="Username" name="Nom" value="<?php echo  $row['Nom'] ?>" autocomplete="off" required="required">
                                </div>
                            </div>
                            <!-- prénom utilisateurs -->
                            <div class="mb-3 row from-group from-group-lg">
                                <label class="col-sm-2 control-label">Prénom </label>
                                <div class="col-sm-10 col-md-5 from-asterisk">
                                    <input type="text" class="form-control" id="Userprenom" name="Prenom" value="<?php echo $row['Prenom'] ?>" required="required">
                                </div>
                            </div>
                            <!-- Email utilisateurs -->
                            <div class="mb-3 row from-group from-group-lg">
                                <label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10 col-md-5 from-asterisk" required="required">
                                    <input type="Email" class="form-control" id="Email" name="Email" value="<?php echo  $row['Email'] ?>" required="required">
                                </div>
                            </div>
                            <!-- Mdp utilisateurs -->
                            <div class="mb-3 row  from-group from-group-lg">
                                <label class="col-sm-2 control-label">Mot de passe</label>
                                <div class="col-sm-10 col-md-5">
                                    <input type="hidden" name="ancien_mdp" value="<?php echo  $row['Mdp'] ?>">
                                    <input type="Mdp" class="form-control" name="nouveau_mdp" value="" autocomplete="new-Mdp" placeholder="lissez le champs vide si vous ne voulez pas change mot de passe">
                                </div>
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



                ?>
            <?php } elseif ($Emilie == 'Update') {
                //Update  utilisateurs
                echo '<h1 class="w-50 mx-auto"> Mettre à jour les informations de l\'utilisateur </h1>';
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    //get Vraiable 
                    $id = $_POST['Utila'];
                    $nom = $_POST['Nom'];
                    $prenom = $_POST['Prenom'];
                    $email = $_POST['Email'];

                    // j'ai crier un variable vide pour enregestre la valure de 
                    //de mote passe qui choise mambers si le champs de mote passe vide alors le mumbre il garde son mot passe si il a choise une autre mte de passe
                    $pass = '';
                    if (empty($_POST['nouveau_mdp'])) {
                        $pass = $_POST['ancien_mdp'];
                    } else {
                        $pass = sha1($_POST['nouveau_mdp']);
                    }

                    // validation de form 
                    $ErrorsForm = array(); // arry vide pour stocke les message
                    // if(strlen($pass) <= 5 ){
                    //     $ErrorsForm[] = " mote passe oblige etre entre 5 et 10 carctire";
                    // }
                    if (empty($prenom)) {
                        $ErrorsForm[] = "Vous avaez laissé le champs  Prénom vide ";
                    }
                    if (empty($nom)) {
                        $ErrorsForm[] = " Vous avaez laissé le champs  Nom vide ";
                    }
                    if (empty($email)) {
                        $ErrorsForm[] = " Vous avaez laissé le champs  Email vide ";
                    }
                    foreach ($ErrorsForm as $Error) {
                        echo ' <div class="alert alert-danger w-25 mx-auto p-2 text-black" role="alert">';
                        echo $Error . ' </br>';
                        echo '</div>';
                    }
                    if (empty($ErrorsForm)) {

                        //update les donne
                        $stmt = $con->prepare("UPDATE utilisateurs SET Nom = ?,Prenom=?,Email=? ,Mdp = ? WHERE Id_utilisateur=?");
                        $stmt->execute(array($nom, $prenom, $email,  $pass, $id));
                        //message success
                        echo "<div class='container'>";
                        $message = "<div class='alert alert-success mx-auto mt-5 w-50 text-dark  shadow-lg  text-center p-5'> Le nombre de modifications que vous avez apportées est :<strong>  " . $stmt->rowCount()  . "</strong></div>";
                        echo "</div>";
                        direction($message, 5);
                    }
                } else {
                    echo "<div class='container'>";
                    $message = "<div class=' alert alert-danger mx-auto mt-5  text-dark text-center p-5'>Cette page est destinée aux administrateurs uniquement, vous devez être administrateur pour pouvoir accéder à cette page</div>";
                    echo "</div>";
                    direction($message, 5);
                }
            } elseif ($Emilie == 'Delete') {

                echo '<h1 class="w-50 mx-auto">supprimer compte utilisateur</h1>';
                //check integer value
                // short if else
                $Util_ID = isset($_GET['UtilID']) && is_numeric($_GET['UtilID']) ? intval($_GET['UtilID']) : 0;
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
                $tchek = checkItems('Id_utilisateur', 'utilisateurs', $Util_ID);
                if ($tchek  > 0) {
                    $stmt = $con->prepare("DELETE FROM utilisateurs WHERE Id_utilisateur = :abonne");
                    $stmt->bindParam(":abonne", $Util_ID);
                    $stmt->execute();
                    echo "<div class='container text-center'>";
                    $message = "<div class=' alert alert-danger mx-auto mt-5  w-25 shadow-lg text-dark text-center '>" . $stmt->rowCount()  . " L'utilisateur a été bien supprimé </div>";
                    echo "</div>";
                    direction($message, 5);
                } else {
                    echo "<div class='container'>";
                    $message = "<div class=' alert alert-danger mx-auto mt-5  text-dark shadow-lg  text-center p-5'> Ce memmbre n'est pas exsite dans la base de données </div>";
                    echo "</div>";
                    direction($message, 5);
                }
            } elseif ($Emilie == 'Active') {
                //Active  utilisateurs
                echo '<h1 class="w-50 mx-auto">l\'activation de compte utilisateur</h1>';
                $Util_ID = isset($_GET['UtilID']) && is_numeric($_GET['UtilID']) ? intval($_GET['UtilID']) : 0;
                $tchek = checkItems('Id_utilisateur', 'utilisateurs', $Util_ID);
                if ($tchek  > 0) {
                    $stmt = $con->prepare("UPDATE  utilisateurs SET Statut = 1 WHERE Id_utilisateur = ?");
                    $stmt->execute(array($Util_ID));
                    echo "<div class='container'>";
                    $message = "<div class='alert alert-success mx-auto mt-5 w-50  shadow-lg  text-center p-5'> le compte d'utilisateur a été bien activé </div>";
                    echo "</div>";
                    direction($message, 10);
                } else {
                    echo "<div class='container'>";
                    $message = "<div class=' alert alert-danger mx-auto  w-25 text-dark shadow-lg  text-center p-5'> Ce commentaire n'est pas exsite dans la base de données </div>";
                    echo "</div>";
                    direction($message, 'back', 5);
                }
            }
} else {
    //  fin de if isset($_SESSION['admin'])
    header('Location : index.php');
    exit();
}

include $tbl . 'footer.inc.php';
ob_end_flush();


?>