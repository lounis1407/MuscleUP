<?php
session_start();


    $host = "postgresql-bouhadoun.alwaysdata.net";
    $user = "bouhadoun_test";
    $password = "lounis2001";
    $database = "bouhadoun_projet";
    
	$conn = pg_connect("host=$host port=5432 dbname=$database user=$user password=$password");
	if (!$conn) {
		echo "Une erreur s'est produite a la connexion.\n";
		exit;
	}

    $uti = $_SESSION["utilisateur_connecte"];


    $query = "SELECT  sexe, num_telephone, adress_mail, id_carte, login, id_personne, mot_de_passe, nom, prenom FROM personne WHERE personne.login = '$uti'";
	$result = pg_query($conn, $query);
	$result = pg_fetch_assoc($result);

    $query = "SELECT type_abonnement FROM membre WHERE membre.id_membre = (SELECT id_personne FROM personne WHERE personne.login = '$uti')";
	$result1 = pg_query($conn, $query);
	$result1 = pg_fetch_assoc($result1);
    

    $nom = $result["nom"];
	$prenom = $result["prenom"];
    $login = $result["login"];
    $id = $result["id_personne"];
    $idc = $result["id_carte"];
    $mdp = $result["mot_de_passe"];
    $mail = $result["adress_mail"];
    $num = $result["num_telephone"];
    $sexe = $result["sexe"];
    if($result1){
        $abb = $result1["type_abonnement"];
    }
    

    $query = "SELECT COUNT(*) AS nombre_reservations FROM reservation WHERE id_membre = '$id'";
	$result2 = pg_query($conn, $query);
	$result2 = pg_fetch_assoc($result2);

    $res = $result2["nombre_reservations"];



    $query = "SELECT id_cours FROM reservation WHERE reservation.id_membre = '$id' ";
    $result = pg_query($conn, $query);
   

   

require '../includes/header.inc.php'; 
?>
<h1 class="h1co">COMPTE</h1>

<section class="sec_c">
<?php
        // Informations du Compte
        echo '<div class="account-info">';
        echo '<h2>Informations du Compte</h2>';
        echo '<p>Nom: '.$nom.'</p>';
        echo '<p>Prénom: '.$prenom.'</p>';
        echo '<p>login: '.$login.'</p>';
        echo '<p>Sexe: '.$sexe.'</p>';
        echo '<p>ID: '.$id.'</p>';
        echo '<p>ID Carte: '.$idc.'</p>';
        echo '<p>Email: '.$mail.'</p>';
        echo '<p>Numéro de télephone: '.$num.'</p>';
        if($result1){
        echo '<p>Type d\'abonnement : '.$abb.'</p>';
        }
        echo '<p>reservations: '.$res.'</p>';
        if ($result && pg_num_rows($result) > 0) {
            echo "<p> cours reservés :";
            while ($row = pg_fetch_assoc($result)) {
               $id_cours = $row["id_cours"];
               $queryS = "SELECT nom_cours FROM cours WHERE cours.id_cours = '$id_cours' ";
            $resultS = pg_query($conn, $queryS);
            $resultS = pg_fetch_assoc($resultS);
            $nom_cours = $resultS["nom_cours"];
               echo "<p>$nom_cours</p>";
           }
       } else {
           echo "<option value='' disabled>Aucun cours disponible</option>";
       }
        
        echo '</p></div>';

        // Options de Compte
        echo '<div class="account-info">';
        echo '<h2>Options de Compte</h2>';
        echo '<p><a href="modifier.php">Modifier le Profil</a></p>';
        echo '<p><a href="../scripts/fonctions.php">Déconnexion</a></p>';
        echo '</div>';

        ?>
    </section>


	<?php
require '../includes/footer.inc.php';
?>
