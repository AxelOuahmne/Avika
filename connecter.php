<?php
ob_start();
session_start();
$Titre = 'Connecter';
if (isset($_SESSION['utilisateur'])) {
    header('location: profile.php');
}
include 'init.php';

// si user comming par la methode http post request il peut le contacte 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['connexion'])) {
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $hashpass = sha1($pass);


        // on va tcheck si user Existe in Data basee
        $stmt = $con->prepare(" SELECT  	Id_utilisateur ,GroupID, Email ,Mdp
                            FROM utilisateurs 
                            WHERE Email = ?
                             AND Mdp = ? ");

        $stmt->execute(array($email, $hashpass,));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();

        if ($count > 0) {

            //enregister les cordonne dans  session
            if ($row['GroupID'] == '1') {
                $_SESSION['utilisateur'] = $email;
                $_SESSION['ID'] = $row['Id_utilisateur'];
                header('location: Admin/tdb.php');
            } else {
                $_SESSION['utilisateur'] = $email;
                $_SESSION['ID'] = $row['Id_utilisateur'];
                header('location: profile.php');
                exit();
            }
        } else {
            $FormError[] = 'ERREUR : Votre Email ou  mot de passe est incorrect  !';
        }
    } else {
        $FormError = array();
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
        //تخزين المعلومات التي ارسلتها الفورم دخل فريبل
        $nom    = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $pass_1 = $_POST['psd1'];
        $pass_2 = $_POST['psd2'];
        $email = $_POST['email'];
        if (!empty($avtarnom) && !in_array($avtarExtension, $avtarAllowedExtension)) {
            $FormError[] = " champs imag une form intérd il faut jpeg jpg png gif ";
        }
        if ($avtarSize > 4194304) {
            $FormError[] = "  le size de champs imag trés large 4MB ";
            //4 MB = 1024 P(payte) * 4 * 1024 pour payet
        }
        if (isset($nom)) {
            $filterNom = filter_var($nom, FILTER_SANITIZE_STRING);
            // Pour des raisons de sécurité nous allons Filtre le champs de nom pour evité les code des programation
            if (strlen($filterNom) < 4 || strlen($filterNom) > 10) {
                // Vérifier si le nom a entre 3 et 20 caractères(strlen) et stocke erreur dans table 
                $FormError[] = 'ERREUR : Le nom doit faire entre 3 et 10 caractères!';
            }
        }
        if (isset($prenom)) {
            $filterPrenom = filter_var($prenom, FILTER_SANITIZE_STRING);
            // Pour des raisons de sécurité nous allons Filtre le champs de prenom pour evité les code des programation
            if (strlen($filterPrenom) < 2 || strlen($filterPrenom) > 10) {
                // Vérifier si le prenom a entre 3 et 20 caractères(strlen) et stocke erreur dans table 
                $FormError[] = 'ERREUR : Le Prenom doit faire entre 3 et 10 caractères!';
            }
        }
        if (isset($email)) {
            $filterEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
            // Pour des raisons de sécurité nous allons Filtre le champs de Email pour evité les emails non valide 
            if (filter_var($filterEmail, FILTER_VALIDATE_EMAIL) != true) {
                $FormError[] = ' ERREUR : votre adresse email n\'est pas valide';
            }
        }
        if (isset($pass_1) && isset($pass_2)) {
            if (empty($pass_1)) {
                $FormError[] = 'ERREUR : le champ du mot de passe est vide';
            }
            if (sha1($pass_1) !== sha1($pass_2)) {
                $FormError[] = 'ERREUR : Votre mot de passe est incorrect!';
            }
        }
        // Si la table FormError est vide, cela signifie qu'il n'y a pas d'erreur  alors on commençe l'insert
        if (empty($FormError)) {
            $avatar = rand(0, 100000) . '_' . $avtarnom; //IDAFT AR9AM 3CHO2IYA TOMA _ 9BLA ISM SORA
            move_uploaded_file($avtarTmp, "Admin\uploads\avatars\\" . $avatar); //distinastion pour stocke les photo
            //function pour tchek si email est déja existe déja dans database  
            $tchek = checkItems("Email", "utilisateurs", $email);
            if ($tchek == 1) {
                $FormError[] = 'ERRUR : Cette adresse e-mail est déjà utilisée';
            } else {
                // update les donne
                $stmt = $con->prepare("INSERT INTO 
                                            utilisateurs(Nom,Prenom,Email,Mdp,Statut,Avatar,Date)
                                            value(:nom,:prenom,:email,:pass,0,:image,now())");
                //Statut 1 car il ajouter par admin  
                $stmt->execute(array(
                    ':nom' => $nom,
                    ':prenom' => $prenom,
                    ':email' => $email,
                    ':pass' => sha1($pass_1),
                    ':image' => $avatar
                ));


                //message success

                $messagInscription = 'FÉLICITATIONS, VOTRE INSCRIPTION A BIEN ÉTÉ PRISE EN COMPTE ';
            }
        }
    }
}
//si non il peut voir que form
?>
<div class="container mt-5 connecter  ">
    <h1 class="text-center shadow-lg p-3 mb-5 bg-body rounde w-50 mx-auto">
        <span class=" selected" data-class="connexion"> connexion </span> |
        <span data-class="inscription "> inscription</span>
        <!-- data-class hit mli kander disply none lform inscription kaymchi liya hta span  -->
    </h1>
    <!-- ============================== -->
    <!-- form connexion  -->
    <!-- ======================== -->
    <form action="" class="connexion shadow-lg p-3 mb-5 bg-body rounde " action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <input class="form-control" type="email" name="email" autocomplete="off" placeholder="Entre votre Email">
        <input class="form-control" type="password" name="pass" autocomplete="new-password" placeholder="Entre votre mot de passe ">
        <input class="btn btn-primary btn-block" name="connexion" type="submit" value="connexion" />
    </form>
    <div class="message mx-auto w-50">
        <?php
        if (!empty($FormError)) {
            //affiche les erreurs dans un boucle foreach 
            foreach ($FormError as $Error) { ?>
                <div class="alert alert-danger  " role="alert">
                    <?php echo $Error ?>
                </div>
        <?php }
        }
        if (isset($messagInscription)) {
            echo '<div class="alert alert-success" role="alert">' . $messagInscription . '</div>';
        }
        ?>
    </div>
    <!-- ============================== -->
    <!-- form inscription  -->
    <!-- ======================== -->
    <form class="inscription shadow-lg p-3 mb-5 bg-body rounde" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
        <div class="from-asterisk">
            <!--  Pour des raisons de sécurité  la parti frontend 
        nous allons utlise pattern" .{,}" ,title="" , required="required"   -->
            <input pattern=".{3,10}" title="Le nom doit faire entre 3 et 10 caractères!" class="form-control" type="text" name="nom" placeholder="Entre votre Nom" required="required">
        </div>
        <div class="from-asterisk">
            <input pattern=".{3,10}" title="Le prenom doit faire entre 3 et 10 caractères!" class="form-control" type="text" name="prenom" placeholder="Entre votre Prenom" required="required">
        </div>
        <div class="from-asterisk">
            <input class="form-control" type="email" name="email" placeholder="Entre votre Email " required="required">
        </div>
        <div class="from-asterisk">
            <!--  minlength="" Un mot de passe doit contenir au minimum 5 caractére  -->
            <input minlength="5" class="form-control" type="password" name="psd1" placeholder="Entre votre mot de passe " required="required">
        </div>
        <!--  minlength="" Un mot de passe doit contenir au minimum 5 caractére  -->
        <div class="from-asterisk">
            <input minlength="5" class="form-control " type="password" name="psd2" placeholder="Retaper votre mot de passe " required="required">
        </div>
        <div class="from-asterisk">
            <input type="file" class="form-control" id="Avater" name="Avater" title="vous povez télécharger votre phote de compte">
        </div>


        <input class="btn btn-success btn-block" type="submit" name="inscription" value="inscription" />
    </form>
    <!-- ============================== -->
    <!-- fin form inscription  -->
    <!-- ======================== -->

</div>

<?php include  $tbl . 'footer.inc.php';
ob_end_flush();
?>