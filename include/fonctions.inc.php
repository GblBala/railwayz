<?php
declare(strict_types=1);

/******PAGE TECH & API APOD******/

/**
* @author
*/
    
/**
* Cette fonction a pour but d'extraire un flux JSON en array
* @param (string) $url contenant l'url que l'on souhaite traiter
* @return (array) $data contenant les informations que l'on veut
*/
function extractApiJson(string $url):array{
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);
        if($data == false){
            echo curl_error($curl);
        }
        else{
            $data = json_decode($data, true);
        }
        curl_close($curl);
        return $data;
}

/**
* Cette fonction a pour but d'extraire un flux XML en SimpleXMLElement
* @param (string) $url contenant l'url que l'on souhaite traiter
* @return (SimpleXMLElement) $parse contenant les informations que l'veut
*/
function extractApiXml(string $url): SimpleXMLElement{
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $xml = curl_exec($curl);
        if($xml == false){
            echo curl_error($curl);
        }
        else{
            $parse = simplexml_load_string($xml);
        }
        curl_close($curl);
        return $parse;
}

/**
* Cette fonction permet de récupérer le nom du navigateur de l'utilisateur
* @return (string) $browser le navigateur de l'utilisateur 
*/
function getnavigateur(): string {
        $browser = 'Unknown';
        $user = $_SERVER ['HTTP_USER_AGENT'];

        if (strpos($user, 'Firefox') !== false){
            $browser = 'Firefox';
        }else if (strpos($user, 'Chrome') !== false){
            $browser = 'Chrome';
        }else if (strpos($user, 'Safari') !== false){
            $browser = 'Safari';
        }else if (strpos($user, 'Chrome') !== false){
            $browser = 'Chrome';
        }else if (strpos($user, 'Opera Mini') !== false){
            $browser = 'Opera Mini';
        }else if (strpos($user, 'Edge') !== false){
            $browser = 'Microsoft Edge';
        }else if (strpos($user, 'Chromium') !== false){
            $browser = 'Google Chromium';
        }
        return $browser;
}

/**
* Cette fonction permet d'afficher le nombre de visites des pages du site
* @param $file fichier texte
* @return $count nombre de file
*/
function hits_compteur(string $file): int {
        if (!file_exists($file)) {
            file_put_contents($file, '0'); // Écrire '0' (string) dans le fichier s'il n'existe pas
        }
    
        $count = (int) file_get_contents($file); // Convertir le contenu en entier (int)
    
        $count++; // Incrémenter le compteur
    
        file_put_contents($file, (string) $count); // Écrire le compteur mis à jour dans le fichier
    
        return $count;
}

/**
* Cette fonction permet de choisir aléatoirement une image dans un dossier
* @param (string) $dirPath le dossier dans lequel on veut choisir l'image aléatoirement
* @return (string) renvoie le chemin pour l'image choisi
*/
function getRandomImage(string $dirPath) : string {
    $files = scandir($dirPath);

    $files = array_filter($files, function($file) {
        return !in_array($file, [".", "..", ".DS_Store"]);
    });

    $randomIndex = array_rand($files);
    $randomFile = $files[$randomIndex];

    return $dirPath . "/" . $randomFile;
}

/**
 * Cette fonction permet d'obtenir les prochains départs d'un arrêt donné pour un mode de transport spécifique.
 * 
 * @param string $stop L'identifiant de l'arrêt.
 * @param string $transport Le mode de transport (par exemple, 'bus', 'train', etc.).
 * @return string Une chaîne HTML représentant les prochains départs ou un message d'erreur si aucune donnée n'est trouvée.
 */

