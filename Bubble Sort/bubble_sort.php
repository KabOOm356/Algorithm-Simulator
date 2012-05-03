<?php
set_up_values();

/*debug to make sure logic works
 $array_copy = unserialize($_POST['array']);
print_r($array_copy);
echo "<br />";
bubbleSort($array_copy);
*/
//this is the bubble sort logic I will be using
function bubbleSort($array)
{
	if (!$length = count($array))
	{
		return $array;
	}

	//$length = count($array);

	for ($outer = 0; $outer < $length; $outer++)
	{
		for ($inner = 0; $inner < $length; $inner++)
		{
			if ($array[$outer] < $array[$inner])
			{
				$tmp = $array[$outer];
				$array[$outer] = $array[$inner];
				$array[$inner] = $tmp;
			}
		}
	}
	print_r($array);
}
function showOriginalArray($array)
{
	echo "<div align = \"center\">";
	echo "ORIGINAL ARRAY";
	echo "<table cellpadding='5' style='font-size:18pt;'>";
	echo "<tr>";
	for ($i=0; $i < count($array); $i++)
	{
                $temp = $array[$i];
		echo "<td>$temp</td>";

	}
	echo "</tr>";
	echo "</table>";
	echo "</div>";
	echo "<br />";
	echo "<br />";
	echo "<br />";


}

