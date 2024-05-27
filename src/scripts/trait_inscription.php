<?php
session_start();
if((isset($_POST['login']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['sexe']) && isset($_POST['num']) && isset( $_POST['email']) && isset( $_POST['password']) && isset( $_POST['password2']) && isset($_POST['abb'])) && 
      (!empty($_POST['login']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['sexe']) && !empty($_POST['num']) && !empty($_POST['email']) && !empty( $_POST['password']) && !empty( $_POST['password2']) && !empty( $_POST['abb']))){
        $login = $_POST['login'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $sexe = $_POST['sexe'];
        $num = $_POST['num'];
        $email = $_POST['email'];
        $abb = $_POST['abb'];
        $password1 = $_POST['password'];
        $password2 = $_POST['password2'];
        

        if(!($password1 == $password2)){ 
            header("Location:../pages/inscription.php?erreur=1");
            session_destroy();
            exit;
        }

        $host = "postgresql-bouhadoun.alwaysdata.net";
        $user = "bouhadoun_test";
        $password = "lounis2001";
        $database = "bouhadoun_projet";
        
        $conn = pg_connect("host=$host port=5432 dbname=$database user=$user password=$password");
        if (!$conn) {
            echo "Une erreur s'est produite a la connexion.\n";
            exit;
        }


        //creer id avec Ax+1
        $query = "SELECT 'A' || MAX(CAST(SUBSTRING(id_membre FROM 2) AS INTEGER)) AS max_identifiant FROM membre WHERE id_membre LIKE 'A%'; ";
	    $result = pg_query($conn, $query);
	    $row = pg_fetch_row($result);
        if(!($result)){
            $idM = 'A0';
        }
        else{
            $idM = pg_fetch_result($result, 0, 0);

        }
	    

        if(str_starts_with($idM,'A')){
            $id = intval(explode("A", $row[0])[1])+1;
            $id = 'A'.$id;
            echo "$id";
            }
        

            

//Creer id_carte 
            $query = "SELECT 'carteA00' || MAX(CAST(SUBSTRING(id_carte FROM 8) AS INTEGER)) AS max_carte FROM personne WHERE id_personne LIKE 'A%'; ";
            $result = pg_query($conn, $query);
            $row = pg_fetch_row($result);
            if(!($result)){
                $idCM = 'carteA000';
            }
            else{
                $idCM = pg_fetch_result($result, 0, 0);
    
            }
            
    
            if(str_starts_with($idCM,'carteA00')){
                $idcarte = intval(explode("carteA00", $row[0])[1])+1;
                $idcarte = 'carteA00'.$idcarte;
                
            }


    $query = "SELECT adress_mail FROM personne WHERE adress_mail = '$email' ";
    $result = pg_query($conn, $query);
    $result = pg_fetch_assoc($result);

    if($result)
	{
		header("Location:../pages/inscription.php?erreur=1");	
		
	}

    $query = "SELECT num_telephone FROM personne WHERE num_telephone = '$num' ";
    $result = pg_query($conn, $query);
    $result = pg_fetch_assoc($result);

    if ($result)
	{
		header("Location: ../pages/inscription.php?erreur=1");	
		exit();
	}
    
    $dateD = date("Y/m/d");
    $dateF = date("Y/m/d", strtotime($dateD . " +1 year"));
    $query = "INSERT INTO carte VAlUES('$idcarte','Membre','$dateD','$dateF')";
    $result = pg_query($conn, $query); 
    if (!$result) {
            echo "Une erreur s'est produite dans la table client.\n";
    }else{
            
    }

    $query = "INSERT INTO personne VAlUES('$id','$nom','$prenom','$sexe','$num','$email','$login','$password1','$idcarte')";
    $result = pg_query($conn, $query); 
    if (!$result) {
            echo "Une erreur s'est produite dans la table personne.\n";
    }
    $query = "INSERT INTO membre VAlUES('$id','$abb')";
    $result = pg_query($conn, $query); 
    if (!$result) {
            echo "Une erreur s'est produite dans la table client.\n";
    }else{
        header("Location: ../pages/inscription.php?session_value=4");
    }
    

    }

    ?>