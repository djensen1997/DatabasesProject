<head>
	<meta charset="UTF-8">
	<title>Edit Exam</title>
</head>


<?php
	$username = $_COOKIE['user'];
	$exam = $_POST['exam'];
	$questions;
	$points = 0;
	$num = 0;
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
			#lists out questions by name, thier point worth, correct answer and number
			#adds 2 buttons next to the question, 1 for viewing/editing the question
			#the other deletes the question from the exam
			echo "<table border='1'>";
			echo "<TR>";
			echo "<TH> Question Number </TH>";//6
			echo "<TH> Question </TH>";//0
			echo "<TH> Correct Choice </TH>";//5
			echo "<TH> Worth </TH>";//7
			echo "</TR>";
			foreach($questions as $row){
				$num += 1;
				$points += $row[7];
				echo '<form action="../php/editquestion.php" method="post">';
				echo "<TR>";
				echo "<TD>".$row[5]."</TD>";
				echo "<TD>".$row[0]."</TD>";
				echo "<TD>".$row[6]."</TD>";
				echo "<TD>".$row[7]."</TD>";
				echo '<TD><input type="submit" name="edit" value="View/Edit"></TD>';
				echo '<TD><input type="submit" name="delete" value="Delete"></TD>';
				echo "</TR>";
				echo "<input type='hidden' name='exam' value='".$exam."'>";
				echo "<input type='hidden' name='number' value='".$row[5]."'>";
				echo '</form>';
				
			}
			echo '</table>';
			#add question button, for when you don't have enough questions
			echo '<form action="AddQuestions.php" method="post">';
				echo '<input type="hidden" name="exam_name" value="'.$exam.'" >';
				echo '<input type="hidden" name="points" value="'.$points.'" >';
				echo '<input type="hidden" name="num" value="'.$num.'" >';
				echo '<input type="submit" name="addquestion" value="Add New Question">';
				echo '</form>';
			echo '<form action="teacherportal.php">';
				echo '<input type="submit" name="submit" value="Back" /> </br>';
			echo '</form>';

		echo '</form>';
	echo '</body>';
?>