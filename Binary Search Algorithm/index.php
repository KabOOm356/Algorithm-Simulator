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

					// TODO Attempt to recover the session, by possible showing the user a form to get the info that was lost
					// Check if the array is set
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

					// Check if the number to search for was set
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
					// TODO Attempt to recover the session, by possible showing the user a form to get the info that was lost
					
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
				else // Check the user input for errors
				{
					echo "<p><font color=red>";

					// Check if the number of values in the array was set
					if(empty($_POST['num']))
					{
						$start = false;
						echo "Number of initial values in array is not set!<br/>";
					}

					// Check if the way the values are generated is set
					if(empty($_POST['values']))
					{
						$start = false;
						echo "Initial values type not set!<br/>";
					}
					elseif($_POST['values'] == 'random') // If the user wants the values to be generated randomly
					{
						// Check if the user has entered a number for the lower bound
						if(!is_numeric($_POST['lowerBound']))
						{
							echo "Random lower bound is not an integer!<br/>";
							$start = false;
						}
						
						// Check if the user has entered a number for the upper bound
						if(!is_numeric($_POST['upperBound']))
						{
							echo "Random upper bound is not an integer!<br/>";
							$start = false;
						}
						
						if(is_numeric($_POST['upperBound']) && is_numeric($_POST['lowerBound']))
						{
							// Calculate the difference between the two bounds
							$diff = abs($_POST['upperBound'] - $_POST['lowerBound']);
							
							if(is_numeric($_POST['num']))
							{
								// Check if it is possible to generate enough unique values for the array 
								if($diff < $_POST['num'])
								{
									echo "The difference between the upper bound and lower bound is $diff and is too small to generate a unique array with {$_POST['num']} values<br/>";
									$start = false;
								}
							}
						}
					}
					elseif($_POST['values'] == 'specified') // The user wants to use an array they enter
					{
						// Check if the user has specified an array
						if(empty($_POST['array']))
						{
							echo "Array values are not set!<br/>";
							$start = false;
						}
						else
						{
							// Split the array by each space
							$array = explode(" ", $_POST['array']);

							if(is_numeric($_POST['num']))
							{
								// Check if the user created an array that is the same size they specified
								if(count($array) != $_POST['num'])
								{
									echo "Number of values in the specified array do not equal the number of values expected!<br/>";
									echo "Number of values expected: " . $_POST['num'] . "<br/>";
									echo "Number of values recieved: " . count($array) . "<br/>";
									$start = false;
								}
								else
								{
									// Create an array that has only unique values in it from the array
									// Essentially removes the duplicates from the array
									$array_unique = array_unique($array);

									// Check if the unique array is still the same size as the user specified
									// Checks for duplicates
									if(count($array_unique) != $_POST['num'])
									{
										echo "There are duplicate values in the provided array!<br/>";
										$start = false;
										
										// Get the number of times a value occurs in the array
										$occurances = array_count_values($array);
										
										for($LCV = 0; $LCV < count($array); $LCV++)
										{
											// Check if the number of times a value occurs is more than once
											if($occurances[$array[$LCV]] > 1)
												echo "Position " . ($LCV+1) . " contains the duplicate number: {$array[$LCV]}<br/>";
										}
									}
									else
									{
										for($LCV = 0; $LCV < count($array_unique); $LCV++)
										{
											// Check if each value provided is a number
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

					// Check if the value to search for was set
					if(!isset($_POST['search']))
					{
						echo "The value to search for is not set!<br/>";
						$start = false;
					}
					elseif(!is_numeric($_POST['search'])) // Check if the value to search for is a number
					{
						echo "The value to search for is not a integer!<br/>";
						$start = false;
					}

					// Check if there were any errors with the user input
					if(!$start)
						echo "<b>Please review the selections below and resubmit the form</b>";
						
					echo "</font></p>";
				}
			}

			// If there were errors or the user has not seen the entry page, display the entry form
			if(!$start)
			{
				// Header 1
				echo "<p><h1>Introduction to Binary Search Algorithm Simulator</h1></p>";

				// Display the last time the file was updated
				echo '<p>This file was last updated: ' . date ('F d Y H:i:s.', getlastmod()) . "</p>";

				// A description of the Binary Search Algorithm
				echo "<p>The Binary Search Algorithm is a search algorithm that when given a sorted array, without duplicate entries, will return the index of the<br/>
			number to search for or the index of where to insert the number.  The algorithm functions by at each step selecting the middle value of the array then<br/>
			comparing the search value to that value.  Depending on if the value to search for is smaller or larger we can rule out that it is not in the lower or upper<br/>
			half of the array, successfully cutting out half of the array in one step.</p>";
				
				// Paragraph 2 of the description of the Binary Search Algorithm
				echo "<p>The Binary Search Algorithm is an algorithm that functions in worst case O(log(n)) time.  Making this algorithm much faster than a linear<br/>
			search on large amounts of data.  This is due to the property of the Binary Search Algorithmto split the array in half and shift the<br/>
			frame of search indecies at each step.  The best case scenario is if the value to search for is exacly in the middle of the array which<br/>
			would make the time complexity O(1), constant time complexity.</p>";
				
				// The purpose/intent of this simulation
				echo "<p>The purpose of this simulation is to help teach computer science students the Binary Search Algorithm.  This simulation will allow you to<br>
			select input data to feed into the simulation.  The simulation is completely dynamic and will operate differently according to the input data.<br>
			The simulator will run through all the steps of the Binary Search Algorithm with a visual and detailed comments of what is happening at each step.<br/>
			If the value that was searched for is not in the array then you will be given a choice to continue to an insertion simulator, to teach you how to<br/>
			properly insert the value into the array.</p>";
				
				// The main form
				echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>";
				echo "Specify number of initial values in array: ";
				
				// Check if there is a default value already passed
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
				else // No default passed.  Use project default
				{
					echo "<input type='radio' name='num' value='7'> 7 ";
					echo "<input type='radio' name='num' value='12' Checked> 12 ";
					echo "<input type='radio' name='num' value='17'> 17<br/><br/>";
				}

				// Check if there is a default value already passed
				if(isset($_POST['values']))
				{
					if($_POST['values'] == 'random')
					{
						echo "<input type='radio' name='values' value='random' Checked> Random numbers in this Range: ";

						// Check if a default value is passed
						if(isset($_POST['lowerBound']))
						{
							if(is_numeric($_POST['lowerBound']))
								echo "<input type='text' name='lowerBound' value='" . $_POST['lowerBound'] . "'> to ";
							else
								echo "<input type='text' name='lowerBound'> to ";
						}
						else
							echo "<input type='text' name='lowerBound'> to ";
						
						// Check if a default value is passed
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

						// Check if a default value is passed
						if(!empty($_POST['array']))
							echo "<input type='text' name='array' value='" . $_POST['array'] . "'><br/><br/>";
						else
							echo "<input type='text' name='array'><br/><br/>";
					}
					else // No default passed.  Use project default
					{
						echo "<input type='radio' name='values' value='random'> Random numbers in this Range: ";

						// Check if a default value is passed
						if(isset($_POST['lowerBound']))
						{
							if(is_numeric($_POST['lowerBound']))
								echo "<input type='text' name='lowerBound' value='" . $_POST['lowerBound'] . "'> to ";
							else
								echo "<input type='text' name='lowerBound'> to ";
						}
						else
							echo "<input type='text' name='lowerBound'> to ";
						
						// Check if a default value is passed
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

						// Check if a default value is passed
						if(!empty($_POST['array']))
							echo "<input type='text' name='array' value='" . $_POST['array'] . "'><br/><br/>";
						else
							echo "<input type='text' name='array'><br/><br/>";
					}
				}
				else
				{
					echo "<input type='radio' name='values' value='random' Checked> Random numbers in this Range: ";
					
					// Check if a default value is passed
					if(isset($_POST['lowerBound']))
					{
						if(is_numeric($_POST['lowerBound']))
							echo "<input type='text' name='lowerBound' value='" . $_POST['lowerBound'] . "'> to ";
						else
							echo "<input type='text' name='lowerBound'> to ";
					}
					else
						echo "<input type='text' name='lowerBound'> to ";

					// Check if a default value is passed
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
					
					// Check if a default value is passed
					if(!empty($_POST['array']))
						echo "<input type='text' name='array' value='" . $_POST['array'] . "'><br/><br/>";
					else
						echo "<input type='text' name='array'><br/><br/>";
				}

				// Check if a default value is passed
				if(isset($_POST['insert']))
					echo "<input type='checkbox' name='insert' Checked> Insert searched-for values that aren't already in the array<br/><br/>";
				else
					echo "<input type='checkbox' name='insert'> Insert searched-for values that aren't already in the array<br/><br/>";

				// Check if a default value is passed
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
			else // The user has submitted the form and all the data needed contained no errors.  Show a confirmation screen before continuing to the simulation
			{
				// Header 1
				echo "<h1>Input Summary</h1>";
				
				// Display the specified size of the array
				echo "Size of array: " . $_POST['num'] . "<br/><br/>";
				
				// If the user specified to generate a random array
				if($_POST['values'] == 'random')
				{
					// Display that the user wants a random array
					echo "Array Generation: Random<br/>";
					
					// Display the lower bound of the random values in the array
					echo "Lower Bound: " . intval($_POST['lowerBound']) . "<br/>";
					
					// Display the upper bound of the random values in the array
					echo "Upper Bound: " . intval($_POST['upperBound']) . "<br/>";
					
					// Get the difference between the two bounds
					$diff = abs($_POST['upperBound'] - $_POST['lowerBound']);
					
					// Create an array
					$occurances = array();
					
					// Initialize the array to use with values that are out side of the bounds, in this case (user supplied lower bound - 1)
					$array = array_fill(0, intval($_POST['num']), intval($_POST['lowerBound'])-1);
					
					// Check if the difference between the upper and lower bounds exactly equals the size of the array
					// This was added to decrease the server load instead of it going into a 'guess and check' algorithm that is used otherwise
					if($diff == $_POST['num'])
					{
						// If the above statement is true then just fill the array with the values that range from the lower bound to the upper bound
						// This array is already sorted so hopefully it will decrease server load 
						for($LCV = 0; $LCV < $_POST['num']; $LCV++)
							$array[$LCV] = intval($_POST['lowerBound'])+$LCV;
					}
					else
					{
						// Run a loop to insert a unique value into each index
						for($LCV = 0; $LCV <  intval($_POST['num']); $LCV++)
						{
							$inserted = false;
							
							// Keep running until a value is inserted
							while(!$inserted)
							{
								// Get a random number between the lower and upper bound
								$rand = rand(intval($_POST['lowerBound']), intval($_POST['upperBound']));

								// Check if the number is already in the array, thus making it not unique
								if(!isset($occurances[$rand]))
								{
									// The value was unique and inserted into the array 
									$inserted = true;
									$array[$LCV] = $rand;
									$occurances[$rand] = 1;
								}
							}
						}
					}
					
					// Sort the array when done
					sort($array);
						
					echo "<br/>Array: ";
					
					// Display the array to the user
					for($LCV = 0; $LCV < count($array); $LCV++)
					{
						echo $array[$LCV];
						if($LCV != (count($array)-1))
							echo ", ";
					}
				}
				else // The user specified an array
				{
					// Split the string array by spaces
					$array = explode(" ", $_POST['array']);
					
					echo "Array Generation: User Specified<br/>";
					echo "Array: ";
					
					// Convert the array into integers
					for($LCV = 0; $LCV < count($array); $LCV++)
						$array[$LCV] = intval($array[$LCV]);
					
					// Sort the array
					sort($array);
					
					// Display the array to the user
					for($LCV = 0; $LCV < count($array); $LCV++)
					{
						echo $array[$LCV];
						if($LCV != (count($array)-1))
							echo ", ";
					}
				}

				// Display if the user wanted to automatically progress to the insertion simulator if the value does not exist
				echo "<br/><br/>Insert value if it does not exist in the array: ";

				if(isset($_POST['insert']))
					echo "True<br/><br/>";
				else
					echo "False<br/><br/>";
				
				// Display the value to search the array for
				echo "Value to search for: " . intval($_POST['search']);

				echo "<br/><br/>";

				// The form that allows the user to return to the main form to change some input
				// NOTE: This form passes the already entered values back to the main form
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

				// If the user wanted to generate a new array
				if($_POST['values'] == 'random')
				{
					// This form allows the user to regenerate a new random array
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

				// This form will progress the user to the binary search simulator page
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
