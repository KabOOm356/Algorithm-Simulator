<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Selection Sort Simulator</title>
</head>
<body bgcolor="gray">
<table border='1' cellpadding='20' align='center'>
<tr>
<td align='center'>
<?php
	echo "<p><h1><font color='yellow'>This is still a work in progress!</font></h1></p>";
	
	if(isset($_POST['array']))
	{
		// Heading 1
		echo "<p><h1><b>Selection Sort Simulator</b></h1></p>";
		
		// Display the last time the file was updated
		echo '<p>This file was last updated: ' . date ('F d Y H:i:s.', getlastmod()) . "</p>";
		
		// Read in the line number or initialize it
		if(isset($_POST['lineNum']))
			$lineNum = $_POST['lineNum'];
		else
			$lineNum = 0;
		
		printAlgo($lineNum);
		
		// Testing form
		echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>";
		echo "<input type='hidden' name='array' value='" . $_POST['array'] . "'>";
		if($lineNum !=7)
			echo "<input type='hidden' name='lineNum' value='" . ($lineNum+1) . "'>";
		echo "<input type='submit'>";
		echo "</form>";
	}
	else
		header("Location: index.php");
	
	// Prints a code snippet from the selection sort algorithm with the line number highlighted
	function printAlgo($lineNum)
	{
		$output = array("void selectionSort(int array[], int size) {<br/>",
						"  for(int index = 0; index < size; index++) {<br/>",
						"    int minimum = index;<br/>",
						"    for(int comparison = index+1; comparison < size; comparison++) {<br/>",
						"      if(array[comparison] < array[minimum]) {<br/>",
						"        minimum = comparison;<br/>      }<br/>    }<br/>",
						"    if(minimum != index) {<br/>",
						"      int temp = array[index];<br/>      array[index] = array[minimum];<br/>      array[minimum] = temp;<br/>    }<br/>  }<br/>}<br/>");
		$highlighted = array("void selectionSort(<span style='background-color: #FFFF00'>int array[], int size</span>) {<br/>",
							"  <span style='background-color: #FFFF00'>for(int index = 0; index < size; index++)</span> {<br/>",
							"    <span style='background-color: #FFFF00'>int minimum = index;</span><br/>",
							"    <span style='background-color: #FFFF00'>for(int comparison = index+1; comparison < size; comparison++)</span> {<br/>",
							"      <span style='background-color: #FFFF00'>if(array[comparison] < array[minimum])</span> {<br/>",
							"        <span style='background-color: #FFFF00'>minimum = comparison;</span><br/>      }<br/>    }<br/>",
							"    <span style='background-color: #FFFF00'>if(minimum != index)</span> {<br/>",
							"      <span style='background-color: #FFFF00'>int temp = array[index];</span><br/>      <span style='background-color: #FFFF00'>array[index] = array[minimum];</span><br/>      <span style='background-color: #FFFF00'>array[minimum] = temp;</span><br/>    }<br/>  }<br/>}<br/>");
		echo "<table><tr><td>";
		echo "<pre>";
		for($LCV = 0; $LCV < count($output); $LCV++)
		{
			if($LCV == $lineNum)
				echo $highlighted[$LCV];
			else
				echo $output[$LCV];
		}
		echo "</pre>";
		echo "</td></tr></table>";
	}
?>
</td>
</tr>
</table>
</body>
</html>