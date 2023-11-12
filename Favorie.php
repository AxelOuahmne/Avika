<?php
ob_start();
    session_start();
    $Titre='Favories';
    include 'init.php';
    if(isset($_POST['Ajouter'])){
      if(isset ($_SESSION['favoir'])){
        $session_array_id = array_column($_SESSION['favoir'],"id");
        if(! in_array($_GET['id'] ,$session_array_id)){
          $session_array =array(
            'id'=> $_GET['id'],
            'nom'=>$_POST['nom'],
            'categorie'=>$_POST['categorie'] 
          );
          $_SESSION['favoir'][]=$session_array;
        }
        
      } else{
        $session_array =array(
          'id'=> $_GET['id'],
          'nom'=>$_POST['nom'],
          'categorie'=>$_POST['categorie'],
   
        );
        $_SESSION['favoir'][]=$session_array;
      }
      }

    ?>

<h1 class="text-center mt-5  p-5 mx-auto Favorie"> <i class="fa-solid fa-heart"></i> Votre Favorie </h1>
    <?php if (!empty($_SESSION['favoir']))  { ?>
    <table class="table table-dark table-striped w-75 mx-auto">

      <thead>
      <tr>
    <td>ID<td>
    <td>Nom<td>
    <td>Categorie<td>
    
 
    <td>Action<td>
    <tr>  
    </thead>
    
<?php 
        $total=0;
      foreach($_SESSION['favoir'] AS $key =>$value) {
        ?>
       
        <tbody>
        <tr>
        <td> <?php echo $value['id'] ;?> <td>
        <td> <?php  echo $value['nom'] ;?> <td>
        <td> <?php  echo $value['categorie']; ?> <td>
        <td>
        <a href="Favorie.php?action=remove&id= <?php echo $value['id']; ?> ">
        <button class='btn btn-danger btn-block'>supprimer</button><a>
        <td>
    </tr>
    </tbody>
 
    <?php   }
  //$total = 0;
//   foreach ($panierWithData as $item) {
//     $totalItem = $item['product']->getPrice() * $item['quantity'];
//     $total += $totalItem;
// }
    
  // for ($total = 0; $total < $t; $total++) {
  //   $C += $total * $t;
  // }
    ?>
    <tr>
        <td>
        <a href='Favorie.php?action=clearall'>   
        <button class='btn btn-warning btn-block '> effacer-tous</button><a>
        </td>
    </tr>          
</table>
<?php 
if(!empty($_SESSION['favoir'])){
if(isset($_GET['action'])){
  if($_GET['action'] == "clearall") {
    unset($_SESSION['favoir']);
    echo "<div class='container mt-5 w-50 m-auto'>
    <span><div class='alert alert-danger text-center' role='alert'>
    Si vous désirez supprimer tous les articles de votre Favorie, cliquez a nouveau sur  ' effacer-tous 'l
  </div></span>
</div>";
  }
  if($_GET['action'] == "remove") {


        foreach(($_SESSION['favoir']) AS  $key => $value){
          if($value['id'] == $_GET['id']){
              unset($_SESSION['favoir'][$key]);
              echo "<div class='container mt-5 w-50 m-auto'>

              <span><div class='alert alert-danger text-center' role='alert'>
              Si vous désirez supprimer un article de votre Favorie cliquez a nouveau sur ' supprimer '
            </div></span>
        </div>";
            }
        }
      
    }

}
}
}else {
  echo "<div class='container mt-5 w-50 m-auto'>
  
        <span><div class='alert alert-info text-center' role='alert'>
       votre  Favorie est vide !
      </div></span>
  </div>";
} 

include  $tbl . 'footer.inc.php';
 
ob_end_flush();// output Buffering end

?>



    
