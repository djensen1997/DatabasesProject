<!--if a value was changed while viewing questions, this updates it in the table -->

<?php

	$exam = $_POST['exam'];
	$num = $_POST['number'];
	$question;
	$dbh;
	try{
		$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=ejmoore', "cs3425gr", "cs3425gr");
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbh->beginTransation();
		$question = $dbh->query("select * from Question where eName='".$_POST['exam']."' and number=".$_POST['number']);
		//goes through each value in the question and answer to see if something changed
		//if a value did change, it updates it
		foreach($question as $row){
			if(strcmp($row[0], $_POST['qname']) != 0){
				$dbh->query("update Question set question='".$_POST['qname']."' where eName='".$exam."' and number=".$num);
			}
			if(strcmp($row[6], $_POST['correct']) != 0){
				$dbh->query("update Question set correctAnswer='".$_POST['correct']."' where eName='".$exam."' and number=".$num);
			}
			if(strcmp($row[7], $_POST['points']) != 0){
				$dbh->query("update Question set point='".$_POST['points']."' where eName='".$exam."' and number=".$num);
			}
		}
		$i = 1;
		$char = 'A';
		foreach($dbh->query("select * from Answer where eName='".$_POST['exam']."' and number=".$_POST['number']) as $row){
			if(strcmp($_POST['a'.$i], $row[3]) != 0){
				$dbh->query("update Answer set value='".$_POST['a'.$i]."' where eName='".$exam."' and number=".$num." and choice='".$char."'");
			}
			$i++;
			$char++;
		}
		while(isset($_POST['a'.$i])){
			$dbh->query("insert into Answer values(".$num.", '".$exam."', '".$char."', '".$_POST['a'.$i]."')");
			$i++;
			$char++;
		}
		$dbh->commit();
	}catch (Exception $e){
		$dbh->rollback();
		print "ERROR!" . $e->getMessage()."<br/>";
		die();
	}
	//return to the teacher portal when completed
	header("Location: teacherportal.php");

?>