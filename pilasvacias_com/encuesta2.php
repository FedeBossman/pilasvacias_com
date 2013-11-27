<?
include("_head.php");

session_start();

if(!isset($_SESSION['last_email_sent']) || $_SESSION['last_email_sent']==null || $_SESSION['last_email_sent'] < time()){

	if (isset($_POST["miencuesta"])){
		$flagError = false;

		$mensaje .= "Sexo: " . $_POST['gender'] . "\n";
		$mensaje .= "Edad: " . $_POST['age'] . "\n";

		$mensaje .= "----------------------------------------------" . "\n";

		$mensaje .= "Pregunta 1: " . $_POST['question1'] . "\n";
		
		$mensaje .= "Pregunta 3: " . $_POST['question3'] . "\n";
		$mensaje .= "Pregunta 4: " . $_POST['question4'] . "\n";
		$mensaje .= "Pregunta 5: " . $_POST['question5'] . "\n";
		$mensaje .= "Pregunta 6: " . $_POST['question6'] . "\n";
		$mensaje .= "Pregunta 7: " . $_POST['question7'] . "\n";

		printOk();


		if($flagError){
			printError();
		} else {
			sendEmail($mensaje);
			set_session("last_email_sent",time()+10);
		}

	}else{
		printForm();
	}

} else {
	printOk();
}

function set_session($attr, $val){

	$_SESSION[$attr] = $val;

}

// include("_tail.php");

function sendEmail($mensaje) {
	$para    = 'pilasvacias@gmail.com';
	$titulo  = 'Prueba encuesta';

	mail($para, $titulo, $mensaje);
		mail("laurasanchezsevilla@gmail.com", "Encuesta para la boba :P", $mensaje);
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
	</div>
	<?
}


