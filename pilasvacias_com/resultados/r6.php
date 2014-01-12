<?
include("_results_head.php");
$link = mysqli_connect("mysql51-105.perso","pilasvacias","G7cpcUUkCkdk","pilasvacias") or die("Error " . mysqli_error($link));
mysqli_set_charset($link, "utf8");

echo "<strong>¿Qué soporte usas?</strong><br/>";

$rango_edades = array('12 -17', '18 - 25', '26 - 35', '36 - 45', '46 - 55', '+56');

for ($i = 0; $i <= 5; $i++) {
    $query =  "SELECT 
    COUNT(CASE WHEN discman = 1 THEN 1 ELSE NULL END) AS discman_c, 
    COUNT(CASE WHEN ipod = 1 THEN 1 ELSE NULL END) AS ipod_c,
    COUNT(CASE WHEN movil = 1 THEN 1 ELSE NULL END) AS movil_c,
    COUNT(CASE WHEN mp3 = 1 THEN 1 ELSE NULL END) AS mp3_c,
    COUNT(CASE WHEN ordenador = 1 THEN 1 ELSE NULL END) AS ordenador_c,
    COUNT(CASE WHEN radio = 1 THEN 1 ELSE NULL END) AS radio_c,
    COUNT(CASE WHEN walkman = 1 THEN 1 ELSE NULL END) AS walkman_c,
    COUNT(CASE WHEN otros = 1 THEN 1 ELSE NULL END) AS otros_c    
FROM question6
WHERE question6.id
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