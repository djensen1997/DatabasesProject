<?php
#handles adding new posts to the forum
		try{
			$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=ejmoore', "cs3425gr", "cs3425gr");
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			#call the add post procedure
			if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm'])){
				if(strcmp($_POST['password'], $_POST['confirm']) == 0){
					$dbh->query('insert into Student values("'.$_POST['sid'].'", "'.$_POST['password'].'")');
				}else{
					header('Location: newUser.html?msg='.urldecode("Passwords do not match"));
				}
			}else{
				header('Location: newUser.html');
			}
			
			
		}catch (PDOException $e){
			print "ERROR!" . $e->getMessage()."<br/>";
			header('Location: newUser.html');
		}
		header('Location: forum.php?username='.$_POST['username']);

?>