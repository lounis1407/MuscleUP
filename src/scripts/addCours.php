<?php

session_start();


if (!isset($_SESSION["utilisateur_connecte"])) {
	header("Location: ../pages/reservS.php?erreur=1");
	exit();
  }
  
 
    if(isset($_POST['cours'])){
       
        $nomC = $_POST['cours'];

        $host = "postgresql-bouhadoun.alwaysdata.net";
        $user = "bouhadoun_test";
        $password = "lounis2001";
        $database = "bouhadoun_projet";
        
        $conn = pg_connect("host=$host port=5432 dbname=$database user=$user password=$password");
        if (!$conn) {
            echo "Une erreur s'est produite a la connexion.\n";
            exit;
        }

            $dateD = date("Y/m/d");
            $dateF = '2023-12-31';

            $query = "SELECT 'reserv' || MAX(CAST(SUBSTRING(id_reservation FROM 7) AS INTEGER)) AS max_res FROM reservation; ";
            $result = pg_query($conn, $query);
            $row = pg_fetch_row($result);
            if(!($result)){
                $id_res = 'reserv1';
            }
            else{
                $id_res = pg_fetch_result($result, 0, 0);
    
            }
            
    
            if(str_starts_with($id_res,'reserv')){
                $idR = intval(explode("reserv", $row[0])[1])+1;
                $idR = 'reserv'.$idR;
                echo "$idR";
            }

            $uti = $_SESSION["utilisateur_connecte"];


    $query = "SELECT id_personne FROM personne WHERE personne.login = '$uti'";
	$result = pg_query($conn, $query);
	$result = pg_fetch_assoc($result);

    $idP = $result["id_personne"];

    $query = "SELECT id_cours FROM cours WHERE cours.nom_cours = '$nomC'";
	$result = pg_query($conn, $query);
	$result = pg_fetch_assoc($result);

    $idC = $result["id_cours"];
        
    $query = "INSERT INTO reservation VAlUES('$idR','$dateD','$dateF','$idP','$idC')";
    $result = pg_query($conn, $query); 
    if (!$result) {
            echo "Une erreur s'est produite dans la table personne.\n";
    }
    else{
        header("Location: ../pages/reservS.php?session_value=4");
    }

        
}
?>

