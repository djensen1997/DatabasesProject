<head>
</head>

<?php

try {
	$sId = $_POST['sId'];
	$eName = $_POST['eName'];
	$number=$_POST['number'];
	$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=ejmoore',"cs3425gr", "cs3425gr");
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	echo '<form method="post" action="gradeQuestion.php">'; #Submitting the form grades the question and redirects to another question or the user portal

	$question = $dbh->query('Select number, question, correctAnswer, point from Question where eName = "'.$eName.'" and number='.$number)->fetch(); #Get the current question

	echo "<p>".$question[0].".) ".$question[1]."</p>";

	echo '<input type="hidden" name="correctAnswer" value="'.$question[2].'">'; #Correct answer for use with grading
	echo '<input type="hidden" name="sId" value="'.$sId.'">'; #Basic variables needed to keep track of grades for submission
	echo '<input type="hidden" name="eName" value="'.$eName.'">';
	echo '<input type="hidden" name="number" value="'.$number.'">';
	echo '<input type="hidden" name="points" value="'.$question[3].'">';
	

	echo '</br>';
	foreach ($dbh->query('Select choice, value from Question natural join Answer where ename = "'.$eName.'" and number='.$number) as $query) { #Display all answer's associated with the question
		echo '<input type="radio" name="choice" value="'.$query[0].'">'.$query[1]."</br>";	
	}

	echo '<input type="submit" name="nextQuestion" value="Next Question">';
	echo "</form>";
} catch (PDOException $e) {
	print "Error! " . $e->getMessage()."<br>";
	die();
}

?>
