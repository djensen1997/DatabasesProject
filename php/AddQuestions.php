

<?php
$exam;
$points = 0;
if(isset($_POST['exam_name']) && !isset($_POST['points'])){
	//cookie only lasts 30 minutes
	setcookie('exam', $_POST['exam_name'], time() + (86400/48), "/");
	$exam = $_POST['exam_name'];
	$points = 0;
	setcookie('num', 1, time() + (86400/48), "/");
	try{
		$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=ejmoore', "cs3425gr", "cs3425gr");
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbh->query("insert into Exam values(0, '".$exam."', CURDATE())");
	}catch (PDOException $e){
		print "ERROR!" . $e->getMessage()."<br/>";
		die();
	}
}else{
	$exam = $_COOKIE['exam'];
	try{
		$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=ejmoore', "cs3425gr", "cs3425gr");
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		foreach($dbh->query("select * from Exam") as $temp){
			if(strcmp($temp[1], $exam) == 0){
				$points = $temp[0];
			}
		}
	}catch (PDOException $e){
		print "ERROR!" . $e->getMessage()."<br/>";
		die();
	}
}
if(isset($_POST['points'])){
	setcookie('exam', $_POST['exam_name'], time() + (86400/48), "/")
	$points = $_POST['points'];
	setcookie('num', $_POST['num'] + 1, time() + (86400/48), "/");
}
	echo '<html><br/><body>';
	echo '<h1>Currently Adding Questions for Exam: '.$exam;
	echo '<form action="SubmitQuestion.php" method="post">';
	echo '<br/><br/><br/>';
	echo "<table border='0'>";
	echo "<TR>";
	echo "<TD>Question: </TD>";
	echo "<TD><input type='text' name='qname' maxlength='255'></TD>";
	echo "<TD>Select the Correct Answer</TD>";
	echo "</TR>";
	echo "<TR>";
	echo "<TD>Answer 1: </TD>";
	echo "<TD><input type='text' name='a1' maxlength='255'></TD>";
	echo "<TD><input type='radio' name='correct' value='A' /></TD>";
	echo "</TR>";
	echo "<TR>";
	echo "<TD>Answer 2: </TD>";
	echo "<TD><input type='text' name='a2' maxlength='255'></TD>";
	echo "<TD><input type='radio' name='correct' value='B' /></TD>";
	echo "</TR>";
	echo "<TR>";
	echo "<TD>Answer 3: </TD>";
	echo "<TD><input type='text' name='a3' maxlength='255'></TD>";
	echo "<TD><input type='radio' name='correct' value='C' /></TD>";
	echo "</TR>";
	echo "<TR>";
	echo "<TD>Answer 4: </TD>";
	echo "<TD><input type='text' name='a4' maxlength='255'></TD>";
	echo "<TD><input type='radio' name='correct' value='D' /></TD>";
	echo "</TR>";
	echo "<TR>";
	echo "<TD>Points: <input type='text' name='points'></TD>";
	echo "<TD><input type='submit' name='Add Question' value='Next Question'></TD>";
	echo "<TD><input type='submit' name='Finish' value='Finish'></TD>";
	echo "</form>";
	echo "</TR>";
	echo "</table>";
	echo "<br/><br/><br/>";
	echo "Exam Currently Worth ".$points;
	echo "</body><br/></html>";

?>
