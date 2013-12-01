<?
include("_head.php");

session_start();

if(!isset($_SESSION['last_email_sent']) || $_SESSION['last_email_sent']==null || $_SESSION['last_email_sent'] < time()){

	if (isset($_POST["miencuesta"])){
		$flagError = false;

		$emailText = printResultsForEmail();

		if($flagError){
			printError();
		} else {
			printOk();
			sendEmail($emailText);
			set_session("last_email_sent",time()+60*5);
		}

	}else{
		printForm();
	}

} else {
	printRepeat();
}

include("_tail.php");

function printResultsForEmail() {
	$mensaje .= "Sexo: " . $_POST['gender'] . "\n";
	$mensaje .= "Edad: " . $_POST['age'] . "\n";

	$mensaje .= "----------------------------------------------" . "\n";

	$mensaje .= "Pregunta 1: " . $_POST['question1'] . "\n";

	$likes = "";
	for ($i = 0; $i < 22; $i++) {
		$q = "question2_" . $i;
		if (isset($_POST[$q])) {
			$likes .= $_POST[$q] . " // ";
		}
	}

	$mensaje .= "Pregunta 2: " . $likes . $_POST['question2_otros'] . "\n";

	$mensaje .= "Pregunta 3: " . $_POST['question3'] . " // " . $_POST['question3_b'] . "\n";

	$mensaje .= "Pregunta 4: " . $_POST['question4'] . "\n";
	$mensaje .= "Pregunta 5: " . $_POST['question5'] . "\n";

	$likes = "";
	for ($i = 0; $i < 8; $i++) {
		$q = "question6_" . $i;
		if (isset($_POST[$q])) {
			$likes .= $_POST[$q] . " // ";
		}
	}

	$mensaje .= "Pregunta 6: " . $likes . "\n";
	$mensaje .= "Pregunta 7: " . $_POST['question7'] . "\n";

	$mensaje .= "Pregunta 8: " . $_POST['question8'] . " //cuándo: " . $_POST['question8_b'] . " //cómo: " . $_POST['question8_c'] . " //dónde: " . $_POST['question8_d'] . "\n";
	$mensaje .= "Pregunta 9: " . $_POST['question9'] . " // " . $_POST['question9_b'] . "\n";
	$mensaje .= "Pregunta 10: " . $_POST['question10'] . " // cuál:" . $_POST['question10_b'] . " // cuándo:" . $_POST['question10_c'] . "\n";

	$mensaje .= "Pregunta 11: " . $_POST['question11'] . "\n";
	$mensaje .= "Pregunta 12: " . $_POST['question12'] . "\n";

	$mensaje .= "Fecha: " . date("j-n-Y H:i:s") . "\n";

	return $mensaje;
}

function set_session($attr, $val){

	$_SESSION[$attr] = $val;

}

function sendEmail($mensaje) {
	$para = 'muthingucm@hotmail.com';
	$copia    = 'pilasvacias@gmail.com';	
	$titulo  = 'Prueba encuesta';
	mail($para, $titulo, $mensaje);
	mail($copia, $titulo, $mensaje);
}

