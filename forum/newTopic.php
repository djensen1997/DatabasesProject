<?php
try {
	$title=$_POST['title'];
	$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=airline', "cs3425", "grader");
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$statement = $dbh->prepare("insert into topics values(".$title.",0);"
	$result = $statement->execute();
} catch (PDOException $e) {
	print "Error!" . $e->getMessage()."<br/>";
	die();
}
?>
