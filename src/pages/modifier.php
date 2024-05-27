<?php
session_start();


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

$uti = $_SESSION["utilisateur_connecte"];

    $query = "SELECT   id_personne, num_telephone, adress_mail, login, mot_de_passe, nom, prenom FROM personne WHERE personne.login = '$uti'";
	$result = pg_query($conn, $query);
	$result = pg_fetch_assoc($result);

    $query = "SELECT type_abonnement FROM membre WHERE membre.id_membre = (SELECT id_personne FROM personne WHERE personne.login = '$uti')";
	$result1 = pg_query($conn, $query);
	$result1 = pg_fetch_assoc($result1);

    $id= $result["id_personne"];
    $nom = $result["nom"];
	$prenom = $result["prenom"];
    $login = $result["login"];
    $mdp = $result["mot_de_passe"];
    $mail = $result["adress_mail"];
    $num = $result["num_telephone"];
    $abb = $result1["type_abonnement"];

?>
<main>
<section class="form_insc">
<h1>MODIFICATION COMPTE</h1>
<div class="div_insc">
  
    <form action="../scripts/trait_modification.php" method="post">
      
    <div class="d">
      <label for="id">ID :</label>
        <input type="text" id="id" name="id" value="<?php echo $id;?>" readonly>
      </div>
    <div class="double">
      <div class="d">
      <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?php echo $nom;?>">
      </div>

      <div class="d">
      <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?php echo $prenom;?>">
      </div>
</div>


      <div class="d">
      <label for="num">Numéro :</label>
        <input type="text" id="num" name="num" value="<?php echo $num;?>">
      </div>

      <div class="d">
        <label for="mail">Email :</label>
        <input type="text" id="mail" name="mail" value="<?php echo $mail;?>">
      </div>

      <div class="double">
      <label >Abonnement</label>
    <div class="d">
    <label for="Classique">Classique</label>
    <input type="radio" id="Classique"  value="Classique" name="abb" checked />
    
      </div>

      <div class="d">
      <label for="famille">Famille</label>
      <input type="radio" id="famille"  value="famille" name="abb"  />
    
  </div>
  <div class="d">
      <label for="premium">premium</label>
      <input type="radio" id="premium"  value="premium" name="abb"  />
    
  </div>
</div>

<div class="d">
<label for="login">Login :</label>
        <input type="text" id="login" name="login" value="<?php echo $login;?>">
</div>

      <div class="d">
      <label for="mdp">Mot de passe :</label>
        <input type="text" id="mdp" name="mdp" value="<?php echo $mdp;?>">
      </div>


      <div class="d">
            <button type="submit">VALIDER</button>
            </div>

           

      
    </form>
    <div>
</section>
<?php
	require '../includes/footer.inc.php';
	?>