<?php
ob_start();
session_start();
if (isset($_SESSION['admin'])) {
    $Titre = 'Dashbord';
    include 'init.php';
    $Titre = '';
    $Emilie = '';
    if (isset($_GET['Emilie'])) {
        $Emilie = $_GET['Emilie'];
    } else {
        $Emilie = 'Accueil';
    }
    // si la page est la page principale
    if ($Emilie == 'Accueil') {
        $stmt = $con->prepare("SELECT  contacter.*,utilisateurs.Nom AS Client,utilisateurs.Email AS email
     FROM  contacter
      INNER JOIN  utilisateurs
      ON
      utilisateurs.Id_utilisateur = contacter.ID_Client ORDER BY ID_Client  DESC ");
        $stmt->execute();
        $Accueil = $stmt->fetchAll();
?>
        <div class="container-fluid">
            <h1 class="text-center">Les messagies des utilisateurs  </h1>
            <h2 class="cat-h2">tableau des Messages </h2>
            <hr>
            <div class="table-responsive w-100  members-table mt-3">
                <table class="table table-bordered main-table accueil-table ">
                    <tr>
                        <td>#ID</td>
                        <td>Messages</td>
                        <td>Télelphone</td>
                        <td>Email</td>
                        <td>Utilisateur</td>
                        <td>Date</td>
                        <td>Contrôler</td>
                    </tr>

                    <?php foreach ($Accueil as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['ID_message'] . "</td>";
                        echo "<td>" . $row['Message'] . "</td>";
                        echo "<td>" . $row['Tele'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['Client'] . "</td>";
                        echo " <td>" . $row['Date'] . "</td>";
                        echo "<td class='text-center'>
                            <a href='message.php?Emilie=Delete&messageID=" . $row['ID_message'] . "'  class='btn btn-danger confirm '> <i class='fa-solid fa-trash-can'></i></a>";
                        echo "</td>";
                        echo "<tr>";
                    } ?>
                </table>
            </div>
        </div>
        <?php  
    } elseif ($Emilie == 'Delete') {

        echo '<h1 class="text-center">supréssion  de message  </h1>';
        //check integer value
        // short if else
        $messageID = isset($_GET['messageID']) && is_numeric($_GET['messageID']) ? intval($_GET['messageID']) : 0;
        // if(isset($_GET['CommID']) && is_numeric($_GET['CommID'])) {
        //     echo intval($_GET['CommID']);
        // }else {
        //     echo 0;
        // }

        $tchek = checkItems('ID_message','contacter', $messageID);
        if ($tchek  > 0) {
            $stmt = $con->prepare("DELETE FROM contacter WHERE ID_message = :id");
            $stmt->bindParam(":id", $messageID);
            $stmt->execute();
            echo "<div class='container text-center'>";
            $message = "<div class=' alert alert-danger mx-auto mt-5  w-25 shadow-lg text-dark text-center '><strong >" . $stmt->rowCount()  . " </strong> message a été bien supprimé </div>";
            echo "</div>";
            direction($message, 5);
        } else {
            echo "<div class='container'>";
            $message = "<div class=' alert alert-danger mx-auto mt-5  fw-bold message_alert shadow-lg  text-center p-5'> ce message  n'est pas exsiter dans la base de données </div>";
            echo "</div>";
            direction($message, 'back', 5);
        }
    }else {
        header('Location : index.php');
        exit();
    }
    
}


include $tbl . 'footer.inc.php';
ob_end_flush();
?>