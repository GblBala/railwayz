<?php
    declare (strict_types=1);
    $titre="Notre Compagnie";
    $page="compagnie.php";
    require "./include/header.inc.php";
    require "./include/fonctions.inc.php";
?>

    <main>    
        <aside>
            <a class="btn-remonte" href="#">⬆</a>
        </aside>   
        <h1 id="titre">Notre Compagnie</h1> 
            <section id="transports">
                <div class="center-text">
                    <h2>Nos Transports</h2>
                </div>
                <?php
                    $stations = getSNCFCommercial();
                    if (is_array($stations)) {
                        echo "<ul>\n";
                        foreach ($stations as $station) {
                            echo "\t\t\t\t\t<li>$station</li>\n";
                        }
                        echo "\t\t\t\t</ul>\n";
                    } else {
                        echo"<p>Notre Service est momentanément indisponibles</p>\n";
                    }
                ?>
            </section>  
            <section>
                <div class="center-text">
                    <h2>Nos Partenaires</h2>
                </div>
                <div class="partenaires">
                    <figure>
                        <img src="./images/navitia_logo.jpg" alt="Logo Navitia" width="230" />
                    </figure>
                    <figure>
                        <img src="./images/ratp_logo.png" alt="Logo RATP" width="230" />
                    </figure>
                    <figure>
                        <img src="./images/transilien_logo.png" alt="Logo Transilien" width="230" />
                    </figure>
                </div>
            </section>
    </main>

<?php
    require "./include/footer.inc.php";
?>