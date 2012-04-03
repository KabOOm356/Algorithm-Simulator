<?php
/*
echo "Made it here <br />\n";
// Read in the array
$array1 = unserialize($_POST['array']);
echo "here is your array: <br />\n";

reset($array1);
foreach($array1 as $data){
    echo "$data \n";
}
$line = $_POST['lineNum'];
echo "here is your initial line number $line \n <br />";
echo "-------------------------------------------------";
*/
set_up_values();

function set_up_values(){
    $array1 = unserialize($_POST['array']);
    $lineNum = $_POST['lineNum'];
    $i = $_POST['iValue']; 
    $j = $_POST['jValue'];
    $count = $_POST['count'];
    insertion_sort($array1,$i,$j,$lineNum,$count);
}
    //function used to display what line of the algorithm we are currently iterating through.
    function show_algorithm($which_line){
        //insertion sort logic
        /*
        0. for($j=1; $j < $count; $j++)
        {
        1.   $tmp_val = $array_original[$j];
            $i = $j;   
        2.    while(($i >= 0) && ($array_original[$i-1] > $tmp_val))
            {
        3.        $array_original[$i] = $array_original[$i-1];
                //visual_array($array_original, $i, $i-1,2);
        .        $i--;
            }
            //set comp_val variable for written description
        4.  $array_original[$i] = $tmp_val;
        }

        */
        echo '<div align="right">';
        echo '<table border = "1">';
        echo '<tr><th bgcolor="#808080">What Line of the Sort Are We In</th></tr>';
        //the value of $which_line will show which line of the algorithm we are at by making the
        //background of that line yellow
        if($which_line==0)
        {
            echo '<tr><td bgcolor="#FFFF00">for($j=1; $j < $count; $j++)</td></tr>';
            echo '<tr><td>{</td></tr>';
        }else
        {
            echo '<tr><td>for($j=1; $j < $count; $j++)</td></tr>';
            echo '<tr><td>{</td></tr>';
        }
        
        if($which_line==1)
        {
            echo '<tr><td bgcolor="#FFFF00">$tmp_val = $array_original[$j];</td></tr>';
        }else
        {
            echo '<tr><td>$tmp_val = $array_original[$j];</td></tr>';
        }
        
        if($which_line==1)
        {
             echo '<tr><td bgcolor="#FFFF00">$i = $j;</td></tr>';
        }else
        {
            echo '<tr><td>$i = $j;</td></tr>';
        }
        if($which_line==2)
        {
            echo '<tr><td bgcolor="#FFFF00">while(($i >= 0) && ($array_original[$i-1] > $tmp_val))</td></tr>';
            echo '<tr><td>{</td></tr>';
        }else
        {
            echo '<tr><td>while(($i >= 0) && ($array_original[$i-1] > $tmp_val))</td></tr>';
            echo '<tr><td>{</td></tr>';
        }
        if($which_line==3)
        {
            echo '<tr><td bgcolor="#FFFF00">$array_original[$i] = $array_original[$i-1];</td></tr>';
        }else
        {
            echo '<tr><td>$array_original[$i] = $array_original[$i-1];</td></tr>';
        }
        if($which_line==3)
        {
            echo '<tr><td bgcolor="#FFFF00">$i--;</td></tr>';
        }else
        {
            echo '<tr><td>$i--;</td></tr>';
        }
        if($which_line==4)
        {
            echo '<tr><td bgcolor="#FFFF00">$array_original[$i] = $tmp_val;</td></tr>';
            echo '<tr><td>}</td></tr>';
        }else
        {
            echo '<tr><td>$array_original[$i] = $tmp_val;</td></tr>';
            echo '<tr><td>}</td></tr>';
        }
        echo '</table>';
        echo '</div>';   
        
    }
