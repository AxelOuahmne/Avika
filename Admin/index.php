<?php
session_start();

$NonnavBar = "";
$Titre='Login';
if(isset($_SESSION['admin'])) {
    header('location: tdb.php');
}
include 'init.php';




// si user comming par la methode http post request il peut le contacte 
if($_SERVER['REQUEST_METHOD']=='POST'){
    $email =$_POST['email'];
    $pass =$_POST['pass'];
    $hashpass =sha1($pass);
    
    // on va tcheck si user Existe in Data basee
    $stmt = $con->prepare(" SELECT 
                            Id_utilisateur,Email ,Mdp
                            FROM
                            utilisateurs 
                            WHERE
                            Email = ? AND Mdp = ?
                            And 
                            GroupID = 1
                            LIMIT 1");

    $stmt->execute(array($email ,$hashpass));
    $row =$stmt->fetch();
    $count = $stmt->rowCount();
    //si $count > 0 alors  user est exicte 
    // si leur  GroupID =1 alors si Admin il peut accdé à la page d'ADMIN
    if($count > 0) {
         //print_r($row)
            $_SESSION['ID'] =$row['Id_utilisateur']; 
            $_SESSION['admin'] =$email; //enregister session car il vide
            header('location: tdb.php');
            exit();

    }

}
//si non il peut voir que form

?>
<h1 class="w-25 text-center mx-auto shadow-lg p-3 mb-5 bg-body rounded">Administrations</h1>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="loginAdmin mt-5">
    
    <input class="form-control" type="Email" name="email"  class="mt-2" placeholder="votre Email" autocomplete="off">
    <input class="form-control" type="password" name="pass"  class="mt-2" placeholder="votre mote de pass" autocomplete="new-password">
    <div class="d-grid">
        <input class="btn btn-primary " type="submit"  class="mt-2" value="Connexion">
    </div>
</form>

















<?php



include  $tbl . 'footer.inc.php';
?>