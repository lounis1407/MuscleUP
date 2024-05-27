<?php


require '../includes/header.inc.php';

?>
<main>
<section class="form_insc">
<h1>INSCRIPTION</h1>
<div class="div_insc">
  
  <div id="error-message" style="color: red;"></div>

    <form action="../scripts/trait_inscription.php" method="post">
        <?php
    if (isset($_GET['session_value'])) {
    
    if($_GET['session_value']==4){
    echo '<div class="d"><h2 style="text-align: center; color: green; padding-top : 3%;"> INSCRIPTION CONFIRMEE </h2></div>';
    }
}?>
      <div class="d">
        <label for="login">Nom d'utilisateur:</label>
        <input type="text" id="login" name="login" required>
      </div>
    <div class="double">
      <div class="d">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required>
      </div>

      <div class="d">
        <label for="prénom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" required>
      </div>
</div>

<div class="double">
<div class="d">
    <label for="Homme">Homme</label>
    <input type="radio" id="Homme"  value="M" name="sexe"  />
    
      </div>

      <div class="d">
      <label for="Femme">Femme</label>
      <input type="radio" id="Femme"  value="F" name="sexe"  />
    
  </div>
</div>


      <div class="d">
        <label for="num">Numéro:</label>
        <input type="text" id="num" name="num" required>
        <div id="num-validation" style="color: green;"></div>
      </div>

      <div class="d">
        <label for="email-confirm">Adresse e-mail :</label>
        <input type="email" id="email" name="email" required>
        <div id="email-validation" style="color: green;"></div>
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
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>
      </div>

      <div class="d">
        <label for="username">Confirmez votre Mot de passe</label>
        <input type="password" id="password2" name="password2" required>
        <div id="password-validation" style="color: green;"></div>
        
      </div>

      <div class="d">
            <button type="submit">S'inscrire</button>
            <div id="error_message" style="color: green;"></div>
          </div>

      <div class="d">
        <a href="login.php">Vous avez déjà un compte </a>
      </div>
      
      
    </form>
    <div>
</section>


<script>
  document.addEventListener("DOMContentLoaded", function() {
    var numInput = document.getElementById("num");
    var emailInput = document.getElementById("email");
    var passwordInput = document.getElementById("password");
    var passwordInput2 = document.getElementById("password2");
    var errorMessage = document.getElementById("error_message");
    var passwordValidation = document.getElementById("password-validation");
    var emailValidation = document.getElementById("email-validation");
    var numValidation = document.getElementById("num-validation");
    var submitButton = document.querySelector("button[type='submit']");

    

    // Fonction de validation du password2 en temps réel
    passwordInput2.addEventListener("input", function() {
      var pw = passwordInput.value;
      var pw2 = passwordInput2.value;
      if (pw2 != pw) {
        passwordValidation.style.color = "red";
        passwordValidation.innerHTML = "Veuillez entrer 2 mots de passe identiques";
        errorMessage.style.color = "red";
        errorMessage.innerHTML = "Merci de vérifier les infos entrées avant validation";
      } else {
        passwordValidation.style.color = "green";
        passwordValidation.innerHTML = "Mot de passe OK";
        errorMessage.innerHTML = "";
      }
      updateSubmitButton()
    });

    // Fonction de validation du num en temps réel
    numInput.addEventListener("input", function() {
      var num = numInput.value;
      if (num.length !== 10) {
        numValidation.style.color = "red";
        numValidation.innerHTML = "Le numéro doit contenir 10 caractères.";
        errorMessage.style.color = "red";
        errorMessage.innerHTML = "Merci de vérifier les infos entrées avant validation";
      } else {
        numValidation.style.color = "green";
        numValidation.innerHTML = "Ce numéro est ok.";
        errorMessage.innerHTML = "";
      }
      updateSubmitButton()
    });

    // Fonction de validation du mail en temps réel
    emailInput.addEventListener("input", function() {
      var email = emailInput.value;

      // Vérifiez le format de l'adresse e-mail
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        emailValidation.style.color = "red";
        emailValidation.innerHTML = "L'adresse e-mail n'est pas valide.";
        errorMessage.style.color = "red";
        errorMessage.innerHTML = "Merci de vérifier les infos entrées avant validation";
      } else {
        emailValidation.style.color = "green";
        emailValidation.innerHTML = "L'adresse e-mail est valide.";
        errorMessage.innerHTML = "";
      }
      
  });
});


    
</script>

</main>

<?php
require '../includes/footer.inc.php';
?>