function written_section($which_desc, $comp_val, $comp_val2, $comp_val3){
    if($which_desc==0){
        echo "We are now going to compare $comp_val to $comp_val2 because of the for-loop.";
        if($comp_val< $comp_val2){
            echo "Inside our for-loop, our j variable ($comp_val) is still less than the count ($comp_val2) of the array";
            echo " so we will enter the for-loop.\n";
        }else{
            echo "Our j variable ($comp_val) is not less than the count ($comp_val2) of our array, so we will jump past the for-loop.\n";
            echo "The algorithm is complete as of now.";
        }
    }elseif($which_desc==1){
        echo 'Since we have entered the for-loop, we will now set our temp(local) variable to the value of our array[$j], which is'. $comp_val;
        echo 'Next, we will set our i variable to the value of $j('.$comp_val2.'). We will now jump to the while-statement.\n';
    }elseif($which_desc==2){
        echo "This next step will execute the statement needed to enter the while loop.";
        if($comp_val>=0 && $comp_val3>$comp_val2){
            echo "Since our i variable ($comp_val) is greater than 0 and our array index one slot";
            echo "less than our i variable is less than our temp variable. That is array[i-1]($comp_val3) is less than ";
            echo " $comp_val2 so we will enter the while loop.\n";
        }else{
            if($comp_val<0){
                echo "Our i variable($comp_val) is now less than 0 so we cant enter the loop.";
            }elseif($comp_val3<=$comp_val2){
                echo "Because our array[i-1] is less than or equal to $comp_val2 we can't enter the while-loop again.";
                echo "This will put us to the last line of the for-loop.\n";
            }
        }
        
    }elseif($which_desc==3){
        echo "Now, we set our value of array_original[i] to array_orignal[i-1] ($comp_val).";
        echo "We will also decrement the i variable by one from $comp_val2 to ($comp_val2-1).This takes us back to the top of the loop.\n";
    }elseif($which_desc==4){
        echo "After jumping out of the while-loop, we have now reached the end of our original for-loop.";
        echo "We now know where our temp variable needs to be placed in the array. So, array_original[$comp_val] = $comp_val2 \n.";
    }elseif($which_desc==5){
        echo "The array is now sorted and in ascending order.\n";
    } 
  
}
    


function next_step_button($array1, $i1, $j1, $linenum1, $count1){
    //variables needed
    //array
    //i
    //j
    //linenum
    //count
    $array_copy =$array1;
    $i = $i1;
    $j = $j1;
    $linenum = $linenum1;
    $count = $count1;
    
    // Form to continue to the next step
    echo "<form name='form' action='" . $_SERVER['PHP_SELF'] . "' method='POST'>\n";
    echo "<input type='hidden' name='array' value='" . serialize($array_copy) . "'>\n";
    echo "<input type='hidden' name='iValue' value='$i'>\n";
    echo "<input type='hidden' name='jValue' value='$j'>\n";
    echo "<input type='hidden' name='lineNum' value='$linenum'>\n";
    echo "<input type='hidden' name='count' value='$count'>\n";
    echo "<input type=\"hidden\" name=\"hasPrevious\" value=\"true\">\n";
    echo "<input type='submit' value=\"Next Step in Simulation\">\n";
    echo "</form>\n";
}
function insertion_sort($array_copy, $i1, $j1, $linenum1, $count1){
    // perform the current line of the selection sort
    $array1 = $array_copy;
    $i = $i1;
    $j = $j1;
    $lineNum = $linenum1;
    $count = $count1;
    
    switch($lineNum)
    {
        // Line number = 0
        // for($j=1; $j < $count; $j++){
        case 0:
            
            if($j < $count){
                //step into line 1
                $lineNum = 1;
            }else{
                //pass ovr for-loop, algorithm complete
                $lineNum = 5;
            }
            show_algorithm(0);
            written_section(0, $j, $count, 0);
            next_step_button($array1,$i, $j,$lineNum,$count);
        break;
        // Line number = 1
        // $tmp_val = $array_original[$j];
        // $i = $j;
        case 1:
            
            $tmp_val = $array1[$j];
            $i = $j;
            $lineNum = 2;
            show_algorithm(1);
            written_section(1, $tmp_val, $j, 0);
            next_step_button($array1,$i, $j,$lineNum,$count);
            //step into line 2
        break;
        // Line number = 2
        // while(($i >= 0) && ($array_original[$i-1] > $tmp_val)){
        case 2:
            
            $tmp_val2 = $array1[$i-1];
            if($i>0&&$tmp_val2>$tmp_val){
                //step into line 3
                $lineNum = 3;
            }else{
                //step into line 4
                $lineNum = 4;
            }
            show_algorithm(1);
            written_section(2, $i, $tmp_val,$tmp_val2);
            next_step_button($array1,$i, $j,$lineNum,$count);
        break;
        // Line number = 3
        // $array_original[$i] = $array_original[$i-1];
        //$i--;
        //}
        case 3:
            
            $array1[$i] = $array1[$i-1];
            $tmp_val = $array1[$i];
            $lineNum = 3;
            //step into line 2 again
            show_algorithm(3);
            written_section(3, $tmp_val,0,0);
            next_step_button($array1,$i, $j,$lineNum,$count);
        break;
        // Line number = 4
        // $array_original[$i] = $tmp_val;
        //}
        case 4:
            
            $array1[$i] = $tmp_val;
            //step into line 0
            $lineNum = 0;
            show_algorithm(4);
            written_section(4, $i, $tmp_val, 0);            
            next_step_button($array1,$i, $j,$lineNum,$count);
        break;
        //special case for when algorithm is over
        case 5;
            show_algorithm(5);
            written_section(0, $j, $count, 0);
            echo "YOU ARE DONE!";
            
        break;
    }

    
    
    
    
}
?>		