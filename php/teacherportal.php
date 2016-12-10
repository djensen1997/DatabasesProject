<head>
	<meta charset="UTF-8">
	<title>Online Exam Portal (Teacher)</title>
</head>

<?php
	$username = $_COOKIE['user'];
	$exams; #holds all the exam names
	try{
		#get the exam names
		$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=ejmoore', "cs3425gr", "cs3425gr");
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$exams = $dbh->query("select name,points,cDate from Exam");
	}catch (PDOException $e){
		print "ERROR!" . $e->getMessage()."<br/>";
		die();
	}
	echo '<body style="background-color:pink;">';
		echo '<strong> Welcome Back '.$username.'</strong>'; #nice welcome
		echo '</br> </br> </br> </br>'; #spacing
		#the acutal exam selection
		echo 'Your Created Exams </br>';
		echo '<form action="../php/edit.php" method="post">';
			echo "<table border='1'>";
			echo "<TR>";
			echo "<TH> Exam ID </TH>";
			echo "<TH> Exam Name </TH>";
			echo "<TH> Total Points </TH>";
			echo "<TH> Date Created </TH>";
			echo "</TR>";
			foreach($exams as $row){
				echo "<TR>";
				echo "<TD>".$row[0]."</TD>";
				echo "<TD>".$row[1]."</TD>";
				echo "<TD>".$row[2]."</TD>";
				echo "<TD>".$row[3]."</TD>";
				echo '<TD><input type="submit" name="edit" value="Edit"></TD>';
				echo "</TR>";
			}
			echo '</table>';
			echo '</form>';
			echo '<form action "../html/newExam.html">';
				echo '<input type="submit" name="submit" value="Create New Exam" /> </br>';
			echo '</form>';
		echo '</form>';
		echo '<a href="http://thecatapi.com"><img src="http://thecatapi.com/api/images/get?format=src&type=gif"></a>';
	echo '</body>';
?>