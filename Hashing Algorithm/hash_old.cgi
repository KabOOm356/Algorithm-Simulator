#!/usr/local/bin/php

<table border='1' cellpadding='20' align='center'>
<tr>
<td align='center'>

<?php

if (count($_POST) > 0) 
{

$range1 = $_POST['range1'];
$range2 = $_POST['range2'];
$Size = $_POST['Size'];

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


$rand = array();
while (count($rand) < $Size ) 
{
    $r = mt_rand($range1,$range2); 
    if ( !in_array($r,$rand) ) 
    {
        $rand[] = $r;
    }
}

function hashing($array, $array2)
{
	//printArray($array2);
	
	for($i = 0; $i < sizeof($array); $i++)
	{
		$mod = mod($array[$i]);

		if($array2[$mod] > 0)
		{
			while($array2[$mod] > 0)
			{
				printArray($array2);
				$mod++;
			}
		}

		$array2[$mod] = $array[$i];
		printArray($array2);
		
	}

	printArray($array2);

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

function printArray($array)
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
	
	if(mod($number) == ($i-1) AND $number != 0)
	{
		echo "<img src=\"http://students.cse.unt.edu/~dad0176/class/3410/alert.png\" /><br/>Collision at " . ($i-1) . " <br/>";
		echo "<img src=\"http://students.cse.unt.edu/~dad0176/class/3410/arrow.png\" /><br/>New Position<br/>";
	}

	else if ($number != 0)
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

$array[15];

while (count($array) < 15) 
{
        $array[] = 0;
}

initialArray($rand, sizeof($rand));
hashing($rand, $array);

}




}



//   display the form
if ($error OR count($_POST) == 0)
  echo <<< EOT
<form method="post" action="">

Indicate your initial Array Size:  <input type="radio" name="Size" value="7" checked />
          7 &nbsp; &nbsp;
      <input type="radio" name="Size" value="12" /> 12 &nbsp; &nbsp; <input type="radio" name="Size" value="15" /> 15<br /><br />

Input Range: <input name="range1" value="$range1" size="3" maxlength="3" /> to <input name="range2" value="$range2" size="3" maxlength="3" />

<br /><br />

<input type="reset" /><input type="submit" name="Send" value="Submit" />
</form>

EOT;
?>

</td>
</tr>
</table>