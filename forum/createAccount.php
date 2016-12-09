<?php
#handles adding new posts to the forum
		try{
			$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=danej', "cs3425gr", "cs3425gr");
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			#call the add post procedure
			if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm'])){
				if($_POST['password'] == $_POST['confirm']){
					$dbh->query('insert into User("'.$_POST['username'].'", "'.$_POST['password'].'")');
				}else{
					header('Location: newUser.html?msg='..urldecode("Passwords do not match"));
				}
			}else{
				header('Location: newUser.html');
			}
			
			
		}catch (PDOException $e){
			print "ERROR!" . $e->getMessage()."<br/>";
			die();
		}
		header('Location: forum.php?username='.$_POST['username']);

?>