<?php 

	try{
		if(strcmp($corret,'A') == 0){
			echo 'checked="checked">';
		}else{
			echo '>';
		}
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
				$name = $row[0];
				$choicea = $row[1];
				$choiceb = $row[2];
				$choicec = $row[3];
				$choiced = $row[4];
				$correct = $row[6];
				$point = $row[7];
			}
			echo '<html><br/><body>';
			echo '<form action="ChangeQuestion.php" method="post">';
			echo '<input type="hidden" name="exam" value='.$_POST['exam'].'>';
			echo '<input type="hidden" name="number" value='.$_POST['number'].'>';
			echo '<br/><br/><br/>';
			echo "<table border='0'>";
			echo "<TR>";
			echo "<TD>Question: </TD>";
			echo "<TD><input type='text' name='qname' maxlength='255' value='".$name."'></TD>";
			echo "<TD>Select the Correct Answer</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD>Answer 1: </TD>";
			echo "<TD><input type='text' name='a1' maxlength='255' value='".$choicea."'></TD>";
			echo "<TD><input type='radio' name='correct' value='A' ";
			if(strcmp($correct,'A') == 0){
				echo 'checked="checked">';
			}else{
				echo '>';
			}
			echo "</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD>Answer 2: </TD>";
			echo "<TD><input type='text' name='a2' maxlength='255' value='".$choiceb."'></TD>";
			echo "<TD><input type='radio' name='correct' value='B'";
			if(strcmp($correct,'B') == 0){
				echo 'checked="checked">';
			}else{
				echo '/>';
			}
			echo  "</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD>Answer 3: </TD>";
			echo "<TD><input type='text' name='a3' maxlength='255' value='".$choicec."'></TD>";
			echo "<TD><input type='radio' name='correct' value='C'";
			if(strcmp($correct,'C') == 0){
				echo 'checked="checked">';
			}else{
				echo '/>';
			}
			echo  "</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD>Answer 4: </TD>";
			echo "<TD><input type='text' name='a4' maxlength='255' value='".$choiced."'></TD>";
			echo "<TD><input type='radio' name='correct' value='D'";
			if(strcmp($correct,'D') == 0){
				echo 'checked="checked">';
			}else{
				echo '/>';
			}
			echo  "</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD>Points: <input type='text' name='points' value='".$point."''></TD>";
			echo "<TD><input type='submit' name='edit' value='Submit Changes'></TD>";
			echo "</form>";
			echo "</TR>";
			echo "</table>";
			echo "<br/><br/><br/>";
			echo "</body><br/></html>";
		}
	}catch (PDOException $e){
		//header("Location: teacherportal.php");
		print "ERROR!" . $e->getMessage()."<br/>";
		die();
	}




?>