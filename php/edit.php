<head>
	<meta charset="UTF-8">
	<title>Edit Exam</title>
</head>


<?php
	$username = $_COOKIE['user'];
	$exam = $_POST['exam'];
	$questions;
	try{
		#get the exam names
		$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=ejmoore', "cs3425gr", "cs3425gr");
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$questions = $dbh->query("select * from Question where eName='".$exam."'");
	}catch (PDOException $e){
		print "ERROR!" . $e->getMessage()."<br/>";
		die();
	}
	echo '<body style="background-color:pink;">';
		echo '<h1> Viewing Exam '.$exam.'</h1>'; #nice welcome
		echo '</br> </br> </br> </br>'; #spacing
		#the acutal exam selection
		echo 'Questions </br>';
		
			echo "<table border='1'>";
			echo "<TR>";
			echo "<TH> Question Number </TH>";//6
			echo "<TH> Quesiton </TH>";//0
			echo "<TH> Choice A </TH>";//1
			echo "<TH> Choice B </TH>";//2
			echo "<TH> Choice C </TH>";//3
			echo "<TH> Choice D </TH>";//4
			echo "<TH> Correct Choice </TH>";//5
			echo "<TH> Worth </TH>";//7
			echo "</TR>";
			foreach($questions as $row){
				echo '<form action="../php/editquestion.php" method="post">';
				echo "<TR>";
				echo "<TD>".$row[7]."</TD>";
				echo "<TD>".$row[0]."</TD>";
				echo "<TD>".$row[1]."</TD>";
				echo "<TD>".$row[2]."</TD>";
				echo "<TD>".$row[3]."</TD>";
				echo "<TD>".$row[4]."</TD>";
				echo "<TD>".$row[5]."</TD>";
				echo "<TD>".$row[6]."</TD>";
				echo '<TD><input type="submit" name="edit" value="Edit"></TD>';
				echo '<TD><input type="submit" name="delete" value="Delete"></TD>';
				echo "</TR>";
				echo "<input type='hidden' name='exam' value='".$exam."'>";
				echo "<input type='hidden' name='number' value='".$row[6]."'>";
				echo '</form>';
			}
			echo '</table>';
			
			echo '<form action="/teacherportal.php">';
				echo '<input type="submit" name="submit" value="Back" /> </br>';
			echo '</form>';
		echo '</form>';
	echo '</body>';
?>