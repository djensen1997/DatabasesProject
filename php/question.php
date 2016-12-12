<head>
</head>

<?php

try {
	$sId = $_POST['sId'];
	$eName = $_POST['eName'];
	$number=$_POST['number'];
	$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=ejmoore',"cs3425gr", "cs3425gr");
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	echo '<form method="post" action="gradeQuestion.php">';

	$question = $dbh->query('Select number, question, correctAnswer, point from Question where eName = "'.$eName.'" and number='.$number);

	echo "<p>".$question[0].".) ".$question[1]."</p>";

	echo '<input type="hidden" name="correctAnswer" value="'.$question[2].'">';
	echo '<input type="hidden" name="sId" value="'.$sId.'">';
	echo '<input type="hidden" name="eName" value="'.$eName.'">';
	echo '<input type="hidden" name="number" value="'.$number.'">';
	echo '<input type="hidden" name="points" value="'.$question[3].'">';

	foreach ($dbh->query('Select choice, value from Question natural join Answer where ename = "'.$eName.'" and number='.$number) as $query) {
		echo '<input type="radio" name="choice" value="'.$query[0].'">'.$query[1]."</br>";	
	}

	//foreach ($dbh->query('Select number, question, choiceA, choiceB, choiceC, choiceD, correctAnswer, point from Question where eName = "'.$eName.'" and number='.$number) as $query) {
	//	echo "<p>".$query[0].".) ".$query[1]."</p>";
	//	echo "</br>";
	//	echo '<input type="radio" name="choice" value="A" checked>'.$query[2]."</br>";
	//	echo '<input type="radio" name="choice" value="B" checked>'.$query[3]."</br>";
	//	echo '<input type="radio" name="choice" value="C" checked>'.$query[4]."</br>";
	//	echo '<input type="radio" name="choice" value="D" checked>'.$query[5]."</br>";
	//
	//	echo '<input type="hidden" name="correctAnswer" value="'.$query[6].'">';
	//	echo '<input type="hidden" name="sId" value="'.$sId.'">';
	//	echo '<input type="hidden" name="eName" value="'.$eName.'">';
	//	echo '<input type="hidden" name="number" value="'.$number.'">';
	//	echo '<input type="hidden" name="points" value="'.$query[7].'">';
	//	echo '<input type="submit" name="nextQuestion" value="Next Queston">';
//
//
//	}
	echo "</form>";
} catch (PDOException $e) {
	print "Error! " . $e->getMessage()."<br>";
	die();
}

?>
