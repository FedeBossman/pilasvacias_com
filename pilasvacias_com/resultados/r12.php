<?
include("_results_head.php");
$link = mysqli_connect("mysql51-105.perso","pilasvacias","G7cpcUUkCkdk","pilasvacias") or die("Error " . mysqli_error($link));
mysqli_set_charset($link, "utf8");

echo "<strong>¿Te avergüenzas de alguna canción de tu lista de reproducción?</strong><br/>";

$rango_edades = array('12 -17', '18 - 25', '26 - 35', '36 - 45', '46 - 55', '+56');

for ($i = 0; $i <= 5; $i++) {
    $query =  "SELECT question12, COUNT( encuesta_musica.question12 ) AS SUMA
FROM encuesta_musica
WHERE encuesta_musica.age = ". $i ."
GROUP BY question12
";

$myArray = array();
if ($result = $link->query($query)) {
    $tempArray = array();
    while($row = $result->fetch_object()) {
        $tempArray = $row;
        array_push($myArray, $tempArray);
    }

    $find = array('"question12":"0"', '"question12":"1"', "{", "[", "]", "}", ",", '"', "_c");
    $replace = array("<u>Sí</u>", "<u>No</u>", "", " - ", "", "", "<br/> - ", " ", "");

    $results = str_replace($find, $replace, json_encode($myArray));

    echo "<strong> Edad: ". $rango_edades[$i] . " </strong><br/>";
    echo $results;
    echo "<hr/>";
}

$result->close();
}

$link->close();
?>