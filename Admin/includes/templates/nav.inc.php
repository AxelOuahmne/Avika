<nav class="navbar navbar-expand-sm navbar-dark bg-dark" aria-label="Third navbar example">
  <div class="container">
    <a class="navbar-brand" href="tdb.php">Tableau de bord</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar_Admin" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar_Admin">
      <ul class="navbar-nav me-auto mb-2 mb-sm-0">
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="produits.php">Produits</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="categories.php">Catégories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="utilisateur.php">Utilisateurs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="commentaire.php">Commentaires</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="message.php">Messages</a>
        </li>
      
      </ul>
      <ul class="navbar-nav ">
        <li class="nav-item dropdown d-flex justify-content-end ">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-bs-toggle="dropdown" aria-expanded="false">Admin</a>
          <ul class="dropdown-menu" aria-labelledby="dropdown03">
            <!-- UtilID =  $_SESSION['ID'] -->
            <li><a class="dropdown-item" href="utilisateur.php?Emilie=Edite&UtilID=<?php echo  $_SESSION['ID']; ?>">modifier Profil</a></li>
            <li><a class="dropdown-item" href="../index.php">Boutique</a></li>
            <li><a class="dropdown-item" href="deconnexion.php">Déconnexion</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>