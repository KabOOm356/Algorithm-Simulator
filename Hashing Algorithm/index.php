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

// TODO remove this after debugging
ini_set("display_errors", 1);

$start = false;

if(isset($_POST['submit']))
{
	$start = true;
	
	echo "<p><font color=red>";
	
	if(empty($_POST['range1']))
	{
		$start = false;
		echo "Lower bound is not set!<br />";
	}
	elseif(!is_numeric($_POST['range1']))
	{
		$start = false;
		echo "Lower bound is not an integer!<br />";
	}
	
	if(empty($_POST['range2']))
	{
		$start = false;
		echo "Upper bound is not set!<br />";
	}
	elseif(!is_numeric($_POST['range2']))
	{
		$start = false;
		echo "Upper bound is not an integer!<br />";
	}
	
	// Check if there were any errors with the user input
	if(!$start)
		echo "<b>Please review the selections below and resubmit the form</b>";
	
	echo "</font></p>";
}

// If there were errors or the main form was not submitted
if(!$start)
{
	echo "<h1>Introduction to the Hashing Algorithm Simulator</h1>";
	
	echo '<p>This file was last updated: ' . date ('F d Y H:i:s.', getlastmod()) . "</p>";
	
	// TODO write a description
	echo "<p><i>Write a description...</i></p>";
	
	// Main input form
	echo "<form method=\"POST\" action=\"" . $_SERVER['PHP_SELF'] . "\">";
	
	echo "Indicate your initial Array Size:  ";
	
	if(empty($_POST['Size']))
		$_POST['Size'] = -1;
	
	switch ($_POST['Size'])
	{
			case 7:
				echo "<input type='radio' name='Size' value='7' Checked> 7 ";
				echo "<input type='radio' name='Size' value='12'> 12 ";
				echo "<input type='radio' name='Size' value='15'> 15<br/><br/>";
				break;
			case 15:
				echo "<input type='radio' name='Size' value='7'> 7 ";
				echo "<input type='radio' name='Size' value='12'> 12 ";
				echo "<input type='radio' name='Size' value='15' Checked> 15<br/><br/>";
				break;
			default:
				echo "<input type='radio' name='Size' value='7'> 7 ";
				echo "<input type='radio' name='Size' value='12' Checked> 12 ";
				echo "<input type='radio' name='Size' value='15'> 15<br/><br/>";
				break;
	}
	
	$range1 = (!empty($_POST['range1'])) ? $_POST['range1'] : "";
	$range2 = (!empty($_POST['range2'])) ? $_POST['range2'] : "";
	
	echo "Input Range: <input name=\"range1\" value=\"$range1\" size=\"3\" maxlength=\"3\" /> to <input name=\"range2\" value=\"$range2\" size=\"3\" maxlength=\"3\" />";
	echo "<br /><br />";
	echo "<input type=\"submit\" name=\"submit\" value=\"Run Simulator\" /> <input type=\"reset\" value=\"Reset\"><br />";
	echo "</form>";
	
	// Form to return to the main 
	echo "<form action='../' method='POST'>";
	echo "<input type='submit' value='Return to Simulation Selection'>";
	echo "</form>";
}
else
{
	echo "<h1>Input Summary</h1>";
	
	// Generate a a random array
	for($LCV = 0; $LCV < $_POST['Size']; $LCV++)
		$array[$LCV] = rand($_POST['range1'], $_POST['range2']);
					
	// Shuffle the array
	shuffle($array);
	
	echo "<p>";
	echo "Size: " . $_POST['Size'] . "<br/>";
	echo "Lower Bound: " . $_POST['range1'] . "<br/>";
	echo "Upper Bound: " . $_POST['range2'] . "<br/>";
	echo "<br/>Array: ";
	
	// Display the array to the user
	for($LCV = 0; $LCV < count($array); $LCV++)
	{
		echo $array[$LCV];
		if($LCV != (count($array)-1))
			echo ", ";
	}
	
	echo "</p>";
	
	// Form to return to the previous screen
	echo "<form method=\"POST\" action=\"" . $_SERVER['PHP_SELF'] . "\">";
	echo "<input type=\"hidden\" name=\"Size\" value=\"" . $_POST['Size'] . "\">";
	echo "<input type=\"hidden\" name=\"range1\" value=\"" . $_POST['range1'] . "\">";
	echo "<input type=\"hidden\" name=\"range2\" value=\"" . $_POST['range2'] . "\">";
	echo "<input type=\"submit\" value=\"Return\">";
	echo "</form>";
	
	// Form to regenerate the array
	echo "<form method=\"POST\" action=\"" . $_SERVER['PHP_SELF'] . "\">";
	echo "<input type=\"hidden\" name=\"Size\" value=\"" . $_POST['Size'] . "\">";
	echo "<input type=\"hidden\" name=\"range1\" value=\"" . $_POST['range1'] . "\">";
	echo "<input type=\"hidden\" name=\"range2\" value=\"" . $_POST['range2'] . "\">";
	echo "<input type=\"submit\" name=\"submit\" value=\"Regenerate Array\">";
	echo "</form>";
	
	// Form to being the simulator
	// TODO add the name of the simulator file here as action
	echo "<form method=\"POST\" action=\"" . $_SERVER['PHP_SELF'] . "\">";
	echo "<input type=\"hidden\" name=\"Size\" value=\"" . $_POST['Size'] . "\">";
	echo "<input type=\"hidden\" name=\"range1\" value=\"" . $_POST['range1'] . "\">";
	echo "<input type=\"hidden\" name=\"range2\" value=\"" . $_POST['range2'] . "\">";
	echo "<input type=\"submit\" value=\"Run Simulator\">";
	echo "</form>";
}
?>
</td>
</tr>
</table>
</body>
</html>