<head>
	<meta charset="UTF-8">
	<title>Online Exam Portal (Student)</title>
</head>

<?php
	$exams; #holds all the exam names
	try{
		#get the exam names
		$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=ejmoore', "cs3425gr", "cs3425gr");
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$exams = $dbh->query("select name from Exam");
	}catch (PDOException $e){
		print "ERROR!" . $e->getMessage()."<br/>";
		header('Location: ../html/userportal.html');
		die();
	}
	echo '<body style="background-color:pink;">';
		echo '<strong> Welcome Back '.$_POST['username'].'</strong>'; #nice welcome
		echo '</br> </br> </br> </br>'; #spacing
		#the acutal exam selection
		echo 'Select an exam to take </br>';
		echo '<form action="../php/exam.php" method="post">';
			echo 'Exam: <select name="exam">';
				#adds each exam name as an option
				foreach($exams as $exam){
					echo '<option>'.$exam[0].'</option>';
				}
			echo '</select>';
			echo '<input type="submit" name="submit" value="Take Exam" /> </br>'
		echo '</form>';
	echo '</body>';
?>

