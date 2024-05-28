<?php
declare(strict_types=1);
    $titre="Team";
    $page="team.php";
    require "./include/header.inc.php";
    require "./include/fonctions.inc.php";
?>

    <main>
        <aside>
            <a class="btn-remonte" href="#">⬆</a>
        </aside>
        <h1 id="titre">Equipe</h1>
            <div class="center-text">
                <h2 class="team">Auteurs</h2>
            </div>
            <section class="culture">
                <figure>
                    <div class="culture-img">
                        <img src="./images/b-one.jpg" alt="Illustration auteur 1" />
                    </div>
                </figure>

                <div class="culture-text">
                    <h5>Présentation de l'équipe</h5>
                    <h2><span class="multiple-team"></span>Bala GOBALOUCHENIN</h2>
                    <p>Le <span>Designer</span> ! Tout l'aspect esthétique du site est son oeuvre.
                        Vous ne trouverez pas souvent quelqu'un qui maîtrise autant son art que lui. De la gestion des couleurs
                        en passant par les animations textuels, avec lui rien n'est laissé au hasard. Il manipule les fonctionnalités
                        du CSS aussi bien qu'un enchanteur connaissant parfaitement ses sorts.
                        Ecrivez lui ! Qui sait peut-être qu'il vous aidera à réaliser vos idées les plus folles !
                    </p>
                </div>
            </section>

            <section class="culture">
                <div class="culture-text">
                    <h5>Présentation de l'équipe</h5>
                    <h2><span class="multiple-team-one"></span>William GABITA</h2>
                    <p>Le <span>Concepteur</span> ! Derrière chaque grande oeuvre se cache un architecte hors-pair.
                        Il a pensé à tout lors de la conception et de la réalisation de la maquette du site. Chaque détail compte et à
                        son importance. Faire un bon site internet peut sembler facile, mais c'est une véritable pyramide de codes et d'idées
                        qu'il faut organiser. 
                        Associez un excellent <span>Designer</span> à un grand <span>Concepteur</span>
                        et vous obtenez fusion parfaite poour votre site internet
                    </p>
                </div>

                <div class="culture-img">
                    <img src="./images/w-one.jpg" alt="Illustration auteur 2" />
                </div>
            </section>
    </main>

<?php
    require "./include/footer.inc.php";
?>