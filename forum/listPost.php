<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<button type="button" onclick="back()">Back to Main Page</button><br/>
	<?php
		#header('Location: listPost.php');
		try{
			$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=danej', "cs3425gr", "cs3425gr");
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			#list out the topics
			echo "<table border='1'>";
			echo "<TR>";
			echo "<TH> Post Number </TH>";
			echo "<TH> Posted By </TH>";
			echo "<TH> Post </TH>";
			echo "</TR>";
			$i = 0;
			foreach($dbh->query('select * from Posts where Topic="'.$_POST['topic'].'"') as $row){
				$i = $i + 1;
				echo "<TR>";
				echo "<TD>".$i."</TD>";
				echo "<TD>".$row[2]."</TD>";
				echo "<TD>".$row[3]."</TD>";
				echo "</TR>";
			}
			echo '</table>';
			

		}catch (PDOException $e){
			print "ERROR!" . $e->getMessage()."<br/>";
			die();
		}

		echo '<br/>';

	echo '<form action="newPost.php">';
		echo '<input type="hidden" name="username" value="'.$_POST['username'].'">';
		echo '<input type="hidden" name="topic" value="'.$_POST['topic'].'">';
		echo 'Add Post: <input type="text" name="post" maxlength="100">';
		echo '<input type="submit" name="sub" value="Post">';
		echo '<br/>';
	echo '</form>';

	?>
	

</body>
</html>