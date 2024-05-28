<?php
    declare (strict_types=1);
$titre="Recherche";
$page="recherche.php";
require "./include/header.inc.php";
require "./include/fonctions.inc.php";
?>

    <main>
        <aside>
            <a class="btn-remonte" href="#">⬆</a>
        </aside>
        <h1 id="titre">Itineraire Rapide</h1>
    <section id="recherche">
            <h2>Résultats pour votre recherche :</h2>
            <article id="info-choisis">
                <h3>Informations choisis :</h3>
                    <?php
                    if(isset($_GET['gare_depart']) && isset($_GET['gare_arrive'])) {
                        $gare_depart = $_GET['gare_depart'];
                    
                        $gare_arrive = $_GET['gare_arrive'];
                                            
                        echo "<p>Départ : $gare_depart</p>\n";
                        echo "\t\t\t\t\t<p>Arrivée : $gare_arrive</p>\n";
                        echo "\t\t\t\t\t<p>Heure de départ : " .date("H:i") ."</p>\n";
                    } else {
                        echo "<p>Les valeurs de date et/ou d'heure n'ont pas été spécifiées.</p>\n";
                    }                 
                    ?>
            </article>
                <?php
                if(isset($_GET["gare_depart"]) && isset($_GET['gare_arrive'])){
                    saveStations($_GET["gare_depart"], $_GET['gare_arrive']);
                }
                ?>
<article style="margin-bottom:50px">
                <h3>Votre Itinéraire :</h3>
                <?php
                    $count = 5;

                    if(isset($_GET['gare_depart']) && isset($_GET['gare_arrive'])){              
                        $depart = getStationId($_GET['gare_depart']);
                        $arrive = getStationId($_GET['gare_arrive']);
                        
                        $result = getItineraireRapide($depart, $arrive, $count);
                        echo $result;
                    }
                ?>
            </article>
            <ul>
                <li>
                    <a class="btn-retour" href="./itineraire.php">Retour</a>
                </li>
            </ul>
        </section>
    </main>

<?php
require "./include/footer.inc.php";
?>