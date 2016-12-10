

<?php
	$exam = $_COOKIE['exam'];
	$num = $_COOKIE['num'];
	try{
		$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=ejmoore', "cs3425gr", "cs3425gr");
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbh->query("insert into Questions values(".$_POST['qname']", ".$_POST['a1'].", ".$_POST['a2']
			.", ".$_POST['a3'].", ".$_POST['a4'].", ".$_POST['correct'].", ".$num.", ".$POST['points'].", ".$exam);
	}catch (PDOException $e){
		print "ERROR!" . $e->getMessage()."<br/>";
		die();
	}
	$num += 1;
	setcookie('num', $num,  time() + (86400/48), "/");
	if(isset($_POST['Finish'])){
		header('Location: teacherportal.php');
	}else{
		header('Location: AddQuestions.php');
	}
	
?>