function printError() {
	?>
	<div class="main-container body">
		<div class ="cardy">
			<h1>ERROR<h1>
			</div>
		</div>
		<?
	}

	function printOk() {
		?>
		<div class="main-container body">
			<div class ="cardy">
				<h1>GRACIAS POR PARTICIPAR<h1>
				</div>
				<?
			}

			function printRepeat() {
				?>
				<div class="main-container body">
					<div class ="cardy">
						<h1>YA HAS PARTICIPADO<h1>
						</div>
						<?
					}

					function printForm(){
						?>

						<div class="main-container body">
							<div class ="cardy">
								<form name="cuestionario" id ="cuestionario" action="encuesta" method="post">
									<h1> <span style = "color:#17f0ff">ENCUESTA:</span> Relación entre sistema de comunicación mediante la música y sistema social.</h1>
									<hr/>
									<div class = "previous-info"> 
										<p>Sexo:</p>
										<div class = "check-holder">						
											<div>			
												<input type="radio" name="gender" id="male" value="Hombre">
												<label for="male"><span></span>Hombre</label><br/>
											</div>
											<div>
												<input type="radio" name="gender" id="female" value="Mujer"> 
												<label for="female"><span></span>Mujer</label><br/>
											</div>
										</div>

									</div>
									<div class = "previous-info"> 
										<p>Edad:</p>
										<div class = "check-holder">									
											<div>
												<input type="radio" id="age0" name="age" value="12 -17"> 
												<label for="age0"><span></span>12 -17</label><br/>
											</div>
											<div>
												<input type="radio" id ="age1" name="age" value="18 - 25"> 
												<label for="age1"><span></span>18 - 25</label><br/>
											</div>
											<div>
												<input type="radio" id ="age2" name="age" value="26 - 35" > 
												<label for="age2"><span></span>26 - 35</label><br/>
											</div>
											<div>
												<input type="radio" id ="age3" name="age" value="36 - 45"> 
												<label for="age3"><span></span>36 - 45</label><br/>
											</div>
											<div>
												<input type="radio" id ="age4" name="age" value="46 - 55"> 
												<label for="age4"><span></span>46 - 55</label><br/>
											</div>	
											<div>
												<input type="radio" id ="age5" name="age" value="+56"> 
												<label for="age5"><span></span>+56</label><br/>
											</div>
										</div>
									</div>

									<h3>CUESTIONARIO</h3>
									<hr>

									<div class="question-container">
										<div class = "question"><div class ="question-number">1.</div> ¿Qué estás escuchando/ qué es lo último que escuchaste?</div>
										<input type="text" name="question1" value=""><br/>
									</div>

									<div class="question-container">
										<div class = "question"><div class ="question-number">2.</div> ¿Qué tipo de música sueles escuchar?</div><br/>
										<div class = "check-holder">
											<div>
												<input type="checkbox" id ="q2-1" name="question2_0" value="Blues"> 
												<label for="q2-1"><span></span>Blues</label>
											</div>
											<div>
												<input type="checkbox" id ="q2-2" name="question2_1" value="Clásica" > 
												<label for="q2-2"><span></span>Clásica</label>
											</div>
											<div>
												<input type="checkbox" id ="q2-3" name="question2_2" value="Dance">
												<label for="q2-3"><span></span>Dance</label>
											</div>
											<div>
												<input type="checkbox" id ="q2-4" name="question2_3" value="Dubstep" > 
												<label for="q2-4"><span></span>Dubstep</label>
											</div>
											<div>
												<input type="checkbox" id ="q2-5" name="question2_4" value="Electrónica">
												<label for="q2-5"><span></span>Electrónica</label>
											</div>
											<div>
												<input type="checkbox" id ="q2-6" name="question2_5" value="Flamenco" >
												<label for="q2-6"><span></span>Flamenco</label>
											</div>
											<div>
												<input type="checkbox" id ="q2-7" name="question2_6" value="Funk">
												<label for="q2-7"><span></span>Funk</label>
											</div>
											<div>
												<input type="checkbox" id ="q2-8" name="question2_7" value="Hip-Hop" >
												<label for="q2-8"><span></span>Hip-Hop</label>
											</div>
											<div>
												<input type="checkbox" id ="q2-9" name="question2_8" value="Indie"> 
												<label for="q2-9"><span></span>Indie</label>
											</div>
											<div>
												<input type="checkbox" id ="q2-10" name="question2_9" value="Jazz" > 
												<label for="q2-10"><span></span>Jazz</label>
											</div>
											<div>
												<input type="checkbox" id ="q2-11" name="question2_10" value="Latina"> 
												<label for="q2-11"><span></span>Latina</label>
											</div>
											<div>
												<input type="checkbox" id ="q2-12" name="question2_11" value="Metal" > 
												<label for="q2-12"><span></span>Metal</label>
											</div>
											<div>
												<input type="checkbox" id ="q2-13" name="question2_12" value="Pop"> 
												<label for="q2-13"><span></span>Pop</label>
											</div>
											<div>
												<input type="checkbox" id ="q2-14" name="question2_13" value="Punk" > 
												<label for="q2-14"><span></span>Punk</label>
											</div>
											<div>
												<input type="checkbox" id ="q2-15" name="question2_14" value="R&B"> 
												<label for="q2-15"><span></span>R&B</label>
											</div>
											<div>
												<input type="checkbox" id ="q2-16" name="question2_15" value="Reggae" > 
												<label for="q2-16"><span></span>Reggae</label>
											</div>
											<div>
												<input type="checkbox" id ="q2-17" name="question2_16" value="Reggaetón"> 
												<label for="q2-17"><span></span>Latina</label>
											</div>
											<div>
												<input type="checkbox" id ="q2-18" name="question2_17" value="Rock" > 
												<label for="q2-18"><span></span>Rock</label>
											</div>
											<div>
												<input type="checkbox" id ="q2-19" name="question2_18" value="Rumba"> 
												<label for="q2-19"><span></span>Rumba</label>
											</div>
											<div>
												<input type="checkbox" id ="q2-20" name="question2_19" value="Soul" > 
												<label for="q2-20"><span></span>Soul</label>
											</div>
											<div>
												<input type="checkbox" id ="q2-21" name="question2_20" value="Teatro musical"> 
												<label for="q2-21"><span></span>Teatro musical</label>
											</div>
											<div>
												<input type="checkbox" id ="q2-22" name="question2_21" value="Techno" > 
												<label for="q2-22"><span></span>Techno</label>
											</div>
											<br/>
										</div>
										<div class = "question">Otros:</div><input type="text" name="question2_otros" value=""><br/>
									</div>
									
									<div class="question-container">
										<div class = "question"><div class ="question-number">3.</div> ¿Identificas tu forma de vestir con la música que escuchas?</div>
										<div class = "check-holder">
											<div>
												<input type="radio" id="q3-y" name="question3" value="Sí"> 
												<label for="q3-y"><span></span>Sí</label>	
											</div>
											<div>
												<input type="radio" id="q3-n" name="question3" value="No" > 
												<label for="q3-n"><span></span>No</label>	
											</div>
											<div>
												<input type="radio" id="q3-m" name="question3" value="A veces"> 
												<label for="q3-m"><span></span>A veces</label>	
											</div>
										</div>
										<div class = "question">¿Por qué?</div><input type="text" name="question3_b" value=""><br/>
									</div>
									
									<div class="question-container">
										<div class = "question"><div class ="question-number">4.</div> ¿Escuchas la misma música cuando sales por la noche?</div>
										<div class = "check-holder">
											<div>
												<input type="radio" id="q4-y" name="question4" value="Sí" > 
												<label for="q4-y"><span></span>Sí</label>	
											</div>
											<div>			
												<input type="radio" id="q4-n" name="question4" value="No" > 
												<label for="q4-n"><span></span>No</label>	
											</div>
											<div>
												<input type="radio" id="q4-m" name="question4" value="A veces"> 
												<label for="q4-m"><span></span>A veces</label>	
											</div>
										</div>
									</div>
									
									<div class="question-container">
										<div class = "question"><div class ="question-number">5.</div> ¿Cuántas horas de música escuchas al día?</div>
										<input type="number" name="question5" min="0" max="24"/> <br/>
									</div>
									
									<div class="question-container">
										<div class = "question"><div class ="question-number">6.</div> ¿Qué soporte usas?</div>

										<div class = "check-holder">
											<div>
												<input type="checkbox" id ="q6-1" name="question6_0" value="Discman"> 
												<label for="q6-1"><span></span>Discman</label>
											</div>
											<div>
												<input type="checkbox" id ="q6-2" name="question6_1" value="iPod" > 
												<label for="q6-2"><span></span>iPod</label>
											</div>
											<div>
												<input type="checkbox" id ="q6-3" name="question6_2" value="Móvil">
												<label for="q6-3"><span></span>Móvil</label>
											</div>
											<div>
												<input type="checkbox" id ="q6-4" name="question6_3" value="Mp3" > 
												<label for="q6-4"><span></span>Mp3, Mp4, Mp5</label>
											</div>
											<div>
												<input type="checkbox" id ="q6-5" name="question6_4" value="Ornedanor">
												<label for="q6-5"><span></span>Ornedanor</label>
											</div>
											<div>
												<input type="checkbox" id ="q6-6" name="question6_5" value="Radio" >
												<label for="q6-6"><span></span>Radio</label>
											</div>
											<div>
												<input type="checkbox" id ="q6-7" name="question6_6" value="Walkman">
												<label for="q6-7"><span></span>Walkman</label>
											</div>
											<div>
												<input type="checkbox" id ="q6-8" name="question6_7" value="Otros">
												<label for="q6-8"><span></span>Otros</label>
											</div>
										</div>
									</div>

									<div class="question-container">
										<div class = "question"><div class ="question-number">7.</div> ¿Cómo descubres nueva música?</div>
										<input type="text" name="question7" value=""><br/>
									</div>

									<div class="question-container">
										<div class = "question"><div class ="question-number">8.</div> Último disco que has adquirido: </div>
										<input type="text" name="question8" value=""><br/>
										<div class = "question">¿Cuándo?</div>
										<input type="text" name="question8_b" value=""><br/>
										<div class = "check-holder">
											<div>
												<input type="radio" id="q8-comprado" name="question8_c" value="Comprado" > 
												<label for="q8-comprado"><span></span>Comprado</label>	
											</div>
											<div>			
												<input type="radio" id="q8-descargado" name="question8_c" value="Descargado" > 
												<label for="q8-descargado"><span></span>Descargado</label>	
											</div>
										</div>
										<div class = "check-holder">
											<div>
												<input type="radio" id="q8-tienda" name="question8_d" value="Tienda" > 
												<label for="q8-tienda"><span></span>Tienda</label>	
											</div>
											<div>			
												<input type="radio" id="q8-internet" name="question8_d" value="Internet" > 
												<label for="q8-internet"><span></span>Internet</label>	
											</div>
										</div>
									</div>

									<div class="question-container">
										<div class = "question"><div class ="question-number">9.</div> Último concierto al que has asistido: </div>
										<input type="text" name="question9" value=""><br/>
										<div class = "question">¿Cuándo?</div>
										<input type="text" name="question9_b" value=""><br/>
									</div>

									<div class="question-container">
										<div class = "question"><div class ="question-number">10.</div> ¿Has ido a algún musical? </div>
										<div class = "check-holder">
											<div>
												<input type="radio" id="q10-y" name="question10" value="Sí"> 
												<label for="q10-y"><span></span>Sí</label>	
											</div>
											<div>
												<input type="radio" id="q10-n" name="question10" value="No" > 
												<label for="q10-n"><span></span>No</label>	
											</div>
										</div>
										<div class = "question">¿Cuál?</div>
										<input type="text" name="question10_b" value=""><br/>
										<div class = "question">¿Cuándo?</div>
										<input type="text" name="question10_c" value=""><br/>
									</div>

									<div class="question-container">
										<div class = "question"><div class ="question-number">11.</div> ¿Tus amistades tienen tus mismos gustos musicales? </div>
										<div class = "check-holder">
											<div>
												<input type="radio" id="q11-y" name="question11" value="Sí"> 
												<label for="q11-y"><span></span>Sí</label>	
											</div>
											<div>
												<input type="radio" id="q11-m" name="question11" value="Mixto"> 
												<label for="q11-m"><span></span>Mixto</label>	
											</div>
											<div>
												<input type="radio" id="q11-n" name="question11" value="No" > 
												<label for="q11-n"><span></span>No</label>	
											</div>
										</div>
									</div>

									<div class="question-container">
										<div class = "question"><div class ="question-number">12.</div> ¿Te avergüenzas de alguna canción de tu lista de reproducción? </div>
										<div class = "check-holder">
											<div>
												<input type="radio" id="q12-y" name="question12" value="Sí"> 
												<label for="q12-y"><span></span>Sí</label>	
											</div>
											<div>
												<input type="radio" id="q12-n" name="question12" value="No" > 
												<label for="q12-n"><span></span>No</label>	
											</div>
										</div>
									</div>

									<input type="hidden" name="miencuesta" value="true">
									<input type = "submit" value="Enviar!">
								</form>
							</div>
							<!-- </div> -->

							<script>

							function getCheckedValue(radioObj) {
								if(!radioObj)
									return "";
								var radioLength = radioObj.length;
								if(radioLength == undefined)
									if(radioObj.checked)
										return radioObj.value;
									else
										return "";
									for(var i = 0; i < radioLength; i++) {
										if(radioObj[i].checked) {
											return radioObj[i].value;
										}
									}
									return "";
								}

								function setCheckedValue(radioObj, newValue) {
									if(!radioObj)
										return;
									var radioLength = radioObj.length;
									if(radioLength == undefined) {
										radioObj.checked = (radioObj.value == newValue.toString());
										return;
									}
									for(var i = 0; i < radioLength; i++) {
										radioObj[i].checked = false;
										radioObj[i].disabled = false;
										if(radioObj[i].value == newValue.toString()) {
											radioObj[i].checked = true;
										}
									}
								}

								function disableRestValues(radioObj, newValue) {
									if(!radioObj)
										return;
									var radioLength = radioObj.length;
									if(radioLength == undefined) {
										radioObj.checked = (radioObj.value == newValue.toString());
										return;
									}
									for(var i = 0; i < radioLength; i++) {
										radioObj[i].checked = false;
										if(radioObj[i].value == newValue.toString()) {
											radioObj[i].checked = true;
										} else {
											radioObj[i].disabled = true;
										}
									}
								}

								var sz = document.forms['cuestionario'].elements['question10'];

								for (var i=0, len=sz.length; i<len; i++) {
									sz[i].onclick = function() {
										if (this.value == "Sí") {
											document.forms["cuestionario"]["question10_b"].disabled = false;
											document.forms["cuestionario"]["question10_c"].disabled = false;
										} else if (this.value == "No") {
											document.forms["cuestionario"]["question10_b"].disabled = true;
											document.forms["cuestionario"]["question10_c"].disabled = true;
										}
									};
								}

								sz = document.forms['cuestionario'].elements['question8_c'];

								for (var i=0, len=sz.length; i<len; i++) {
									sz[i].onclick = function() {
										if (this.value == "Comprado") {	
											setCheckedValue(document.forms['cuestionario'].elements['question8_d'],"0");
										} else if (this.value == "Descargado") {
											disableRestValues(document.forms['cuestionario'].elements['question8_d'],"Internet");
										}
									};
								}


								document.getElementById('cuestionario').onsubmit = function() {
									var haveToCheck = new Array();
									haveToCheck[0] = "gender";
									haveToCheck[1] = "age";

									var totalCheck = true;					
									var checked = false;

									var radioButton = document.forms['cuestionario'].elements['gender'];

									for (var i=0, len=radioButton.length; i<len; i++) {
										if (radioButton[i].checked) {
											checked = true;
											break;
										}
									}

									if(!checked) {
										alert('Por favor indica tu sexo');
										totalCheck = false;
										return false;
									}

									checked = false;

									radioButton = document.forms['cuestionario'].elements['age'];

									for (var i=0, len=radioButton.length; i<len; i++) {
										if (radioButton[i].checked) {
											checked = true;
											break;
										}
									}

									if(!checked) {
										alert('Por favor indica tu edad');
										totalCheck = false;
										return false;
									}

									checked = false;

									radioButton = document.forms['cuestionario'].elements['question12'];

									for (var i=0, len=radioButton.length; i<len; i++) {
										if (radioButton[i].checked) {
											checked = true;
											break;
										}
									}

									if(!checked) {
										alert('Contesta a la pregunta 12');
										totalCheck = false;
										return false;
									}

									return true;
								}

								$(document).ready(function() {
					// var elements = document.getElementsByTagName("input");
					// for (var i = 0; i < elements.length; i++) {
					// 	elements[i].oninvalid = function(e) {
					// 		e.target.setCustomValidity("");
					// 		if (!e.target.validity.valid) {
					// 			e.target.setCustomValidity("This field cannot be left blank");
					// 		}
					// 	};
					// 	elements[i].oninput = function(e) {
					// 		e.target.setCustomValidity("");
					// 	};
					// }
				})

								</script>


								<?
							}

							?>