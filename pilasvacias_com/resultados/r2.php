<?
include("_results_head.php");
$link = mysqli_connect("mysql51-105.perso","pilasvacias","G7cpcUUkCkdk","pilasvacias") or die("Error " . mysqli_error($link));
mysqli_set_charset($link, "utf8");

echo "<strong>¿Qué tipo de música sueles escuchar?</strong><br/>";

$rango_edades = array('12 -17', '18 - 25', '26 - 35', '36 - 45', '46 - 55', '+56');

for ($i = 0; $i <= 5; $i++) {
    $query =  "SELECT 
    COUNT(CASE WHEN blues = 1 THEN 1 ELSE NULL END) AS blues_c, 
    COUNT(CASE WHEN clasica = 1 THEN 1 ELSE NULL END) AS clasica_c,
    COUNT(CASE WHEN dance = 1 THEN 1 ELSE NULL END) AS dance_c,
    COUNT(CASE WHEN dubstep = 1 THEN 1 ELSE NULL END) AS dubstep_c,
    COUNT(CASE WHEN electronica = 1 THEN 1 ELSE NULL END) AS electronica_c,
    COUNT(CASE WHEN flamenco = 1 THEN 1 ELSE NULL END) AS flamenco_c,
    COUNT(CASE WHEN funk = 1 THEN 1 ELSE NULL END) AS funk_c,
    COUNT(CASE WHEN hip_hop = 1 THEN 1 ELSE NULL END) AS hip_hop_c,
    COUNT(CASE WHEN indie = 1 THEN 1 ELSE NULL END) AS indie_c,
    COUNT(CASE WHEN jazz = 1 THEN 1 ELSE NULL END) AS jazz_c,
    COUNT(CASE WHEN latina = 1 THEN 1 ELSE NULL END) AS latina_c,
    COUNT(CASE WHEN metal = 1 THEN 1 ELSE NULL END) AS metal_c,
    COUNT(CASE WHEN musicales = 1 THEN 1 ELSE NULL END) AS musicales_c,
    COUNT(CASE WHEN pop = 1 THEN 1 ELSE NULL END) AS pop_c,
    COUNT(CASE WHEN punk = 1 THEN 1 ELSE NULL END) AS punk_c,
    COUNT(CASE WHEN rnb = 1 THEN 1 ELSE NULL END) AS rnb_c,
    COUNT(CASE WHEN reggae = 1 THEN 1 ELSE NULL END) AS reggae_c,
    COUNT(CASE WHEN reggaeton = 1 THEN 1 ELSE NULL END) AS reggaeton_c,
    COUNT(CASE WHEN rock = 1 THEN 1 ELSE NULL END) AS rock_c,
    COUNT(CASE WHEN rumba = 1 THEN 1 ELSE NULL END) AS rumba_c,
    COUNT(CASE WHEN soul = 1 THEN 1 ELSE NULL END) AS soul_c,
    COUNT(CASE WHEN techno = 1 THEN 1 ELSE NULL END) AS techno_c
FROM question2
WHERE question2.id
IN (
SELECT encuesta_musica.id
FROM encuesta_musica
WHERE encuesta_musica.age = ". $i ."
)";

$myArray = array();
if ($result = $link->query($query)) {
    $tempArray = array();
    while($row = $result->fetch_object()) {
        $tempArray = $row;
        array_push($myArray, $tempArray);
    }

    $find = array("{", "[", "]", "}", ",", '"', "_c");
    $replace = array("", " - ", "", "", "<br/> - ", " ", "");

    $results = str_replace($find, $replace, json_encode($myArray));

    echo "<strong> Edad: ". $rango_edades[$i] . " </strong><br/>";

    echo $results;
    echo "<hr/>";
}

$result->close();

}

$link->close();
?>


