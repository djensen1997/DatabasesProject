<?php
	try{
		$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=danej', "cs3425gr", "cs3425gr");
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$reconized = 0;
		#check for each student if the person attempting to login is 
		#reconized in the system as a student
		foreach($dbh->query("select username,password from User") as $row){
			if(strcmp($row[0] , $_POST["username"]) == 0){
				if(strcmp($row[1] , $_POST["password"]) == 0){
					$reconized = 1;
					break;
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