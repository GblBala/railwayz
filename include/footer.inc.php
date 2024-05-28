<footer>
    <div class="footer">
        <div class="footer-box">
            <h3>Navigation</h3>
            <a href="./index.php">Accueil</a>
            <a href="./itineraire.php">Itineraire</a>
            <a href="./statistiques.php">Statistiques</a>
            <a href="./compagnie.php">Compagnie</a>
        </div>

        <div class="footer-box">
            <h3>Nous Connaître</h3>
            <a href="./team.php">Equipe</a>
            <a href="#">Visites : <?= (isset($hit)) ? $hit :hits_compteur('./cache/compteur.txt'); ?></a>
        </div>

        <div class="footer-box">
            <h3>Informations Utiles</h3>
            <a href="./tech.php">Tech</a>
            <a href="./plan.php">Plan du site</a>
            <a href="#"><?php echo getnavigateur(); ?></a>
        </div>

        <div class="footer-box">
            <h3>Réseaux</h3>
            <div class="social">
                <a href="https://www.instagram.com/"><i class="ri-instagram-fill"></i></a>
                <a href="https://fr.linkedin.com/"><i class="ri-linkedin-fill"></i></a>
                <a href="https://www.google.com/"><i class="ri-google-fill"></i></a>
                <a href="https://github.com/"><i class="ri-github-fill"></i></a>
            </div>
        </div>
    </div>

    <div class="copyright">
        <p>Copyright &#169; 2024 par William GABITA / Bala GOBALOUKICHENIN</p>
    </div>

    <!--Fichier JS-->
    </footer>

    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
    <script src="./script/script.js"></script>
    <script src="./script/scriptt.js"></script>
    <script src="./script/scripttt.js"></script>
</body>
</html>