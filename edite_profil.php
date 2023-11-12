<?php

session_start();
if (isset($_SESSION['utilisateur'])) {
    $Titre = 'Dashbord';
    include 'init.php';
    $Titre = 'Utilisateurs';
    $Emilie = '';
    // if (isset($_GET['Emilie'])) {
    //     $Emilie = $_GET['Emilie'];
    // } else {
    //     $Emilie = 'Accueil';
    // }
    $Emilie = isset($_GET['Emilie']) ?  $_GET['Emilie'] : 'Boutique';

    if ($Emilie == 'Edite') {
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


            <h1 class="w-50 mx-auto mt-5 promotion">Modifier les informations de compte </h1>
            <div class="container ">
                <!-- ------------------------------------------ -->
                <!-- 
                            Nous allons récupérer les données de utilisateurs  dans  base de données 
                            on va utilisé form
                            -->
                <!-- --------------------------------------------- -->
                <form class="form-horizontal form-members mt-5 text-center mx-auto w-50 " action="?Emilie=Update" method="POST">
                    <input type="hidden" name="Utila" value="<?php echo  $Util_ID  ?>">
                    <div class="mb-3">
                        <label class="col-sm-2 control-label label-text ">Nom</label>
                        <input type="text" class="form-control" id="Username" name="Nom" value="<?php echo  $row['Nom'] ?>" autocomplete="off" required="required">
                    </div>
                    <div class="mb-3">
                        <label class="col-sm-2 control-label label-text">Prénom </label>
                        <input type="text" class="form-control" id="Userprenom" name="Prenom" value="<?php echo $row['Prenom'] ?>" required="required">

                    </div>
                    <div class="mb-3">
                        <label class="col-sm-2 control-label label-text">Email</label>
                        <input type="Email" class="form-control" id="Email" name="Email" value="<?php echo  $row['Email'] ?>" required="required">
                    </div>
                    <div class="mb-3">
                        <label class="col-sm-2 control-label label-text">Mot de passe</label>
                        <input type="hidden" name="ancien_mdp" value="<?php echo  $row['Mdp'] ?>">
                        <input type="Mdp" class="form-control" name="nouveau_mdp" value="" autocomplete="new-Mdp" placeholder="lissez le champs vide si vous ne voulez pas change mot de passe">
                    </div>

                    <button type="submit" class="btn btn-primary">Modifier</button>
                </form>


            <?php } else { ?>
                <div class='alert alert-white mx-auto mt-5 w-50 text-dark  shadow-lg  text-center  mb-5'>
                    <p> Désolé, Cette page n’existe pas/plus (erreur 404).Rendez-vous sur l’une de nos autres pages pour poursuivre votre visite.</p>
                    <a class='btn btn-outline-secondary' href='index.php'> boutique </a>
                    <a href="adresse.php" class="btn btn-outline-secondary">Contactez-nous </a>
                </div>
            <?php } ?>
            <?php } elseif ($Emilie == 'Update') {
            //Update  utilisateurs
            echo '<h1 class="w-50  mt-5 promotion"> Mettre à jour les informations de compte  </h1>';
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
                    $stmt->rowCount(); ?>
                    <div class='alert alert-white mx-auto mt-5 w-50 text-dark  shadow-lg  text-center  mb-5'>
                        <p> votre information est bien modifiée Rendez-vous sur l’une de nos autres pages pour poursuivre votre visite.</p>
                        <a class='btn btn-outline-secondary' href='index.php'> boutique </a>
                        <a href="profile.php" class="btn btn-outline-secondary"> Votre profil </a>
                    </div>
                <?php   } else { ?>
                    <div class='alert alert-white mx-auto mt-5 w-50 text-dark  shadow-lg  text-center  mb-5'>
                        <p> Désolé, Cette page n’existe pas/plus (erreur 404).Rendez-vous sur l’une de nos autres pages pour poursuivre votre visite.</p>
                        <a class='btn btn-outline-secondary' href='index.php'> boutique </a>
                        <a href="adresse.php" class="btn btn-outline-secondary">Contactez-nous </a>
                    </div>

    <?php  }
            } else {
                header('Location: index.php');
                exit();
            }
        }
        include $tbl . 'footer.inc.php';
    } else {
        header('Location : index.php');
        exit();
    }



    ?>