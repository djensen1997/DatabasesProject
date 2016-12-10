<head>
</head>

<?php

try {
	$sId = $_POST['sId'];
	$eName = $_POST['eName'];
	$number = $_POST['number'];
	$answer = $_POST['choice'];
	$correct = $_POST['correctAnswer'];
	$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=ejmoore',"cs3425gr", "cs3425gr");
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if (strcmp($answer,$correct) == 0) {
		$dbh->query('insert into qGrade values('.$sId.',"'.$eName.'",'.$number.',1)');
	} else {
		$dbh->query('insert into qGrade values('.$sId.',"'.$eName.'",'.$number.',0)');
	}

	$maxNumber = mysql_fetch_array($dbh->query('select max(number) from Question where eName = "'.$eName.'"'));

	if (strcmp($maxNumber[0],$number) == 0) {
		echo '<form method="POST" id="form" action="../php/userportal.php">';
	} else {
		echo '<form method="POST" id="form" action="../php/question.php">';
	}

	echo '<input type="hidden" name="sId" value ="'.$sId.'">';
	echo '<input type="hidden" name="eName" value ="'.$eName.'">';
	echo '<input type="hidden" name="number" value ="'.($number+1).'">';

	echo '<input type="submit">';

	echo '</form>';

	echo '<script> window.onload = function(){ document.getElementById("form").submit(); } </script>';
} catch (PDOException $e) {
	print "Error! " . $e->getMessage()."<br";
	die();
}
?>
