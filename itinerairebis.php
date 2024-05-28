<?php
    declare (strict_types=1);
    $titre="Recherche";
    $page="itinerairebis.php";
    require "./include/header.inc.php";
    require "./include/fonctions.inc.php";
?>

<main>
    <aside>
        <a class="btn-remonte" href="#">⬆</a>
    </aside>
<h1 id="titre">Itineraires</h1>
<section id="recherche">
        <h2>Résultats pour votre recherche : </h2>
        <article id="info-choisis">
            <h3>Informations choisies :</h3>
                <?php
                    if(isset($_GET['gare_depart']) && isset($_GET['date_depart']) && isset($_GET['heure_depart']) && isset($_GET['gare_arrive']) && !isset($_GET['gare'])) {
                        $gare_depart = $_GET['gare_depart'];
                        $date_depart = $_GET['date_depart'];
                        $heure_depart = $_GET['heure_depart'];
                    
                        $gare_arrive = $_GET['gare_arrive'];
                        
                        $date_format_depart = date("d/m/y", strtotime($date_depart));
                    
                        echo "<p>Départ : $gare_depart</p>\n";
                        echo "\t\t\t\t\t<p>Arrivée : $gare_arrive</p>\n";
                        echo "\t\t\t\t\t<p>Date de départ : $date_format_depart</p>\n";
                        echo "\t\t\t\t\t<p>Heure de départ : $heure_depart</p>\n";
            
                        $search_text = "<p>Itineraire de $gare_depart à $gare_arrive, le $date_depart à $heure_depart<p>\n";
            
                        setcookie("last", $search_text, time() + (24 * 3600), "/");

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
            <h3>Votre Itineraire :</h3>
            <?php
                $count = 5;
                if(isset($_GET['gare_depart']) && isset($_GET['gare_arrive']) && isset($_GET['heure_depart']) && isset($_GET['date_depart'])){              
                    $depart = getStationId($_GET['gare_depart']);
                    $arrive = getStationId($_GET['gare_arrive']);
                    $horaire = $_GET['date_depart'] . 'T' . $_GET['heure_depart']; 
                    
                    $result = getTrajet($depart, $arrive, $horaire, $count);
                    echo $result;
                }
            ?>
            </article>
            <a class="btn-retour" href="./itineraire.php">Retour</a> 
    </section>
            </main>

<?php
    require "./include/footer.inc.php";
?>