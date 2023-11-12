<?php
ob_start();  // démarre la temporisation de sortie. Tant qu'elle est enclenchée,  aucune donnée, hormis les en-têtes, n'est envoyée 
//au navigateur, mais temporairement mise en tampon. 
session_start();
if (isset($_SESSION['admin'])) {

    $Titre = 'Tableau de bord';
    include 'init.php';
    //print_r($_SESSION);
?>

    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-md-3 col-3 col-sm-6 ">
                <div class="circle-tile  ">
                    <a href="utilisateur.php">
                        <div class="circle-tile-heading active_user "><i class="fa fa-users fa-fw fa-3x mt-3"></i></div>
                    </a>
                    <div class="circle-tile-content active_user ">
                        <div class="circle-tile-description text-white">Utilisateurs active</div>
                        <div class="circle-tile-number  "><?php echo countElemntes('Id_utilisateur', 'utilisateurs'); ?></div>

                    </div>
                </div>
            </div>
            <div class="col-md-3 col-3 col-sm-6 ">
                <div class="circle-tile ">
                    <a href="utilisateur.php?Emilie=Accueil&page=actif">
                        <div class="circle-tile-heading red"><i class="fa-solid fa-users-slash fa-fw fa-3x mt-3"></i></div>
                    </a>
                    <div class="circle-tile-content red">
                        <div class="circle-tile-description text-white"> Utilisateurs en attente</div>
                        <div class="circle-tile-number text-faded "><?php echo checkItems('Statut', 'utilisateurs', 0) ?> </div>

                    </div>
                </div>
            </div>
            <div class="col-md-3 col-3 col-sm-6">
                <div class="circle-tile ">
                    <a href="commentaire.php">
                        <div class="circle-tile-heading comment "><i class="fa-solid fa-comments fa-fw fa-3x mt-3"></i></div>
                    </a>
                    <div class="circle-tile-content comment">
                        <div class="circle-tile-description text-white"> commentaires</div>
                        <div class="circle-tile-number text-faded "><?php echo countElemntes('Commentaire_Id', 'commentaire'); ?></div>

                    </div>
                </div>
            </div>
            <div class="col-md-3 col-3  col-sm-6">
                <div class="circle-tile ">
                    <a href="message.php">
                <div class=" circle-tile-heading comment "> <i class=" fa-solid fa-envelope fa-fw fa-3x mt-3"></i>
                </div>
                </a>
                <div class="circle-tile-content comment">
                    <div class="circle-tile-description text-white"> Messages </div>
                    <div class="circle-tile-number text-faded "><?php echo countElemntes('ID_message', 'contacter'); ?></div>

                </div>
            </div>
        </div>
        <div class="col-md-3 col-3  mx-auto col-sm-6 ">
            <div class="circle-tile ">
                <a href="produits.php">
                    <div class="circle-tile-heading produits"> <i class="fa fa-shopping-bag icons fa-fw fa-3x mt-3"></i></div>
                </a>
                <div class="circle-tile-content produits">
                    <div class="circle-tile-description text-white"> les Produits </div>
                    <div class="circle-tile-number text-faded "><?php echo countElemntes('Id_produit', 'produits'); ?></div>

                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col">
            <div class="card">
                <div class="card-header"> <i class="fa-solid fa-users"></i> <span>Les utilisateurs</span></div>
                <div class="card-body">
                    <h5 class="card-title">Cinq derniers utilisateurs inscrit </h5>
                    <p class="card-text">
                    <ul class="list-unstyled liste-bd">
                        <?php
                        $listeUser = GetElements('*', 'utilisateurs', 'Id_utilisateur');
                        foreach ($listeUser as $list) {
                            echo '<li>';
                            echo $list['Nom'];
                            echo '<span class=" btn btn-success"><i class="fa-solid fa-user-pen"></i>';
                            echo ' <a href="utilisateur.php?Emilie=Edite&UtilID=' . $list['Id_utilisateur'] . '">modifier</a></span>';
                            if ($list['Statut'] == 0) {
                                echo "<a href='utilisateur.php?Emilie=Active&UtilID=" . $list['Id_utilisateur'] .   " ' class='btn btn-info mb-sm-2 '>Active
                    <i class='fa-solid fa-person-circle-check'></i></a>";
                            }
                            echo '</li>';
                        }
                        ?>
                    </ul>
                    </p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card  mb-3">
                <div class="card-header"> <i class="fa-solid fa-comment"></i> <span>Les commentaires</span></div>
                <div class="card-body commentaire_card">
                    <h5 class="card-title">Cinq derniers Commentaires</h5>
                    <p class="card-text">
                    <ul class="list-unstyled liste-bd">
                        <?php
                        $stmt = $con->prepare("SELECT  commentaire.*,utilisateurs.Nom AS Client  FROM  commentaire INNER JOIN  utilisateurs ON utilisateurs.Id_utilisateur = commentaire.Commentaire_Utilesateur  LIMIT 5 ");
                        // j'ai fait beaind entre id de get avec Commentaire_Produit dans la tabele commenatire
                        $stmt->execute();
                        $Comment = $stmt->fetchAll();
                        foreach ($Comment as $commentaire) {

                            echo '<li>';
                            echo substr($commentaire['Commentaire'], 0, 30);
                            echo '<span class=" btn btn-success"><i class="fa-solid fa-user-pen"></i>';
                            echo ' <a href="">' . $commentaire['Client'] . '</a></span>';
                            echo '</li>';
                        } ?>
                    </ul>
                    </p>

                </div>

            </div>
        </div>
    </div>
    <div class="col mx-auto">
        <div class="card">
            <div class="card-header"><i class="fa-solid fa-envelope-open-text"></i> <span>Les messages</span></div>
            <div class="card-body">
                <h5 class="card-title">Cinq derniers Messages </h5>
                <p class="card-text">
                <ul class="list-unstyled liste-bd">
                    <?php
                    $stmt = $con->prepare("SELECT  contacter.*,utilisateurs.Nom AS Client
                           FROM  contacter
                            INNER JOIN  utilisateurs
                            ON
                            utilisateurs.Id_utilisateur = contacter.ID_Client ORDER BY ID_Client  DESC ");

                    $stmt->execute();
                    $message = $stmt->fetchAll();
                    foreach ($message as $messagerie) {
                        echo '<li>';
                        echo substr($messagerie['Message'], 0, 50) . ' .....';
                        echo '<span class=" btn btn-success bg-warning">';
                        echo ' <a href="message.php"><i class="fa-solid fa-comment-sms"></i> ' . $messagerie['Client'] . '</a></span>';

                        echo '</li>';
                    }
                    ?>
                </ul>
                </p>
            </div>
        </div>
    </div>
    </div>
    </div>










<?php  } else {
    header('location: index.php');
    exit();
}
include $tbl . 'footer.inc.php';
ob_end_flush();
?>