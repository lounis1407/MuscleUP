<?php
session_start();
require '../includes/header.inc.php';
?>

<h1 class="h1log">NOS SALLES</h1>
    <section class="section_prod">
        <div class="produits">
            <div class="catalogue">
                <div class="img"><img src="../images/s1.jpg" ></div>
                <div class="desc">123 Main St, City A</div>
                <div class="titre">SALLE 1</div>
                <div class="box">
                <a href="reservS.php?session_value=1">
                    <button class="achat">INFOS</button>
                </a>
                </div>
            </div>

            <div class="catalogue">
                <div class="img"><img src="../images/s2.jpg" ></div>
                <div class="desc">456 Elm St, Town B</div>
                <div class="titre">SALLE 2</div>
                <div class="box">
                <a href="reservS.php?session_value=2">
                    <button class="achat">INFOS</button>
                </a>
                </div>
            </div>

            <div class="catalogue">
                <div class="img"><img src="../images/s3.jpeg" ></div>
                <div class="desc">789 Oak St, Village C</div>
                <div class="titre">SALLE 3</div>
                <div class="box">
                <a href="reservS.php?session_value=3">
                    <button class="achat">INFOS</button>
                </a>
                </div>
            </div>
        </div>
    </section>

    <?php
    require '../includes/footer.inc.php';
    ?>