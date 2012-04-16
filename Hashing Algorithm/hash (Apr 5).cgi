#!/usr/local/bin/php

<table border='1' cellpadding='20' align='center'>
<tr>
<td align='center'>

<?php

$begin = false;

//   display the form


if (!$begin AND ($error OR count($_POST) == 0))
 
echo <<< EOT

<h1>Overview</h1> 
<h3>This demonstrates linear probing closed hashing. The primary hash function <br />
is to take the key mod the table size. If the primary hash function yields a <br />
collision, the next cell will be tried. If there is another collision, the cell following,<br /> 
and so on, until an empty cell is found.</h3> 

<form method="post" action="$_SERVER[PHP_SELF]">

Indicate your initial Array Size:  <input type="radio" name="Size" value="7" checked />
          7 &nbsp; &nbsp;
      <input type="radio" name="Size" value="12" /> 12 &nbsp; &nbsp; <input type="radio" name="Size" value="15" /> 15<br /><br />

Input Range: <input name="range1" value="$range1" size="3" maxlength="3" /> to <input name="range2" value="$range2" size="3" maxlength="3" />

<br /><br />

<input type = 'hidden' name = 'rand' value = "0">
<input type = 'hidden' name = 'counter' value = "0">
<input type = 'hidden' name = 'array' value = "0">
<input type = 'hidden' name = 'compArray' value = "0">
<input type = 'hidden' name = 'prev' value = "0">
<input type="reset" /><input type="submit" name="Send" value="Submit" />
</form>

EOT;


