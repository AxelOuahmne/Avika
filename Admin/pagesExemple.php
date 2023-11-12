<?php 
   session_start();
   if(isset($_SESSION['admin'])) {
     $Titre='Dashbord';
     include 'init.php';
$Titre='';
$Emilie='';
if(isset($_GET['Emilie'])){
    $Emilie = $_GET['Emilie'];
}else{
    $Emilie = 'Accueil';
}
// si la page est la page principale
if($Emilie == 'Accueil') {
    echo 'helo in page accueil';
}elseif($Emilie == 'Ajouter') {
    echo "hello ajou";
    
}else{
echo " la page n'exicte pas";
}

   }


   include $tbl . 'footer.inc.php';
?>