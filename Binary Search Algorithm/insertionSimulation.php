<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Binary Search Algorithm Simulator</title>
<script src="../res/javascript.js"></script>
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js'></script>
<script type='text/javascript' src='../js/jquery.easing.1.2.js'></script>
<script type='text/javascript' src='../js/jquery.circulate.js'></script>
<link rel="stylesheet" type="text/css" href="../css/SimCss.css" />
</head>
<body bgcolor="gray"  onkeypress="javascript: onKey(event);">
	<table border='1' cellpadding='20' align='center'class="alpha60">
		<tr>
			<td align='center'>
			<?php
			if(isset($_POST['array']) && isset($_POST['insert']) && is_numeric($_POST['insert']) && isset($_POST['index']))
			{
				// Heading 1
				echo "<p><h1><b>Insertion Simulator</b></h1></p>";

				// Display the last time the file was updated
				echo '<p>This file was last updated: ' . date ('F d Y H:i:s.', getlastmod()) . "</p>";

				$done = false;

				// The array
				$array = unserialize($_POST['array']);

				// The value to insert
				$insert = intval($_POST['insert']);

				// The index to insert the value into
				$index = intval($_POST['index']);

				// The augmented array
				if(isset($_POST['augarray']))
					$aArray = unserialize($_POST['augarray']);
				elseif($index != count($array)-1 || $array[$index] != "")
				{
					$aArray = $array;
					$aArray[] = "";
				}
				else
					$aArray = $array;

				if(isset($_POST['currentIndex']))
					$currentIndex = $_POST['currentIndex'];
				else
					$currentIndex = ($index);

				if($index == count($aArray)-1)
				{
					$currentIndex = $index-1;
					$done = true;
				}
				elseif($currentIndex != -1)
					$aArray[$currentIndex+1] = $aArray[$currentIndex];
					
				if($index == $currentIndex+1 && isset($_POST['correct']))
					$done = true;
					
				if($done)
					$aArray[$index] = $insert;

				echo "<p>Inserting the value $insert in index position $index:</p>";

				// Print the comments that appear above the array
				if(isset($_POST['correct']))
				{
					if($done)
					{
						echo "<p>Finally, the new value ($insert) is placed in index position $index, and it has<br/>been successfully inserted into the array in the proper sorted location.</p>";
					}
					elseif($currentIndex == $index)
					{
						echo "<p>The process continues moving the values down in the array, until we reach<br/>the location (index position $index) where the new value ($insert) is to be added.</p>";
					}
					elseif($currentIndex == count($array)-1)
					{
						echo "<p>To move the values over to leave room for the newly-inserted value $insert,<br/>
					we have to start at the end of the array and copy the values one at a time to the next index<br/>
					position, and the move downward, repeating the process, until we reach the index position of<br/>
					where the value $insert should be added.</p>";
						echo "<p>In this first step in the loop, we copy the value stored in index $currentIndex (" . $aArray[$currentIndex] . ")<br/>to the new index " . ($currentIndex+1) . ".</p>";
					}
					else
					{
						if($currentIndex == count($array)-2)
							echo "<p>The process is repeated here with the next lower index.  As you can see, the<br/>index value is copied to the next position each time through a loop.</p>";

						echo "<p>In this case, copy index $currentIndex (" . $aArray[$currentIndex] . ") to index " . ($currentIndex+1) . ".</p>";
					}
				}
				else
				{
					if($index == count($aArray)-1)
						echo "<p>In this example add an index to the end of the array ($index) and then insert the value ($insert) into it.</p>";
					elseif($index == count($aArray)-2)
					{
						// really didn't want to do this but it's a quick fix
						$_POST['correct'] = 1;
						echo "<p>In this example add an index to the end of the array (" . (count($aArray)-1) . ") and move the value (" . $aArray[$index] . ") in index ($index) into it.</p>";
					}
					elseif($currentIndex == $index)
					{
						echo "<p>For the moving process to be successful, we have to move the top element<br/>(position $currentIndex) to the next position (" . ($currentIndex+1) . "), and then move down in the array,";
						echo "<br/>rather then moving from the lowest point ($index) up.  If we were to move the elements<br/>left-to-right, the values would be copying on top of the old values, losing";
						echo "<br/>the old values as we went, similar to the following:</p>";
					}
					else
					{
						echo "<p>As you can see, as we continue to copy the elements in the array, we<br/>destroy all the values in the process.</p>";
					}
				}

				// Print the array

				echo "<table border='0' cellpadding='0' style='font-size:12pt;'>";
				echo "<tr align='center' valign='bottom'>";

				for($LCV = 0; $LCV < count($aArray); $LCV++)
					echo "<td width='57'>$LCV</td>";
					
				echo "</tr></table>";

				echo "<table border='0' cellpadding='5' style='font-size:18pt;'>";
				echo "<tr align='center'>";

				for($LCV = 0; $LCV < count($aArray); $LCV++)
				{
					if(!isset($_POST['correct']) && $index != count($aArray)-2)
					{
						if($LCV < $index)
							echo "<td width='40' id='tableTD3'>" . $aArray[$LCV] . "</td>";
						elseif($LCV == $index)
							echo "<td width='40' id='tableTD1'>" . $aArray[$LCV] . "</td>";
						elseif($LCV <= $currentIndex+1)
							echo "<td width='40' id='tableTD4'>" . $aArray[$LCV] . "</td>";
						else
							echo "<td width='40' id='tableTD2'>" . $aArray[$LCV] . "</td>";
					}
					else
					{
						if($LCV < $index)
							echo "<td width='40' id='tableTD3'>" . $aArray[$LCV] . "</td>";
						elseif($LCV == $index)
							echo "<td width='40' id='tableTD1'>" . $aArray[$LCV] . "</td>";
						elseif($LCV == $currentIndex)
							echo "<td width='40' id='tableTD6'>" . $aArray[$LCV] . "</td>";
						elseif($LCV > $currentIndex)
							echo "<td width='40' id='tableTD5'>" . $aArray[$LCV] . "</td>";
						else
							echo "<td width='40' id='tableTD2'>" . $aArray[$LCV] . "</td>";
					}
				}
					
				echo "</tr></table>";

				echo "<table border='0' cellpadding='0' style='font-size:12pt;'>";
				echo "<tr align='center' valign='top'>";

				for($LCV = 0; $LCV < count($aArray); $LCV++)
				{
					if($done && ($LCV == $currentIndex+2 || $LCV == $currentIndex+1))
					{
						if(isset($_POST['correct']) && $LCV == $currentIndex+2)
						{
							echo "<td width='56'>&uarr;<br/>Insert<br/>Here<br/></td>";
							if($index == 0)
								echo "<td width='56'>&nbsp;<br/></td>";
						}
						elseif(!isset($_POST['correct']) && $LCV == $currentIndex+1)
						{
							echo "<td width='56'>&nbsp;<br/></td><td width='56'>&nbsp;<br/></td>";
							echo "<td width='56'>&uarr;<br/>Insert<br/>Here<br/></td>";
						}

						echo "<td width='56'>&nbsp;<br/></td>";
					}
					elseif($LCV == $currentIndex+1 && !$done)
					{
						echo "<td width='56' colspan='2' align='center'><img src='img/moveRight.png'></td>";
					}
					else
					{
						if($LCV != $currentIndex)
							echo "<td width='56'>&nbsp;<br/></td>";	
					}
				}

				echo "</tr></table>";

				// Print the comments that appear below the array
				if(isset($_POST['correct']))
				{
					if($done)
					{
						echo "<p>The code to insert the new value into the array looks like the following:</p>";
						echo "<table><tr><td>";
						echo "<pre>";
						echo "for (int pos=<i>lastPositionInArray</i>; pos >= <i>insertLocation</i>; --pos)<br/>";
						echo "  <i>array</i>[pos+1] = <i>array</i>[pos];<br/>";
						echo "<i>array</i>[<i>insertLocation</i>] = <i>insertedValue</i>;<br/>";
						echo "</pre>";
						echo "</td></tr></table><br /><br />";
					}
				}
				else
				{
					if($index != count($array)-1 && $currentIndex == $index)
						echo "<p>When this copy takes place, the value " . $array[$index+1] . " is replaced by " . $array[$index] . ", losing the<br/>value " . $array[$index+1] . " forever.</p>";
					elseif($index != count($array)-1)
						echo "<p>Instead, we clearly have to process the elements from the top down.</p>";
				}

				if(isset($_POST['correct']))
					$currentIndex--;
				else
					$currentIndex++;
					
				if(!$done)
				{
					// Next step form
					echo "<form name='form' action='" . $_SERVER['PHP_SELF'] . "' method='POST'>";
					echo "<input type='hidden' name='array' value='" . serialize($array) . "'>";
					echo "<input type='hidden' name='index' value='" . $index . "'>";
					if(isset($_POST['correct']))
					{
						echo "<input type='hidden' name='correct' value='true'>";
						echo "<input type='hidden' name='augarray' value='" . serialize($aArray) . "'>";
					}
					elseif($currentIndex < $index + 2 && $currentIndex != count($aArray)-1)
					{
						echo "<input type='hidden' name='augarray' value='" . serialize($aArray) . "'>";
					}
					else
					{
						echo "<input type='hidden' name='correct' value='true'>";
						$currentIndex = count($array)-1;
					}
					echo "<input type='hidden' name='currentIndex' value='" . $currentIndex . "'>";
					echo "<input type=\"hidden\" name=\"hasPrevious\" value=\"true\">";
					echo "<input type='hidden' name='insert' value='" . $insert . "'>";
					echo "<input type='submit' value='Next step in Simulation'>";
					echo "</form>";
					
					// Form to go to the previous step
					if(isset($_POST['hasPrevious']))
					{
						echo "<form>";
						echo "<input type=\"button\" value=\"Previous Step in Simulation\" onClick=\"javascript: previousPage();\">";
						echo "</form>";
					}
				}
				else
				{
					// User Selects to start a new Simulation
					echo "<form action='binarySimulation.php' method='POST'>";
					echo "New Key to search for: <input type='text' size='3' name='search' value='" . $insert . "'>";
					echo "<input type='hidden' name='array' value='" . serialize($aArray) . "'>";
					echo "<input type='hidden' name='lineNum' value='0'>";
					echo "<input type='hidden' name='first' value='0'>";
					echo "<input type='hidden' name='mid' value='-1'>";
					echo "<input type='hidden' name='last' value='-2'>";
					echo "<input type='submit' value='Start a new Simulation'>";
					echo "</form>";
					
					// Form to go to previous step
					echo "<form>";
					echo "<input type=\"button\" value=\"Previous Step in Simulation\" onClick=\"javascript: previousPage();\">";
					echo "</form>";
					
					// Form to go to the Binary Search Simulation menu
					echo "<form action='../index.php' action='POST'>";
					echo "<input type='submit' value='Return to Simulator Selection Menu'>";
					echo "</form>";
				}
			}
			elseif(isset($_POST['array']) || isset($_POST['insert']) || isset($_POST['index']))
			{
				// Some of the required variables were not set, alert the user and begin debugging
				echo "<b><font color='red'>One or all of the required variables were not set properly.<br/><br/>You must return to the Simulator Selection Menu to get the error and restart</font><br/><br/>";
				echo "<form action='index.php' method='POST'>";
				if(isset($_POST['index']))
					echo "<input type='hidden' name='index' value='" . $_POST['index'] . "'>";
				if(isset($_POST['array']))
					echo "<input type='hidden' name='array' value='" . $_POST['array'] . "'>";
				if(isset($_POST['insert']))
					echo "<input type='hidden' name='insert' value='" . $_POST['insert'] . "'>";
				echo "<input type='hidden' name='insDebug' value='true'>";
				echo "<input type='submit' value='Return to Simulator Selection Menu'>";
				echo "</form>";
			}
			else // Default case that no variables are being passed, assuming the user just went to this link so redirect them to the main form
				header("Location: index.php");
			?></td>
		</tr>
	</table>
</body>
</html>
