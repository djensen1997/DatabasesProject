<head>
</head>

<?php

try {
	$sId = $_POST['sId'];
	$eName = $_POST['eName'];
	$number = $_POST['number'];
	$answer = $_POST['choice'];
	$points = $_POST['points'];
	$correct = $_POST['correctAnswer'];
	$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=ejmoore',"cs3425gr", "cs3425gr");
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if (strcmp($answer,$correct) == 0) {
		$dbh->query('insert into qGrade values('.$sId.',"'.$eName.'",'.$number.',1,'.$points.')');
	} else {
		$dbh->query('insert into qGrade values('.$sId.',"'.$eName.'",'.$number.',0,'.$points.')');
	}

	$maxNumber = $dbh->query('select max(number) from Question where eName = "'.$eName.'"')->fetch()['max(number)'];
	echo '<p>'.$maxNumber.'</p>';

	if ($maxNumber[0]-$number == 0) {
		$totalScore = $dbh->query('select sum(points) from qGrade where eName="'.$eName.'" and correct=1 and sId ='.$sId)->fetch()['sum(points)'];
		$totalPoint = $dbh->query('select sum(points) from qGrade where eName="'.$eName.'" and sId = '.$sId)->fetch()['sum(points)'];
		$dbh->query('insert into eGrade values("'.$eName.'",'.$totalPoint.','.$totalScore.','.$sId.')');
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
