
<?php

$dsn = 'mysql:host=localhost;dbname=styliste';
$user = 'root';
$pass = '';
$option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8',
);
 try {
     $con = new PDO($dsn,$user,$pass,$option);
     $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
     //echo 'vous êtes contacté bienvenue dans la base de données';
 }
catch(PDOException $e){
    echo'vous n\'êtes pas  contacté au la base de données' .$e->getMessage();

}
?>