function getNextDeparture($stop, $transport) : string{
    // Clé d'API pour accéder à l'API SNCF
    $apiKey = "c7cae7cf-e419-4845-9684-fff7de1c3466";

    // Construire l'URL de l'API avec les éléments spécifiées
    $url = "https://api.navitia.io/v1/coverage/fr-idf/stop_areas/$stop$transport/departures?count=15&";
    
    // Options pour la requête HTTP
    $options = array(
        'http' => array(
            'header' => "Authorization: $apiKey\r\n"
        )
    );

    // Créer le contexte de flux avec les options de requête
    $context = stream_context_create($options);

    // Envoyer la requête à l'API et récupérer les données
    $result = file_get_contents($url, false, $context);

    // Vérifier si la requête a réussi
    if ($result === FALSE) {
        // En cas d'erreur, retourner un message d'erreur
        return "<p>Erreur lors de la récupération des données de perturbation.</p>\n";
    } else {
        // Convertir les données JSON en tableau associatif
        $data = json_decode($result, true);

        // Vérifier si des perturbations ont été trouvées
        if (isset($data['departures'])) {

            // Parcourir les departures trouvées
            $s="";
            $s.="\t\t\t<table>\n";
                $s.="\t\t\t\t<caption style=\"margin-bottom:7px;\">Horaires</caption>\n";
                $s.="\t\t\t\t<thead>\n";
                $s.="\t\t\t\t\t<tr>\n";
                $s.="\t\t\t\t\t\t<th>Destination</th>\n";
                $s.="\t\t\t\t\t\t<th>Ligne</th>\n";
                $s.="\t\t\t\t\t\t<th>Type</th>\n";
                $s.="\t\t\t\t\t\t<th>Date</th>\n";
                $s.="\t\t\t\t\t\t<th>Heure</th>\n";
                $s.="\t\t\t\t\t</tr>\n";
                $s.="\t\t\t\t</thead>\n";
                $s.="\t\t\t\t<tbody>\n";
            foreach ($data['departures'] as $departure) {
                $departureCode = isset($departure['display_informations']['code']) ? $departure['display_informations']['code'] : '';
                $departureColor = isset($departure['display_informations']['color']) ? $departure['display_informations']['color'] : '';
                $departureName = isset($departure['display_informations']['direction']) ? $departure['display_informations']['direction'] : '';
                $departureVehicle = isset($departure['display_informations']['commercial_mode']) ? $departure['display_informations']['commercial_mode'] : '';
                $departureDateTime = isset($departure['stop_date_time']['departure_date_time']) ? $departure['stop_date_time']['departure_date_time'] : '';

                $departureDate = substr($departureDateTime, 6, 2) . "/" . substr($departureDateTime, 4, 2) . "/" . substr($departureDateTime, 0, 4);
                $departureTime = substr($departureDateTime, 9, 2) . ":" . substr($departureDateTime, 11, 2);


                $s.="\t\t\t\t\t<tr>\n";
                $s.="\t\t\t\t\t\t<td>$departureName</td>\n";
                $s.="\t\t\t\t\t\t<td style=\"background-color:#$departureColor;\">$departureCode</td>\n";
                $s.="\t\t\t\t\t\t<td>$departureVehicle</td>\n";
                $s.="\t\t\t\t\t\t<td>$departureDate</td>\n";
                $s.="\t\t\t\t\t\t<td>$departureTime</td>\n";
                $s.="\t\t\t\t\t</tr>\n";
            }
            $s.="\t\t\t\t</tbody>\n";
            $s.="\t\t\t</table>\n";
            return $s;
        } else {
            // Si aucune perturbation n'a été trouvée, retourner un message indiquant l'absence de perturbation
            return "Aucune perturbation trouvée.";
        }
    }
}


/**
 * Cette fonction permet d'obtenir les modes commerciaux disponibles via l'API SNCF.
 * @return array|string Un tableau contenant les noms des modes commerciaux ou un message d'erreur si aucune donnée n'est trouvée.
 */
function getSNCFCommercial() : array|string{
    // Clé API SNCF
    $apiKey = "4f636f9a-6ceb-442d-9795-9addbe13fdb0";

    // URL de l'API pour obtenir les modes commerciaux
    $url = "https://api.sncf.com/v1/coverage/sncf/commercial_modes";

    //Requête HTTP
    $options = array(
        'http' => array(
            'header' => "Authorization: $apiKey\r\n"
        )
    );

    // Créer le contexte de flux avec les options de requête
    $context = stream_context_create($options);

    // Envoyer la requête à l'API et récupérer les données
    $result = file_get_contents($url, false, $context);

    // Vérifier si la requête a réussi
    if ($result === FALSE) {
        // En cas d'erreur, retourner un message d'erreur
        return "Erreur lors de la récupération des données.";
    } else {
        // Convertir les données JSON en tableau associatif
        $data = json_decode($result, true);

        // Vérifier si des modes commerciaux ont été trouvés
        if (isset($data['commercial_modes'])) {
            // Initialiser un tableau pour stocker les noms des modes commerciaux
            $modes_commerciaux = array();
            // Parcourir les modes commerciaux trouvés
            foreach ($data['commercial_modes'] as $commercial_mode) {
                // Ajouter le nom du mode commercial au tableau
                $modes_commerciaux[] = $commercial_mode['name'];
            }
            // Retourner le tableau des modes commerciaux
            return $modes_commerciaux;
        } else {
            // Si aucun mode commercial n'a été trouvé, retourner un message indiquant l'absence de mode commercial
            return "Aucun mode commercial trouvé.";
        }
    }
}

