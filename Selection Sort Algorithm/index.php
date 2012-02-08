<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Selection Sort Algorithm Simulator</title>
</head>
<body bgcolor="gray">
<table border='1' cellpadding='20' align='center'>
<tr>
<td align='center'>
<?php
	$start=false;
	
	// TODO Add debugging here
	if(isset($_POST['run']) /* || isset($_POST['debug'] */)
	{
		$start = true;
		// TODO Check user input;  If there is an error or debugging is on, print the error and set start to false
		if(isset($_POST['run']))
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
			
			// Check if there were any errors with the user input
			if(!$start)
				echo "<b>Please review the selections below and resubmit the form</b>";
			
			echo "</font></p>";
		}
		/*
		elseif(isset($_POST['debug']))
		{
			
		}
		 */
	}
	
	if(!$start) // If there was an error or the user has not filled out the form yet show the form
	{	
		echo "<p><h1><font color='yellow'>This is still a work in progress!</font></h1></p>";
		
		echo "<p><h1>Introduction to Selection Sort Algorithm Simulator</h1></p>";
		
		echo '<p>This file was last updated: ' . date ('F d Y H:i:s.', getlastmod()) . "</p>";
		
		// TODO Add a description
		echo "<p><i>Description...</i></p>";
		
		// Start the main form
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
		
		echo "<input type='Submit' name='run' value='Run Simulator'>  <input type='reset' value='Reset'>";
		echo "</form>";
	}
	else // If the user has filled out the form and the input was properly entered
	{
		// TODO Show a confirmation screen that if accepted continues on to the simulation
	}
?>
</td>
</tr>
</table>
</body>
</html>