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
    $tmp_val = $_POST['tmpVal'];
    
    /*
    echo "DEBUG STUFF";
    echo "<br />";
    echo "line num: $lineNum <br />\n";
    echo "i: $i <br />\n";
    echo "j: $j <br />\n";
    */
    insertion_sort1($array1,$i,$j,$lineNum,$tmp_val);
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
//debug method to make sure the insertion sort method I use will work
function sort_prac($array1){
        print_r($array1);
        $arr = $array1;
        
        for($j=1; $j < count($arr); $j++)
        {
	    $tmp = $arr[$j];
	    $i = $j;
	    while(($i >= 0) && ($arr[$i-1] > $tmp)) {
	        $arr[$i] = $arr[$i-1];
	        $i--;
	    }
	    $arr[$i] = $tmp;
	}
	 
        echo "<br />";
        print_r($arr);
    }
function written_section1(){
    
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

function next_step_button($array1, $i1, $j1, $linenum1, $tmp_val1){
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
    $tmp_val = $tmp_val1;
    // Form to continue to the next step
    echo "<form name='form' action='" . $_SERVER['PHP_SELF'] . "' method='POST'>\n";
    echo "<input type='hidden' name='array' value='" . serialize($array_copy) . "'>\n";
    echo "<input type='hidden' name='iValue' value='$i'>\n";
    echo "<input type='hidden' name='jValue' value='$j'>\n";
    echo "<input type='hidden' name='lineNum' value='$linenum'>\n";
    echo "<input type='hidden' name='tmpVal' value='$tmp_val'>\n";
    echo "<input type=\"hidden\" name=\"hasPrevious\" value=\"true\">\n";
    echo "<input type='submit' value=\"Next Step in Simulation\">\n";
    echo "</form>\n";
}
function insertion_sort1($array_copy, $i1, $j1, $linenum1, $tmp_val1){
    /*
    1.)perform the current line of the selection sort with the imported line number
    2.)Set the values of the variables needed for the algorithm/function
    */
    $array1 = $array_copy;
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
    
    switch($lineNum)
    {
        /*
        Line number = 0
        for($j=1; $j < count($arr); $j++) {
        */
        case 0:
            
            if($j < count($array1)){
                
                //step into line 1
                $lineNum = 1;
            }else{
                //pass over for-loop, algorithm complete
                $lineNum = 5;
            }
            show_algorithm1(0);
            show_array($array1);
            next_step_button($array1,$i, $j,$lineNum,$tmp_val);
        break;
        /*
        Line number = 1
        $tmp = $arr[$j];
        $i = $j;
        */
        case 1:    
            $tmp_val = $array1[$j];
            $i = $j;
            $lineNum = 2;
            show_algorithm1(1);
            show_array($array1);
            next_step_button($array1,$i, $j,$lineNum,$tmp_val);
            //step into line 2
        break;
        /*
        Line number = 2
        while(($i >= 0) && ($arr[$i-1] > $tmp)) {
        */
        case 2:
            
            $tmp_val2 = $array1[$i-1];
            if($i>=0&&$tmp_val2>$tmp_val){
                //step into line 3
                $lineNum = 3;
            }else{
                //step into line 4
                $lineNum = 4;
            }
            show_algorithm1(2);
            show_array($array1);
            next_step_button($array1,$i, $j,$lineNum,$tmp_val);
        break;
        /*
        Line number = 3
        $arr[$i] = $arr[$i-1];
        $i--;
        }
        */
        case 3:
            
            $array1[$i] = $array1[$i-1];
            $i = $i -1;
            
            //step into line 2 again
            $lineNum = 2;
            
            show_algorithm1(3);
            show_array($array1);
            next_step_button($array1,$i, $j,$lineNum,$tmp_val);
        break;
        /*
        Line number = 4
        $arr[$i] = $tmp;
        }
        */
        case 4:
            
            $array1[$i] = $tmp_val;
            
            //the iteration part of the for-loop
            $j= $j +1;
            
            //step into line 0
            $lineNum = 0;
            
            show_algorithm1(4);
            show_array($array1);
            next_step_button($array1,$i, $j,$lineNum,$tmp_val);
        break;
        /*
         special case for when algorithm is over
        */
        case 5;
            show_algorithm(5);
            show_array($array1);
            echo "YOU ARE DONE!";
        break;
    }
    
    
}
    
    
    
}
?>		