/**
 * Cette fonction permet d'obtenir l'identifiant d'une station à partir de son nom.
 * @param string $gare Le nom de la station.
 * @return string L'identifiant de la station ou un message d'erreur si aucune station correspondante n'est trouvée.
 */
function getStationId(string $gare): string {
    // Clé d'API pour accéder à l'API Navitia
    $apiKey = "c7cae7cf-e419-4845-9684-fff7de1c3466";

    // Parcourir jusqu'à la 5ème page de résultats pour couvrir toutes les stations
    for ($i = 0; $i < 15; $i++) {
        
        // Construire l'URL de l'API pour obtenir les informations sur les stations
        $url = "https://api.navitia.io/v1/coverage/fr-idf/stop_areas/?count=1000&start_page=$i";

        // Options pour la requête HTTP
        $options = array(
            'http' => array(
                'header' => "Authorization: $apiKey\r\n"
            )
        );

        // Créer le contexte de flux avec les options de requête
        $context = stream_context_create($options);

        // Envoyer la requête à l'API et récupérer les données
        $result = file_get_contents($url, false, $context);

        // Vérifier si la requête a réussi
        if ($result === FALSE) {
            // En cas d'erreur, retourner un message d'erreur
            return "Erreur lors de la récupération des données.";
        } else {
            // Convertir les données JSON en tableau associatif
            $data = json_decode($result, true);

            // Vérifier si des stations ont été trouvées
            if (isset($data['stop_areas'])) {
                // Parcourir les stations trouvées
                foreach ($data['stop_areas'] as $stop_area) {
                    if($stop_area['label'] == $gare){
                        return $stop_area['id'];
                    }
                    // Vérifier si le nom de la station correspond à celui recherché
                }
            } else {
                // Si aucune donnée sur les arrêts n'a été trouvée sur cette page, retourner un message d'erreur
                return "Aucune donnée sur les arrêts trouvée sur la page $i.";
            }
        }
    }

    // Si aucune station correspondante n'a été trouvée après avoir parcouru toutes les pages, retourner un message d'erreur
    return "Aucune station trouvée avec le nom '$gare'.";
}

/**
 * Cette fonction permet d'obtenir le type de transport à partir du numéro de ligne.
 * @param string $line Le numéro de la ligne.
 * @return string Le type de transport ou un message d'erreur si la ligne n'existe pas.
 */
function getTransportType(string $line) : string{
    // Clé d'API pour accéder à l'API SNCF
    $apiKey = "4f636f9a-6ceb-442d-9795-9addbe13fdb0";


    // URL de l'API pour obtenir les informations sur les trajets
    $url = "https://api.sncf.com/v1/coverage/sncf/lines/$line/?";
    // Options pour la requête HTTP
    $options = array(
        'http' => array(
            'header' => "Authorization: Basic " . base64_encode($apiKey) . "\r\n"
        )
    );

    // Créer le contexte de flux avec les options de requête
    $context = stream_context_create($options);
    // Envoyer la requête à l'API et récupérer les données
    $result = file_get_contents($url, false, $context);

    if($result == FALSE){
        echo "<p>Erreur lors de la récupération de la ligne</p>";
    }else{
        $data = json_decode($result, true);
        
        // Vérifier si des stations ont été trouvées
        if (isset($data["lines"])) {
            // Parcourir les stations trouvées
            foreach ($data['lines'] as $line) {
                return $line['commercial_mode']['name'];
            }
        } else {
            // Si aucune donnée sur les arrêts n'a été trouvée sur cette page, retourner un message d'erreur
            return "Cette ligne n'existe pas.";
        }
    }
}

/**
 * Cette fonction permet d'obtenir les émissions de CO2 pour un trajet spécifié.
 * @param string $depart Le point de départ du trajet.
 * @param string $arrive Le point d'arrivée du trajet.
 * @param string $horaire L'horaire du trajet au format ISO 8601 (YYYY-MM-DDTHH:MM:SS).
 * @return string Les émissions de CO2 pour le trajet ou un message d'erreur si le trajet n'existe pas.
 */
