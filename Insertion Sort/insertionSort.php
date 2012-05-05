<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Selection Sort Simulator</title>
<script src="../res/javascript.js" type="text/javascript"></script>
</head>
<body onkeypress="javascript: onKey(event);">
	<table border="1">
		<tr>
			<td><?php

			set_up_values();

			function set_up_values(){
				$array = unserialize($_POST['array']);
				$arrayCopy = unserialize($_POST['arrayCopy']);
				$lineNum = $_POST['lineNum'];
				$i = $_POST['iValue'];
				$j = $_POST['jValue'];
				$tmp_val = $_POST['tmpVal'];


				insertion_sort1($array,$i,$j,$lineNum,$tmp_val,$arrayCopy);
			}
			function show_algorithm1($which_line){
				//insertion sort logic

				/*
				 for($j=1; $j < count($arr); $j++) {
				$tmp = $arr[$j];
				$i = $j;
				while(($i >= 0) && ($arr[$i-1] > $tmp)) {
				$arr[$i] = $arr[$i-1];
				$i--;
				}
				$arr[$i] = $tmp;
				}
				*/

				echo '<div align="right">';
				echo '<table border = "1">';
				echo '<tr><th bgcolor="#808080">What Line of the Sort Are We In</th></tr>';
				//the value of $which_line will show which line of the algorithm we are at by making the
				//background of that line yellow
				if($which_line==0)
				{
					echo '<tr><td bgcolor="#FFFF00">for($j=1; $j < count($array); $j++)</td></tr>';
					echo '<tr><td>{</td></tr>';
				}else
				{
					echo '<tr><td>for($j=1; $j < count($array); $j++)</td></tr>';
					echo '<tr><td>{</td></tr>';
				}

				if($which_line==1)
				{
					echo '<tr><td bgcolor="#FFFF00">&nbsp;&nbsp;&nbsp;&nbsp;$tmp = $array[$j];</td></tr>';
				}else
				{
					echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;$tmp = $array[$j];</td></tr>';
				}

				if($which_line==1)
				{
					echo '<tr><td bgcolor="#FFFF00">&nbsp;&nbsp;&nbsp;&nbsp;$i = $j;</td></tr>';
				}else
				{
					echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;$i = $j;</td></tr>';
				}
				if($which_line==2)
				{
					echo '<tr><td bgcolor="#FFFF00">&nbsp;&nbsp;&nbsp;&nbsp;while(($i >= 0) && ($array[$i-1] > $tmp)) </td></tr>';
					echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;{</td></tr>';
				}else
				{
					echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;while(($i >= 0) && ($array[$i-1] > $tmp)) </td></tr>';
					echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;{</td></tr>';
				}
				if($which_line==3)
				{
					echo '<tr><td bgcolor="#FFFF00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$array[$i] = $array[$i-1];</td></tr>';
				}else
				{
					echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$array[$i] = $array[$i-1];</td></tr>';
				}
				if($which_line==3)
				{
					echo '<tr><td bgcolor="#FFFF00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$i--;</td></tr>';
				}else
				{
					echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$i--;</td></tr>';
				}
				if($which_line==4)
				{
					echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;}</td></tr>';
					echo '<tr><td bgcolor="#FFFF00">&nbsp;&nbsp;&nbsp;&nbsp;$array[$i] = $tmp;</td></tr>';
					echo '<tr><td>}</td></tr>';
				}else
				{
					echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;}</td></tr>';
					echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;$array[$i] = $tmp;</td></tr>';
					echo '<tr><td>}</td></tr>';
				}
				echo '</table>';
				echo '</div>';



			}

			function written_section1($array1,$i,$j,$lineNum,$tmp_val){

				if($lineNum==0){
					$count = count($array1);
					echo "<p> This part of the algorithm will compare the value of j to the total count of the array. The value of j is {$j}. The array count is {$count}.";
					if($j<$count){
						echo "Because j is less than the total count of the array, we will now enter the for-loop. </p> <br />";
					}else{
						echo "Since j is not less than the count of the array($j is not less than {$count}), we will pass over the for-loop.</p> <br />";
					}
				}elseif($lineNum==1){
					echo "<p> This section of the insertion sort method will set our temp variable to {$tmp_val}. That is the value of our array[j].";
					echo "Next we set the value of i to equal j. This gives us a way cycle to all indexes to the left of what our temp variable is.";
					echo "We will now go to the while-loop. </p> <br />";
				}elseif($lineNum==2){
					$quick_var = $array1[$i-1];
					echo "<p>This part of the array will use the value of i and the value of our temp variable in the condition of the while-loop. i equals $i and array[\$i-1] equals {$quick_var}.We will compare ";
					echo "i to 0 and the value of array[i-1] to our temp value.";

					if($i>=0&&$quick_var>$tmp_val){
						echo "Our i variable is greater than 0, and array[i-1], which is $quick_var, is greater than [$tmp_val].";
						echo "Because both of our while-loop conditions are satisfied, we will enter the loop.</p> <br />";
					}else{
						echo "The conditions for the while-loop were not met with our current values for i, array[i-1], and our temp variable. We will pass over the while-loop. </p> <br />";
					}
				}elseif($lineNum==3){
					$quick_var1 = $array1[$i];
					$quick_var2 = $array1[$i-1];
					$quick_var3 = $i+1;
					echo "<p>We have entered the while-loop. We will set array[i] to equal array[i-1] because array[i] equals {$quick_var1}. That number is less than ";
					echo "array[i-1], which is equal to $quick_var2. Also, this section of the sort will decrement i from $quick_var3 to {$i}. ";
					echo "Now, we will go back to the top of the while-statement. </p> <br />";
				}elseif($lineNum==4){
					echo "<p>We have passed over the while-loop and this means we know the index we need to place our temp variable. Our array[\i] will now equal our temp variable,";
					echo " which is {$tmp_val}.</p> <br />";
				}elseif($lineNum==5){
					echo "Since we have passed over the for-loop we have been thrown out of the scope of the sort and our array is now sorted!</p> <br />";
				}
			}
			function showOriginalArray($array)
			{
				echo "<div align = \"center\">";
				echo "ORIGINAL ARRAY";
				echo "<table cellpadding='5' style='font-size:18pt;'>";
				echo "<tr>";
				for ($i=0; $i < count($array); $i++)
				{

					echo "<td>$array[$i]</td>";

				}
				echo "</tr>";
				echo "</table>";
				echo "</div>";
				echo "<br />";
				echo "<br />";
				echo "<br />";


			}

			function showCurrentArray($array, $i1, $j1)
			{
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
				for ($i=0; $i < count($array); $i++)
				{

					echo "<td>$array[$i]</td>";

				}
				echo "</tr>";
				echo "<tr>";
				for ($i=0; $i < count($array); $i++)
				{
					if($i1==$j1)
					{
						if($i==$i1){
							echo "<td style=\"background-color:red;\">&uarr;</td>";
						}else{
							echo "<td>*</td>";
						}
					}else{
						if($i==$i1){
							echo "<td style=\"background-color:red;\">&uarr;</td>";
				}else if($i==$j1){
					echo "<td style=\"background-color:blue;\">&uarr;</td>";
				}else{
					echo "<td> * </td>";
				}
			}
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
	function show_array($array_copy){
		echo "<div align =\"center\">";
		echo "<p>CURRENT ARRAY</p>";
		echo "<table border = \"1\">";
		echo "<tr>";
		for($i=0;$i<count($array_copy);$i++){
			$data = $array_copy[$i];
			echo "<td>$data</td>";

		}
		echo "</tr>";
		echo "</table>";
		echo "</div>";

	}

	function next_step_button($arrayChange, $i1, $j1, $linenum1, $tmp_val1,$array1 ){
		/*variables needed
		 array, i, j, linenum, count
		*/

		// Form to continue to the next step
		echo "<form name='form' action='" . $_SERVER['PHP_SELF'] . "' method='POST'>\n";
		echo "<input type='hidden' name='array' value='" . serialize($arrayChange) . "'>\n";
		echo "<input type='hidden' name='arrayCopy' value='" . serialize($array1) . "'>\n";
		echo "<input type='hidden' name='iValue' value='$i1'>\n";
		echo "<input type='hidden' name='jValue' value='$j1'>\n";
		echo "<input type='hidden' name='lineNum' value='$linenum1'>\n";
		echo "<input type='hidden' name='tmpVal' value='$tmp_val1'>\n";
		echo "<input type=\"hidden\" name=\"hasPrevious\" value=\"true\">\n";
		echo "<input type='submit' value=\"Next Step in Simulation\">\n";
		echo "</form>\n";
	}



	function insertion_sort1($arrayChange, $i1, $j1, $linenum1, $tmp_val1,$array1){
		/*
		 1.)perform the current line of the selection sort with the imported line number
		2.)Set the values of the variables needed for the algorithm/function
		*/
		$array_copy = $arrayChange;
		$originalArray = $array1;
		$i = $i1;
		$j = $j1;
		$lineNum = $linenum1;
		$tmp_val = $tmp_val1;


		/*
		 Here is the algorithm that I am using:

		[0]for($j=1; $j < count($arr); $j++) {
		[1]	$tmp = $arr[$j];
		$i = $j;
		[2]	while(($i >= 0) && ($arr[$i-1] > $tmp)) {
		[3]	    $arr[$i] = $arr[$i-1];
		$i--;
		}
		[4]	$arr[$i] = $tmp;
		}

		I have broken the insertion sort logic into 4 sections. Each section is numbered by the
		bracketed number at the beginning of the section. That bracketed number is the line number
		variable used in the switch statement below.
		*/
		
		//showOriginalArray($originalArray);
		arrowArrayOriginal($originalArray);
		//arrowArray($array_copy, $i, $j);
                
                
		switch($lineNum)
		{
			/*
			 Line number = 0
			for($j=1; $j < count($arr); $j++) {
			*/
			case 0:

				
				
				show_algorithm1(0);
				//show_array($array1);
				
                                //showCurrentArray($array_copy, $i, $j);
                                arrowArray($array_copy, $i, $j);
				written_section1($array_copy,$i,$j,$lineNum,$tmp_val);
				

				if($j < count($array_copy)){

					//step into line 1
					$lineNum = 1;
				}else{
					//pass over for-loop, algorithm complete
					$lineNum = 5;
				}

				next_step_button($array_copy,$i, $j,$lineNum,$tmp_val,$originalArray);
				backButton();
				break;
				/*
				 Line number = 1
				$tmp = $arr[$j];
				$i = $j;
				*/
			case 1:
				$tmp_val = $array_copy[$j];
				$i = $j;
				show_algorithm1(1);
				//show_array($array_copy);
				//showCurrentArray($array_copy, $i, $j);
                                arrowArray($array_copy, $i, $j);
				written_section1($array_copy,$i,$j,$lineNum,$tmp_val);
					
				$lineNum = 2;

				next_step_button($array_copy,$i, $j,$lineNum,$tmp_val,$originalArray);
				backButton();
				//step into line 2
				break;
				/*
				 Line number = 2
				while(($i >= 0) && ($arr[$i-1] > $tmp)) {
				*/
			case 2:

				$tmp_val2 = $array_copy[$i-1];

				show_algorithm1(2);
				//show_array($array_copy);
				//showCurrentArray($array_copy, $i, $j);
                                arrowArray($array_copy, $i, $j);
				written_section1($array_copy,$i,$j,$lineNum,$tmp_val);

				if($i>=0&&$tmp_val2>$tmp_val){
					//step into line 3
					$lineNum = 3;
				}else{
					//step into line 4
					$lineNum = 4;
				}


				next_step_button($array_copy,$i, $j,$lineNum,$tmp_val,$originalArray);
				backButton();
				break;
				/*
				 Line number = 3
				$arr[$i] = $arr[$i-1];
				$i--;
				}
				*/
			case 3:

				$array1[$i] = $array_copy[$i-1];
				$i = $i -1;

				show_algorithm1(3);
				//show_array($array_copy);
				//showCurrentArray($array_copy, $i, $j);
                                arrowArray($array_copy, $i, $j);
				written_section1($array_copy,$i,$j,$lineNum,$tmp_val);

				//step into line 2 again
				$lineNum = 2;


				next_step_button($array_copy,$i, $j,$lineNum,$tmp_val,$originalArray);
				backButton();
				break;
				/*
				 Line number = 4
				$arr[$i] = $tmp;
				}
				*/
			case 4:
				show_algorithm1(4);
				//show_array($array_copy);
				
				//just for current array method
				$tempj = $j+1;
				//showCurrentArray($array_copy, $i, $tempj);
                                arrowArray($array_copy, $i, $j);
				$array1[$i] = $tmp_val;

				//the iteration part of the for-loop
				$j= $j +1;

				//step into line 0
				$lineNum = 0;

				
				written_section1($array_copy,$i,$j,$lineNum,$tmp_val);
				next_step_button($array_copy,$i, $j,$lineNum,$tmp_val,$originalArray);
				backButton();
				break;
				/*
				 special case for when algorithm is over
				*/
			case 5;
			show_algorithm(5);
			//show_array($array_copy);
			//showCurrentArray($array_copy, $i, $j);
                        arrowArray($array_copy, $i, $j);
			written_section1($array_copy,$i,$j,$lineNum,$tmp_val);
			//echo "YOU ARE DONE!";
			break;
		}


	}

	
	function arrowArrayOriginal($array){
		// Print the indexes
		echo "<div align = \"center\">";
		echo "<p>ORIGINAL ARRAY</p>";
		echo "<table border='0' cellpadding='0' style='font-size:12pt;'>";
		echo "<tr align='center' valign='bottom'>";
	
		// Print the indexes numbers
		for($LCV = 0; $LCV < count($array); $LCV++)
			echo "<td width='52'>$LCV</td>";
	
			echo "</tr></table>";
	
			// Print the array
	
			echo "<table border='1' cellpadding='5' style='font-size:18pt;'>";
			echo "<tr align='center'>";
	
			for($LCV = 0; $LCV < count($array); $LCV++)
			{
			if($LCV < $index)
				echo "<td width='40' bgcolor=gray>" . $array[$LCV] . "</td>";
				else
				echo "<td width='40' bgcolor=white>" . $array[$LCV] . "</td>";
			}
	
				echo "</tr></table>";
	echo "</div>";
			
				}
	
	function arrowArray($array, $ival, $jval){
		// Print the indexes
		echo "<div align=\"center\">";
		echo "<p>CURRENT ARRAY</p>";
		echo "<table border='0' cellpadding='0' style='font-size:12pt;'>";
		echo "<tr align='center' valign='bottom'>";
		
		// Print the indexes numbers
		for($LCV = 0; $LCV < count($array); $LCV++)
			echo "<td width='52'>$LCV</td>";
				
			echo "</tr></table>";
		
			// Print the array
		
			echo "<table border='1' cellpadding='5' style='font-size:18pt;'>";
			echo "<tr align='center'>";
		
			for($LCV = 0; $LCV < count($array); $LCV++)
			{
			if($LCV < $index)
				echo "<td width='40' bgcolor=gray>" . $array[$LCV] . "</td>";
				else
				echo "<td width='40' bgcolor=white>" . $array[$LCV] . "</td>";
			}
		
			echo "</tr></table>";
		
			// Print the variable arrows
		
			echo "<table border='0' cellpadding='0' style='font-size:12pt;'>";
			echo "<tr align='center' valign='top'>";
		
			for($LCV = 0; $LCV < count($array); $LCV++)
			{
			echo "<td width='52'>";
			if($LCV == $iVal)
			echo "&uarr;<br/>I Value<br/>";
			if($LCV == $jVal)
					echo "&uarr;<br/>J Value<br/>";
			}
		
			echo "</tr></table>";
		echo "</div>";
	}

	
	function backButton(){

		echo "<form>";
		echo "<input type=\"button\" value =\"Previous Step in Simulation\" onClick=\"javascript: previousPage();\">";
		echo "</form>";

	}



	?></td>
		</tr>
	</table>
</body>
</html>
