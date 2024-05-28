<?php
    declare(strict_types=1);
    $titre="Plan du Site";
    $page="plan.php";
    require "./include/header.inc.php";
    require "./include/fonctions.inc.php";
?>

    <main>
        <aside>
            <a class="btn-remonte" href="#">⬆</a>
        </aside>
        <h1 id="titre">Plan du Site</h1>
        <section>
            <h2 class="plan-sommaire">Sommaire</h2>
                <article>
                    <h3 class="a-plan">
                        <a href="./index.php" class="plan">Accueil</a>
                    </h3>
                    <ul>
                        <li>
                            <a href="./index.php#discover" class="a-plan-li">Actualités</a>
                        </li>
                        <li>
                            <a href="./index.php#populaire" class="a-plan-li">Gares populaires</a>
                        </li>
                        <li>
                            <a href="./index.php#jo" class="a-plan-li">La SNCF se prépare pour les JO</a>
                        </li>
                        <li>
                            <a href="./index.php#site" class="a-plan-li">Vous aimez le site ?</a>
                        </li>
                    </ul>
                </article>

                <article>
                    <h3 class="a-plan">
                        <a href="./itineraire.php" class="plan">Itinéraire</a>
                    </h3>
                    <ul>
                        <li>
                            <a href="./itineraire.php#travel-it" class="a-plan-li">Où allez-vous ?</a>
                        </li>
                    </ul>
                </article>

                <article>
                    <h3 class="a-plan"><a href="./statistiques.php" class="plan">Statistiques</a></h3>
                </article>

                <article>
                    <h3 class="a-plan">
                        <a href="./autres.php" class="plan">Compagnies ferrovières</a>
                    </h3>
                    <ul>
                        <li>
                            <a href="./autres.php#ligne" class="a-plan-li">Lignes disponibles</a>
                        </li>
                    </ul>
                </article>

                <article>
                    <h3 class="a-plan">
                        <a href="./team.php" class="plan">Auteurs</a>
                    </h3>
                    <ul>
                        <li>
                            <a href="./team.php#one" class="a-plan-li">Bala Gobaloukichenin</a>
                        </li>
                        <li>
                            <a href="./team.php#two" class="a-plan-li">William Gabita</a>
                        </li>
                    </ul>
                </article>

                <article>
                    <h3 class="a-plan">
                        <a href="./tech.php" class="plan">API Nasa</a>
                    </h3>
                    <ul>
                        <li>
                            <a href="./tech.php#loc" class="a-plan-li">Localisation avec GeoPlugin</a>
                        </li>
                    </ul>
                </article>
        </section>
    </main>

<?php
require "./include/footer.inc.php";
?>