function getEmission(string $depart, string $arrive, string $horaire) : string{
    // Clé d'API pour accéder à l'API SNCF
    $apiKey = "4f636f9a-6ceb-442d-9795-9addbe13fdb0";


    // URL de l'API pour obtenir les informations sur les trajets
    $url = "https://api.sncf.com/v1/coverage/sncf/journeys/?from=$depart&to=$arrive&datetime=$horaire&";
    // Options pour la requête HTTP
    $options = array(
        'http' => array(
            'header' => "Authorization: Basic " . base64_encode($apiKey) . "\r\n"
        )
    );

    // Créer le contexte de flux avec les options de requête
    $context = stream_context_create($options);
    // Envoyer la requête à l'API et récupérer les données
    $result = file_get_contents($url, false, $context);

    if($result == FALSE){
        echo "<p>Erreur lors de la récupération de la ligne</p>";
    }else{
        $data = json_decode($result, true);
        
        // Vérifier si des stations ont été trouvée
        if (isset($data["journeys"])) {
            foreach($data["journeys"] as $journey){
                $co2_emission = isset($journey['co2_emission']['value']) ? $journey['co2_emission']['value'] : '';
                return $co2_emission;
            }
        } else {
            // Si aucune donnée sur les arrêts n'a été trouvée sur cette page, retourner un message d'erreur
            return "Ce mode n'existe pas.";
        }
    }
} 

/**
 * Cette fonction permet de compter le nombre de stations.
 * @param array $stations Le tableau des stations.
 * @return int Le nombre de stations.
 */
function count_stations($stations) : int{
    $count = 0;
    foreach ($stations as $station) {
        $count++;
    }
    return $count -1;
}

/**
 * Cette fonction permet d'obtenir les informations sur les trajets entre deux gares.
 * @param string $gare_depart La gare de départ.
 * @param string $gare_arrive La gare d'arrivée.
 * @param string $horaire L'horaire du départ.
 * @param int $count Le nombre de trajets à récupérer.
 * @return string Les informations sur les trajets.
 */
