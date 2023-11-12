<?php 

/**
 * //virsion 1
 * function pour get le titre
 */
function getTitre() {
    global $Titre;
    if(isset($Titre)){
        echo $Titre;
    }else {
        echo "ESPACE ADMIN";
    }

}
                                                                
 function getAllFrom($field,$table,$where=null,$and=null,$orderfield,$ordering="DESC"){

    global $con;
    $getALL = $con ->prepare("SELECT $field FROM $table $where $and ORDER BY $orderfield $ordering");
    $getALL->execute();
    $all = $getALL->fetchAll();
    return $all;
}
//virsion 1
// function de directions 
// cette function accepte des paramettre [$message: message qui va afficher dans la page ,$seconds : dure de function]
//     echo "<div class='alert alert-danger'>$message</div>";
 //=========================================================
 // virsion2 
 //$url
 // choisir la methode de message
 function direction($message ,$url= null, $seconds = 3){
     if($url === null){
        $url = 'index.php'; 
     }else {
         if(isset($_SERVER['HTTP_REFERER'])&& $_SERVER['HTTP_REFERER'] !== ''){
            $url = $_SERVER['HTTP_REFERER']; //الموقع الذي جئت منه اي الصفحة السابقة 
         }else{
            $url='index.php'; 
         }
     }
    echo $message;
     echo "<div class='alert alert-info mx-auto w-25 text-center shadow-lg bodre rounded-start'> Cette page disparaîtra après  $seconds  secondes </div>";
     header("refresh:$seconds;url=$url"); //refcher da page  est direction
     exit();
    }
 //virsion1
 // function va chercher avent d'ajouter users sur data base ice que est il exicte si il n'est pas excite elle va ajoutre si non le contrere 
 // function pour tchek element dans data base 
 //function accept des paramettre 
 //$select = select sur table
 //$from = nom de table 
 //$value = value de table

function checkItems($select ,$from ,$value){
    global $con;
    $chek = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
    $chek->execute(array($value));
    $count = $chek->rowCount();
    return $count;

}

// version 1
// compte les numbers  function pour metrre a dashboard (page admin)
// $element si l'element la quelle on le fait compte 
//$table si le table de element qla quelle que on va cherche element
function countElemntes($element ,$table){ 
    global $con;
    $stmt2 = $con->prepare("SELECT COUNT($element)FROM $table");
    $stmt2->execute();
    return $stmt2->fetchColumn();

}

/**
 * GetElements function pour récupere les element dans database 
 * exemple (members ,produits ,comments)
 * $select  = element
 * $table = table
 */
function GetElements($select ,$table,$order='DESC'){
    global $con;
    $getELm = $con->prepare("SELECT $select FROM $table  ORDER BY $order LIMIT 5");
    $getELm->execute();
    $rows = $getELm->fetchAll();
    return $rows;

}












?>