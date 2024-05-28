<?php
declare(strict_types=1);
$titre="RailWayz";
$page="index.php";
require "./include/header.inc.php";
require "./include/fonctions.inc.php";
?>

<main>
    <aside>
        <a class="btn-remonte" href="#">⬆</a>
    </aside>
<section class="home">
        <div class="home-text">
            <h5>Bienvenue !</h5>
            <h1>Vous recherchez un <span class ="multiple-text"></span></h1>
            <p>De la France, en passant par l'Allemagne et partout en Europe, il n'y a aucune limite..</p>
            <a href="./itineraire.php" class="btn-spe">C'est parti</a>
        </div>
</section>

<div class="recherche">
            <form method="GET" action="./recherche.php">
                <div>
                    <label>Départ</label>
                    <input list="choix_gare_depart" placeholder="Gare de départ" name="gare_depart" required="" class="gare-input"/>
                    <datalist id="choix_gare_depart" class="gare-datalist">
                        <!-- Options gérés dynamiquement grâce au JS -->
                    </datalist>
                </div>
                <div>
                    <label>Arrivée</label>
                    <input list="choix_gare_arrive" placeholder="Gare d'arrivée" name="gare_arrive" required="" class="gare-input"/>
                    <datalist id="choix_gare_arrive" class="gare-datalist">
                        <!-- Options gérés dynamiquement grâce au JS -->
                    </datalist>
                </div>
                <input type="submit" value="chercher" />
            </form>
        </div>

    <section class="random-section">
        <div class="culture-img">
            <?php
            $photoDir = "./random";
            $randomImage = getRandomImage($photoDir);
            if ($randomImage == "./random/euro.webp") {
                $r="";
                $r.= "<figure>\n";
                $r.= "\t\t\t\t<img src= \"$randomImage\" alt=\"Euro\" />\n";
                $r.= "\t\t\t</figure>\n";
                $r.= "\t\t</div>\n";

                $r.= "\t\t<div class=\"culture-text\">\n";
                $r.= "\t\t\t<h5 id=\"discover\">Et buuut !</h5>\n";
                $r.= "\t\t\t<h2>Embarquez pour l'Euro 2024 avec RailWayz</h2>\n";
                $r.= "\t\t\t<p>En coulisses et sur le terrain, nos équipes relèvent un défi inédit : être au rendez-vous des Jeux Olympiques et Paralympiques de Paris 2024. A la SNCF, nous nous battons pour une mobilité durable, pour tous, dans tous les coins de France, avec ouverture, efficacité et engagement.</p>\n";
                $r.= "\t\t\t<a href=\"https://fr.uefa.com/euro2024/news/0257-0e16c47d1289-04633da9a9ce-1000--uefa-euro-2024-toutes-les-infos/\" class=\"btn\">Lire plus</a>\n";
                $r.= "\t\t</div>\n";
                echo $r;
            } else if ($randomImage == "./random/disneyland.jpg") {
                $r="";
                $r.= "<figure>\n";
                $r.= "\t\t\t\t<img src= \"$randomImage\" alt=\"Disneyland\" />\n";
                $r.= "\t\t\t</figure>\n";
                $r.= "\t\t</div>\n";

                $r.= "\t\t<div class=\"culture-text\">\n";
                $r.= "\t\t\t<h5 id=\"discover\">Un autre monde vous attend</h5>\n";
                $r.= "\t\t\t<h2>Explorez la Magie de Disneyland !</h2>\n";
                $r.= "\t\t\t<p>Embarquez pour une aventure inoubliable vers Disneyland Paris avec notre service de train. Profitez du confort et de la simplicité du voyage en train tout en vous laissant transporter vers le monde féerique de Disney. Réservez dès aujourd'hui et préparez-vous à vivre des moments magiques en famille ou entre amis.</p>\n";
                $r.= "\t\t\t<a href=\"https://www.disneylandparis.com/fr-fr/\" class=\"btn\">Lire plus</a>\n";
                $r.= "\t\t</div>\n";
                echo $r;
            } else if ($randomImage == "./random/printemps_parisc.jpg") {
                $r="";
                $r.= "<figure>\n";
                $r.= "\t\t\t\t<img src= \"$randomImage\" alt=\"Printemps\" />\n";
                $r.= "\t\t\t</figure>\n";
                $r.= "\t\t</div>\n";

                $r.= "\t\t<div class=\"culture-text\">\n";
                $r.= "\t\t\t<h5 id=\"discover\">Voyager à petits prix</h5>\n";
                $r.= "\t\t\t<h2>Profiter du printemps avec RailWayz</h2>\n";
                $r.= "\t\t\t<p>Plongez au cœur de la saison printanière avec notre service de train et partez à la découverte des merveilles de la nature en fleur. Réservez dès maintenant pour une escapade en train vers des destinations printanières enchanteuses. Vivez des instants uniques et rafraîchissants en profitant du voyage confortable et pittoresque en train.</p>\n";
                $r.= "\t\t\t<a href=\"https://parisjetaime.com/article/paris-au-printemps-a736\" class=\"btn\">Lire plus</a>\n";
                $r.= "\t\t</div>\n";
                echo $r;
            } else if ($randomImage == "./random/cyu.jpg") {
                $r="";
                $r.="<figure>\n";
                $r.= "\t\t\t\t<img src= \"$randomImage\" alt=\"Université de Cergy\" />\n";
                $r.= "\t\t\t</figure>\n";
                $r.= "\t\t</div>\n";

                $r.= "\t\t<div class=\"culture-text\">\n";
                $r.= "\t\t\t<h5 id=\"discover\">CY Université</h5>\n";
                $r.= "\t\t\t<h2>La référence du Val d'Oise</h2>\n";
                $r.= "\t\t\t<p>Bienvenue dans la plus grande université du 95. Avec plusieurs pôles implantés dans les plus grandes agglomérations du Val D'Oise dont Cergy aujourd'hui qualifiée de ville étudiante, l'université de CY Cergy-Pontoise accueille un grand nombre d'étudiants nationaux et internationaux dans plusieurs formations diverses et variées.</p>\n";
                $r.= "\t\t\t<a href=\"https://www.cyu.fr/\" class=\"btn\">Lire plus</a>\n";
                $r.= "\t\t</div>\n";
                echo $r;
            }else if ($randomImage == "./random/jo.jpg") {
                $r="";
                $r.= "<figure>\n";
                $r.= "\t\t\t\t<img src= \"$randomImage\" alt=\"JO de Paris\" />\n";
                $r.= "\t\t\t</figure>\n";
                $r.= "\t\t</div>\n";

                $r.= "\t\t<div class=\"culture-text\">\n";
                $r.= "\t\t\t<h5 id=\"discover\">L'évènement de l'été</h5>\n";
                $r.= "\t\t\t<h2>Jeux Olympiques de Paris 2024</h2>\n";
                $r.= "\t\t\t<p>Les Jeux Olympiques et Paralympiques de Paris 2024 promettent d'être un événement spectaculaire qui captivera le monde entier. En tant que ville hôte, Paris se prépare à accueillir des milliers d'athlètes et de spectateurs venus du monde entier pour célébrer l'esprit olympique et paralympique. Cet événement historique sera l'occasion pour Paris de briller sous les feux des projecteurs et de laisser un héritage durable pour les générations futures.</p>\n";
                $r.= "\t\t\t<a href=\"https://olympics.com/fr/paris-2024\" class=\"btn\">Lire plus</a>\n";
                $r.= "\t\t</div>\n";
                echo $r;
            }
            ?>
    </section>

    <section class="tour">
        <div class="center-text">
            <h2 id="populaire">Gares populaires</h2>
        </div>

        <div class="tour-content">
            <div class="box">
                <img src="./images/paris_nord.jpg" alt="Paris Nord" />
                <h4>Paris Nord</h4>
            </div>

            <div class="box">
                <img src="./images/gare_de_lyon.jpg" alt="Gare de Lyon" />
                <h4>Gare de Lyon</h4>
            </div>

            <div class="box">
                <img src="./images/saint_lazare.jpg" alt="Saint Lazare" />
                <h4>Saint Lazare</h4>
            </div>
        </div>

        <div class="center-btn">
            <a href="https://fr.wikipedia.org/wiki/Liste_des_gares_fran%C3%A7aises_accueillant_plus_d%27un_million_de_voyageurs_par_an" class="btn">Voir plus</a>
        </div>
    </section>

    <section class="culture">
        <div class="culture-text">
            <h5 id="jo">À vos marques !</h5>
            <h2>La SNCF se prépare pour les JO</h2>
            <p>En coulisses et sur le terrain, nos équipes relèvent un défi inédit :
                être au rendez-vous des Jeux Olympiques et Paralympiques de Paris 2024. A la SNCF, nous nous battons pour
                une mobilité durable, pour tous, dans tous les coins de France, avec ouverture, efficacité et
                engagement.
            </p>
            <a href="https://www.sncf.com/fr" class="btn">Lire plus</a>
        </div>

        <div class="culture-img">
            <img src="./images/sncf.jpg" alt="Lignes de train" />
        </div>
    </section>


    <section class="newsletter">
        <div class="newsletter-content">
            <div class="newsletter-text">
                <h2 id="site" >Vous aimez le site ?</h2>
                <p>Notez votre expérience. Merci !</p>
            </div>

            <form method="GET" action="./index.php#site">
                <div class="rating">
                    <input value="5" name="rating" id="star5" type="radio" />
                    <label for="star5"></label>
                    <input value="4" name="rating" id="star4" type="radio" />
                    <label for="star4"></label>
                    <input value="3" name="rating" id="star3" type="radio" />
                    <label for="star3"></label>
                    <input value="2" name="rating" id="star2" type="radio" />
                    <label for="star2"></label>
                    <input value="1" name="rating" id="star1" type="radio" />
                    <label for="star1"></label>
                </div>
                <button class="btn" type="submit">Notez</button>
                <?php
    if (isset($_GET['rating'])) {
        $rating = intval($_GET['rating']);
        switch ($rating) {
            case 5:
                echo "<span style=\"margin-left:10rem\">Merci pour cette excellente note ;)</span>\n";
                break;
            case 4:
                echo "<span style=\"margin-left:10rem\">Nous sommes ravis que vous ayez apprécié :)</span>\n";
                break;
            case 3:
                echo "<span style=\"margin-left:10rem\">Nous allons nous améliorer :|</span>\n";
                break;
            case 2:
                echo "<span style=\"margin-left:10rem\">Nous avons encore du pain sur la planche :(</span>\n";
                break;
            case 1:
                echo "<span style=\"margin-left:10rem\">Désolé que vous n'ayez pas apprécié :(</span>\n";
                break;
            default:
                echo "<span style=\"margin-left:10rem\">Veuillez sélectionner une note pour nous aider à améliorer nos services.</span>\n";
        }
    }
    ?>
            </form>
        </div>
    </section>
</main>
<?php

require "./include/footer.inc.php";
?>