<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<button type="button" onclick="createDiscTopic()">New Discussion Topic</button><br/>
	<?php
		try{
			$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=danej', "cs3425gr", "cs3425gr");
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			#list out the topics
			echo '<form action="listPost.php" method="post">';
			echo '<input type="hidden" name="username" value="'.$_GET['username'].'">'
			echo "<table border='1'>";
			echo "<TR>";
			echo "<TH> Topic Number </TH>";
			echo "<TH> Topic Title </TH>";
			echo "<TH> Num Replies </TH>";
			echo "</TR>";
			$i = 0;
			foreach($dbh->query("select * from Topics") as $row){
				$i = $i + 1;
				echo "<TR>";
				echo "<TD>".$i."</TD>";
				echo "<TD>".$row[0]."</TD>";
				echo "<TD>".$row[1]."</TD>";
				echo '<TD><input type="button" name="list" value="List Postings"></TD>';
				echo '<input type="hidden" name="topic" value="'.$row[0].'">';
				echo "</TR>";
			}
			echo '</table>';
			echo '</form>';
			

		}catch (PDOException $e){
			print "ERROR!" . $e->getMessage()."<br/>";
			die();
		}



	?>

</body>
</html>