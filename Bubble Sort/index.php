<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Bubble Sort Algorithm Simulator</title>
</head>
<table border='0' cellpadding='0' align='center'>
<tr>
<td align='center'>
<?php
$start = false;

if(isset($_POST['run']))
{
	$start = true;

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
					for($LCV = 0; $LCV < count($array); $LCV++)
					{
						// Check if each value provided is a number
						if(!is_numeric($array[$LCV]))
						{
							echo "The value at index " . ($LCV+1) . " of the provided array is not a number!<br/>";
							$start = false;
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
	echo '<p>This file was last updated: ' . date ('F d Y H:i:s.', getlastmod()) . "</p>";

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
}
else // The user has submitted the form and all the data needed contained no errors.  Show a confirmation screen before continuing to the simulation
{
	// Header 1
	echo "<h1>Input Summary</h1>";

	// Display the specified size of the array
	echo "Size of array: " . $_POST['num'] . "<br/>";

	// If the user specified to generate a random array
	if($_POST['values'] == 'random')
	{
		// Display that the user wants a random array
		echo "Array Generation: Random<br/>";

		// Display the lower bound of the random values in the array
		echo "Lower Bound: " . intval($_POST['lowerBound']) . "<br/>";

		// Display the upper bound of the random values in the array
		echo "Upper Bound: " . intval($_POST['upperBound']) . "<br/>";

		// Generate a a random array
		for($LCV = 0; $LCV < $_POST['num']; $LCV++)
			$array[$LCV] = rand($_POST['lowerBound'], $_POST['upperBound']);

		// Shuffle the array
		shuffle($array);

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
	
	$length = count($array)-1;

	// This form will progress the user to the bubble sort simulator page
	echo "<form action='bubble_sort.php' method='POST' target='_top'>\n";
	echo "<input type='hidden' name='array' value='" . serialize($array) . "'>\n";
	echo "<input type='hidden' name='lineNum' value='0'>\n";
	echo "<input type='hidden' name='outerVal' value='0'>\n";
	echo "<input type='hidden' name='innerVal' value='0'>\n";
	echo "<input type='hidden' name='length' value='$length'>\n";
	echo "<input type='submit' value='Run Simulation'>\n";
	echo "</form>\n";
}
?>
</td>
</tr>
</table>
</body>
</html>