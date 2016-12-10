<?php
	try{
		$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=ejmoore', "cs3425gr", "cs3425gr");
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$reconized = 0;
		#check for each student if the person attempting to login is 
		#reconized in the system as a student
		foreach($dbh->query("select sid,password from Student") as $row){
			if(strcmp($row[0] , $_POST["username"]) == 0){
				if($row[1] == $_POST["password"]){
					$reconized = 2;
				}
			}
		}

		if($reconized == 0){
			#check for each teacher if the person attempting to login is 
			#reconized in the system as a teacher
			foreach($dbh->query("select tid,password from Teacher") as $row){
				if(strcmp($row[0], $_POST["username"]) == 0){
					if($row[1] == $_POST["password"]){
						$reconized = 3;
					}
				}
			}
		}
		#if the student isn't reconized
		if($reconized == 0){
			header('Location: ../html/login.html?msg='.urldecode("Username or Password not Reconized"));
		}

		#if the student's login info is correct
		if($reconized == 2){
			$name = 'user';
			setcookie($name, $_POST['username'], time() + (86400 * 30), "../");
			setcookie('roll', 'student', time() + (86400*30), "../");

			header('Location: userportal.php');
		}

		#if the teacher's login info is correct
		if($reconized == 3){
			$name = 'user';
			setcookie($name, $_POST['username'], time() + (86400 * 30), "../");
			setcookie('roll', 'teacher', time() + (86400*30), "../");
			header('Location: teacherportal.php');
		}

	}catch (PDOException $e){
		print "ERROR!" . $e->getMessage()."<br/>";
		die();
	}

?>
