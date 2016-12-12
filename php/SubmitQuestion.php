

<?php
	$exam = $_COOKIE['exam'];
	$num = $_COOKIE['num'];
	try{
		$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=ejmoore', "cs3425gr", "cs3425gr");
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//Question(qnum, ename, qname, points, correctChoice)
		$dbh->query("insert into Question values( ".$num.", '".$exam."', '".$_POST['qname']."', ".
			$_POST['points'].", '".$_POST['correct']."')");
		$i = 0;
		$char = 'A';
		while(isset($_POST['a'.i])){
			//Answer(qnum, ename, choice, value)
			$dbh->query("insert into Answer values(".$num.", '".$exam."', '".$char++."', '".$_POST['a'.i]."'')");
		}
		$dbh->query("update Exam set points = points + ".$_POST['points']." where name = '".$exam."'");
	}catch (PDOException $e){
		print "ERROR!" . $e->getMessage()."<br/>";
		die();
	}
	$num += 1;

	setcookie('num', $num,  time() + (86400/48), "/");
	if(isset($_POST['Finish'])){
		unset($_COOKIE['exam']);
		unset($_COOKIE['num']);
		header('Location: teacherportal.php');
	}else{
		header('Location: AddQuestions.php');
	}

?>