function getTrajet(string $gare_depart, string $gare_arrive, string $horaire, int $count): string {
    // Clé d'API pour accéder à l'API Navitia
    $apiKey = "c7cae7cf-e419-4845-9684-fff7de1c3466";

    // URL de l'API pour obtenir les informations sur les trajets
    $url = "https://api.navitia.io/v1/coverage/fr-idf/journeys?from=$gare_depart&to=$gare_arrive&datetime=$horaire&count=$count";

    // Options pour la requête HTTP
    $options = array(
        'http' => array(
            'header' => "Authorization: Basic " . base64_encode($apiKey) . "\r\n"
        )
    );

    // Créer le contexte de flux avec les options de requête
    $context = stream_context_create($options);

    // Envoyer la requête à l'API et récupérer les données
    $result = file_get_contents($url, false, $context);

    $r = '';

    // Vérifier si la requête a réussi
    if ($result === FALSE) {
        // Vérifier si la requête a réussi
        $r .= "<p>Erreur lors de la récupération des informations sur le trajet.</p>";
    } else {
        // Convertir les données JSON en tableau associatif
        $data = json_decode($result, true);

        // Vérifier si des trajets ont été trouvés
        if (isset($data['journeys'])) {
            // Afficher la liste des trajets
            foreach ($data['journeys'] as $journey) {
                $r .= "\t\t\t\t<div class=\"itineraire-info\">\n";
                $r .= "\t\t\t\t<ul>\n";
                // Convertir les dates et heures en format lisible
                $departureDateTime = date("H:i", strtotime($journey['departure_date_time']));
                $arrivalDateTime = date("H:i", strtotime($journey['arrival_date_time']));

                // Calculer la durée du trajet
                $durationHours = floor($journey['duration'] / 3600);
                $durationMinutes = floor(($journey['duration'] % 3600) / 60);

                $durationHoursFormated = sprintf("%02d", $durationHours);
                $durationMinutesFormated = sprintf("%02d", $durationMinutes);

                // Afficher les informations sur le trajet
                $r .= "\t\t\t\t\t<li class=\"time\">$departureDateTime - </li>\n";
                $r .= "\t\t\t\t\t<li class=\"time\">$arrivalDateTime</li>\n";
                $r .= "\t\t\t\t\t<li class=\"temps\">$durationHoursFormated:$durationMinutesFormated</li>\n";

                // Récupérer les lignes de transport
                $lines = [];
                foreach ($journey['sections'] as $section) {
                    if (isset($section['display_informations']['commercial_mode'])) {
                        $mode = $section['display_informations']['commercial_mode'];
                        if ($mode === "Train Transilien") {
                            $lines[] = "\t\t\t\t\t\t<img src=\"./images/icon_train_blanc.png\" alt=\"Train Transilien\" width=\"60\" />\n" . "\t\t\t\t\t\t<div class=\"ligne\" style=\"background-color:#" . $section['display_informations']['color'] . ";color:#fff; border:1px solid #" . $section['display_informations']['color'] . "\">" . $section['display_informations']['code'] . "</div>\n";
                        } elseif ($mode === "RER") {
                            $lines[] = "\t\t\t\t\t\t<img src=\"./images/icon_rer_blanc.png\" alt=\"RER\" width=\"60\" />\n" . "\t\t\t\t\t\t<div class=\"ligne\" style=\"background-color:#" . $section['display_informations']['color'] . ";color:#fff; border:1px solid #" . $section['display_informations']['color'] . "\">" . $section['display_informations']['code'] . "</div>\n";
                        }elseif ($mode === "Bus") {
                            $lines[] = "\t\t\t\t\t\t<img src=\"./images/bus_icon.png\" alt=\"Bus\" width=\"60\" />\n" . "\t\t\t\t\t\t<div class=\"ligne\" style=\"background-color:#" . $section['display_informations']['color'] . ";color:#fff; border:1px solid #" . $section['display_informations']['color'] . "\">" . $section['display_informations']['code'] . "</div>\n";
                        }elseif ($mode === "Métro") {
                            $lines[] = "\t\t\t\t\t\t<img src=\"./images/metro_icon.png\" alt=\"Métro\" width=\"60\" />\n" . "\t\t\t\t\t\t<div class=\"ligne\" style=\"background-color:#" . $section['display_informations']['color'] . ";color:#fff; border:1px solid #" . $section['display_informations']['color'] . "\">" . $section['display_informations']['code'] . "</div>\n";
                        }
                    }
                }
                $r .= "\t\t\t\t\t<li class=\"ligne-container\">\n" . implode("\t\t\t\t\t<span class=\"chevron\">></span>\n", $lines) . "\t\t\t\t\t</li>\n";

                //Récupère le nom des arrêts desservis à partir de l'API
                $stations = array();
                foreach ($journey['sections'] as $section) {
                    // Vérifie si la clé 'stop_date_times' existe dans la section actuelle
                    if (isset($section['stop_date_times'])) {
                        foreach ($section['stop_date_times'] as $stop) {
                            $stationName = isset($stop['stop_point']['name']) ? $stop['stop_point']['name'] : '';
                            if (!empty($stationName)) {
                                $stations[] = $stationName;
                            }
                        }
                    }
                }
                $r .= "\t\t\t\t</ul>\n";

                // Afficher les gares desservies si elles existent
                if (!empty($stations)) {
                    $r .= "\t\t\t\t<details>\n";
                    $r .= "\t\t\t\t\t<summary>Trajet Complet</summary>\n";
                    $r .= "\t\t\t\t\t" . '<div class="timeline">' . "\n";
                    foreach ($stations as $stop) {
                        $r .= "\t\t\t\t\t\t" .'<div class="checkpoint">' . "\n";
                        $r .= "\t\t\t\t\t\t\t" .'<div>' . "\n";
                        $r .= "\t\t\t\t\t\t\t\t" ."<span>$stop</span>" . "\n";
                        $r .= "\t\t\t\t\t\t\t" .'</div>' . "\n";
                        $r .= "\t\t\t\t\t\t" .'</div>' . "\n";
                    }
                    $r .= "\t\t\t\t\t" .'</div>' . "\n";
                    $r .= "\t\t\t\t" ."</details>" ."\n";
                }
                $r .= "\t\t\t\t<ul>\n";

                // Afficher les émissions de CO2 du trajet si disponibles
                if (isset($journey['co2_emission'])) {
                    $co2_emission = $journey['co2_emission']['value'];
                    $r .= "\t\t\t\t\t<li class=\"co2\">CO2 émis sur ce trajet: $co2_emission gEC</li>\n";
                } else {
                    $r .= "\t\t\t\t\t<li>Pas de données sur les émissions de CO2 pour ce trajet</li>\n";
                }

                $lastDepartureDateTime = date("Y-m-d H:i", strtotime($journey['departure_date_time']));
                $lastArrivalDateTime = date("Y-m-d H:i", strtotime($journey['arrival_date_time']));

                $r .= "\t\t\t\t</ul>\n";
                $r .= "\t\t\t</div>\n";

            }
        } else {
            // Si aucun trajet n'a été trouvé, afficher un message d'erreur
            $r .= "<p>Aucun trajet trouvé.</p>";
        }
    }
    return $r;
}

/**
 * Cette fonction permet d'obtenir les informations sur les itinéraires rapides entre deux gares.
 * @param string $gare_depart La gare de départ.
 * @param string $gare_arrive La gare d'arrivée.
 * @param int $count Le nombre d'itinéraires à récupérer.
 * @return string Les informations sur les itinéraires rapides.
 */
