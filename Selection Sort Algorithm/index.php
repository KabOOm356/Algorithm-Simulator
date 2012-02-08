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
	if(isset($_POST['submit']) /* || isset($_POST['debug'] */)
	{
		$start = true;
		// TODO Check user input;  If there is an error or debugging is on, print the error and set start to false
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