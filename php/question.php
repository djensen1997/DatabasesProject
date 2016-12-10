<head>
</head>

<?php

try {
	$sId = $_POST['sId'];
	$eName = $_POST['eName'];
	$number=$_POST['number'];
	$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=ejmoore',"cs3425gr", "cs3425gr");
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	echo '<form method="post">';

	foreach ($dbh->query("Select number, question, choiceA, choiceB, choiceC, choiceD, correctAnswer from Question where eName = ".$eName." and number=".$number) as $row) {
		echo "<p>".$query[0].".) ".$query[1]."</p>";
		echo "</br>";
		echo '<input type="radio" name="choiceA" value="A" checked>'.$query[2]."</br>";
		echo '<input type="radio" name="choiceB" value="B" checked>'.$query[3]."</br>";
		echo '<input type="radio" name="choiceC" value="C" checked>'.$query[4]."</br>";
		echo '<input type="radio" name="choiceD" value="D" checked>'.$query[5]."</br>";
	
		echo '<input type="hidden" name="correctAnswer" value='.$query[6].'">';

		echo '<input type="submit" name="nextQuestion" value="Next Queston">';


	}
	echo "</form>";
} catch (PDOException $e) {
	print "Error! " . $e->getMessage()."<br>";
	die();
}

?>
