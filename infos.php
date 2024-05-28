<?php
    declare (strict_types=1);
    $titre="Horaires";
    $page="infos.php";
require "./include/header.inc.php";
require "./include/fonctions.inc.php";
?>

<main>
    <aside>
        <a class="btn-remonte" href="#">⬆</a>
    </aside>
    <h1 id="titre">Horaires</h1>
    <section id="info-section">
        <h2>Résultats de votre recherche :</h2>
        <article>
            <h3>Informations choisies :</h3>
                <?php
                if(isset($_GET["gare"])){
                    saveStation($_GET["gare"]);
                    $gare = $_GET['gare'];
                
                    $search_text = "Horaires sur $gare";

                    setcookie("last", $search_text, time() + (24 * 3600), "/");

                    echo "<p>Gare choisie : $gare</p>\n";
                }else {
                    echo "<p>Le nom de la gare n'a pas été spécifié.</p>\n";
                } 
                ?>
            </article>
<article style="margin-bottom:50px">
                <?php
                echo "<h3>Horaires de départ de " . $_GET['gare'] . ":</h3>\n";
                    if(isset($_GET['gare'])) {  
                        if(isset($_GET['options'])){
                            $departuresName = getStationId($_GET['gare']);
                            $choosenOption = "/" . "commercial_modes/" . $_GET['options'];
                            $departure = getNextDeparture($departuresName, $choosenOption);
        
                            echo $departure;
                        }else{
                            $departuresName = getStationId($_GET['gare']);
                            $default = "/";
                            $departure = getNextDeparture($departuresName, $default);

                            echo $departure;
                        }             
                    }else{
                        echo "<p>Aucune informations trouvé pour cette gare</p>";
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