else 
{
	$range1 = $_POST['range1'];
	$range2 = $_POST['range2'];
	$Size = $_POST['Size'];
	$rand = unserialize($_POST['rand']);
	$array = unserialize($_POST['array']);
	$compArray = unserialize($_POST['compArray']);
	$counter = $_POST['counter'];
	$prev = $_POST['prev'];


	if($prev == 1)
	{
		$count = $count - 2;
	}

	if ((!(is_numeric($range1) AND ($range1 >= 1 AND $range1 <= 100))) OR (!(is_numeric($range2) AND ($range2 >= 1 AND $range2 <= 100)))) 
    	{
    		$error = true;
    		echo "<div style=\"color:red;\">Invalid Range.</div>\n";
    	}

	if (($range1 > $range2) OR ($range1 == $range2)) 
    	{
    		$error = true;
    		echo "<div style=\"color:red;\">Invalid Range.</div>\n";
    	}


	if($rand == 0)
	{
		$rand = array();
		while (count($rand) < $Size ) 
		{
			$r = mt_rand($range1,$range2); 
    			if ( !in_array($r,$rand) ) 
    			{
        			$rand[] = $r;
    			}
		}
	}

	$_POST['rand'] = (serialize($rand));

//-----------------------------------------------------------------------------------------------------------------

	function hashing($array, $array2, $comp, $num)
	{
		$mod = mod($array[$num]);

		if($array2[$mod] > 0)
		{
			while($array2[$mod] > 0)
			{
				$mod++;
			}
			printArray($array2, $comp, $num, $array, $mod);
		}
	
		$array2[$mod] = $array[$num];
		$_POST['compArray'] = (serialize($array2));
		$_POST['array'] = (serialize($array2));
		printArray($array2, $comp, $num, $array, $mod);

	}

//-----------------------------------------------------------------------------------------------------------------
	
	function mod($num)
	{
		$mod = $num%10;
		return $mod;
	}

//-----------------------------------------------------------------------------------------------------------------
	
	function initialArray($input, $size) 
	{
		$cols = $size;
		$first = $size -1; 
		$last = 0; 
     
    		echo "<table border='1' cellpadding='5' style='font-size:18pt;'>"; 

    		for ($i=0; $i < count($input); $i++) 
    		{ 
     			echo "<tr>";
        		for ($c=0; $c<$cols; $c++) 
        		{ 
				echo "<td>$input[$c]</td>";
        		}
 
 			echo "</tr>";   
    			$i += $c; 
    		}       
    		echo "</table>"; 
	}

//-----------------------------------------------------------------------------------------------------------------

	function printArray($array, $comp, $num, $original, $mod)
	{
		echo "<table border='0' cellpadding='0' style='font-size:12pt;'>";
		echo "<tr align='center' valign='bottom'>";
		
		// Print the indexes numbers
		for($i = 0; $i < count($array); $i++)
			echo "<td width='52'>$i</td>";
			
		echo "</tr></table>";

		echo "<table border='1' cellpadding='5' style='font-size:18pt;'>";
		echo "<tr align='center'>";

		for ($i = 0; $i < sizeof($array); $i++)
		{
			if ($array[$i] == 0)
				echo "<td width='40'>" . "*" . "</td>";
			else
			{
				echo "<td width='40'>" . $array[$i] . "</td>";
			}
       
	 	}

		echo "</tr></table>"; 


		echo "<table border='0' cellpadding='0' style='font-size:12pt;'>";
		echo "<tr align='center' valign='top'>";

		$array2 = $array;

		for($i = 0; $i < sizeof($array); $i++)
		{
			echo "<td width='52'>";
			$number = $array2[$i];
			
	
			if(mod($array[$i]) != $i AND $array[$i-1] > 0 AND ($number > 0) AND ($comp[$i] != $array[$i]))
			{
				echo "<img src=\"http://students.cse.unt.edu/~dad0176/class/3410/alert.png\" /><br/><font color='red'><b>Collision Detected</b></font><br/>";
				echo "<img src=\"http://students.cse.unt.edu/~dad0176/class/3410/arrow.png\" /><br/><b>Move to index [<font color='green'>" . ($i) . "</font>]</b><br/>";
				$loop = 1;
				$print = 1;
				$index = $i-1;
				$value = $array[$i];
			}

			else if ($number > 0 AND ($comp[$i] != $array[$i]))
			{
				echo "<img src=\"http://students.cse.unt.edu/~dad0176/class/3410/arrow.png\" /><br/>";
				$loop = 1;
				$print = 0;
				$index = $i-1;
				$value = $array[$i];
			}

			if($loop != 1) //Sets values for text to print correct information
			{
				$index = $num;
				$value = $original[$num];
			}

			echo "&nbsp;<br/>";
			echo "</td>";
		}

		echo "</tr></table>";

		if($print == 1) //Print Collisions under graphics
		{
			$index2 = $index+1;
			$values = mod($original[$num]);
			$positions = $index2 - $values;
			
			if($positions == 1)
			{
				echo "<h3>There was a collision at index [<font color='green'>$index</font>] so <font color='green'>$value</font> has to be moved over one position to index [<font color='green'>$index2</font>].</h3>";
			}

			else
			{
				echo "<h3>There were multiple collisions so <font color='green'>$value</font> has to be moved over $positions positions to index [<font color='green'>$index2</font>].</h3>";
			}
		}

		if($print == 0) //Print text under graphics
		{
			$modValue = mod($value);
			echo "<h3><font color='red'>$value</font>%<font color='red'>10</font> = <font color='green'>$modValue</font><br/>";
			echo "This statement is equvilent to <font color='red'>$value</font>/<font color='red'>10</font> leaving a remainder of <font color='green'>$modValue</font>.</h3>";
			echo "<h3>The modulus 10 of <font color='red'>$value</font> equals <font color='green'>$modValue</font> resulting in its insertion to index [<font color='green'>$modValue</font>].</h3>";
		}

	}

//-----------------------------------------------------------------------------------------------------------------

//Main Program
	if (!$error)
	{
		if($array == 0)
		{
			$array[15];

			while (count($array) < 15) 
			{
        			$array[] = 0;
			}
		}
	
		initialArray($rand, sizeof($rand));
		hashing($rand, $array, $compArray, $counter);
	
		$counting = $counter;
		$counter = $counter+1;
		$_POST['counter'] = $counter;


		echo "</p>";

		// Restart
		echo "<form method=\"POST\" action=\"" . $_SERVER['PHP_SELF'] . "\">";
		echo "<input type=\"hidden\" name=\"Size\" value=\"" . $_POST['Size'] . "\">";
		echo "<input type=\"hidden\" name=\"range1\" value=\"" . $_POST['range1'] . "\">";
		echo "<input type=\"hidden\" name=\"range2\" value=\"" . $_POST['range2'] . "\">";
		echo "<input type=\"hidden\" name=\"rand\" value=\"" . $_POST['rand'] . "\">";
		echo "<input type=\"hidden\" name=\"counter\" value=\"0\">";
		echo "<input type=\"submit\" value=\"Restart\">";
		echo "</form>";

		// Form to regenerate the array
		echo "<form method=\"POST\" action=\"" . $_SERVER['PHP_SELF'] . "\">";
		echo "<input type=\"hidden\" name=\"Size\" value=\"" . $_POST['Size'] . "\">";
		echo "<input type=\"hidden\" name=\"range1\" value=\"" . $_POST['range1'] . "\">";
		echo "<input type=\"hidden\" name=\"range2\" value=\"" . $_POST['range2'] . "\">";
		echo "<input type=\"hidden\" name=\"counter\" value=\"0\">";
		echo "<input type=\"submit\" name=\"submit\" value=\"Regenerate Array\">";
		echo "</form>";

		//Remove previous button until complete
		/*if($counting > 0)
		{
			// Previous
			echo "<form method=\"POST\" action=\"" . $_SERVER['PHP_SELF'] . "\">";
			echo "<input type=\"hidden\" name=\"Size\" value=\"" . $_POST['Size'] . "\">";
			echo "<input type=\"hidden\" name=\"range1\" value=\"" . $_POST['range1'] . "\">";
			echo "<input type=\"hidden\" name=\"range2\" value=\"" . $_POST['range2'] . "\">";
			echo "<input type=\"hidden\" name=\"rand\" value=\"" . $_POST['rand'] . "\">";
			echo "<input type=\"hidden\" name=\"array\" value=\"" . $_POST['compArray'] . "\">";
			echo "<input type=\"hidden\" name=\"counter\" value=\"" . $_POST['counter'] . "\">";
			echo "<input type=\"hidden\" name=\"prev\" value=\"1\">";
			echo "<input type=\"submit\" value=\"Previous\">";
			echo "</form>";
		}*/

	
		if(sizeof($rand) > $counter)
		{
			// Next
			echo "<form method=\"POST\" action=\"" . $_SERVER['PHP_SELF'] . "\">";
			echo "<input type=\"hidden\" name=\"Size\" value=\"" . $_POST['Size'] . "\">";
			echo "<input type=\"hidden\" name=\"range1\" value=\"" . $_POST['range1'] . "\">";
			echo "<input type=\"hidden\" name=\"range2\" value=\"" . $_POST['range2'] . "\">";
			echo "<input type=\"hidden\" name=\"rand\" value=\"" . $_POST['rand'] . "\">";
			echo "<input type=\"hidden\" name=\"array\" value=\"" . $_POST['array'] . "\">";
			echo "<input type=\"hidden\" name=\"compArray\" value=\"" . $_POST['compArray'] . "\">";
			echo "<input type=\"hidden\" name=\"counter\" value=\"" . $_POST['counter'] . "\">";
			echo "<input type=\"submit\" value=\"Next\">";
			echo "</form>";
		}


	}

}
?>

</td>
</tr>
</table>