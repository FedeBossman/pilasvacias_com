<?
include("_results_head.php");
$link = mysqli_connect("mysql51-105.perso","pilasvacias","G7cpcUUkCkdk","pilasvacias") or die("Error " . mysqli_error($link));
mysqli_set_charset($link, "utf8");

echo "<strong>¿Cómo descubres nueva música?</strong><br/>";

$query =  "SELECT question7
FROM encuesta_musica
";

$myArray = array();
if ($result = $link->query($query)) {
    $tempArray = array();
    while($row = $result->fetch_object()) {
        $tempArray = $row;
        array_push($myArray, $tempArray);
    }

    $find = array('"question7":',"{", "[", "]", "}", ",", '"');
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