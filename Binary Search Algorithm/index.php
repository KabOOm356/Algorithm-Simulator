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
			$start=false;
			if(isset($_POST['run']) || isset($_POST['binDebug']) || isset($_POST['insDebug']))
			{
				$start=true;

				// For debugging the binary search algorithm page
				if(isset($_POST['binDebug']))
				{
					$start = false;

					echo "<font color='red'><b>The following errors occurred during the binary search simulation:</b><br/>";

					if(isset($_POST['array']))
					{
						$_POST['values'] = "specified";
						$_POST['num'] = count(unserialize($_POST['array']));

						$array = unserialize($_POST['array']);
						$arrayString = "";

						foreach($array as &$val)
							$arrayString = $arrayString . $val . " ";

						$arrayString = trim($arrayString);
							
						$_POST['array'] = $arrayString;
					}
					else
					echo "The array was not set!<br/>";

					if(isset($_POST['search']))
					{
						if(!is_numeric($_POST['search']))
							echo "The search value was not numeric!<br/>";
					}
					else
						echo "The search value was not set!<br/>";

					echo "</font>";
				}
				elseif(isset($_POST['insDebug'])) // For debugging the insertion page
				{
					$start = false;

					echo "<font color='red'><b>The following errors occurred during the insertion simulation:</b><br/>";

					if(isset($_POST['array']))
						$_POST['num'] = count(unserialize($_POST['array']));
					else
						echo "The array was not set!<br/>";

					if(isset($_POST['insert']))
					{
						if(!is_numeric($_POST['insert']))
						echo "The insert value was not numeric!<br/>";
					}
					else
						echo "The insert value was not set!<br/>";

					if(isset($_POST['index']))
					{
						if(!is_numeric($_POST['index']))
						echo "The index value was not numeric!<br/>";
					}
					else
						echo "The index value was not set!<br/>";

					echo "</font>";
				}
				else // The entrance for the index of the project
				{
					echo "<p><font color=red>";

					if(empty($_POST['num']))
					{
						$start = false;
						echo "Number of initial values in array is not set!<br/>";
					}

					if(empty($_POST['values']))
					{
						$start = false;
						echo "Initial values type not set!<br/>";
					}
					elseif($_POST['values'] == 'random')
					{
						if(!is_numeric($_POST['lowerBound']))
						{
							echo "Random lower bound is not an integer!<br/>";
							$start = false;
						}
							
						if(!is_numeric($_POST['upperBound']))
						{
							echo "Random upper bound is not an integer!<br/>";
							$start = false;
						}
							
						if(is_numeric($_POST['upperBound']) && is_numeric($_POST['lowerBound']))
						{
							$diff = abs($_POST['upperBound'] - $_POST['lowerBound']);

							if(is_numeric($_POST['num']))
							{
								if($diff < $_POST['num'])
								{
									echo "The difference between the upper bound and lower bound is $diff and is too small to generate a unique array with {$_POST['num']} values<br/>";
									$start = false;
								}
							}
						}
					}
					elseif($_POST['values'] == 'specified')
					{
						if(empty($_POST['array']))
						{
							echo "Array values are not set!<br/>";
							$start = false;
						}
						else
						{
							$array = explode(" ", $_POST['array']);

							if(is_numeric($_POST['num']))
							{
								if(count($array) != $_POST['num'])
								{
									echo "Number of values in the specified array do not equal the number of values expected!<br/>";
									echo "Number of values expected: " . $_POST['num'] . "<br/>";
									echo "Number of values recieved: " . count($array) . "<br/>";
									$start = false;
								}
								else
								{
									$array_unique = array_unique($array);

									if(count($array_unique) != $_POST['num'])
									{
										echo "There are duplicate values in the provided array!<br/>";
										$start = false;
											
										$occurances = array_count_values($array);
											
										for($LCV = 0; $LCV < count($array); $LCV++)
										{
											if($occurances[$array[$LCV]] > 1)
												echo "Position " . ($LCV+1) . " contains the duplicate number: {$array[$LCV]}<br/>";
										}
									}
									else
									{
										for($LCV = 0; $LCV < count($array_unique); $LCV++)
										{
											if(!is_numeric($array_unique[$LCV]))
											{
												echo "The value at index " . ($LCV+1) . " of the provided array is not a number!<br/>";
												$start = false;
											}
										}
									}
								}
							}
						}
					}
					else
					{
						echo "Variable values is not an expected value<br/>";
						$start = false;
					}

					if(!isset($_POST['search']))
					{
						echo "The value to search for is not set!<br/>";
						$start = false;
					}
					elseif(!is_numeric($_POST['search']))
					{
						echo "The value to search for is not a integer!<br/>";
						$start = false;
					}

					if(!$start)
						echo "<b>Please review the selections below and resubmit the form</b>";
						
					echo "</font></p>";
				}
			}

			if(!$start)
			{
				echo "<p><h1>Introduction to Binary Search Algorithm Simulator</h1></p>";

				echo '<p>This file was last updated: ' . date ('F d Y H:i:s.', getlastmod()) . "</p>";

				echo "<p>The Binary Search Algorithm is a search algorithm that when given a sorted array, without duplicate entries, will return the index of the<br/>
			number to search for or the index of where to insert the number.  The algorithm functions by at each step selecting the middle value of the array then<br/>
			comparing the search value to that value.  Depending on if the value to search for is smaller or larger we can rule out that it is not in the lower or upper<br/>
			half of the array, successfully cutting out half of the array in one step.</p>";
					
				echo "<p>The Binary Search Algorithm is an algorithm that functions in worst case O(log(n)) time.  Making this algorithm much faster than a linear<br/>
			search on large amounts of data.  This is due to the property of the Binary Search Algorithmto split the array in half and shift the<br/>
			frame of search indecies at each step.  The best case scenario is if the value to search for is exacly in the middle of the array which<br/>
			would make the time complexity O(1), constant time complexity.</p>";
					
				echo "<p>The purpose of this simulation is to help teach computer science students the Binary Search Algorithm.  This simulation will allow you to<br>
			select input data to feed into the simulation.  The simulation is completely dynamic and will operate differently according to the input data.<br>
			The simulator will run through all the steps of the Binary Search Algorithm with a visual and detailed comments of what is happening at each step.<br/>
			If the value that was searched for is not in the array then you will be given a choice to continue to an insertion simulator, to teach you how to<br/>
			properly insert the value into the array.</p>";
					
				echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>";
				echo "Specify number of initial values in array: ";
				if(!empty($_POST['num']))
				{
					switch($_POST['num'])
					{
						case 7:
							echo "<input type='radio' name='num' value='7' Checked> 7 ";
							echo "<input type='radio' name='num' value='12'> 12 ";
							echo "<input type='radio' name='num' value='17'> 17<br/><br/>";
							break;
						case 17:
							echo "<input type='radio' name='num' value='7'> 7 ";
							echo "<input type='radio' name='num' value='12'> 12 ";
							echo "<input type='radio' name='num' value='17' Checked> 17<br/><br/>";
							break;
						default:
							echo "<input type='radio' name='num' value='7'> 7 ";
						echo "<input type='radio' name='num' value='12' Checked> 12 ";
						echo "<input type='radio' name='num' value='17'> 17<br/><br/>";
						break;
					}
				}
				else
				{
					echo "<input type='radio' name='num' value='7'> 7 ";
					echo "<input type='radio' name='num' value='12' Checked> 12 ";
					echo "<input type='radio' name='num' value='17'> 17<br/><br/>";
				}

				if(isset($_POST['values']))
				{
					if($_POST['values'] == 'random')
					{
						echo "<input type='radio' name='values' value='random' Checked> Random numbers in this Range: ";

						if(isset($_POST['lowerBound']))
						{
							if(is_numeric($_POST['lowerBound']))
								echo "<input type='text' name='lowerBound' value='" . $_POST['lowerBound'] . "'> to ";
							else
								echo "<input type='text' name='lowerBound'> to ";
						}
						else
							echo "<input type='text' name='lowerBound'> to ";
							
						if(isset($_POST['upperBound']))
						{
							if(is_numeric($_POST['upperBound']))
								echo "<input type='text' name='upperBound' value='" . $_POST['upperBound'] . "'> , or<br/><br/>";
							else
								echo "<input type='text' name='upperBound'> , or<br/><br/>";
						}
						else
							echo "<input type='text' name='upperBound'> , or<br/><br/>";

						echo "<input type='radio' name='values' value='specified'> Specific numeric values:";

						if(!empty($_POST['array']))
							echo "<input type='text' name='array' value='" . $_POST['array'] . "'><br/><br/>";
						else
							echo "<input type='text' name='array'><br/><br/>";
					}
					else
					{
						echo "<input type='radio' name='values' value='random'> Random numbers in this Range: ";

						if(isset($_POST['lowerBound']))
						{
							if(is_numeric($_POST['lowerBound']))
								echo "<input type='text' name='lowerBound' value='" . $_POST['lowerBound'] . "'> to ";
							else
								echo "<input type='text' name='lowerBound'> to ";
						}
						else
							echo "<input type='text' name='lowerBound'> to ";
							
						if(isset($_POST['upperBound']))
						{
							if(is_numeric($_POST['upperBound']))
								echo "<input type='text' name='upperBound' value='" . $_POST['upperBound'] . "'> , or<br/><br/>";
							else
								echo "<input type='text' name='upperBound'> , or<br/><br/>";
						}
						else
							echo "<input type='text' name='upperBound'> , or<br/><br/>";

						echo "<input type='radio' name='values' value='specified' Checked> Specific numeric values:";

						if(!empty($_POST['array']))
							echo "<input type='text' name='array' value='" . $_POST['array'] . "'><br/><br/>";
						else
							echo "<input type='text' name='array'><br/><br/>";
					}
				}
				else
				{
					echo "<input type='radio' name='values' value='random' Checked> Random numbers in this Range: ";
						
					if(isset($_POST['lowerBound']))
					{
						if(is_numeric($_POST['lowerBound']))
							echo "<input type='text' name='lowerBound' value='" . $_POST['lowerBound'] . "'> to ";
						else
							echo "<input type='text' name='lowerBound'> to ";
					}
					else
						echo "<input type='text' name='lowerBound'> to ";

					if(isset($_POST['upperBound']))
					{
						if(is_numeric($_POST['upperBound']))
							echo "<input type='text' name='upperBound' value='" . $_POST['upperBound'] . "'> , or<br/><br/>";
						else
							echo "<input type='text' name='upperBound'> , or<br/><br/>";
					}
					else
						echo "<input type='text' name='upperBound'> , or<br/><br/>";
						
					echo "<input type='radio' name='values' value='specified'> Specific numeric values:";
						
					if(!empty($_POST['array']))
						echo "<input type='text' name='array' value='" . $_POST['array'] . "'><br/><br/>";
					else
						echo "<input type='text' name='array'><br/><br/>";
				}

				if(isset($_POST['insert']))
					echo "<input type='checkbox' name='insert' Checked> Insert searched-for values that aren't already in the array<br/><br/>";
				else
					echo "<input type='checkbox' name='insert'> Insert searched-for values that aren't already in the array<br/><br/>";

				if(isset($_POST['search']))
				{
					if(is_numeric($_POST['search']))
						echo "Value to initially search for: <input type='text' name='search' value='" . $_POST['search'] . "'><br/><br/>";
					else
						echo "Value to initially search for: <input type='text' name='search'><br/><br/>";
				}
				else
					echo "Value to initially search for: <input type='text' name='search'><br/><br/>";

				echo "<input type='hidden' name='currentLine' value='0'>";
				echo "<input type='Submit' name='run' value='Run Simulator'>  <input type='reset' value='Reset'>";
				echo "</form>";
			}
			else
			{
				echo "<h1>Input Summary</h1>";
				echo "Size of array: " . $_POST['num'] . "<br/><br/>";
				if($_POST['values'] == 'random')
				{
					echo "Array Generation: Random<br/>";
					echo "Lower Bound: " . intval($_POST['lowerBound']) . "<br/>";
					echo "Upper Bound: " . intval($_POST['upperBound']) . "<br/>";
						
					$diff = abs($_POST['upperBound'] - $_POST['lowerBound']);
						
					$occurances = array();
						
					$array = array_fill(0, intval($_POST['num']), intval($_POST['lowerBound'])-1);
						
					if($diff == $_POST['num'])
					{
						for($LCV = 0; $LCV < $_POST['num']; $LCV++)
						$array[$LCV] = intval($_POST['lowerBound'])+$LCV;
					}
					else
					{
						for($LCV = 0; $LCV <  intval($_POST['num']); $LCV++)
						{
							$inserted = false;
								
							while(!$inserted)
							{
								$rand = rand(intval($_POST['lowerBound']), intval($_POST['upperBound']));

								if(!isset($occurances[$rand]))
								{
									$inserted = true;
									$array[$LCV] = $rand;
									$occurances[$rand] = 1;
								}
							}
						}
					}
						
					sort($array);
						
					echo "<br/>Array: ";
						
					for($LCV = 0; $LCV < count($array); $LCV++)
					{
						echo $array[$LCV];
						if($LCV != (count($array)-1))
							echo ", ";
					}
				}
				else
				{
					$array = explode(" ", $_POST['array']);
					echo "Array Generation: User Specified<br/>";
					echo "Array: ";
					
					for($LCV = 0; $LCV < count($array); $LCV++)
						$array[$LCV] = intval($array[$LCV]);
						
					sort($array);
						
					for($LCV = 0; $LCV < count($array); $LCV++)
					{
						echo $array[$LCV];
						if($LCV != (count($array)-1))
							echo ", ";
					}
				}

				echo "<br/><br/>Insert value if it does not exist in the array: ";

				if(isset($_POST['insert']))
					echo "True<br/><br/>";
				else
					echo "False<br/><br/>";
					
				echo "Value to search for: " . intval($_POST['search']);

				echo "<br/><br/>";

				echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>";
				echo "<input type='hidden' name='search' value='" . intval($_POST['search']) . "'>";
				echo "<input type='hidden' name='num' value='" . intval($_POST['num']) . "'>";
				echo "<input type='hidden' name='array' value='" . $_POST['array'] . "'>";
				echo "<input type='hidden' name='values' value='" . $_POST['values'] . "'>";
				echo "<input type='hidden' name='upperBound' value='" . intval($_POST['upperBound']) . "'>";
				echo "<input type='hidden' name='lowerBound' value='" . intval($_POST['lowerBound']) . "'>";
				if(isset($_POST['insert']))
					echo "<input type='hidden' name='insert' value='true'>";
				echo "<input type='submit' value='Return'>";
				echo "</form>";

				if($_POST['values'] == 'random')
				{
					echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>";
					echo "<input type='hidden' name='search' value='" . intval($_POST['search']) . "'>";
					echo "<input type='hidden' name='num' value='" . $_POST['num'] . "'>";
					echo "<input type='hidden' name='array' value='" . $_POST['array'] . "'>";
					echo "<input type='hidden' name='values' value='" . $_POST['values'] . "'>";
					echo "<input type='hidden' name='upperBound' value='" . $_POST['upperBound'] . "'>";
					echo "<input type='hidden' name='lowerBound' value='" . $_POST['lowerBound'] . "'>";
					if(isset($_POST['insert']))
						echo "<input type='hidden' name='insert' value='true'>";
					echo "<input type='hidden' name='run' value='true'>";
					echo "<input type='submit' value='Regenerate Array'>";
					echo "</form>";
				}

				echo "<form action='binarySimulation.php' method='POST'>";
				echo "<input type='hidden' name='search' value='" . intval($_POST['search']) . "'>";
				echo "<input type='hidden' name='array' value='" . serialize($array) . "'>";
				if(isset($_POST['insert']))
					echo "<input type='hidden' name='insert' value='true'>";
				echo "<input type='hidden' name='lineNum' value='0'>";
				echo "<input type='hidden' name='first' value='0'>";
				echo "<input type='hidden' name='mid' value='-1'>";
				echo "<input type='hidden' name='last' value='-2'>";
				echo "<input type='submit' value='Run Simulation'>";
				echo "</form>";
			}
			?></td>
		</tr>
	</table>
</body>
</html>
