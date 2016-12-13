<head>

</head>

<?php
$exam;
$points = 0;
//basically, if this came from the newExam page, it executes this code
if(isset($_POST['exam_name']) && !isset($_POST['points'])){
	//cookie only lasts 30 minutes
	setcookie('exam', $_POST['exam_name'], time() + (86400/48), "/");
	$exam = $_POST['exam_name'];
	$points = 0;
	setcookie('num', 1, time() + (86400/48), "/");
	try{
		//connect to the server
		$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=ejmoore', "cs3425gr", "cs3425gr");
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//insert the exam
		$stmt = $dbh->prepare("insert into Exam values(0, :exam , CURDATE())");
		$stmt->execute(array('exam' => $exam));
	}catch (PDOException $e){
		print "ERROR!" . $e->getMessage()."<br/>";
		die();
	}
//if this was opened from anywhere else, it executes this code
}else{
	//if there is an exam_name set, set our exam name
	if(isset($_POST['exam_name'])){
		$exam = $_POST['exam_name'];
		setcookie('exam', $_POST['exam_name'], time() + (86400/48), "/");
	//else we get the exam name from a cookie
	}else{
		$exam = $_COOKIE['exam'];
	}
	
	try{
		//connect to the server
		$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=ejmoore', "cs3425gr", "cs3425gr");
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//get the total points for this exam
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
	$points = $_POST['points'];
	setcookie('num', $_POST['num'] + 1, time() + (86400/48), "/");
}
	//the actual question creation section
	echo '<html><br/><body>';
	echo '<h1>Currently Adding Questions for Exam: '.$exam;
	echo '<form action="SubmitQuestion.php" method="post">';
	echo '<br/><br/><br/>';
	echo "<table border='0' id='qtable'>";
	echo "<TR>";
	echo "<TD>Question: </TD>";
	echo "<TD><input type='text' name='qname' maxlength='255' ></TD>";
	echo "<TD>Select the Correct Answer</TD>";
	echo "</TR>";
	echo "<TR>";
	echo "<TD>Answer A: </TD>";
	echo "<TD><input type='text' name='a1' maxlength='255'></TD>";
	echo "<TD><input type='radio' name='correct' value='A' /></TD>";
	echo "</TR>";
	echo "<TR>";
	echo "<TD>Answer B: </TD>";
	echo "<TD><input type='text' name='a2' maxlength='255'></TD>";
	echo "<TD><input type='radio' name='correct' value='B' /></TD>";
	echo "</TR>";
	echo "<TR>";
	//used to add another answer choice to a question
	//can generate infinite answer choices
	echo '<TD></TD><TD><button type="button" onclick="addRow()">Add Another Choice</button></TD>';
	echo '<TD></TD>';
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
	echo "</body><br/>";

?>

<script>
	//script to make more answer choices
	function addRow(){
		var table = document.getElementById('qtable');
		var rowN = table.rows.length - 2;
		var letter = String.fromCharCode('A'.charCodeAt(0) + (rowN-1));
		var row = table.insertRow(rowN);
		var col = 0;
		var cell1 = row.insertCell(col++);
		var cell2 = row.insertCell(col++);
		var cell3 = row.insertCell(col++);
		cell1.innerHTML = "Answer " + letter + ":";
		cell2.innerHTML = "<input type='text' name = 'a" + (rowN) + "' maxlength='255'>";
		cell3.innerHTML = "<input type='radio' name='correct' value='"+ letter + "' />";
	}
</script>
