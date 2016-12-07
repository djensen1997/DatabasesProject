<?php
try {
	$title=$_POST['title'];
	$username=$_POST['username'];
	$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=airline', "cs3425", "grader");
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$statement = $dbh->prepare("insert into topics values(".$title.",".$username.",0);"
	$result = $statement->execute();
} catch (PDOException $e) {
	print "Error!" . $e->getMessage()."<br/>";
	die();
}
?>
