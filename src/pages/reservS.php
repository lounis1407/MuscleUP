<?php
session_start();




// Vérifiez si la valeur session_value est présente dans l'URL
if (isset($_GET['session_value'])) {
    
    if($_GET['session_value']==1){
    $_SESSION['adr_salle'] = '123 Main St, City A';
    }
    else if($_GET['session_value']==2){
        $_SESSION['adr_salle'] = '456 Elm St, Town B';
    }
    else{
        $_SESSION['adr_salle'] = '789 Oak St, Village C';
    }
}

$adr =  $_SESSION['adr_salle'];

require '../includes/header.inc.php';

$host = "postgresql-bouhadoun.alwaysdata.net";
$user = "bouhadoun_test";
$password = "lounis2001";
$database = "bouhadoun_projet";

$conn = pg_connect("host=$host port=5432 dbname=$database user=$user password=$password");
if (!$conn) {
    echo "Une erreur s'est produite a la connexion.\n";
    exit;
}

$query = "SELECT nom_cours FROM cours WHERE cours.id_salle = (SELECT id_salle FROM salle WHERE adress_salle = '$adr') ";
$result = pg_query($conn, $query);

?>
<h1 class="h1log">RESERVATION</h1>
<div class="form-connexion">
<form action="../scripts/addCours.php" method="post">

        <?php echo $adr ; ?>
        <div class="d">
        <label for="cours">Choisissez une activité :</label>
        <select name="cours" id="cours">
            <?php            

        if ($result && pg_num_rows($result) > 0) {
             while ($row = pg_fetch_assoc($result)) {
                $nomCours = $row["nom_cours"];
                echo "<option value='$nomCours'>$nomCours</option>";
            }
        } else {
            echo "<option value='' disabled>Aucun cours disponible</option>";
        }

            
            echo '</select></div>';
           
            
    
        if (isset($_SESSION["utilisateur_connecte"] )) {
            
            $t = "E";
            if( $_SESSION["type"]=== $t){
                echo '<p>EMPLOYE NE PEUT PAS RESERVER DE COURS</p>';
                exit;
            }
            
            echo ' <button type="submit">Soumettre</button> </form>';
            
        
            if (isset($_GET['session_value'])) {

                if($_GET['session_value']==4){
                    echo '<h2 style="text-align: center; color: green; padding-top : 3%;"> RESERVATION CONFIRMEE </h2>';
                }
            }
        }
        
        else{
            echo '<p>VEUILLEZ VOUS CONNECTER POUR POUVOIR RESERVER UN COURS</p>';
        }

    
        ?>
    


    </div>


    
<?php 
require '../includes/footer.inc.php';
?>