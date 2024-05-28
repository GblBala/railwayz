<?php
    if (!isset($_COOKIE["style"])) {
        setcookie("style", "jour", time() + (30 * 24 * 60 * 60));
    }

    if(isset($_GET["style"])){
        if($_GET["style"]=="jour"){
            setcookie("style", "jour", time() + (30 * 24 * 60 * 60));
        }
        else{
            setcookie("style", "nuit", time() + (30 * 24 * 60 * 60));
        }
    }

    if(isset($_GET["style"])){
        if($_GET["style"]=="jour"){
            $css = "./style/style.css";
        }
        else{
            $css = "./style/alt.css";
        }
    }
    else if(isset($_COOKIE["style"])){
        if($_COOKIE["style"]=="nuit"){
            $css = "./style/alt.css";
        }
        else if($_COOKIE["style"]=="jour"){
            $css = "./style/style.css";
        } 
    }
    else{
        $css = "./style/style.css";
    }
?>

<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="./images/Logo.png" />
    <title><?=$titre?></title>
    <?php 
    if (isset($css)){
        echo"<link href=\"".$css."\" rel=\"stylesheet\"/>\n";
    }else{
        echo "<link href=\"./style/style.css\" rel=\"stylesheet\"/>\n";
    }
    ?>
    <!--Boxicons-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" />

    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet"/>
    </head>

<body>
    <header class="header" id="sticky">
        <a href="./index.php" class="logo">Rail<span>Wayz</span></a>

        <nav id="desktop-nav">
        <ul class="navbar">
            <li><a href="./index.php">Accueil</a></li>
            <li><a href="./itineraire.php">Itinéraire</a></li>
            <li><a href="./statistiques.php">Statistiques</a></li>
            <li><a href="./compagnie.php">Compagnie</a></li>
        </ul>
    </nav>
    <nav id="hamburger-nav">
        <a href="./index.php" class="logo-mobile">Rail<span>Wayz</span></a>
        <div class="hamburger-menu">
            <div class="hamburger-icon" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
            </div>
            <div class="menu-links">
                <ul>
                    <li><a href="./index.php" onclick="toggleMenu()">Accueil</a></li>
                    <li><a href="./itineraire.php" onclick="toggleMenu()">Itineraire</a></li>
                    <li><a href="./statistiques.php" onclick="toggleMenu()">Statistiques</a></li>
                    <li><a href="./compagnie.php" onclick="toggleMenu()">À Propos</a></li>
                </ul>
            </div>
        </div>
        </nav>
            <ul class="h-right" style="list-style: none;">
                <?php
                    $sty = "?";
                    $str = "";
                    if(isset($_GET["style"])){
                        if($_GET["style"]=="jour"){
                            $sty.="style=nuit";
                        }
                        else{
                            $sty.="style=jour";
                        }
                    }
                    else if(isset($_COOKIE["style"])){
                        if($_COOKIE["style"]=="jour"){
                            $sty.="style=nuit";
                        }
                        else{
                            $sty.="style=jour";
                        }
                    }
                    else{
                        $sty.="style=nuit";
                    }

                    foreach($_GET as $key => $value){
                        if($key!="style"){
                            $str.="&".$key."=".$value;
                        }
                    }


                    if(isset($_GET["style"])){
                        if($_GET["style"]=="jour"){
                            echo "<li>\n<a href=\"./".$page.$sty.htmlspecialchars(urlencode($str), ENT_QUOTES, "UTF-8")."\">\n<img src=\"./images/mode-jour.png\" width =\"30\" alt=\"mode nuit\"/>\n</a>\n</li>\n";
                        }
                        else{
                            echo "<li>\n<a href=\"./".$page.$sty.htmlspecialchars(urlencode($str), ENT_QUOTES, "UTF-8")."\">\n<img src=\"./images/lune.png\" width =\"30\" alt=\"mode jour\"/>\n</a>\n</li>\n";
                        }
                    }
                    else if(isset($_COOKIE["style"])){
                        if($_COOKIE["style"]=="jour"){
                            echo "<li>\n\t\t\t\t\t<a href=\"./".$page.$sty.htmlspecialchars(urlencode($str), ENT_QUOTES, "UTF-8")."\">\n\t\t\t\t\t\t<img src=\"./images/mode-jour.png\" width =\"30\" alt=\"mode nuit\"/>\n\t\t\t\t\t</a>\n\t\t\t\t</li>\n";
                        }
                        else{
                            echo "<li>\n\t\t\t\t\t<a href=\"./".$page.$sty.htmlspecialchars(urlencode($str), ENT_QUOTES, "UTF-8")."\">\n\t\t\t\t\t\t<img src=\"./images/lune.png\" width =\"30\" alt=\"mode jour\"/>\n\t\t\t\t\t</a>\n\t\t\t\t</li>\n";
                        }
                    }
                    else{
                        echo "<li>\n\t\t\t\t\t<a href=\"./".$page.$sty.htmlspecialchars(urlencode($str), ENT_QUOTES, "UTF-8")."\">\n\t\t\t\t\t\t<img  src=\"./images/mode-jour.png\" width =\"30\" alt=\"mode nuit\"/>\n\t\t\t\t\t</a>\n\t\t\t\t</li>\n";
                    }
                ?>
            </ul>
    </header>

    