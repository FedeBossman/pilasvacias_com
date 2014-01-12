<?
include("_results_head.php");
$link = mysqli_connect("mysql51-105.perso","pilasvacias","G7cpcUUkCkdk","pilasvacias") or die("Error " . mysqli_error($link));
mysqli_set_charset($link, "utf8");

echo "<strong>¿Identificas tu forma de vestir con la música que escuchas?</strong><br/>";

$rango_edades = array('12 -17', '18 - 25', '26 - 35', '36 - 45', '46 - 55', '+56');

for ($i = 0; $i <= 5; $i++) {
    $query =  "SELECT question3, COUNT( encuesta_musica.question3 ) AS SUMA
FROM encuesta_musica
WHERE encuesta_musica.age = ". $i ."
GROUP BY question3
";

$myArray = array();
if ($result = $link->query($query)) {
    $tempArray = array();
    while($row = $result->fetch_object()) {
        $tempArray = $row;
        array_push($myArray, $tempArray);
    }

    $find = array('"question3":"0"', '"question3":"1"', '"question3":"2"', "{", "[", "]", "}", ",", '"', "_c");
    $replace = array("<u>Bastante</u>", "<u>Poco</u>", "<u>Nada</u>","", " - ", "", "", "<br/> - ", " ", "");

    $results = str_replace($find, $replace, json_encode($myArray));

    echo "<strong> Edad: ". $rango_edades[$i] . " </strong><br/>";

    echo $results;
    echo "<hr/>";
}

$result->close();

}

echo "<hr/>";
echo "<strong>¿Por qué?</strong><br/>";

$query =  "SELECT question3_b
FROM encuesta_musica
";

$myArray = array();
if ($result = $link->query($query)) {
    $tempArray = array();
    while($row = $result->fetch_object()) {
        $tempArray = $row;
        array_push($myArray, $tempArray);
    }

    $find = array('"question3_b":',"{", "[", "]", "}", ",", '"');
    $replace = array("" ,"", " - ", "", "", "<br/> - ", " ");
    array_push($find, '\u00c3\u00a1', '\u00c3\u00a9', '\u00e9','\u00c3\u00ad','\u00c3\u00af', '\u00f3', '\u00c3\u00b3','\u00c3\u00ba', '\u00fa');
    array_push($replace, 'á', 'é', 'é','í','ï','ó', 'ó','ú', 'ú');

    $results = str_replace($find, $replace, json_encode($myArray));

    echo $results;
    echo "<hr/>";
}

$result->close();

$link->close();
?>