<nav class="navbar navbar-expand-md navbar-dark bg-dark" aria-label="Fourth navbar example">
    <div class="container-fluid">
    <a class="navbar-brand log" href="index.php"><img src="img/LOGO-NOIRE.png" alt="" ></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#Emilie" aria-controls="Emliie" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      

      <div class="collapse navbar-collapse " id="Emilie">
                <ul class="navbar-nav mx-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">boutique</a>
                    </li>
                    <?php
                    $categories = GetCategories();
                    foreach ($categories as $cat) { ?>
                        <li class="nav-item dropdown">
                            <a class="" href="#">
                                <a class="nav-link dropdown-toggle"  role="button" data-bs-toggle="dropdown" aria-expanded="false" href="<?php echo 'categories.php?pageid=' . $cat['ID'] . '&pagenom=' . str_replace('', '-', $cat['Nom']) . '">' . $cat['Nom'] . '</a> ' ?>  
                     <!-- str_replace bach nhid dok les line dul url onbdlhom b - Nom hit ila sefti nom bal str_replace ghadi iseft lik f url %/ -->
                        <ul class=" dropdown-menu" aria-labelledby="navbarDropdown">
                                    <?php
                                    $stm = $con->prepare("SELECT * FROM categories WHERE pere = ?  ");
                                    $stm->execute(array($cat['ID']));
                                    $categ = $stm->fetchAll();
                                    foreach ($categ as $m) {  ?>
                        <li><a class="dropdown-item" href="<?php echo 'categories.php?pageid=' . $m['ID'] . '&pagenom=' . str_replace('', '-', $m['Nom']) . '">' . $m['Nom']; ?></a></li>
                                 <?php  } ?>
                   </ul>
                    </li>
                             <?php } ?>          
                    <li class=" nav-item dropdown float-end ">
                            <a class=" nav-link dropdown-toggle" href="profile.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">compte </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php if (isset($_SESSION['utilisateur'])) { ?>
                                    <li><a class="dropdown-item" href="profile.php"> Profile</a></li>
                                    <li><a class="dropdown-item" href="deconnexion.php">Déconnexion</a></li>
                                <?php  } else { ?>
                                    <li><a class="dropdown-item" href="connecter.php">inscription</a></li>
                                    <li><a class="dropdown-item" href="connecter.php">connexion</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                </ul>
                <div class="d-flex nav_icon justify-content-center">
                    <?php
                    if (isset($_SESSION['panier'])) {
                        $count = count($_SESSION['panier']); ?>
                        <span class="text-white fw-bold bg-dark" id="count_panier"> <?php echo $count; ?> </span>
                    <?php } else { ?>
                        <span class="text-white fw-bold bg-dark" id="count_panier"> <?php echo 0; ?> </span>
                    <?php } ?>
                    <a href="panier.php" class="me-2"> <i class="fas fa-shopping-basket"></i></a>
                   <?php if (isset($_SESSION['favoir'])) {
                        $count = count($_SESSION['favoir']); ?>
                        <span class="text-dark fw-bold  btn-favoir" id="count_panier"> <?php echo $count; ?> </span>
                    <?php } else { ?>
                        <span class="text-dark fw-bold  btn-favoi" id="count_panier"> <?php echo 0; ?> </span>
                    <?php } ?>
                    <a href="Favorie.php" class="me-2"><i class="fas fa-heart"></i></a>
                </div>
            </div>
       
    </div>
  </nav>
 