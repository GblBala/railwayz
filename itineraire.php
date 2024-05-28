<?php
    declare (strict_types=1);
    $titre="Itineraire";
    $page="itineraire.php";
    require "./include/header.inc.php";
    require "./include/fonctions.inc.php";
?>

<main>
    <aside>
        <a class="btn-remonte" href="#">⬆</a>
    </aside>
    <h1 id="titre">Itineraire</h1>
        <section class="chercher">
            <div class="chercher-text-it">
                <h5>Planifier votre voyage</h5>
                <h2 id="travel-it">Où allez vous ?</h2>

            <div class="container" id="container">
                <div class="form-container sign-up">
                    <form method="GET" action="./infos.php">
                        <h2>Horaire</h2>
                        <input list="gare_info" id="gares" placeholder="Gare" name="gare" class="gare-input"/>                 
                            <datalist id="gare_info" class="gare-datalist">
                                <!-- Options gérés dynamiquement grâce au JS -->
                            </datalist>
                            <div class="radio-inputs">
                                <input type="radio" id="option1" name="options" value="commercial_mode:LocalTrain" />
                                <label class="radio-label" for="option1">Train</label>

                                <input type="radio" id="option2" name="options" value="commercial_mode:Bus"/>
                                <label class="radio-label" for="option2">Bus</label>

                                <input type="radio" id="option3" name="options" value="commercial_mode:Metro"/>
                                <label class="radio-label" for="option3">Métro</label>

                                <input type="radio" id="option4" name="options" value="commercial_mode:RapidTransit"/>
                                <label class="radio-label" for="option4">RER</label>
                            </div>
                        <button>Chercher</button>
                    </form>
                </div>
                <div class="form-container sign-in">
                    <form method="GET" action="./itinerairebis.php">
                        <h2>Itineraire</h2>
                        <input list="choix_gare_depart" placeholder="Départ" name="gare_depart" class="gare-input"/>                 
                            <datalist id="choix_gare_depart" class="gare-datalist">

                            </datalist>
                            <input list="choix_gare_arrive" placeholder="Arrivée" name="gare_arrive" class="gare-input"/>                  
                            <datalist id="choix_gare_arrive" class="gare-datalist">

                            </datalist>
                            <input class="input" type="date" id="date_depart" name="date_depart" required="" />
                            
                            <input class="input" type="time" id="heure" name="heure_depart" required="" />
                        <button>Chercher</button>
                    </form>
                </div>
                <div class="toggle-container">
                    <div class="toggle">
                        <div class="toggle-panel toggle-left">
                            <h2 style="color:#fff">...ou plutot un Itineraire</h2>
                            <p>Préparez votre voyage avec notre service simple et efficace !</p>
                            <button class="hidden" id="login">C'est Parti</button>
                        </div>
                        <div class="toggle-panel toggle-right">
                            <h2 style="color:#fff">Des Horaires...</h2>
                            <p>Soyez à jour sur les horaires de la gare à coté de chez vous !</p>
                            <button class="hidden" id="register">C'est parti</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </section>
    
    <section id="lastResearch">
        <h2>Dernières Recherches :</h2>
                <?php
                    if(isset($_COOKIE['last'])) {
                        echo '<span>' . $_COOKIE['last'] . "</span>\n";
                    } else {
                        echo "<span>Aucune recherche effectuée.</span>";
                    }
                ?>
    </section>

    
</main>

<?php
require "./include/footer.inc.php";
?>
