<?
include("_results_head.php");
$link = mysqli_connect("mysql51-105.perso","pilasvacias","G7cpcUUkCkdk","pilasvacias") or die("Error " . mysqli_error($link));
mysqli_set_charset($link, "utf8");

echo "<strong>¿Frecuentas lugares donde suena ese tipo de musica?</strong><br/>";

$rango_edades = array('12 -17', '18 - 25', '26 - 35', '36 - 45', '46 - 55', '+56');

for ($i = 0; $i <= 5; $i++) {
    $query =  "SELECT question4, COUNT( encuesta_musica.question4 ) AS SUMA
FROM encuesta_musica
WHERE encuesta_musica.age = ". $i ."
GROUP BY question4
";

$myArray = array();
if ($result = $link->query($query)) {
    $tempArray = array();
    while($row = $result->fetch_object()) {
        $tempArray = $row;
        array_push($myArray, $tempArray);
    }

    $find = array('"question4":"0"', '"question4":"1"', '"question4":"2"', "{", "[", "]", "}", ",", '"', "_c");
    $replace = array("<u>Siempre</u>", "<u>A veces</u>", "<u>No</u>","", " - ", "", "", "<br/> - ", " ", "");

    $results = str_replace($find, $replace, json_encode($myArray));

    echo "<strong> Edad: ". $rango_edades[$i] . " </strong><br/>";
    echo $results;
    echo "<hr/>";
}

$result->close();

}

$link->close();
?>