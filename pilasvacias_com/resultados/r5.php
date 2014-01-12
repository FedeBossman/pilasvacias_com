<?
include("_results_head.php");
$link = mysqli_connect("mysql51-105.perso","pilasvacias","G7cpcUUkCkdk","pilasvacias") or die("Error " . mysqli_error($link));
mysqli_set_charset($link, "utf8");

echo "<strong>¿Cuántas horas de música escuchas al día?</strong><br/>";

$rango_edades = array('12 -17', '18 - 25', '26 - 35', '36 - 45', '46 - 55', '+56');

for ($i = 0; $i <= 5; $i++) {
    $query =  'SELECT 
    COUNT(CASE WHEN question5 = 0 THEN 1 ELSE NULL END) AS "Nada", 
    COUNT(CASE WHEN question5 >0 AND question5 <= 1.5 THEN 1 ELSE NULL END) AS "1 hora", 
    COUNT(CASE WHEN question5 >= 1.5 AND question5 <= 3.5 THEN 1 ELSE NULL END) AS "Entre 1 y 3",
    COUNT(CASE WHEN question5 >= 3.5 AND question5 <= 6.5 THEN 1 ELSE NULL END) AS "Entre 4 y 6",
    COUNT(CASE WHEN question5 >= 6.5 THEN 1 ELSE NULL END) AS "Mas de 7"
FROM encuesta_musica
WHERE encuesta_musica.age = '. $i;

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