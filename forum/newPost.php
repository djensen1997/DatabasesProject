<?php
#handles adding new posts to the forum
		try{
			$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=danej', "cs3425gr", "cs3425gr");
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			#call the add post procedure
			$dbh->query('call addPost("'.$_POST['topic'].'", "'.$_POST['username'].'", "'.$_POST['post'].'")');
			
		}catch (PDOException $e){
			print "ERROR!" . $e->getMessage()."<br/>";
			die();
		}
		header('Location: forum.php?username='.$_POST['username']);

?>