<?php 

	try{
		
		#get the exam names
		$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=ejmoore', "cs3425gr", "cs3425gr");
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$question = $dbh->query("select * from Question where eName='".$_POST['exam']."' and number=".$_POST['number']);
		if(isset($_POST['delete'])){
			$dbh->query("delete from Question where eName='".$_POST['exam']."' and number=".$_POST['number']);
			foreach($question as $row){
				$dbh->query("update Exam set points=points-".$row[7]);
				$dbh->query("update Question set number=number-1 where eName='".$_POST['exam']."' and number>".$row[5]);
			}
			header("Location: teacherportal.php");
		}else{
			foreach($question as $row){
				$num = $row[5];
				$name = $row[0];
				$correct = $row[6];
				$point = $row[7];
			}
			echo '<html><br/><body>';
			echo '<form action="ChangeQuestion.php" method="post">';
			echo $_POST['exam'];
			$exam = $_POST['exam'];
			echo '<input type="hidden" name="exam" value="'.$exam.'">';
			echo '<input type="hidden" name="number" value='.$_POST['number'].'>';
			echo '<br/><br/><br/>';
			echo "<table border='0' id='qtable'>";
			echo "<TR>";
			echo "<TD>Question: </TD>";
			echo "<TD><input type='text' name='qname' maxlength='255' value='".$name."'></TD>";
			echo "<TD>Select the Correct Answer</TD>";
			echo "</TR>";
			$i = 1;
			$char = 'A';
			foreach($dbh->query("select * from Answer where eName='".$_POST['exam']."' and number=".$num) as $ans){
				echo "<TR>";
				echo '<TD>Answer '.$char.':</TD>';
				echo '<TD><input type="text" name="a'.$i.'" value='.$ans[3].' maxlength="20"></TD>';
				echo '<TD><input type="radio" name="correct" value='.$char.' ';
				if(strcmp($correct, $char) == 0){
					echo 'checked="checked"';
				}
				echo '></TD>';
				echo "</TR>";
				$i++;
				$char++;
			}
			echo "<TR>";
			echo '<TD></TD><TD><button type="button" onclick="addRow()">Add Another Choice</button></TD>';
			echo '<TD></TD>';
			echo "</TR>";
			echo "<TR>";
			echo "<TD>Points:</TD><TD> <input type='text' name='points' value='".$point."''></TD>";
			echo "<TD><input type='submit' name='edit' value='Submit Changes'></TD>";
			echo "</TR>";
			echo "<br/><br/>";
			echo "</table>";
			echo "</form>";
			echo "<br/>";


			echo "<form action='edit.php' method=post>";
				echo "<input type='submit' name='unimportant' value='Back'>";
				echo "<input type='hidden' name='exam' value='".$_POST['exam']."''>";
			echo "</form>";
			echo "</body><br/></html>";
		}
	}catch (PDOException $e){
		//header("Location: teacherportal.php");
		print "ERROR!" . $e->getMessage()."<br/>";
		die();
	}




?>

<script>
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
		cell2.innerHTML = "<input type='text' name = 'a" + (rowN) + "' maxlength='20'>";
		cell3.innerHTML = "<input type='radio' name='correct' value='"+ letter + "' />";
	}
</script>
