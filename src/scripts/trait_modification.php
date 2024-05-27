<?php
session_start();

if((isset($_POST['login']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['num']) && isset( $_POST['mail']) && isset( $_POST['mdp']) && isset($_POST['abb'])) ){

        $id = $_POST['id'];
        $login = $_POST['login'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $num = $_POST['num'];
        $mail = $_POST['mail'];
        $abb = $_POST['abb'];
        $mdp = $_POST['mdp'];


        $host = "postgresql-bouhadoun.alwaysdata.net";
        $user = "bouhadoun_test";
        $password = "lounis2001";
        $database = "bouhadoun_projet";
        
        $conn = pg_connect("host=$host port=5432 dbname=$database user=$user password=$password");
        if (!$conn) {
            echo "Une erreur s'est produite a la connexion.\n";
            exit;
        }


    $query = "UPDATE membre SET type_abonnement = '$abb' WHERE id_membre = '$id'";
    $query2 = "UPDATE personne SET  nom = '$nom', prenom = '$prenom', num_telephone = '$num', adress_mail = '$mail', login = '$login', mot_de_passe = '$mdp' WHERE id_personne = '$id'";

    $result = pg_query($conn, $query);
    $result2 = pg_query($conn, $query2);
    // Exécution de la requête
    if (!$result) {
        echo "Une erreur s'est produite dans la table client.\n";
}else{
    if(!$result2){
        echo "Une erreur s'est produite dans la table client.\n";
    }
    else{
        header("Location: ../pages/login.php?session_value=4");
    }
}
    

    }
    else{
       
    }

    ?>