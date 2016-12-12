<head>
</head>

<?php
	$sId = $_POST['sId'];
	$eName = $_POST['eName'];
	$questions;
	try {
		$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=ejmoore', "cs3425gr", "cs3425gr");
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$questions = $dbh->query('select number, question, correct, point from Question natural join qGrade where sId='.$sId.' and eName = "'.$eName.'"');
	} catch (PDOException $e) {
		print "ERROR!". $e->getMessage()."<br/>";
		die();
	}

	echo "<table border='1'>";
	echo "<TR>";
	echo "<TH> Number </TH>";
	echo "<TH> Question </TH>";
	echo "<TH> Correct </TH>";
	echo "<TH> Points </TH>";
	echo "</TR>";
	foreach ($questions as $question) {
		echo "<TR>";
		echo "<TD>".$question[0]."</TD>";
		echo "<TD>".$question[1]."</TD>";
		if ($question[2] == 0) {
			echo "<TD>No</TD>";
		} else {
			echo "<TD>Yes</TD>";
		}
		echo "<TD>".$question[3]."</TD>";
		echo "</TR>";
	}
	echo "</table>";
	
	echo "<form action='../php/userportal.php'>";
	echo "<input type='submit' value='Back to User Portal'/>";
	echo "</form>";
?>
