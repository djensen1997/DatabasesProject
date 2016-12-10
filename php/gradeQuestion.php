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

	if (strcmp($answer,$correct)) {
		$dbh->query('insert into qGrade values('.$sId.',"'.$eName.'",'.$number.',true)');
	} else {
		$dbh->query('insert into qGrade values('.$sId.',"'.$eName.'",'.$number.',false)');
	}

	$maxNumber = mysql_fetch_array($dbh->query('select max(number) from Question where eName = "'.$eName.'"'));

	if ($maxNumber[0]==$number) {
		echo '<form type="POST" id="form" action="../php/userportal.php">';
	} else {
		echo '<form type="POST" id="form" action="../php/question.php">';
	}

	echo '<input type="hidden" name="sId" value ="'.$sId.'">';
	echo '<input type="hidden" name="eName" value ="'.$eName.'">';
	echo '<input type="hidden" name="number" value ="'.$number.'">';

	echo '<input type="submit">';

	echo '</form>';

	echo '<script> window.onload = function(){ document.getElementById("form").submit(); } </script>';
} catch (PDOException $e) {
	print "Error! " . $e->getMessage()."<br";
	die();
}
?>
