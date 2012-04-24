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
    bubble_sort($array_copy,$lineNum,$outerVal,$innerVal,$length);

}

function bubble_sort($array_copy,$lineNum,$outerVal,$innerVal, $length){
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
            if($outerVal < $length){
                //enter for-loop
                $lineNum =1;
            }else{
                $lineNum = 4;
                //algorithm is over
            }
            next_step_button($array_copy,$lineNum,$outerVal,$innerVal, $length);
        break;
        /*
        Line number = 1
        for ($innerVal = 0; $innerVal < $length; $innerVal++)
        */
        case 1:    
            if($innerVal < $length){
                //enter for-loop
                $lineNum =2;
            }else{
                //algorithm is over
                $outerVal = $outerVal + 1;
                $lineNum = 0;
            }
            next_step_button($array_copy,$lineNum,$outerVal,$innerVal, $length);
        break;
        /*
        Line number = 2
        if ($array_copy[$outerVal] < $array_copy[$innerVal])
        */
        case 2:
            $compareValue1 = $array_copy[$outerVal]; 
            $compareValue2 = $array_copy[$innerVal];
            if($compareValue1<$compareValue2){
                //enter if-statement
                $lineNum =3;
            }else{
                //pass over if-statement
                $innerVal = $innerVal + 1;
                $lineNum = 1;
            }
            
            next_step_button($array_copy,$lineNum,$outerVal,$innerVal, $length);
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
            $lineNum = 1;
            next_step_button($array_copy,$lineNum,$outerVal,$innerVal, $length);
            //increment inner for-loop
        break;
        /*
        Line number = 4
        case for when algorithm is over
        */
        case 4:
            print_r($array_copy);
            echo "<br /> ARRAY SHOULD BE SORTED!";
        break;
        
    }
        
}
function next_step_button($array_copy, $lineNum, $outerVal, $innerVal, $length){
    /*variables needed
    array, linenum, outerval, innerval, tmpVal, length
    */
    // Form to continue to the next step
    echo "<form name='form' action='" . $_SERVER['PHP_SELF'] . "' method='POST'>\n";
    echo "<input type='hidden' name='array' value='" . serialize($array_copy) . "'>\n";
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