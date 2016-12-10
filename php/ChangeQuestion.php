<?php

	$exam = $_POST['exam'];
	$num = $_POST['number'];
	$question;
	try{
		$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=ejmoore', "cs3425gr", "cs3425gr");
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$question = $dbh->query("select * from Question where eName='".$_POST['exam']."' and number=".$_POST['number']);
		foreach($question as $row){
			if(strcmp($row[0], $_POST['qname']) != 0){
				$dbh->query("update Question set question='".$_POST['qname']."' where eName='".$exam."' and number=".$num);
			}
			if(strcmp($row[1], $_POST['a1']) != 0){
				$dbh->query("update Question set choiceA='".$_POST['a1']."' where eName='".$exam."' and number=".$num);
			}
			if(strcmp($row[2], $_POST['a2']) != 0){
				$dbh->query("update Question set choiceB='".$_POST['a2']."' where eName='".$exam."' and number=".$num);
			}
			if(strcmp($row[3], $_POST['a3']) != 0){
				$dbh->query("update Question set choiceC='".$_POST['a3']."' where eName='".$exam."' and number=".$num);
			}
			if(strcmp($row[4], $_POST['a4']) != 0){
				$dbh->query("update Question set choiceD='".$_POST['a4']."' where eName='".$exam."' and number=".$num);
			}
			if(strcmp($row[6], $_POST['correct']) != 0){
				$dbh->query("update Question set correctAnswer='".$_POST['qname']."' where eName='".$exam."' and number=".$num);
			}
			if(strcmp($row[7], $_POST['points']) != 0){
				$dbh->query("update Question set point='".$_POST['qname']."' where eName='".$exam."' and number=".$num);
			}
		}
	}catch (PDOException $e){
		print "ERROR!" . $e->getMessage()."<br/>";
		die();
	}
	header("Location: teacherportal.php");

?>