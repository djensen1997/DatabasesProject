<!--used to create submit the created exam questions-->

<?php
	$exam = $_COOKIE['exam'];
	$num = $_COOKIE['num'];
	$dbh;
	try{
		$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=ejmoore', "cs3425gr", "cs3425gr");
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbh->beginTransaction();
		//Question(qnum, ename, qname, points, correctChoice)
		//insert the question, with its point worth, and correct answer letter choice
		$stmt = $dbh->prepare("insert into Question(number,eName,question,point,correctAnswer) values( :num, :exam, :qname, :points".
			", :correct)");
		$stmt->execute(array("num" => $num, "exam" => $exam, "qname" => $_POST['qname'], 
			"points" => $_POST['points'], "correct" => $_POST['correct']));
		//a loop that goes through each answer until a.$i is not defined in POST
		//inserts each answer into the Answer table
		$i = 1;
		$char = 'A';
		echo "<script> Console.log(".$_POST['a1']."); </script>";
		$index = 'a'.$i;
		while(isset($_POST[$index])){
			echo "<script> Console.log(".$_POST['a'.$i]."); </script>";
			//Answer(qnum, ename, choice, value)
			$stmt = $dbh->prepare("insert into Answer values(".$num.", :exam, '".$char."', :value)");
			$stmt->execute(array("exam" => $exam, "value" => $_POST['a'.$i]));
			$char++;
			$i++;
			$index = 'a'.$i;
		}
		//updates the exams total points
		$stmt = $dbh->prepare("update Exam set points = points + ".$_POST['points']." where name = :exam");
		$stmt->execute(array("exam" => $exam));
		$dbh->commit();
	}catch (Exception $e){
		$dbh->rollback();
		print "ERROR!" . $e->getMessage()."<br/>";
	}
	$num += 1;
	//update the num cookie and decide what to do next based on user input
	setcookie('num', $num,  time() + (86400/48), "/");
	if(isset($_POST['Finish'])){
		unset($_COOKIE['exam']);
		unset($_COOKIE['num']);
		header('Location: teacherportal.php');
	}else{
		header('Location: AddQuestions.php');
	}

?>
