<?php
	try{
		$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=danej', "cs3425gr", "cs3425gr");
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$reconized = 0;
		#check for each student if the person attempting to login is 
		#reconized in the system as a student
		foreach($dbh->query("select username,password from User") as $row){
			if($row[0] == intval($_POST["username"])){
				if($row[1] == $_POST["password"]){
					$reconized = 1;
				}else{
					$reconized = 0;
				}
			}
		}
		#if the student isn't reconized
		if($reconized == 0){
			header('Location: login.html?msg='.urldecode("Username or Password not Reconized"));
		}

		#if the student's login info is correct
		if($reconized == 1){
			header('Location: forum.php?username='.$_POST['username']);
		}

	}catch (PDOException $e){
		print "ERROR!" . $e->getMessage()."<br/>";
		die();
	}

?>