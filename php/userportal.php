<head>
	<meta charset="UTF-8">
	<title>Online Exam Portal (Student)</title>
</head>

<?php
	$exams; #holds all the exam names
	$username = $_COOKIE['user'];
	try{
		#get the exam names

		$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=ejmoore', "cs3425gr", "cs3425gr");
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$exams = $dbh->query("select name from Exam where name not in(select eName from eGrade where sId=".$username.")");
	}catch (PDOException $e){
		print "ERROR!" . $e->getMessage()."<br/>";
		die();
	}
	echo '<body style="background-color:pink;">';
		echo '<strong> Welcome Back '.$username.'</strong>'; #nice welcome
		echo '</br> </br> </br> </br>'; #spacing
		#the acutal exam selection
		echo 'Select an exam to take </br>';
		echo '<form action="../php/question.php" method="post">';
			echo 'Exam: <select name="eName">';
			#adds each exam name as an option
			foreach($exams as $exam){
				echo '<option>'.$exam[0].'</option>';	
			}
			echo '</select>';
			echo '<input type="hidden" name="sId" value="'.$username.'">';
			echo '<input type="hidden" name="number" value="1">';
			echo '<input type="submit" name="submit" value="Take Exam" /> </br>';
		echo '</form>';
			
		echo "<table border='1'>";
		echo "<TR>";
		echo "<TH> Exam Name </TH>";
		echo "<TH> Grade / Points </TH>";
		echo "</TR>";

		foreach ( $dbh->query("select eName, grade, points from eGrade where sId =".$username) as $row) {
			echo "<form action = '../php/questionReview.php'>";
			echo "<TR>";
			echo "<TD>".$row[0]."</TD>";
			echo "<TD>".$row[1]." / ".$row[2]."</TD>";
			echo "<TD><input type = 'submit'>Review</input></TD>";
			echo "</TR>";
			echo "</form>";
		}

		echo "</table>";

		echo '<a href="https://thecatapi.com"><img src="http://thecatapi.com/api/images/get?format=src&type=gif"></a>';
	echo '</body>';
?>

