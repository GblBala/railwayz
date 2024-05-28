<?php
declare(strict_types=1);
$titre="Statistiques";
$page="statistiques.php";
require "./include/header.inc.php";
require "./include/fonctions.inc.php";
?>

    <main>
        <aside>
            <a class="btn-remonte" href="#">⬆</a>
        </aside>
        <h1 id="titre">Statistiques</h1>
            <section id="statistiques">
                <h2>Statistiques des Gares Consultées</h2>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <?php
                    if(isset($_GET["style"])){
                        if($_GET["style"]=="jour"){
                            echo statisticsFromCSV("recherche_gare.csv", "rgba(255, 163, 67, 0.2)", "rgba(255, 163, 67, 1)");
                        }
                        else{
                            echo statisticsFromCSV("recherche_gare.csv", "rgba(15, 136, 206, 0.7)", "blue");
                        }
                    }
                    else if(isset($_COOKIE["style"])){
                        if($_COOKIE["style"]=="jour"){
                            echo statisticsFromCSV("recherche_gare.csv", "rgba(255, 163, 67, 0.2)", "rgba(255, 163, 67, 1)");
                        }
                        else{
                            echo statisticsFromCSV("recherche_gare.csv", "rgba(15, 136, 206, 0.7)", "blue");
                        }
                    }
                    else{
                        echo statisticsFromCSV("recherche_gare.csv", "rgba(255, 163, 67, 0.2)", "rgba(255, 163, 67, 1)");
                    }
                ?>
            </section>
        </main>

<?php
require "./include/footer.inc.php";
?>