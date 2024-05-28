<?php
    declare(strict_types=1);
    $titre = "Tech";
    $page="tech.php";
    include "./include/header.inc.php"; 
    include "./include/fonctions.inc.php";
?>


<main>
    <aside>
        <a class="btn-remonte" href="#">⬆</a>
    </aside>
    <h1 id="titre">Tech</h1>
    <section id="tech">
        <h2>Découverte des API</h2>
        <article>
            <?php
                $imgSat = extractApiJson("https://api.nasa.gov/planetary/apod?api_key=jKySgkPnxBnIyTX6dKRm8Ev9vdp6NN1LaJxXdJYV&date=".date("Y")."-".date("m")."-".date("d"));
                $s = "";
                if(isset($imgSat["media_type"])){
                    if($imgSat["media_type"] == "image"){
                        $s.= "<h3>Image du jour</h3>\n";
                        $s.= "<figure>\n";
                        $s.= "\t<img style=\"max-height : 40%;max-width:40%;\" alt=\"Image du jour\" src=\"".$imgSat["url"]."\" decoding=\"async\"/>\n";
                        $s.= "\t<figcaption>".$imgSat["title"]."</figcaption>\n";
                        $s.="</figure>\n";
                    }
                }
                else if($imgSat["media_type"] == "video"){
                    $s.= "<h3>".$imgSat["title"]."</h3>\n";
                    $s.= "\t<iframe height=\"350px\" width=\"500px\" src=\"".$imgSat["url"]."\"></iframe>\n";
                }
                echo $s;
            ?>
        </article>
        <article>
            <h3>Localisation avec GeoPlugin :</h3>
            <?php
                $parse = extractApiXml("http://www.geoplugin.net/xml.gp?ip=".$_SERVER["REMOTE_ADDR"]);
                echo "<p>Vous etes localisé à ".$parse->geoplugin_city.", ".$parse->geoplugin_regionName.", ".$parse->geoplugin_region.", ".$parse->geoplugin_countryName."</p>\n";
            ?>
        </article>
        <article>
            <h3>Localisation avec IpInfo.io :</h3>
            <?php
                $loc = extractApiJson("https://ipinfo.io/".$_SERVER["REMOTE_ADDR"]."/geo");
                echo "<p>Vous etes localisé à ".$loc["city"].", ".$loc["region"]."</p>\n"
            ?>
        </article>
        <article>
            <h3>Localisation avec WhatIsMyIp :</h3>
            <?php
                $lieu = extractApiXml("https://api.whatismyip.com/ip-address-lookup.php?key=600d7ef44c92cb9b87ef52c62462750d&input=".$_SERVER["REMOTE_ADDR"]."&output=xml");
                echo "<p>Vous etes localisé à ".$lieu->server_data->city.", ".$lieu->server_data->postalcode.", ".$lieu->server_data->region.", ".$lieu->server_data->country."</p>\n";
            ?>
        </article>
    </section>
</main>
<?php
    include "./include/footer.inc.php";
?>
