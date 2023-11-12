<?php
function debug($var){
  echo '<pre class="border border-dark bg-light text-primary">';
  print_r($var); 
  echo '</pre>';

}
    session_start();
    $Titre='Panier';
    include 'init.php';
    if(isset($_POST['Ajouter'])){
     
      if(isset ($_SESSION['panier'])){
        $_SESSION['Panier'][0]['totale']= 0;
        $session_array_id = array_column($_SESSION['panier'],"id");
        if(!in_array($_GET['id'] ,$session_array_id)){
          $session_array =array(
            'id'=> $_GET['id'],
            'nom'=>$_POST['nom'],
            'prix'=>$_POST['prix'],
            'quantite'=>$_POST['quantite'],
            'categorie'=>$_POST['categorie'] ,
            'totale' => 0
          );
          $_SESSION['panier'][]=$session_array;
        }
        
      } else{
        $session_array =array(
          'id'=> $_GET['id'],
          'nom'=>$_POST['nom'],
          'prix'=>$_POST['prix'],
          'categorie'=>$_POST['categorie'],
          'quantite'=>$_POST['quantite'],
          'totale' => 0
        );
        $_SESSION['panier'][]=$session_array;
      }
      }
    echo '<h1 class="text-center mt-5  p-5 mx-auto Favorie"> <i class="fa-solid fa-bag-shopping"></i> Votre Panier </h1>';  
 if(!empty($_SESSION['panier'])){
    ?>
 

 
    <table class="table table-dark table-striped w-75 mx-auto mt-5">

      <thead>
      <tr>
    <td>ID<td>
    <td>Nom<td>
    <td>Prix<td>
    <td>Categorie<td>
    <td>Quantite<td>
    <td>Prix Totale<td>
    <td>Action<td>
    <tr>  
    </thead>
    <?php if (!empty($_SESSION['panier']))  {
      
      foreach($_SESSION['panier'] AS $key =>$value) {
        $P =(int)$value['prix'] ;
        $Q=(int)$value['quantite'] ;
        $t = $P*$Q ;
       (int)$value['totale'] = $t ;
        $_SESSION['panier'][$key]['totale'] = $t;
        
        ?>
       
        <tbody>
        <tr>
        <td> <?php echo $value['id'] ;?> <td>
        <td> <?php  echo $value['nom'] ;?> <td>
        <td> <?php  echo $value['prix'] ;?> <td>
        <td> <?php  echo $value['categorie']; ?> <td>
        <td> <?php  echo $value['quantite']; ?> <td>
        <td> <?php  echo $value['totale']  ?> <td>
        <td>
        <a href="panier.php?action=remove&id= <?php echo $value['id']; ?> ">
        <button class='btn btn-danger btn-block'>supprimer</button><a>
        <td>
    </tr>
    </tbody>
 
    <?php   }
    
    ?>
    <tr>
        <td colspan='3'></td>
        <td></b> Prix Total</b></td>
      
        <td> <?php
         $totlePanier = 0 ;
         foreach($_SESSION['panier'] AS $key =>$value){
         
          $totlePanier +=(int)$value['totale'] ;
        
        //  debug($totlePanier);
         }
         echo $totlePanier;
        ?></td>
        <td>
        <a href='panier.php?action=clearall'>   
        <button class='btn btn-warning btn-block '> effacer-tous </button><a>
        </td>
    </tr>          
</table>
 
<?php 


if(isset($_GET['action'])){

  if($_GET['action'] == "clearall") {
    unset($_SESSION['panier']);
    echo "<div class='container mt-5 w-50 m-auto'>
    <span><div class='alert alert-danger text-center' role='alert'>
    Si vous désirez supprimer tous les articles de votre panier, cliquez a nouveau sur  ' effacer-tous '
  </div></span>
</div>";
  }
  if($_GET['action'] == "remove") {


        foreach(($_SESSION['panier']) AS  $key => $value){
          if($value['id'] == $_GET['id']){
              unset($_SESSION['panier'][$key]);
              echo "<div class='container mt-5 w-50 m-auto'>

              <span><div class='alert alert-danger text-center' role='alert'>
              Si vous désirez supprimer un article de votre panier cliquez a nouveau sur ' supprimer '
            </div></span>
        </div>";
            }
        }
      
    }

}
}
} else {
  echo "<div class='container mt-5 w-50 m-auto'>
  
        <span><div class='alert alert-info text-center' role='alert'>
       votre  Panier est vide !
      </div></span>
  </div>";
  }



  include  $tbl . 'footer.inc.php';

  ob_end_flush();
  ?>