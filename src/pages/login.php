<?php

if (isset($_GET['session_value'])) {
    
    if($_GET['session_value']==4){
		// Démarrer la session
		session_start();

		// Détruire la session
		session_destroy();
	  
		// Rediriger l'utilisateur vers la page de connexion
		header("Location: ../pages/login.php?session_value=5");
    }
}

session_start();

if (isset($_SESSION["utilisateur_connecte"])) {
	header("Location: ./compte.php");
	exit();
  }

if(isset($_POST["login"]) && isset($_POST["mot_de_passe"]))
{
	$login = $_POST["login"];
	$mdp = $_POST["mot_de_passe"];

	if(strlen($login) == 0 || strlen($mdp) == 0)
	{
		header("Location: login.php?erreur=1");
		exit();
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

	$queryB = "SELECT id_personne FROM personne WHERE personne.login = '$login' ";
	$result2 = pg_query($conn, $queryB);
	$result2 = pg_fetch_assoc($result2);
	$id = $result2["id_personne"];
    
    $query = "SELECT id_personne FROM personne	INNER JOIN membre ON personne.id_personne = membre.id_membre LEFT JOIN employe ON personne.id_personne = employe.id_employe	WHERE personne.id_personne = '$id' AND employe.id_employe IS NULL";
    $result1 = pg_query($conn, $query);
    $result1 = pg_fetch_assoc($result1);
     
    if(!$result1)
	{
		header("Location: login.php?erreur=1");	
		exit();
	}
    
	$result = pg_prepare($conn, "get_m", "SELECT  mot_de_passe, nom, prenom FROM personne WHERE personne.id_personne = $1");
	$result = pg_execute($conn, "get_m", array($id));
	$result = pg_fetch_assoc($result);

	if(!$result)
	{
		header("Location: login.php?erreur=1");
		
	}

	$nom = $result["nom"];
	$prenom = $result["prenom"];

	if($result["mot_de_passe"] == $mdp)
	{
		$_SESSION["type"] = "M";
		$_SESSION["id_membre"] = $id;
		$_SESSION["nom"] = $nom;
		$_SESSION["prenom"] = $prenom;
		$_SESSION["utilisateur_connecte"] = $login;
		header("Location: compte.php");
		exit();
	}
    else{
        header("Location: login.php?erreur=1");
    }

}



require '../includes/header.inc.php';
?>


    <h1 class="h1log">CONNEXION MEMBRE</h1>
	<?php
			if (isset($_GET['session_value'])) {
    
    if($_GET['session_value']==5){
		echo '<div class="d"><h2 style="text-align: center; color: green; padding-top : 3%;"> MODIFICATIONS CONFIRMEES, VEUILLEZ VOUS RECONNECTER </h2></div>';
    }
}
?>
    <div class="form-connexion">
        <form action="login.php" method="post">

            <div class="d">
                <label for="login">Nom d'utilisateur:</label>
                <input type="text" id="login" name="login" placeholder="Jean15" required >
            </div>

            <div class="d">
                <label for="mot_de_passe">Mot de passe:</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required>
            </div>

            <div class="d">
				<button type="submit">Envoyer</button>
                
            </div>
			


            <div class="d">
                <a href="./inscription.php">Sinon créez vous votre compte ici</a>
            </div>
        </form> 
        
        <!-- Zone pour afficher les messages d'erreur -->
        <div id="error-message" style="color: red;"></div>
    </div>
<div>
	<?php
	require '../includes/footer.inc.php';
	?>
	</div>