function show_algorithm($which_line){
	//insertion sort logic

	/*
	 [0]
	for ($outerVal = 0; $outerVal < $length; $outerVal++)
	{
	[1]
	for ($innerVal = 0; $innerVal < $length; $innerVal++)
	{
	[2]
	if ($array_copy[$outerVal] < $array_copy[$innerVal])
	{
	[3]
	$tmpVal = $array_copy[$outerVal];
	$array_copy[$outerVal] = $array_copy[$innerVal];
	$array_copy[$innerVal] = $tmpVal;
	}
	}
	}
	*/

	echo '<div align="right">';
	echo '<table border = "1">';
	echo '<tr><th bgcolor="#808080">What Line of the Sort Are We In</th></tr>';
	//the value of $which_line will show which line of the algorithm we are at by making the
	//background of that line yellow
	if($which_line==0)
	{
		echo '<tr><td bgcolor="#FFFF00">for ($outerVal = 0; $outerVal < $length; $outerVal++)</td></tr>';
		echo '<tr><td>{</td></tr>';
	}else
	{
		echo '<tr><td>for ($outerVal = 0; $outerVal < $length; $outerVal++)</td></tr>';
		echo '<tr><td>{</td></tr>';
	}

	if($which_line==1)
	{
		echo '<tr><td bgcolor="#FFFF00">&nbsp;&nbsp;&nbsp;&nbsp;for ($innerVal = 0; $innerVal < $length; $innerVal++)</td></tr>';
		echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;{</td></tr>';
	}else
	{
		echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;for ($innerVal = 0; $innerVal < $length; $innerVal++)</td></tr>';
		echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;{</td></tr>';
	}

	if($which_line==2)
	{
		echo '<tr><td bgcolor="#FFFF00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if ($array_copy[$outerVal] < $array_copy[$innerVal])</td></tr>';
		echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{</td></tr>';
	}else
	{
		echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if ($array_copy[$outerVal] < $array_copy[$innerVal])</td></tr>';
		echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{</td></tr>';
	}
	if($which_line==3)
	{
		echo '<tr><td bgcolor="#FFFF00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$tmpVal = $array_copy[$outerVal];</td></tr>';
	}else
	{
		echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$tmpVal = $array_copy[$outerVal];</td></tr>';
	}
	if($which_line==3)
	{
		echo '<tr><td bgcolor="#FFFF00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$array_copy[$outerVal] = $array_copy[$innerVal];</td></tr>';
	}else
	{
		echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$array_copy[$outerVal] = $array_copy[$innerVal];</td></tr>';
	}
	if($which_line==3)
	{
		echo '<tr><td bgcolor="#FFFF00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$array_copy[$innerVal] = $tmpVal;</td></tr>';

	}else
	{
		echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$array_copy[$innerVal] = $tmpVal;</td></tr>';
	}

	echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}</td></tr>';
	echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;}</td></tr>';
	echo '<tr><td>}</td></tr>';

	echo '</table>';
	echo '</div>';
	echo "<br />";


}
function set_up_values(){
	$array_copy = unserialize($_POST['array']);
	$arrayOriginal = unserialize($_POST['array1']);
	$lineNum = $_POST['lineNum'];
	$outerVal = $_POST['outerVal'];
	$innerVal = $_POST['innerVal'];
	//$tmpVal = $_POST['tmpVal'];
	$length = $_POST['length'];
	//$length = count($array1);

        
	echo "DEBUG STUFF <br />";
	echo "line num: $lineNum <br />\n";
	echo "outerval: $outerVal <br />\n";
	echo "innerval: $innerVal <br />\n";
	//echo "tmpval: $tmpVal <br />\n";
	echo "length: $length <br />\n";

	bubble_sort($array_copy,$lineNum,$outerVal,$innerVal,$length, $arrayOriginal);

}
function showCurrentArray($currentArray, $outerVal1, $innerVal1){
	echo "<div align = \"center\">";
	echo "CURRENT ARRAY";
	/*
	 echo "<table border='1' cellpadding='5' style='font-size:12pt;'>";
	echo "<tr>";
	for ($i=0; $i < count($array); $i++)
	{
	
	echo "<td>$i</td>";
	
	}
	echo "</tr>";
	echo "</table>";
	*/
	echo "<table  cellpadding='5' style='font-size:18pt;'>";
	
	echo "<tr>";
	for ($i=0; $i < count($currentArray); $i++)
	{
		$temp = $current[$i];
	if($outerVal1 ==$innerVal1){
		if($i==$outerVal1){
			echo "<td >$temp</td>";
			
		}else{
			echo "<td>$temp</td>";
		}
	}else{
		if($i==$outerVal){
			echo "<td >$temp</td>";
		}else if($i==$innerVal){
			echo "<td >$temp</td>";
		}else{
			echo "<td>$temp</td>";
		}
	}
	echo "<td>$currentArray[$i]</td>";
	
	}
	echo "</tr>";
	
	
	echo "</table>";
	
	/*
	echo "<table cellpadding='5' style='font-size:18pt;'>";
	echo "<tr>";
	for ($i=0; $i < count($array); $i++)
	 {
	if($i==$i1){
	echo "<td background-color = \"red\">&uarr;</td>";
	}else if($i==$j1){
	echo "<td background-color = \"blue\">&uarr;</td>";
	}else{
	echo "<td></td>";
	}
	
	}
	echo "</tr>";
	echo "</table>";
	*/
	echo "</div>";
	echo "<br />";
	echo "<br />";
	echo "<br />";
	

}
function bubble_sort($array_copy,$lineNum,$outerVal,$innerVal, $length, $arrayOriginal){
	/*
	 $array_copy = $array1;
	$lineNum = $lineNum1;
	$outerVal = $outerVal1;
	$innerVal = $innerVal1;
	$tmpVal = $tmpVal1;
	*/
	//$length = count($array_copy);

	/*
	 [0]for ($outerVal = 0; $outerVal < $length; $outerVal++)
	 {
	[1] for ($innerVal = 0; $innerVal < $length; $innerVal++)
	{
	[2]if ($array_copy[$outerVal] < $array_copy[$innerVal])
	{
	[3] $tmpVal = $array_copy[$outerVal];
	$array_copy[$outerVal] = $array_copy[$innerVal];
	$array_copy[$innerVal] = $tmpVal;
	}
	}
	}
	*/
	$arrayOriginal1 =$arrayOriginal;
	showOriginalArray($arrayOriginal1);

	show_algorithm($lineNum);
	switch($lineNum)
	{
		/*
		 Line number = 0
		for ($outerVal = 0; $outerVal < $length; $outerVal++)
			*/

		case 0:
			//make sure innerval is 0 in case you step inside for-loop
			$innerVal =0;
			showCurrentArray($array_copy, $outerVal, $innerVal);
			written_section($array_copy, $lineNum, $outerVal, $innerVal, $length);
			if($outerVal < $length){
				//enter for-loop
				$lineNum =1;
			}else{
				$lineNum = 4;
				//algorithm is over
			}
			next_step_button($array_copy,$lineNum,$outerVal,$innerVal, $length, $arrayOriginal);
			break;
			/*
			 Line number = 1
			for ($innerVal = 0; $innerVal < $length; $innerVal++)
				*/
		case 1:

			
			if($innerVal < $length){
				//enter for-loop
				showCurrentArray($array_copy, $outerVal, $innerVal);
				written_section($array_copy, $lineNum, $outerVal, $innerVal, $length);
				$lineNum =2;
			}else{
				//algorithm is over
				showCurrentArray($array_copy, $outerVal, $innerVal);
				written_section($array_copy, $lineNum, $outerVal, $innerVal, $length);
				
				$lineNum = 0;
			}
			next_step_button($array_copy,$lineNum,$outerVal,$innerVal, $length, $arrayOriginal);
			break;
			/*
			 Line number = 2
			if ($array_copy[$outerVal] < $array_copy[$innerVal])
				*/
		case 2:
			$compareValue1 = $array_copy[$outerVal];
			$compareValue2 = $array_copy[$innerVal];

			showCurrentArray($array_copy, $outerVal, $innerVal);
			written_section($array_copy, $lineNum, $outerVal, $innerVal, $length);
			if($compareValue1<$compareValue2){
				//enter if-statement
				$lineNum =3;
			}else{
				//pass over if-statement
				$innerVal = $innerVal + 1;
				$lineNum = 1;
			}
			next_step_button($array_copy,$lineNum,$outerVal,$innerVal, $length, $arrayOriginal);
			break;
			/*
			 Line number = 3
			$tmpVal = $array_copy[$outerVal];
			$array_copy[$outerVal] = $array_copy[$innerVal];
			$array_copy[$innerVal] = $tmpVal;
			*/
		case 3:

			$tmpVal = $array_copy[$outerVal];
			$array_copy[$outerVal] = $array_copy[$innerVal];
			$array_copy[$innerVal] = $tmpVal;

			$innerVal = $innerVal + 1;
			showCurrentArray($array_copy, $outerVal, $innerVal);
			written_section($array_copy, $lineNum, $outerVal, $innerVal, $length);
			$lineNum = 1;

			next_step_button($array_copy,$lineNum,$outerVal,$innerVal, $length, $arrayOriginal);
			//increment inner for-loop
			break;
			/*
			 Line number = 4
			case for when algorithm is over
			*/
		case 4:
			showCurrentArray($array_copy, $outerVal, $innerVal);
			written_section($array_copy, $lineNum, $outerVal, $innerVal, $length);
			print_r($array_copy);
			echo "<br /> ARRAY SHOULD BE SORTED!";
			break;

	}

}
function written_section($array_copy, $lineNum, $outerVal, $innerVal, $length){
	$temp1 = $array_copy[$outerVal];
	$temp2 = $array_copy[$innerVal];
	if($lineNum==0){
		echo "<p>We are at the top-most step of the algorithm. We compare our /$outerVal variable of {$outerVal} to our array length of {$length}.";
		if($outerVal<$length){
			echo " Since our \$outerVal variable is less than our array length, we will step into our for-loop and iterate from the 0 index all the way to $outerVal index. </p><br />";
		}else{
			echo "Because our \$outerVal variable is not less than the length of our array, we have compared every index to each other and our array is now sorted. We will skip over this for-loop. </p><br />";
		}
	}elseif($lineNum==1){
		echo "<p>We are at the second step, or the second-for loop, of the algorithm. Now, our \$innerVal is $innerVal and we will compare it to our array length of {$length}.";
		if($innerValVal<$length){
			echo " Since our \$innerVal variable is less than our array length, we will step into this second for-loop. </p><br />";
		}else{
			echo "Because our \$innerVal variable is not less than the length of our array, we have compared every index from 0 to {$outerVal} with each other. We will skip over this for-loop. </p><br />";
		}
	}elseif($lineNum==2){

		echo "<p>This step of the sort will see if our array at the {$outerVal}(\$outerVal) index, is less than our array at the {$innerVal}(\$innerVal) index.";
		echo "Our array at the $outerVal index is {$temp1}, and our array at the $innerVal index is {$temp2}. ";
		if($temp1<$temp2){
			echo "We will enter the if-statement because $temp1 is less than {$temp2}! </p><br />";
		}else{
			echo "We can pass over this if-statement because $temp1 is not less than {$temp2}, and increment our inner value by 1. </p> <br />";
		}
	}elseif($lineNum==3){
		echo "<p> To swap the two indexes: \$outerval is {$outerVal} and \$innerVal is {$innerVal}, we need to use a temporary variable.";
		echo "We will set this \$tmpVal variable to our array at \$outerVal index, which is {$temp1}.";
		echo "Because we have that array index stored in a temporary variable, we can swap that index with our array value at index $innerVal. So now our array at index $outerVal equals {$temp2}.";
		echo "Finally, we will set our array at the \$innerVal index of {$innerVal} to the value of our temporary variable, which is {$temp1}.";
		echo "After those three commands we can now increment our \$innerVal variable by one and we are done with this section. </p> <br />";
	}elseif($lineNum==4){
		echo "<p>Hopefully you have come to understand the flow of the bubble sort algorithm. It merely starts from the leftmost index, and systematically";
		echo "compares every index to each other. By comparing every index to each other and sorting them along the way, you end up with a sorted array!!</p>";
	}
}
function next_step_button($array_copy, $lineNum, $outerVal, $innerVal, $length, $arrayOriginal){
	/*variables needed
	 array, linenum, outerval, innerval, tmpVal, length
	*/
	// Form to continue to the next step
	echo "<form name='form' action='" . $_SERVER['PHP_SELF'] . "' method='POST'>\n";
	echo "<input type='hidden' name='array' value='" . serialize($array_copy) . "'>\n";
	echo "<input type='hidden' name='array1' value='" . serialize($arrayOriginal) . "'>\n";
	echo "<input type='hidden' name='outerVal' value='$outerVal'>\n";
	echo "<input type='hidden' name='innerVal' value='$innerVal'>\n";
	echo "<input type='hidden' name='lineNum' value='$lineNum'>\n";
	//echo "<input type='hidden' name='tmpVal' value='$tmpVal'>\n";
	echo "<input type='hidden' name='length' value='$length'>\n";
	echo "<input type=\"hidden\" name=\"hasPrevious\" value=\"true\">\n";
	echo "<input type='submit' value=\"Next Step in Simulation\">\n";
	echo "</form>\n";
}

?>