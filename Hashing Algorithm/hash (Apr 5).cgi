#!/usr/local/bin/php

<table border='1' cellpadding='20' align='center'>
<tr>
<td align='center'>

<?php

$begin = false;

//   display the form
if (!$begin AND ($error OR count($_POST) == 0))
  echo <<< EOT
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
	$counter = $counter - 2;
}

print_r($prevArray);

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

function hashing($array, $array2, $comp, $num)
{
	$mod = mod($array[$num]);

	if($array2[$mod] > 0)
	{
		while($array2[$mod] > 0)
		{
			//printArray($array2, $comp, $num);
			$mod++;
		}
		printArray($array2, $comp, $num);
	}
	
	//$_POST['compArray'] = (serialize($array2));
	$array2[$mod] = $array[$num];
	$_POST['compArray'] = (serialize($array2));
	$_POST['array'] = (serialize($array2));
	printArray($array2, $comp, $num);

}

function mod($num)
{
	$mod = $num%10;

	return $mod;
}


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


function printArray($array, $comp, $num)
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
	
	if($array[$i-1] > 0 AND ($number > 0) AND ($comp[$i] != $array[$i]))
	{
		echo "<img src=\"http://students.cse.unt.edu/~dad0176/class/3410/alert.png\" /><br/>Collision at " . ($i-1) . " <br/>";
		echo "<img src=\"http://students.cse.unt.edu/~dad0176/class/3410/arrow.png\" /><br/>Move index to " . ($i) . "<br/>";
	}

	else if ($number > 0 AND ($comp[$i] != $array[$i]))
	{
		echo "<img src=\"http://students.cse.unt.edu/~dad0176/class/3410/arrow.png\" /><br/>Mod 10 Position<br/>";
	}

	echo "&nbsp;<br/>";
	echo "</td>";
}

	echo "</tr></table>";

}


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

	// Form to return to the previous screen
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

	
	if($counting > 0)
	{
	// Form to being the simulator
	// TODO add the name of the simulator file here as action
	echo "<form method=\"POST\" action=\"" . $_SERVER['PHP_SELF'] . "\">";
	echo "<input type=\"hidden\" name=\"Size\" value=\"" . $_POST['Size'] . "\">";
	echo "<input type=\"hidden\" name=\"range1\" value=\"" . $_POST['range1'] . "\">";
	echo "<input type=\"hidden\" name=\"range2\" value=\"" . $_POST['range2'] . "\">";
	echo "<input type=\"hidden\" name=\"rand\" value=\"" . $_POST['rand'] . "\">";
	echo "<input type=\"hidden\" name=\"array\" value=\"" . $_POST['array'] . "\">";
	echo "<input type=\"hidden\" name=\"counter\" value=\"" . $_POST['counter'] . "\">";
	echo "<input type=\"hidden\" name=\"prev\" value=\"1\">";
	echo "<input type=\"submit\" value=\"Previous\">";
	echo "</form>";
	}

	
	if(sizeof($rand) > $counter)
	{
	// Form to being the simulator
	// TODO add the name of the simulator file here as action
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