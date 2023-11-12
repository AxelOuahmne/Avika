<?php
session_start();
$Titre = 'Contactez-nous';

include 'init.php'; 
 if (isset($_SESSION['utilisateur'])) { ?>
     
        <div class="row">
        <h1 class='title '>Contactez-nous </h1>
    
        <div class="w-75 mx-auto shadow-lg p-3 mb-5 bg-body  rounded-start">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="mb-3 ">
                <label for="exampleFormControlInput1" class="form-label">Votre Téléphone</label>
                <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="+33766397744" name="tele" required="required">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Votre Message</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message" required="required"></textarea>
            </div>
            <div class="mb3">
                <input class="btn btn-success taxt-center" type="submit" name="contacte-nous" value="Envoie" />
            </div>
            </form>
         
        </div>
        <?php
           if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
               $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
               $Tele = $_POST['tele'];
               $ID_client =  $_SESSION['ID'];


                        if (!empty($message)) {
                            $stmt = $con->prepare(" INSERT INTO 
                            contacter(Message,Tele,Date,ID_Client)
                             VALUES(:message,:telephone,NOW(),:clinet) ");
                            $stmt->execute(array(
                                 ':message' => $message,
                                ':telephone' => $Tele,
                                ':clinet' => $ID_client,
                               
                            ));


                                if ($stmt) {
                                    echo '<div class="alert alert-success text-center" role="alert">
                                    Nous avons bien  reçu votre message. Nous vous contacterons dans les 48 heures. Merci pour votre confiance
                                            </div>';
                                } else{
                                    echo "un probleme téchnique";
                                }
                        }
}
       
} else {
    echo '<div class="alert alert-info w-75 text-center mx-auto" role="alert">
    Vous devez être inscrit chez nous afin de pouvoir communiquer avec nous via cette page '   . '<a href="connecter.php " class="btn btn-dark"> Connexion </a> <a href="connecter.php " class="btn btn-dark "> Inscription </a> ' . 'Si vous souhaitez communiquer avec nous sans vous inscrire, nous vous informons que notre numéro de téléphone et notre courriel se trouvent sur cette page '.'<a href="adresse.php " class="btn btn-dark"> Notre Adresse </a>'.'
</div><hr>';
}?>

<?php include  $tbl . 'footer.inc.php';

?>