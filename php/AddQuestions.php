
<body>
<?php
	echo '<form action="<?php AddQuestion() ?>">';
	echo '<br/><br/><br/>';
	echo "<table border='0'>";
	echo "<TR>";
	echo "<TD>Question: </TD>";
	echo "<TD><input type='text' name='qname' maxlength='100'></TD>";
	echo "<TD>Select the Correct Answer</TD>";
	echo "</TR>";
	echo "<TR>";
	echo "<TD>Answer 1: </TD>";
	echo "<TD><input type='text' name='a1' maxlength='100'></TD>";
	echo "<TD><input type='radio' name='correct' value='1' /></TD>";
	echo "</TR>";
	echo "<TR>";
	echo "<TD>Answer 2: </TD>";
	echo "<TD><input type='text' name='a2' maxlength='100'></TD>";
	echo "<TD><input type='radio' name='correct' value='1' /></TD>";
	echo "</TR>";
	echo "<TR>";
	echo "<TD>Answer 3: </TD>";
	echo "<TD><input type='text' name='a3' maxlength='100'></TD>";
	echo "<TD><input type='radio' name='correct' value='1' /></TD>";
	echo "</TR>";
	echo "<TR>";
	echo "<TD>Answer 4: </TD>";
	echo "<TD><input type='text' name='a4' maxlength='100'></TD>";
	echo "<TD><input type='radio' name='correct' value='1' /></TD>";
	echo "</TR>";
	echo "<TR>";
	echo "<TD></TD>";
	echo "<TD><input type='submit' name='Add Question' value='Next Question'></TD>";
	echo "<TD><input type='submit' name='Finish' value='Finish'></TD>";
	echo "</form>";
	echo "</TR>";
	echo "</table>";





function AddQuestion(){
	echo 'Hello World';
}

?>
</body>