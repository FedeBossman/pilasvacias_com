<?
include("_results_head.php");
$link = mysqli_connect("mysql51-105.perso","pilasvacias","G7cpcUUkCkdk","pilasvacias") or die("Error " . mysqli_error($link));
mysqli_set_charset($link, "utf8");

echo "<strong>¿Tus amistades tienen tus mismos gustos musicales?</strong><br/>";

$rango_edades = array('12 -17', '18 - 25', '26 - 35', '36 - 45', '46 - 55', '+56');

for ($i = 0; $i <= 5; $i++) {
    $query =  "SELECT question11, COUNT( encuesta_musica.question11 ) AS SUMA
FROM encuesta_musica
WHERE encuesta_musica.age = ". $i ."
GROUP BY question11
";

$myArray = array();
if ($result = $link->query($query)) {
    $tempArray = array();
    while($row = $result->fetch_object()) {
        $tempArray = $row;
        array_push($myArray, $tempArray);
    }

    $find = array('"question11":"0"', '"question11":"1"', '"question11":"2"', "{", "[", "]", "}", ",", '"', "_c");
    $replace = array("<u>Todos</u>", "<u>Casi todos</u>", "<u>Ninguno</u>","", " - ", "", "", "<br/> - ", " ", "");

    $results = str_replace($find, $replace, json_encode($myArray));

    echo "<strong> Edad: ". $rango_edades[$i] . " </strong><br/>";
    echo $results;
    echo "<hr/>";
}

$result->close();

}

$link->close();
?>