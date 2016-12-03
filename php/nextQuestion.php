<head>
</head>

<?php

try {
	$sId = 1;
	$eId = 1;
	$qNumber = 1;
	$prevCorrect = false;
	$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=ejmoore',"cs3425gr", "cs3425gr");
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE);

	echo '<form method="post" action="next_question.php">';

	if($qNumber - 1 != 0) {
		$statement->prepare("insert into table qGrade values(".$sId.",".$eId.",".$qNumber.",".$prevCorrect.")";
		$statement->execute;
	}

	$query = $dbh->query("Select number, question, choiceA, choiceB, choiceC, choiceD, correctAnswer from Question where eId = ".$eId. "and number=".$qNumber);

	echo "<p>".$query[0].".) ".$query[1]."</p>";
	echo "</br>";
	echo '<input type="radio" name="choiceA" value="A" checked>'.$query[2]."</br>";
	echo '<input type="radio" name="choiceB" value="B" checked>'.$query[3]."</br>";
	echo '<input type="radio" name="choiceC" value="C" checked>'.$query[4]."</br>";
	echo '<input type="radio" name="choiceD" value="D" checked>'.$query[5]."</br>";

	echo '<input type="hidden" name="correctAnswer" value='.$query[6].'">';

	echo '<input type="submit" name="nextQuestion" value="Next Queston">';

	echo "</form>";
} catch (PDOException $e) {
	print "Error! " . $e->getMessage()."<br>";
	die();
}

?>
