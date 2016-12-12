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
	}catch (PDOException $e){
		print "ERROR!" . $e->getMessage()."<br/>";
		die();
	}
	header("Location: teacherportal.php");

?>