function getItineraireRapide(string $gare_depart, string $gare_arrive, int $count):string{
    // Clé d'API pour accéder à l'API SNCF
    $apiKey = "c7cae7cf-e419-4845-9684-fff7de1c3466";

    // URL de l'API pour obtenir les informations sur les trajets
    $url = "https://api.navitia.io/v1/coverage/fr-idf/journeys?from=$gare_depart&to=$gare_arrive&count=$count";

    // Options pour la requête HTTP
    $options = array(
        'http' => array(
            'header' => "Authorization: Basic " . base64_encode($apiKey) . "\r\n"
        )
    );

    // Créer le contexte de flux avec les options de requête
    $context = stream_context_create($options);
    // Envoyer la requête à l'API et récupérer les données
    $result = file_get_contents($url, false, $context);

    $r ='';
    // Vérifier si la requête a réussi
    if ($result === FALSE) {
        // Vérifier si la requête a réussi
        $r.= "<p>Erreur lors de la récupération des informations sur le trajet.</p>";
    } else {       
        // Convertir les données JSON en tableau associatif
        $data = json_decode($result, true);

        // Vérifier si des trajets ont été trouvés
        if (isset($data['journeys'])) {
            // Afficher la liste des trajets
            foreach ($data['journeys'] as $journey) {
                $r.="\t\t\t\t<div class=\"itineraire-info\">\n";
                $r.= "\t\t\t\t<ul>\n";
                // Convertir les dates et heures en format lisible
                $departureDateTime = date("H:i", strtotime($journey['departure_date_time']));
                $arrivalDateTime = date("H:i", strtotime($journey['arrival_date_time']));

                // Calculer la durée du trajet
                $durationHours = floor($journey['duration'] / 3600);
                $durationMinutes = floor(($journey['duration'] % 3600) / 60);

                $durationHoursFormated = sprintf("%02d", $durationHours);
                $durationMinutesFormated = sprintf("%02d", $durationMinutes);

                // Afficher les informations sur le trajet
                $r.= "\t\t\t\t\t<li class=\"time\">$departureDateTime - </li>\n";
                $r.= "\t\t\t\t\t<li class=\"time\">$arrivalDateTime</li>\n";
                $r.= "\t\t\t\t\t<li class=\"temps\">$durationHoursFormated:$durationMinutesFormated</li>\n";

                $line = array();
                foreach ($journey['sections'] as $section) {
                    if (isset($section['links']) && !empty($section['links'])) {
                        $line[] = isset($section['links'][1]['id']) ? $section['links'][1]['id'] : '';
                    }
                }

                $lines = [];
                foreach ($journey['sections'] as $section) {
                    if (isset($section['display_informations']['commercial_mode'])) {
                        $mode = $section['display_informations']['commercial_mode'];
                        if ($mode === "Train Transilien") {
                            $lines[] = "\t\t\t\t\t\t<img src=\"./images/icon_train_blanc.png\" alt=\"Train Transilien\" width=\"60\" />\n" . "\t\t\t\t\t\t<div class=\"ligne\" style=\"background-color:#" . $section['display_informations']['color'] . ";color:#fff; border:1px solid #" . $section['display_informations']['color'] . "\">" . $section['display_informations']['code'] . "</div>\n";
                        } elseif ($mode === "RER") {
                            $lines[] = "\t\t\t\t\t\t<img src=\"./images/icon_rer_blanc.png\" alt=\"RER\" width=\"60\" />\n" . "\t\t\t\t\t\t<div class=\"ligne\" style=\"background-color:#" . $section['display_informations']['color'] . ";color:#fff; border:1px solid #" . $section['display_informations']['color'] . "\">" . $section['display_informations']['code'] . "</div>\n";
                        }elseif ($mode === "Bus") {
                            $lines[] = "\t\t\t\t\t\t<img src=\"./images/bus_icon.png\" alt=\"Bus\" width=\"60\" />\n" . "\t\t\t\t\t\t<div class=\"ligne\" style=\"background-color:#" . $section['display_informations']['color'] . ";color:#fff; border:1px solid #" . $section['display_informations']['color'] . "\">" . $section['display_informations']['code'] . "</div>\n";
                        }elseif ($mode === "Métro") {
                            $lines[] = "\t\t\t\t\t\t<img src=\"./images/metro_icon.png\" alt=\"Métro\" width=\"60\" />\n" . "\t\t\t\t\t\t<div class=\"ligne\" style=\"background-color:#" . $section['display_informations']['color'] . ";color:#fff; border:1px solid #" . $section['display_informations']['color'] . "\">" . $section['display_informations']['code'] . "</div>\n";
                        }
                    }
                }
                $r .= "\t\t\t\t\t<li class=\"ligne-container\">\n" . implode("\t\t\t\t\t\t<span class=\"chevron\">></span>\n", $lines) . "\t\t\t\t\t</li>\n";


                //Récupère le nom des arrêts desservis à partir de l'API
                $stations = array();
                foreach($journey['sections'] as $section) {
                    // Vérifie si la clé 'stop_date_times' existe dans la section actuelle
                    if(isset($section['stop_date_times'])) {
                        foreach($section['stop_date_times'] as $stop) {
                            $stationName = isset($stop['stop_point']['name']) ? $stop['stop_point']['name'] : ''; 
                            if (!empty($stationName)) {
                                $stations[] = $stationName;
                            }
                        }
                    }
                }
                $r.= "\t\t\t\t</ul>\n";



                // Afficher les gares desservies si elles existent
                if (!empty($stations)) {
                    $r .= "\t\t\t\t<details>\n";
                    $r .= "\t\t\t\t\t<summary>Gares désservies</summary>\n";
                    $r .="\t\t\t\t\t" .'<div class="timeline">' . "\n";
                    foreach($stations as $stop){
                        $r .="\t\t\t\t\t\t" .'<div class="checkpoint">' . "\n";
                        $r .="\t\t\t\t\t\t\t" .'<div>' . "\n";
                        $r .="\t\t\t\t\t\t\t\t<span>$stop</span>\n";
                        $r .="\t\t\t\t\t\t\t" .'</div>' . "\n";
                        $r .="\t\t\t\t\t\t" .'</div>' . "\n";
                    }
                    $r .="\t\t\t\t\t" .'</div>' . "\n";
                    $r .="\t\t\t\t</details>\n";
                }
                $r.="\t\t\t\t<ul>\n";
                if (isset($journey['co2_emission'])) {
                    $co2_emission = $journey['co2_emission']['value'];
                    $r .= "\t\t\t\t\t<li class=\"co2\">CO2 émis sur ce trajet: $co2_emission gEC</li>\n";
                } else {
                    $r .= "\t\t\t\t\t<li>Pas de données sur les émissions de CO2 pour ce trajet</li>\n";
                }

                $lastDepartureDateTime = date("Y-m-d H:i", strtotime($journey['departure_date_time']));
                $lastArrivalDateTime = date("Y-m-d H:i", strtotime($journey['arrival_date_time']));

                $r.="\t\t\t\t</ul>\n";
                $r.= "\t\t\t</div>\n";

            }
        } else {
            // Si aucun trajet n'a été trouvé, afficher un message d'erreur
            $r.= "<p>Aucun trajet trouvé.</p>";
        }
    }
    return $r;
}