function printForm(){
?>

	<div class="main-container body">
		<div class ="cardy">
		<form name="cuestionario" action="encuesta2" method="post">
			<h1> ENCUESTA: Relación entre sistema de comunicación mediante la música y sistema social.</h1>
			<hr/>
			<div class = "previous-info"> 
				<p>Sexo:</p>
				<div class = "check-holder">						
					<div>			
						<input type="radio" name="gender" id="male" value="Hombre">
						<label for="male">Hombre</label><br/>
					</div>
					<div>
						<input type="radio" name="gender" id="female" value="Mujer"> 
						<label for="female">Mujer</label><br/>
					</div>
				</div>
				
			</div>
			<div class = "previous-info"> 
				<p>Edad:</p>
				<div class = "check-holder">									
					<div>
						<input type="radio" id="age0" name="age" value="12 -17"> 
						<label for="age0">12 -17</label><br/>
					</div>
					<div>
						<input type="radio" id ="age1" name="age" value="18 - 25"> 
						<label for="age1">18 - 25</label><br/>
					</div>
					<div>
						<input type="radio" id ="age2" name="age" value="26 - 35" > 
						<label for="age2">26 - 35</label><br/>
					</div>
					<div>
						<input type="radio" id ="age3" name="age" value="36 - 45"> 
						<label for="age3">36 - 45</label><br/>
					</div>
					<div>
						<input type="radio" id ="age4" name="age" value="46 - 55"> 
						<label for="age4">46 - 55</label><br/>
					</div>	
					<div>
						<input type="radio" id ="age5" name="age" value="+56"> 
						<label for="age5">+56</label><br/>
					</div>
				</div>
			</div>

			<h3>CUESTIONARIO</h3>
			<hr>
			
				<div class = "question">1. ¿Qué estás/ sueles escuchar?</div>
				<input type="text" name="question1" value=""><br/>

				<div class = "question">2. ¿Qué tipo de música sueles escuchar?</div><br/>
				<div class = "check-holder">
					<div>
						<input type="checkbox" id ="q2-1" name="question2" value="classial"> 
						<label for="q2-1">Clásica</label>
					</div>
					<div>
						<input type="checkbox" id ="q2-2" name="question2" value="dubstep" > 
						<label for="q2-2">Dubstep</label>
					</div>
					<div>
						<input type="checkbox" id ="q2-3" name="question2" value="Hombre">
						<label for="q2-3">Electrónica</label>
					</div>
					<div>
						<input type="checkbox" id ="q2-4" name="question2" value="Mujer" > 
						<label for="q2-4">Flamenco</label>
					</div>
					<div>
						<input type="checkbox" id ="q2-5" name="question2" value="Hombre">
						<label for="q2-5">Hip-hop</label>
					</div>
					<div>
						<input type="checkbox" id ="q2-6" name="question2" value="Mujer" >
						<label for="q2-6">Indie</label>
					</div>
					<div>
						<input type="checkbox" id ="q2-7" name="question2" value="Hombre">
						<label for="q2-7">Latino</label>
					</div>
					<div>
						<input type="checkbox" id ="q2-8" name="question2" value="Mujer" >
						<label for="q2-8">Metal</label>
					</div>
					<div>
						<input type="checkbox" id ="q2-9" name="question2" value="Hombre"> 
						<label for="q2-9">Musical</label>
					</div>
					<div>
						<input type="checkbox" id ="q2-10" name="question2" value="Mujer" > 
						<label for="q2-10">Pop</label>
					</div>
					<div>
						<input type="checkbox" id ="q2-11" name="question2" value="Hombre"> 
						<label for="q2-11">Punk</label>
					</div>
					<div>
						<input type="checkbox" id ="q2-12" name="question2" value="Mujer" > 
						<label for="q2-12">Rap</label>
					</div>
					<div>
						<input type="checkbox" id ="q2-13" name="question2" value="Hombre"> 
						<label for="q2-13">Reggae</label>
					</div>
					<div>
						<input type="checkbox" id ="q2-14" name="question2" value="Mujer" > 
						<label for="q2-14">Reggaetón</label>
					</div>
					<div>
						<input type="checkbox" id ="q2-15" name="question2" value="Hombre"> 
						<label for="q2-15">Rock</label>
					</div>
					<div>
						<input type="checkbox" id ="q2-16" name="question2" value="Mujer" > 
						<label for="q2-16">Techno</label>
					</div>
					<br/>
				</div>
				Otros: <input type="text" name="option17" value=""><br/>

				<div class = "question">3. ¿Identificas tu forma de vestir con la música que escuchas?</div>
				<div class = "check-holder">
					<div>
						<input type="radio" id="q3-y" name="question3" value="Sí"> 
						<label for="q3-y">Sí</label>	
					</div>
					<div>
						<input type="radio" id="q3-n" name="question3" value="No" > 
						<label for="q3-n">No</label>	
					</div>
				</div>



				<div class = "question">4. ¿Escuchas la misma música cuando sales por la noche?</div>
				<div class = "check-holder">
					<div>
						<input type="radio" id="q4-y" name="question4" value="Sí" > 
						<label for="q4-y">Sí</label>	
					</div>
					<div>			
						<input type="radio" id="q4-n" name="question4" value="No" > 
						<label for="q4-n">No</label>	
					</div>
				</div>

				<div class = "question">5. ¿Cuántas horas de música escuchas al día?</div>
				<input type="number" name="question5" min="0" max="24"/> <br/>

				<div class = "question">6. ¿Qué soporte usas?</div>
				<select name="question6">
					<option value="" style="display:none;"></option>
					<option value="walkman">walkman</option>
					<option value="diskman">diskman</option>
					<option value="mp3">mp3</option>
					<option value="ipod">ipod</option>
					<option value="móvil">móvil</option>
					<option value="otro">otro</option>
				</select><br/>

				<div class = "question">7. ¿Cómo descubres nueva música?</div>
				<input type="text" name="question7" value=""><br/>

				<input type="hidden" name="miencuesta" value="true">
				<input type = "submit" value="Enviar!">
			</form>
		</div>
	</div>
</body>
</html>


<?
}

?>