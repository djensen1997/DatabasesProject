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

	$dbh->query('select max(number) from Question where eName = "'.$eName.'"') as $maxNumber;

	echo '<input type="hidden" name="sId" value ="'.$sId.'">';
	echo '<input type="hidden" name="eName" value ="'.$eName.'">';
	echo '<input type="hidden" name="number" value ="'.$number.'">';

	if ($maxNumber[0]==$number) {
		header('Location: ../php/userportal.php');
	} else {
		header('Location: ../php/question.php');	
	}

} catch (PDOException $e) {
	print "Error! " . $e->getMessage()."<br";
	die();
}
?>