/**
 * Cette fonction permet d'enregistrer les titres des gares de départ et d'arrivée dans un fichier CSV avec le nombre de recherches.
 * @param string $gare_depart La gare de départ.
 * @param string $gare_arrive La gare d'arrivée.
 * @return void
 */
function saveStations(string $gare_depart, string $gare_arrive){
        $nomFichier = "recherche_gare.csv";
        
        $fichierExiste = file_exists($nomFichier);
        
        if($fichierExiste){
            $fichier = fopen($nomFichier, "r+");
            $ligne = fgetcsv($fichier);
            if (!($ligne[1] == date("j"))) {
                fclose($fichier);
                unlink($nomFichier);
                saveTitles($gare_depart, $gare_arrive);
                return false;
            }
        }
        else{
            $fichier = fopen($nomFichier, "x+");
        }
    
        $nouvellesLignes = array();
        $nouvellesLignes[] = array("date", date("j"));
        $gare1 = false;
        $gare2 = false;
    
        while (($ligne = fgetcsv($fichier)) !== false) {
            if ($ligne[0] == $gare_depart) {
                $ligne[1]++;
                $gare1 = true;
            }
            if ($ligne[0] == $gare_arrive) {
                $ligne[1]++;
                $gare2 = true;
            }
            $nouvellesLignes[] = $ligne;
        }
    
        if (!$gare1) {
            $nouvellesLignes[] = array($gare_depart, 1);
        }
        if (!$gare2) {
            $nouvellesLignes[] = array($gare_arrive, 1);
        }
    
        rewind($fichier);
        foreach ($nouvellesLignes as $ligne) {
            fputcsv($fichier, $ligne);
        }
    
        fclose($fichier);
} 

