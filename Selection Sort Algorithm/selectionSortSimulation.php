<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Selection Sort Simulator</title>
<script src="../res/javascript.js" type="text/javascript"></script>
</head>
<body bgcolor="gray" onkeypress="javascript: onKey(event);">
<table border='1' cellpadding='20' align='center'>
<tr>
<td align='center'>
<?php
	if(isset($_POST['array']))
	{
		// Heading 1
		echo "<h1><b>Selection Sort Simulator</b></h1>";
		
		// Display the last time the file was updated
		echo '<p>This file was last updated: ' . date ('F d Y H:i:s.', getlastmod()) . "</p>";
		
		// Read in the array
		$array = unserialize($_POST['array']);
		
		// Read in the line number or initialize it
		if(isset($_POST['lineNum']))
			$lineNum = $newLineNum = $_POST['lineNum'];
		else
			$lineNum = $newLineNum = 0;
		
		// Read in the current index
		if(isset($_POST['index']))
			$index = $newIndex = $_POST['index'];
		else
			$index = $newIndex = -1;
		
		// Read in the comparison index
		if(isset($_POST['compIndex']))
			$compIndex = $newCompIndex = $_POST['compIndex'];
		else
			$compIndex = $newCompIndex = -1;
		
		// Read in the current minimum index
		if(isset($_POST['minimumIndex']))
			$minimumIndex = $newMinimumIndex = $_POST['minimumIndex'];
		else
			$minimumIndex = $newMinimumIndex = -1;
		
		// perform the current line of the selection sort
		switch($lineNum)
		{
			// Line number = 0
			// void selectionSort(int array[], int size) {
			case 0:
				$newLineNum++;
				$newIndex = 0;
			break;
			// Line number = 1
			// for(int Index = 0; Index < size; Index++) {
			case 1:
				if($index < count($array))
				{
					$cond = true;
					$newLineNum++;
				}
				else
				{
					$cond = false;
					$newLineNum = -1; // The algorithm is complete
				}
				$newMinimumIndex = $index;
			break;
			// Line number = 2
			// int Minimum = Index;
			case 2:
				$newLineNum++;
				$newCompIndex = $index+1;
			break;
			// Line number = 3
			// for(int Comparison = Index+1; Comparison < size; Comparison++) {
			case 3:
				if($compIndex < count($array))
				{
					$newLineNum++;
					$cond = true;
				}
				else
				{
					$newLineNum = 6;
					$cond = false;
				}
			break;
			// Line number = 4
			// if(array[Comparison] < array[Minimum]) {
			case 4:
				if($array[$compIndex] < $array[$minimumIndex])
				{
					$cond = true;
					$newLineNum++;
				}
				else
				{
					$cond = false;
					$newLineNum--;
					$newCompIndex++;
				}
			break;
			// Line number = 5
			// Minimum = Comparison;
			case 5:
				$minimumIndex = $newMinimumIndex = $compIndex;
				$newCompIndex++;
				$newLineNum = 3;
			break;
			// Line number = 6
			// if(Minimum != Index) {
			case 6:
				if($minimumIndex != $index)
				{
					$cond = true;
					$newLineNum++;
				}
				else
				{
					$cond = false;
					$newLineNum = 1;
					$newIndex++;
					$newMinimumIndex = -1;
				}
			break;
			// Line number = 7
			// Perform the swap
			// int temp = array[Index];
			// array[Index] = array[Minimum];
			// array[Minimum] = temp;
			case 7:
				$temp = $array[$index];
				$array[$index] = $array[$minimumIndex];
				$array[$minimumIndex] = $temp;
				$newLineNum = 1;
				$newMinimumIndex = -1;
				$newIndex++;
				break;
		}
		
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
		
		for($LCV = 0; $LCV < count($array); $LCV++)
		{
			if($LCV < $index)
				echo "<td width='40' bgcolor=gray>" . $array[$LCV] . "</td>";
			else
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
		
		switch($lineNum)
		{
			// Line number = -1
			// Special case idicating that the simulation is complete
			case -1:
				echo "<p>As you can see above the array is now sorted, meaning the simulation and algorithm are now complete.";
			break;
			// Line number = 0
			// void selectionSort(int array[], int size) {
			case 0:
				echo "<p>When the function begins, two key parameters are passed to the function:<br/>
						The <b>unsorted array of values</b> which will be sort, and <b>size</b> the size of the array.</p>";
			break;
			// Line number = 1
			// for(int Index = 0; Index < size; Index++) {
			case 1:
				if($index == 0)
				{
					echo "<p>In this step we begin a for loop.  We initialize the variable <b>Index</b><br/>
							to zero (0) and check if it is less than the size of the array.</p>";
					echo "<p>Since <b>Index</b> ($index) is less than <b>size</b> (" . count($array) . ") we enter the for loop.</p>";
				}
				else
				{
					echo "<p>We now go back to the for loop.  We increment the <b>Index</b> variable by one (1).</p>";
					echo "<p><pre>Index = Index + 1 => " . ($index-1) . " + 1 => $newIndex</pre></p>";
					echo "<p>We then test the condition if the for loop should continue.</p>";
					
					if($cond)
						echo "<p><b>Index</b> ($index) is less than size (" . count($array) . ").  We continue the for loop.</p>";
					else
						echo "<p><b>Index</b> ($index) is not less than size (" . count($array) . ").  We exit the for loop.</p>";
				}
			break;
			// Line number = 2
			// int Minimum = Index;
			case 2:
				echo "<p>We now assign a variable named <b>Minimum</b> equal to <b>Index</b> ($index).</p>";
			break;
			// Line number = 3
			// for(int Comparison = Index+1; Comparison < size; Comparison++) {
			case 3:
				if($compIndex == $index + 1)
				{
					echo "<p>In this step we begin a for loop.  We initialize the variable <b>Comparison</b><br/>
							to <b>Index</b> ($index) plus one (1) and check if it is less than the size of the array.</p>";
					echo "<p><pre>Comparison = Index + 1 => $index + 1 => $compIndex</pre></p>";
					echo "<p>Since <b>Comparison</b> ($compIndex) is less than <b>size</b> (" . count($array) . ") we enter the for loop.</p>";
				}
				else
				{
					echo "<p>We now go back to the for loop.  We increment the <b>Comparison</b> variable by one (1).</p>";
					echo "<p><pre>Comparison = Comparison + 1 => " . ($compIndex-1) . " + 1 => $compIndex</pre></p>";
					echo "<p>We then test the condition if the for loop should continue.</p>";
					
					if($cond)
						echo "<p><b>Comparison</b> ($compIndex) is less than size (" . count($array) . ").  We continue the for loop.</p>";
					else
						echo "<p><b>Comparison</b> ($compIndex) is not less than size (" . count($array) . ").  We exit the for loop.</p>";
				}
			break;
			// Line number = 4
			// if(array[Comparison] < array[Minimum]) {
			case 4:
				echo "<p>In this step we test the condition if the value of the array in index <b>Comparison</b> ($compIndex)<br/>
						is less than the value of the array in index <b>Minimum</b> ($minimumIndex).</p>";
				
				if($cond)
					echo "<p>The value at index $compIndex is " . $array[$compIndex] . " and is less than the value " . $array[$minimumIndex] . " at index $minimumIndex.<br/>
							We enter the if statement.</p>";
				else
					echo "<p>The value at index $compIndex is " . $array[$compIndex] . " and is not less than the value " . $array[$minimumIndex] . " at index $minimumIndex.<br/>
							We do not enter the if statement.</p>";
			break;
			// Line number = 5
			// Minimum = Comparison;
			case 5:
				echo "<p>We reassign the variable <b>Minimum</b> to <b>Comparison</b> ($compIndex).</p>";
			break;
			// Line number = 6
			// if(Minimum != Index) {
			case 6:
				echo "<p>In this step we check if the variable <b>Minimum</b> ($minimumIndex) does not equal the variable <b>Index</b> ($index).</p>";
				
				if($cond)
					echo "<p>The value of <b>Minimum</b> ($minimumIndex) does not equal <b>Index</b> ($index).<br/>
							We enter the if statement.</p>";
				else
					echo "<p>The value of <b>Minimum</b> ($minimumIndex) equals <b>Index</b> ($index).<br/>
							We do not enter the if statement.</p>";
			break;
			// Line number = 7
			// Perform the swap
			// int temp = array[Index];
			// array[Index] = array[Minimum];
			// array[Minimum] = temp;
			case 7:
				echo "<p>In this step we swap the values at <b>Minimum</b> ($minimumIndex) and <b>Index</b> ($index)</p>";
				echo '<table border="0"><tr align="center"><td align="left">';
				echo "<pre>temp = array[$index] => " . $array[$index] . "<br/>array[$index] = array[$minimumIndex] => " . $array[$minimumIndex] . "<br/>array[$minimumIndex] = $temp</pre>";
				echo "</td></tr></table>";
			break;
		}
		
		// Print the psuedocode for the algorithm with the current line hightlighted
		if($lineNum != -1)
			printAlgo($lineNum);
		
		// Form to continue to the next step
		if($lineNum != -1)
		{
			echo "<form name='form' action='" . $_SERVER['PHP_SELF'] . "' method='POST'>";
			echo "<input type='hidden' name='array' value='" . serialize($array) . "'>";
			echo "<input type='hidden' name='lineNum' value='$newLineNum'>";
			echo "<input type='hidden' name='index' value='$newIndex'>";
			echo "<input type='hidden' name='compIndex' value='$newCompIndex'>";
			echo "<input type='hidden' name='minimumIndex' value='$newMinimumIndex'>";
			echo "<input type='submit'>";
			echo "</form>";
		}
		else
		{
			echo "<form name='form' action='index.php' method='POST'>";
			echo "<input type='submit' value='Return to Simulator Selection Menu'>";
			echo "</form>";
		}
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