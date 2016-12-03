<?php
	Header('Location: /php/login.php');
	try{
		$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=ejmoore', "cs3425gr", "cs3425gr");
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$reconized = 0;
		#check for each student if the student attempting to login is 
		#reconized in the system
		foreach($dbh->query("select user,pass from Student") as $row){
			if($row[0] == $_POST["username"]){
				$reconized = 1;
				if($row[1] == $_post["password"]){
					$reconized = 2;
				}
			}
		}
		#if the student isn't reconized
		#TODO make return to the login screen with a prompt to create the user

		#if the student's password isn't correct
		#TODO return to the login screen with an error message

		#if the student's login info is correct
		if($reconized == 2){
			header('Location: /userportal.html');
		}

	}catch (PDOException $e){
		print "ERROR!" . $e->getMessage()."<br/>";
		header('Location: ../html/userportal.html');
		die();
	}

?>