/**
 * Cette fonction permet d'senregistrer le titre d'une gare dans un fichier CSV avec le nombre de recherches.
 * @param string $gare Le nom de la gare.
 * @return void
 */
function saveStation(string $gare){
        $nomFichier = "recherche_gare.csv";
        
        $fichierExiste = file_exists($nomFichier);
        
        if($fichierExiste){
            $fichier = fopen($nomFichier, "r+");
            $ligne = fgetcsv($fichier);
            if (!($ligne[1] == date("j"))) {
                fclose($fichier);
                unlink($nomFichier);
                saveTitle($gare);
                return false;
            }
        }
        else{
            $fichier = fopen($nomFichier, "x+");
        }
    
        $nouvellesLignes = array();
        $nouvellesLignes[] = array("date", date("j"));
        $gareExiste = false;
    
        while (($ligne = fgetcsv($fichier)) !== false) {
            if ($ligne[0] == $gare) {
                $ligne[1]++;
                $gareExiste = true;
            }
            $nouvellesLignes[] = $ligne;
        }
    
        if (!$gareExiste) {
            $nouvellesLignes[] = array($gare, 1);
        }
    
        rewind($fichier);
        foreach ($nouvellesLignes as $ligne) {
            fputcsv($fichier, $ligne);
        }
    
        fclose($fichier);
}

    
/**
 * Cette fonction génère des statistiques à partir d'un fichier CSV contenant des données sur les gares recherchées.
 * @param string $filename Le nom du fichier CSV.
 * @param string $color La couleur de fond du graphique.
 * @param string $borderColor La couleur de bordure du graphique.
 * @return string Le code HTML pour afficher le graphique des statistiques ou un message d'erreur si le fichier n'existe pas.
 */
function statisticsFromCSV(string $filename, string $color, string $borderColor) {
        if (file_exists($filename)) {
            $file = fopen($filename, 'r');
        
            $headers = fgetcsv($file);
            
            $labels = array();
            $values = array();
            
            while (($row = fgetcsv($file)) !== FALSE) {
                $labels[] = htmlspecialchars($row[0]);
                
                $values[] = htmlspecialchars($row[1]);
            }
            
            fclose($file);

            $s="";
            $s .= '<div style="width: 100%; margin: 0 auto;">' . "\n";
            $s .= "\t\t\t\t\t". '<canvas id="myChart"></canvas>'. "\n";
            $s .= "\t\t\t\t". '</div>'. "\n";
            $s .= "\t\t\t\t". '<script>'. "\n";
            $s .= "\t\t\t\t\t".'var ctx = document.getElementById("myChart").getContext("2d");'. "\n";
            $s .= "\t\t\t\t\t". 'var myChart = new Chart(ctx, {'. "\n";
            $s .= "\t\t\t\t\t". 'type: "bar",'. "\n";
            $s .= "\t\t\t\t\t". 'data: {'. "\n";
            $s .= "\t\t\t\t\t". 'labels: ' . json_encode($labels) . ','. "\n";
            $s .= "\t\t\t\t\t". 'datasets: [{'. "\n";
            $s .= "\t\t\t\t\t". 'label: "Gare Recherché",'. "\n";
            $s .= "\t\t\t\t\t". 'data: ' . json_encode($values) . ','. "\n";
            $s .= "\t\t\t\t\t". 'backgroundColor: "'. $color .'",'. "\n";
            $s .= "\t\t\t\t\t". 'borderColor: "'. $borderColor .'",'. "\n";
            $s .= "\t\t\t\t\t". 'borderWidth: 1'. "\n";
            $s .= "\t\t\t\t\t". '}]'. "\n";
            $s .= "\t\t\t\t\t". '},'. "\n";
            $s .= "\t\t\t\t\t". 'options: {'. "\n";
            $s .= "\t\t\t\t\t". 'scales: {'. "\n";
            $s .= "\t\t\t\t\t". 'yAxes: [{'. "\n";
            $s .= "\t\t\t\t\t". 'ticks: {'. "\n";
            $s .= "\t\t\t\t\t". 'beginAtZero: true'. "\n";
            $s .= "\t\t\t\t\t". '}'. "\n";
            $s .= "\t\t\t\t\t". '}]'. "\n";
            $s .= "\t\t\t\t\t". '}'. "\n";
            $s .= "\t\t\t\t\t". '}'. "\n";
            $s .= "\t\t\t\t\t". '});'. "\n";
            $s .= "\t\t\t\t". '</script>'. "\n";
        } else {
            $s .= "<article>";
            $s .= "<p>Le fichier $filename n'existe pas.</p>";
            $s .= "</article>";
        }
        return $s;
}
    

?>