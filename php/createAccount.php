<?php
#handles adding new accunts to the exam server
		try{
			$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=ejmoore', "cs3425gr", "cs3425gr");
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			#call the add post procedure
			if(isset($_POST['sid']) && isset($_POST['password']) && isset($_POST['confirm'])){
				if(strcmp($_POST['password'], $_POST['confirm']) == 0){
					$dbh->query('insert into Student values("'.$_POST['sid'].'", "'.$_POST["name"].'", "'.$_POST['major'].'" ,Password("'.$_POST['password'].'"))');
					header('Location: teacherportal.php');
				}else{
					header('Location: ../html/newUser.html?msg='.urldecode("Passwords do not match"));
				}
			}else{
				header('Location: ../html/newUser.html?msg='.urldecode("A field is blank"));
			}
			
			
		}catch (PDOException $e){
			print "ERROR!" . $e->getMessage()."<br/>";
			header('Location: ../html/newUser.html');
		}
		

?>
