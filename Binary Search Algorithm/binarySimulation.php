<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Binary Search Algorithm Simulator</title>
</head>
<body bgcolor="gray">
	<table border='1' cellpadding='20' align='center'>
		<tr>
			<td align='center'>
			<?php
			// Check if the required variables are set
			if(isset($_POST['search']) && is_numeric($_POST['search']) && isset($_POST['array']))
			{
				// Heading 1
				echo "<p><h1><b>Binary Search Simulator</b></h1></p>";

				// Display the last time the file was updated
				echo '<p>This file was last updated: ' . date ('F d Y H:i:s.', getlastmod()) . "</p>";

				// Check if the algorithm has completed
				if(isset($_POST['done']))
				{
					$done = true;
					$lineNum = -1;
				}
				else
				{
					$done = false;
					$lineNumNew = $lineNum = intval($_POST['lineNum']);
				}

				// Number to search for
				$search = intval($_POST['search']);
				
				// Read in the array
				// TODO This is probably not necessary
				$in = unserialize($_POST['array']);
				$array = "";
				
				for($LCV = 0; $LCV < count($in); $LCV++)
				{
					if($LCV != count($in))
						$array = $array . $in[$LCV] . " ";
					else
						$array = $array . $in[$LCV];	
				}
				
				$array = trim($array);
				
				// The array
				$array = explode(" ", $array);

				// Display the number to be searched for
				echo "Searching for the value $search:<br/><br/>";

				// Read in variables
				$firstNew = $first = intval($_POST['first']);
				$midNew = $mid = intval($_POST['mid']);
				$lastNew = $last = intval($_POST['last']);
				
				if($last == -2)
					$lastNew = $last = count($array)-1;

				// perform the current line of the binary search algorithm
				switch($lineNum)
				{
					// Line number = 0
					// int binarySearch (int sortedArray[], int First, int Last, int key) {
					case 0:
						$lineNumNew++;
						break;
					// Line number = 1
					// while (First <= Last) {
					case 1:
						// Make sure last and first are in bounds
						if($last != -1 && $first < count($array))
						{
							// Test if the while condition is true or false
							if($array[$first] <= $array[$last])
							{
								// Increment the new line
								$lineNumNew++;
								$cond = true;
							}
							else
							{
								// Jump to the new line
								$lineNumNew = 8;
								$cond = false;
							}
						}
						else // Special case
						{
							$lineNumNew = 8;
							$cond = false;
						}
						break;
					// Line number = 2
					// int Mid = (First + Last) / 2;
					case 2:
						
						$midNew = floor(($first + $last) / 2);
						$lineNumNew++;
						break;
					// Line number = 3
					// if (key > sortedArray[Mid])
					case 3:
						if($search > $array[$mid])
						{
							$lineNumNew++;
							$cond = true;
						}
						else
						{
							$lineNumNew = 5;
							$cond = false;
						}
						break;
					// Line number = 4
					// First = Mid + 1;
					case 4:
						$firstNew = $mid + 1;
						$lineNumNew = 1;
						break;
					// Line number = 5
					// else if (key < sortedArray[Mid])
					case 5:
						if($search < $array[$mid])
						{
							$cond = true;
							$lineNumNew = 6;
						}
						else
						{
							$cond = false;
							$lineNumNew = 7;
						}
						break;
					// Line number = 6
					// Last = Mid - 1;
					case 6:
						$lastNew = $mid - 1;
						$lineNumNew = 1;
						break;
					// Line number = 7
					// return Mid;
					case 7:
						$done = true;
						break;
					// Line number = 8
					// return -(First + 1);
					case 8:
						$midNew = -($first + 1);
						$done = true;
						break;
				}

				// add extra index for showing where to insert
				if($lineNum == -1 && (-($mid) - 1) == count($array))
					$array[] = "";

				// TODO Update these to look better
				// Display the graphics to the user
				
				echo "<table border='0' cellpadding='0' style='font-size:12pt;'>";
				echo "<tr align='center' valign='bottom'>";

				// Print the indexes numbers
				for($LCV = 0; $LCV < count($array); $LCV++)
					echo "<td width='52'>$LCV</td>";
					
				echo "</tr></table>";

				echo "<table border='1' cellpadding='5' style='font-size:18pt;'>";
				echo "<tr align='center'>";

				// Check if the line number != -1
				// The line number equals -1 when index where to insert the value to search for has been found
				if($lineNum != -1)
				{
					// Display array
					for($LCV = 0; $LCV < count($array); $LCV++)
					{
						if($done && $LCV == $mid && $lineNum != 8)
							echo "<td width='40' bgcolor=yellow>" . $array[$LCV] . "</td>";
						elseif($LCV >= $firstNew && $LCV <= $lastNew)
							echo "<td width='40' bgcolor=white>" . $array[$LCV] . "</td>";
						else
							echo "<td width='40' bgcolor=gray>" . $array[$LCV] . "</td>";
					}

					echo "</tr></table>";
						
					echo "<table border='0' cellpadding='0' style='font-size:12pt;'>";
					echo "<tr align='center' valign='top'>";
						
					// Display variable arrows
						
					if($done && $lineNum != 8)
					{
						// Output that the value has been found and output an arrow pointing to the index where it was found
						for($LCV = -1; $LCV < count($array)+1; $LCV++)
						{
							echo "<td width='52'>";
							if($LCV == $mid)
								echo "&uarr;<br/>Found the Value!<br/>";
							echo "&nbsp;<br/>";
							echo "</td>";
						}
					}
					else
					{
						// Display arrows pointing to the indexes of variables first, mid, and last
						for($LCV = -1; $LCV < count($array)+1; $LCV++)
						{
							echo "<td width='52'>";
							if($LCV == $firstNew)
								echo "&uarr;<br/>First<br/>";
							if($LCV == $lastNew)
								echo "&uarr;<br/>Last<br/>";
							if($midNew != -1)
							{
								if($LCV == $midNew)
								echo "&uarr;<br/>Mid<br/>";
							}
								
							echo "&nbsp;<br/>";
							echo "</td>";
						}
					}
				}
				else // Highlight the location of where the value to search should be inserted
				{
					// Display the highlighted index
					for($LCV = 0; $LCV < count($array); $LCV++)
					{
						if($LCV == (-($mid) - 1))
							echo "<td width='40' bgcolor=yellow>" . $array[$LCV] . "</td>";
						else
							echo "<td width='40' bgcolor=gray>" . $array[$LCV] . "</td>";
					}
					
					echo "</tr></table>";
						
					echo "<table border='0' cellpadding='0' style='font-size:12pt;'>";
					echo "<tr align='center' valign='top'>";
					
					// Display the arrow to where the search for value should be inserted
					for($LCV = 0; $LCV < count($array); $LCV++)
					{
						echo "<td width='52'>";
						if($LCV == (-($mid) - 1))
							echo "&uarr;<br/>Insert<br/>Here<br/>";

						echo "&nbsp;<br/></td>";
					}
				}

				echo "</tr></table>";
				
				
				// Display the comments based on the line number
				switch($lineNum)
				{
					case 0:
						echo "<p>When the function begins, four key parameters are passed to the function:<br/>The <b>sorted array of values</b> in which to search, the positions of the <b>First</b> and <b>Last</b> elements of the array, and the <b>key value</b><br/>to be searched for.  We are trying to determine if the value <b>$search</b> is in the array; if it isn't in the array, where in the array should<br/>it be inserted?</p>";
						echo "<p>In this example, <b>First</b> is set to index position $first, and <b>Last</b> is<br/>set to index position $last, allowing us to search the entire array.  Note that<br/><b>Last</b> should always point to the position of the <i>actual last element</i><br/>in which to search for the key.  It should never be equal to the number of<br/>elements in the array.</p>";
						break;
					case 1:
						// Check if the condition was true on line one to print the appropriate comment accordingly
						if($cond)
						{
							if($first == 0 && $last == count($array)-1)
								echo "<p>The first step in the function's algorithm is to verify that the First value ($first) is less than or equal to Last value ($last). Since<br/>this test is true in the case, we enter the code inside the while loop.</p>";
							else
								echo "<p>At the beginning of the while loop, First is compared to Last. Since First ($first) is still less than or equal to Last ($last), the while loop continues.</p>";
						}
						else
							echo "<p>At the beginning of the while loop, First is compared to Last. Since First ($first) is not less than or equal to Last ($last), the while loop exits.</p>";
						break;
					case 2:
						echo "<p>The first statement in the while loop calculates the mid-point between the <b>First</b> and <b>Last</b> index values, basically splitting the list of<br/>values in half.  In this example, the calculation is:</p><p style='padding-left:15;'><code>Mid = (First + Last) / 2 => $first + $last / 2 => $midNew</code></p><p>Remember that the index values are integers in this calculation, making it<br/>so the division will automatically truncate the value.</p><p>So in this example, the calculated <b>Mid</b> index is $midNew.</p>";
						break;
					case 3:
						echo "<p>You next make the comparison between the <b>key</b> value you're looking<br/>for (in this case $search) and the calculated <b>Mid</b> value (in this case $array[$mid]).</p>";
						if($cond)
							echo "<p>In this example, the <b>key</b> is greater than <b>Mid</b>, causing the<br/>comparison to succeed.  This causes the main clause of the if command to execute.</p>";
						else
							echo "<p>In this example, the <b>key</b> is less than <b>Mid</b>, causing the<br/>comparison to fail.  This causes the else clause of the if command to execute.</p>";
						break;
					case 4:
						echo "<p>The assignment changes the value of <b>First</b> to one more than <b>Mid</b>,<br/>netting the following result:</p>";
						echo "<p style='padding-left:15;'><code>First = $mid + 1 => $firstNew</code></p>";
						echo "<p>By setting the <b>First</b> index to $firstNew, this indicates that all of the values<br/>in the array that appear lower than $firstNew cannot possibly be the value we're<br/>interested in (since the array is sorted).  This is shown by graying out those indices.</p>";
						echo "<p>This concludes the processing of this pass in the while loop, so we return<br/>to the comparison in the while to see if the loop continues.</p>";
						break;
					case 5:
						echo "<p>This step compares the <b>key</b> to the <b>Mid</b> index value again.</p>";
						if($cond)
							echo "<p>In this example, the <b>key</b> is less the <b>Mid</b> index value, so the<br/>comparison succeeds, causing the resultant assignment to be made (shown in<br/>the next step).</p>";
						else
							echo "<p>In this example, the <b>key</b> is less than <b>Mid</b>, causing the<br/>comparison to fail.  This causes the else clause of the if command to execute.</p>";
						break;
					case 6:
						echo "<p>The assignment changes the value of <b>Last</b> to one less than <b>Mid</b>,<br/>netting the following result:</p>";
						echo "<p style='padding-left:15;'><code>Last = $mid - 1 => $lastNew</code></p>";
						echo "<p>By setting the <b>Last</b> index to $lastNew, this indicates that all of the values<br/>in the array that appear higher than $lastNew cannot possibly be the value we're<br/>interested in (since the array is sorted).  This is shown by graying out those indices.</p>";
						echo "<p>This concludes the processing of this pass in the while loop, so we return<br/>to the comparison in the while to see if the loop continues.</p>";
						break;
					case 7:
						echo "<p>After the <b>Mid</b> value is calculated, the comparsion of the <b>key</b> ($search)<br/>to the <b>Mid</b> index value ($array[$midNew]) shows they are the same.</p>";
						echo "<p>Since they are the same value, the second else clause in the if-else<br/>comparison sequence is executed, and <i>we have found the value we've been<br/>looking for!</i></p>";
						echo "<p>We therefore return from the function the indicated index value of <b>$midNew</b>.</p>";
						echo "<p>The positive returned value should indicate to the calling routine that<br/>the seached-for value was successfully found, and that it can be found in<br/>index position $midNew.</p>";
						break;
					case 8:
						echo "<p>Based on the result of the binary search algorithm, since the while<br/>loop has terminated because <b>Last</b> is no longer greater than or equal<br/>to <b>First</b>, we've determined that the value we'd like to find ($search) isn't<br/>in the array currently, so we'd like to add it into the array.</p>";
						break;
					case -1:
						$inv = -($mid);
						$index = $inv - 1;
						echo "<p>Since the binary search function returns a negative value ($mid in this case),<br/>this indicates that the <b>key</b> value searched for was not found, and we<br/>can determine the index where the value <i>should</i> be placed by calculating<br/>the inserting index using this formula:</p>";
						echo "<p style='padding-left:15;'><code>-<i>returnedValue</i> - 1 => -($mid) - 1 => $inv - 1 => $index</code></p>";
						echo "<p>Knowing where the new value is to be placed in the array to maintain the<br/>sorted order of the array, we need to physically move all the elements in the<br/>array starting at this position ($index) to the right, to allow room for the new<br/>value.</p>";
						break;
				}

				// Print the binary search algorithm code snippet with the current line highlighted
				if($lineNum != -1)
				{
					if($lineNum >= 7)
						printAlgo(intval($lineNum)+1);
					else
						printAlgo($lineNum);
				}

				// Pass variables to the next page
				if($done)
				{
					if($midNew < 0)
					{
						if($lineNum != -1)
						{
							echo "<p>We can determine the index location where the new value should be inserted<br/>using the calculation at the end of the algorithm:</p>";
							echo "<p style='padding-left:15;'><code>-(First + 1) => -($firstNew + 1) => -$firstNew - 1 => $midNew</code></p>";
							echo "<p>The returned value $midNew indicates that the value was not found in the array,<br/>and it also can be used to indicate exactly where this new value could be<br/>inserted into the array to maintain the array in sorted order.</p>";
								
							echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>";
							echo "<input type='hidden' name='search' value='" . $search . "'>";
							echo "<input type='hidden' name='array' value='" . serialize($array) . "'>";
							if(isset($_POST['insert']))
								echo "<input type='hidden' name='insert' value='true'>";
							echo "<input type='hidden' name='done' value='true'>";
							echo "<input type='hidden' name='first' value='" . $firstNew . "'>";
							echo "<input type='hidden' name='mid' value='" . $midNew . "'>";
							echo "<input type='hidden' name='last' value='" . $lastNew . "'>";
							echo "<input type='submit' value='Next Step in Simulation'>";
							echo "</form>";
						}
						else
						{
							// If insert was checked continue to insertion
							if(isset($_POST['insert']))
							{
								echo "<form action='insertionSimulation.php' method='POST'>";
								echo "<input type='hidden' name='array' value='" . serialize($array) . "'>";
								echo "<input type='hidden' name='insert' value='" . $search . "'>";
								echo "<input type='hidden' name='index' value='" . $index . "'>";
								echo "<input type='submit' value='Continue to Insertion'>";
								echo "</form>";
							}
							else
							{
								// If insert was not checked give option to re-search, insert, or return to start whole new simulation
								echo "<form action='binarySimulation.php' method='POST'>";
								echo "New Key to search for: <input type='text' size='3' name='search' value='" . intval($_POST['search']) . "'>";
								echo "<input type='hidden' name='array' value='" . serialize($array) . "'>";
								if(isset($_POST['insert']))
									echo "<input type='hidden' name='insert' value='true'>";
								echo "<input type='hidden' name='lineNum' value='0'>";
								echo "<input type='hidden' name='first' value='0'>";
								echo "<input type='hidden' name='mid' value='-1'>";
								echo "<input type='hidden' name='last' value='-2'>";
								echo "<input type='submit' value='Start a new Simulation'>";
								echo "</form>";

								echo "<form action='index.php' action='POST'>";
								echo "<input type='submit' value='Return to Simulator Selection Menu'>";
								echo "</form>";

								echo "<form action='insertionSimulation.php' method='POST'>";
								echo "<input type='hidden' name='array' value='" . serialize($array) . "'>";
								echo "<input type='hidden' name='insert' value='" . $search . "'>";
								echo "<input type='hidden' name='index' value='" . $first . "'>";
								echo "<input type='submit' value='Insert the Value'>";
								echo "</form>";
							}
						}
					}
					else
					{
						// If value was in array give option to re-search or to start whole new simulation
						echo "<form action='binarySimulation.php' method='POST'>";
						echo "New Key to search for: <input type='text' size='3' name='search' value='" . intval($_POST['search']) . "'>";
						echo "<input type='hidden' name='array' value='" . serialize($array) . "'>";
						if(isset($_POST['insert']))
							echo "<input type='hidden' name='insert' value='true'>";
						echo "<input type='hidden' name='lineNum' value='0'>";
						echo "<input type='hidden' name='first' value='0'>";
						echo "<input type='hidden' name='mid' value='-1'>";
						echo "<input type='hidden' name='last' value='-2'>";
						echo "<input type='submit' value='Start a new Simulation'>";
						echo "</form>";

						echo "<form action='index.php' action='POST'>";
						echo "<input type='submit' value='Return to Simulator Selection Menu'>";
						echo "</form>";
					}
				}
				else
				{
					// Continue to next step
					echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>";
					echo "<input type='hidden' name='search' value='" . $search . "'>";
					echo "<input type='hidden' name='array' value='" . serialize($array) . "'>";
					if(isset($_POST['insert']))
						echo "<input type='hidden' name='insert' value='true'>";
					echo "<input type='hidden' name='lineNum' value='". $lineNumNew . "'>";
					echo "<input type='hidden' name='first' value='" . $firstNew . "'>";
					echo "<input type='hidden' name='mid' value='" . $midNew . "'>";
					echo "<input type='hidden' name='last' value='" . $lastNew . "'>";
					echo "<input type='submit' value='Next Step in Simulation'>";
					echo "</form>";
				}
			}
			elseif(isset($_POST['search']) || isset($_POST['array']))
			{
				// Some of the required variables were not set, alert the user and begin debugging
				echo "<b><font color='red'>One or all of the required variables were not set properly.<br/><br/>You must return to the Simulator Selection Menu to get the error and restart</font><br/><br/>";
				echo "<form action='index.php' method='POST'>";

				if(isset($_POST['search']))
					echo "<input type='hidden' name='search' value='" . $_POST['search'] . "'>";

				if(isset($_POST['array']))
					echo "<input type='hidden' name='array' value='" . $_POST['array'] . "'>";

				echo "<input type='hidden' name='binDebug' value='true'>";
				echo "<input type='submit' value='Return to Simulator Selection Menu'>";
				echo "</form>";
			}
			else // Default case that no variables are being passed, assuming the user just went to this link so redirect them to the main form
				header("Location: index.php");

			// Prints a code snippet from the binary search algorithm with the line number highlighted
			function printAlgo($lineNum)
			{
				$output = array("int binarySearch (int sortedArray[], int First, int Last, int key) {<br/>", "  while (First &lt;= Last) {<br/>", "    int Mid = (First + Last) / 2;<br/>", "    if (key &gt; sortedArray[Mid])<br/>", "      First = Mid + 1;<br/>", "    else if (key &lt; sortedArray[Mid])<br/>", "      Last = Mid - 1;<br/>", "    else<br/>", "      return Mid;<br/>  }<br/>", "     return -(First + 1);<br/>}");
				$highlighted = array("int binarySearch (<span style='background-color: #FFFF00'>int sortedArray[], int First, int Last, int key</span>) {<br/>", "  <span style='background-color: #FFFF00'>while (First &lt;= Last)</span> {<br/>", "    <span style='background-color: #FFFF00'>int Mid = (First + Last) / 2;</span><br/>", "    <span style='background-color: #FFFF00'>if (key &gt; sortedArray[Mid])</span><br/>", "      <span style='background-color: #FFFF00'>First = Mid + 1;</span><br/>", "    <span style='background-color: #FFFF00'>else if (key &lt; sortedArray[Mid])</span><br/>", "      <span style='background-color: #FFFF00'>Last = Mid - 1;</span><br/>", "    <span style='background-color: #FFFF00'>else</span><br/>", "      <span style='background-color: #FFFF00'>return Mid;</span><br/>  }<br/>", "     <span style='background-color: #FFFF00'>return -(First + 1);</span><br/>}");
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
			?></td>
		</tr>
	</table>
</body>
</html>
