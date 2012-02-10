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
		
		// Read in the array
		$array = unserialize($_POST['array']);
		
		// Read in the line number or initialize it
		if(isset($_POST['lineNum']))
			$lineNum = $_POST['lineNum'];
		else
			$lineNum = 0;
		
		// Read in the current index
		if(isset($_POST['index']))
			$index = $_POST['index'];
		else
			$index = 0;
		
		// Read in the comparison index
		if(isset($_POST['compIndex']))
			$compIndex = $_POST['compIndex'];
		else
			$compIndex = 0;
		
		// Read in the current minimum index
		if(isset($_POST['minimumIndex']))
			$minimumIndex = $_POST['minimumIndex'];
		else
			$minimumIndex = 0;
		
		// Print the indexes
		
		echo "<table border='0' cellpadding='0' style='font-size:12pt;'>";
		echo "<tr align='center' valign='bottom'>";
		
		// Print the indexes numbers
		for($LCV = 0; $LCV < count($array); $LCV++)
			echo "<td width='52'>$LCV</td>";
			
		echo "</tr></table>";
		
		// Print the array
		
		echo "<table border='1' cellpadding='5' style='font-size:18pt;'>";
		echo "<tr align='center'>";
		
		// TODO Add index highlighting
		for($LCV = 0; $LCV < count($array); $LCV++)
		{
			echo "<td width='40' bgcolor=white>" . $array[$LCV] . "</td>";
		}
		
		echo "</tr></table>";
		
		// Print the variable arrows
		
		echo "<table border='0' cellpadding='0' style='font-size:12pt;'>";
		echo "<tr align='center' valign='top'>";
		
		for($LCV = 0; $LCV < count($array); $LCV++)
		{
			echo "<td width='52'>";
			if($LCV == $index)
				echo "&uarr;<br/>Index<br/>";
			if($LCV == $compIndex)
				echo "&uarr;<br/>Comparison<br/>";
			if($LCV == $minimumIndex)
				echo "&uarr;<br/>Minimum<br/>";

			echo "&nbsp;<br/>";
			echo "</td>";
		}
		
		echo "</tr></table>";
		
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
						"  for(int Index = 0; Index < size; Index++) {<br/>",
						"    int Minimum = Index;<br/>",
						"    for(int Comparison = Index+1; Comparison < size; Comparison++) {<br/>",
						"      if(array[Comparison] < array[Minimum]) {<br/>",
						"        Minimum = Comparison;<br/>      }<br/>    }<br/>",
						"    if(Minimum != Index) {<br/>",
						"      int temp = array[Index];<br/>      array[Index] = array[Minimum];<br/>      array[Minimum] = temp;<br/>    }<br/>  }<br/>}<br/>");
		$highlighted = array("void selectionSort(<span style='background-color: #FFFF00'>int array[], int size</span>) {<br/>",
							"  <span style='background-color: #FFFF00'>for(int Index = 0; Index < size; Index++)</span> {<br/>",
							"    <span style='background-color: #FFFF00'>int Minimum = Index;</span><br/>",
							"    <span style='background-color: #FFFF00'>for(int Comparison = Index+1; Comparison < size; Comparison++)</span> {<br/>",
							"      <span style='background-color: #FFFF00'>if(array[Comparison] < array[Minimum])</span> {<br/>",
							"        <span style='background-color: #FFFF00'>Minimum = Comparison;</span><br/>      }<br/>    }<br/>",
							"    <span style='background-color: #FFFF00'>if(Minimum != Index)</span> {<br/>",
							"      <span style='background-color: #FFFF00'>int temp = array[Index];</span><br/>      <span style='background-color: #FFFF00'>array[Index] = array[Minimum];</span><br/>      <span style='background-color: #FFFF00'>array[Minimum] = temp;</span><br/>    }<br/>  }<br/>}<br/>");
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