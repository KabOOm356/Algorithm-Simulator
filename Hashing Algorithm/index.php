<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Hashing Algorithm Simulator</title>
</head>
<body bgcolor="gray">
<table border='1' cellpadding='20' align='center'>
<tr>
<td align='center'>
<h1><font color='yellow'>This is still a work in progress!</font></h1>
<?php
// TODO Remove this when done debugging
ini_set("display_errors", 1);

$start=false;

if(isset($_POST['run']))
{
	$start=true;

	// Check the user input for errors
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


// If there were errors or the user has not seen the entry page, display the entry form
if(!$start)
{
	echo "<h1>Introduction to the Hashing Algorithm Simulator</h1>";

	echo '<p>This file was last updated: ' . date ('F d Y H:i:s.', getlastmod()) . "</p>";

	// TODO write a description
	echo "<p><i>Write a description...</i></p>";

	// The main form
	echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>";
	echo "Specify number of initial values in array: ";

	$num = (!empty($_POST['num'])) ? $_POST['num'] : "";
	
	switch($num)
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

	$values = (isset($_POST['values'])) ? $_POST['values'] : "random";
	$lowerBound = (isset($_POST['lowerBound'])) ? $_POST['lowerBound'] : "";
	$upperBound = (isset($_POST['upperBound'])) ? $_POST['upperBound'] : "";
	$array = (isset($_POST['array'])) ? $_POST['array'] : "";
	
	if($values == "random")
		echo "<input type='radio' name='values' value='random' Checked> Random numbers in this Range: ";
	else
		echo "<input type='radio' name='values' value='random'> Random numbers in this Range: ";
	
	echo "<input type='text' name='lowerBound' value='$lowerBound'> to ";
	echo "<input type='text' name='upperBound' value='$upperBound'> , or<br/><br/>";
	
	if($values == "specified")
		echo "<input type='radio' name='values' value='specified' Checked> Specific numeric values:";
	else
		echo "<input type='radio' name='values' value='specified'> Specific numeric values:";
	
	echo "<input type='text' name='array' value='$array'><br/><br/>";
	echo "<input type='Submit' name='run' value='Run Simulator'>  <input type='reset' value='Reset'>";
	echo "</form>";
	echo "<form action='../index.php' method='POST'>";
	echo "<input type='submit' value='Return to Simulation Selection'>";
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

		// Display the array to the user
		for($LCV = 0; $LCV < count($array); $LCV++)
		{
			echo $array[$LCV];
			if($LCV != (count($array)-1))
				echo ", ";
		}
	}

	echo "<br/><br/>";

	// The form that allows the user to return to the main form to change some input
	// NOTE: This form passes the already entered values back to the main form
	echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>";
	echo "<input type='hidden' name='num' value='" . intval($_POST['num']) . "'>";
	echo "<input type='hidden' name='array' value='" . $_POST['array'] . "'>";
	echo "<input type='hidden' name='values' value='" . $_POST['values'] . "'>";
	echo "<input type='hidden' name='upperBound' value='" . intval($_POST['upperBound']) . "'>";
	echo "<input type='hidden' name='lowerBound' value='" . intval($_POST['lowerBound']) . "'>";
	echo "<input type='submit' value='Return'>";
	echo "</form>";

	// If the user wanted to generate a new array
	if($_POST['values'] == 'random')
	{
		// This form allows the user to regenerate a new random array
		echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>";
		echo "<input type='hidden' name='num' value='" . $_POST['num'] . "'>";
		echo "<input type='hidden' name='array' value='" . $_POST['array'] . "'>";
		echo "<input type='hidden' name='values' value='" . $_POST['values'] . "'>";
		echo "<input type='hidden' name='upperBound' value='" . $_POST['upperBound'] . "'>";
		echo "<input type='hidden' name='lowerBound' value='" . $_POST['lowerBound'] . "'>";
		echo "<input type='hidden' name='run' value='true'>";
		echo "<input type='submit' value='Regenerate Array'>";
		echo "</form>";
	}

	// This form will progress the user to the binary search simulator page
	echo "<form action='hash_old.php' method='POST'>";
	echo "<input type='hidden' name='array' value='" . serialize($array) . "'>";
	echo "<input type='submit' value='Run Simulation'>";
	echo "</form>";
}
?>
</td>
</tr>
</table>
</body>
</html>
