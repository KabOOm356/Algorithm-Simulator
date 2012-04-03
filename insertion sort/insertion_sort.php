<?php
    
    sort_array();
    //initial starting method
    function sort_array()
    {
      
        $array_one = array(2,5,3,8,23,32,76,22,109,4,566,34,11,12);
        
        
        //show values unsorted
        $sort_bool = false;
       //show_array_vals($array_one, $sort_bool);
        
        //show values after sort
        $sort_bool = true;
        
        //sort values
        set_up_html();
        $array_one = stretch_array($array_one);
        end_html();
        
        
    }
        //Pulls submitted values from post array and  calls funtions to see if values are right.
        function setUpValues(){

                //value for array type radio buttons on the main menu
                $arrayType = $_POST['arrayType'];
    
                //either 7, 12 , or 17
                $arraySize = $_POST['arraySize'];
                
                //if array button for random values is chosen
                if($arrayType =="random"){
                   
                   // find int val for low value of the range.
                   $rangeLow = $_POST['rangeLow'];
                   
                   //find int val for high value of therang
                   $rangeHigh = $_POST['rangeHigh'];
                   
                   //assuming a perfect scenario of a low range, and a high range in the right order
                   if(is_numeric($rangeLow)&&is_numeric($rangeHigh)){
                        //failsafe for if user puts a minimum range value greater than the maximum value range
                        if($rangeLow>$rangeHigh){
                            
                            echo '<br /> Your low value for the range was higher than your maximum value. Please re-enter a range.';
                            echo '<br /><a href="first_page.php" id = "button1">TRY AGAIN</a> ';
                            return;
                            
                        }
                        //create an array of random values
                        if($arraySize==7||$arraySize==12||$arraySize==17){
                            for($i =0; $i<$arraySize;$i++){
                                $newArray[$i]= mt_rand($rangeLow, $rangeHigh);    
                            }
                           //the final array we will use from this point i is $newArray
                            $arrayToUse = $newArray;
                            
                        }else{
                            //if the user didnt select an array size value, force it to seven
                            $arraySize = 7;
                            for($i =0; $i<$arraySize;$i++){
                                $newArray[$i]= mt_rand($rangeLow, $rangeHigh);
                                
                            }
                            //$newArray is the array to use at this point
                            sort($newArray);
                            $arrayToUse = $newArray;
                        }
                        
                        
                        
                        //return;
                   }else{
                    echo 'Please re-enter correct range values.';
                    echo '<br /><a href="mainMenu.html" id = "button1">TRY AGAIN</a> ';
                    return; 
                    
                   }
                   
                   
                   
                   
                   
                   
                    
                }elseif($arrayType=='userVals'){
                    $arrayIndexes = $_POST['arrayIndexes'];
                    $arrayToUse = explode(" ", $arrayIndexes);
                    $total = count($arrayToUse);
                    if($total!=$arraySize){
                        echo "<br />your sizes were different.";
                        echo '<br /><a href="mainMenu.html" id = "button1">TRY AGAIN</a> ';
                        
                        return;
                    }
                    //echo "<br /> your sizes were right";
                    
                    //this is the array to use at this point
                    sort($arrayToUse);
                    
                }else{
                    echo '<br /> You must select an array of random values or an array of values made by you.';
                    echo '<br /><a href="mainMenu.html" id = "button1">TRY AGAIN</a> ';
                    return;
                }
             
                
                $isArrayInts = checkArrayVals($arrayToUse);
                $isArrayUnique = checkUniqueVals($arrayToUse);
                $retVal = FALSE;
                if($isArrayInts === TRUE)
                {
                    //if($isArrayUnique===TRUE)
                    //{
                        
                        
                        //continue because array is right
                        //echo "\n made it to creating array.";
                        
                        $topOfArray = count($arrayToUse);
                        $topOfArray = $topOfArray -1;
                        $middle = floor(($topOfArray + 0)/2);
                        
                        
                        $controlVal = 1;
                        
    
                        $a = new visualArray($arrayToUse, $searchValue, $middle, $topOfArray, $controlVal);
      
                        
                        //$a->showVals();
                        //ob_start();
                        
                        $a->controlFunction();
                        $retVal = FALSE;
                    //}
                    //echo "You can't have repeat values.";
                    //echo "\n";
                    //print_r ($arrayToUse);
                    //$result = array_count_values($arrayToUse);
                    //echo "\n";
                    //print_r($result);
                    //echo '<br /><a href="mainMenu.html" id = "button1">TRY AGAIN</a> ';
                    
                }else{
                    echo "<br /> Your array must be full of integers.";
                    echo '<br /><a href="mainMenu.html" id = "button1">TRY AGAIN</a> ';
                    $retVal = FALSE;
                }

        }
        
    function show_algorithm($comp_val, $comp_val2, $comp_val3, $which_line){
        //insertion sort logic
        /*
        1. for($j=1; $j < $count; $j++)
        {
        2.   $tmp_val = $array_original[$j];
        3.    $i = $j;   
        4.    while(($i >= 0) && ($array_original[$i-1] > $tmp_val))
            {
        5.        $array_original[$i] = $array_original[$i-1];
                //visual_array($array_original, $i, $i-1,2);
        6.        $i--;
            }
            //set comp_val variable for written description
        7.  $array_original[$i] = $tmp_val;
        }

        */
        echo '<div align="right">';
        echo '<table border = "1">';
        echo '<tr><th bgcolor="#808080">What Line of the Sort Are We In</th></tr>';
        //the value of $which_line will show which line of the algorithm we are at by making the
        //background of that line yellow
        if($which_line==1)
        {
            echo '<tr><td bgcolor="#FFFF00">for($j=1; $j < $count; $j++)</td></tr>';
            echo '<tr><td>{</td></tr>';
        }else
        {
            echo '<tr><td>for($j=1; $j < $count; $j++)</td></tr>';
            echo '<tr><td>{</td></tr>';
        }
        
        if($which_line==2)
        {
            echo '<tr><td bgcolor="#FFFF00">$tmp_val = $array_original[$j];</td></tr>';
        }else
        {
            echo '<tr><td>$tmp_val = $array_original[$j];</td></tr>';
        }
        
        if($which_line==3)
        {
             echo '<tr><td bgcolor="#FFFF00">$i = $j;</td></tr>';
        }else
        {
            echo '<tr><td>$i = $j;</td></tr>';
        }
        if($which_line==4)
        {
            echo '<tr><td bgcolor="#FFFF00">while(($i >= 0) && ($array_original[$i-1] > $tmp_val))</td></tr>';
            echo '<tr><td>{</td></tr>';
        }else
        {
            echo '<tr><td>while(($i >= 0) && ($array_original[$i-1] > $tmp_val))</td></tr>';
            echo '<tr><td>{</td></tr>';
        }
        if($which_line==5)
        {
            echo '<tr><td bgcolor="#FFFF00">$array_original[$i] = $array_original[$i-1];</td></tr>';
        }else
        {
            echo '<tr><td>$array_original[$i] = $array_original[$i-1];</td></tr>';
        }
        if($which_line==6)
        {
            echo '<tr><td bgcolor="#FFFF00">$i--;</td></tr>';
        }else
        {
            echo '<tr><td>$i--;</td></tr>';
        }
        if($which_line==7)
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
    
        written_section($comp_val,$comp_val2,$comp_val3, $which_line);
        
        
    }
    function set_up_html(){
        echo"<html>";
        echo"\n     <head><title>Software Development 2</title></head>";
        echo"\n     <body>";
        
        
    }
    function end_html(){
        echo"\n   </body></pre>";
        echo"\n</html>";
        
    }
    function show_cur_array($array_one){
        $temp_array = $array_one;
        $count = count($array_one);
        echo '<div align = "center">';
        echo '<pre>Here is our current array.</pre>';
        echo '<table border = "1">';
        echo '<tr>';
        for($i=0; $i<$count;$i++)
        {
            $var = $temp_array[$i];
            echo"<td>$var</td>";

        }
        echo '</tr>';
        echo '</table>';
        echo '</div>';
    }
    //finish this
    function visual_array($array_one, $first_val, $second_val, $which_vers)
    {
        echo '<div>';
        if($which_vers==1)
        {
            
            echo"\n<pre>";
            echo"\n     <table border =\"1\">";
            echo"\n         <tr>";
            
            $count = count($array_one);
            
            for($j=1; $j < $count; $j++){
                $val = $array_one[$j];
                if($j==$first_val)
                {
                    echo"\n          <td  bgcolor=\"#009900\"> $val </td>";
                    
                }elseif($j==$second_val)
                {
                    echo"\n           <td  bgcolor=\"#0000FF\"> $val </td>";    
                }else
                {
                    echo"\n           <td> $val </td>";    
                }   
            }
            echo"\n      </tr>";
            echo"\n     </table>";
            echo"\n</pre>"; 
        }else if($which_vers==2)
        {
            echo"\n<pre>";
            echo"\n     <table border=\"1\">";
            echo"\n         <tr>";
            
            $count = count($array_one);
            
            for($j=1; $j < $count; $j++){
                $val = $array_one[$j];
                if($j==$first_val)
                {
                    echo"\n          <td  bgcolor=\"#009900\"> $val</td>";
                    
                }elseif($j==$second_val)
                {
                    echo"\n           <td  bgcolor=\"#0000FF\"> $val </td>";    
                }else
                {
                    echo"\n           <td> $val </td>";    
                }   
            }
            echo"\n      </tr>";
            echo"\n     </table>";
            echo"\n</pre>"; 
           
        }
        echo'</div>';
    }
    
    //function to get written descriptions
    function written_section($comp_val, $comp_val2, $comp_val3,$which_desc)
    {
        echo '<div>';
        if($which_desc==1)
        {
            echo '<pre> We will check on the iteration of our for-loop. If our $j variable';
            echo ' is still less than our total count of the array, we will enter the for-loop,';
            echo ' else our sort is done.';
            if($comp_val<$comp_val2)
            {
                echo 'Our $j variable of '.$comp_val.' is less than '.$comp_val2.' so we enter the for-loop.</pre>';    
            }else{
                echo 'Our $j variable of '.$comp_val.' is not less than '.$comp_val2.' so we do not enter the for-loop.';
                echo 'The array should be sorted as of now.</pre>';
            }
            
        }else if($which_desc==2)
        {
           echo '\n<pre> We jumped into the next iteration of the for-loop, and now we will set our $tmp_val';
           echo "to $comp_val .";
        }else if($which_desc==3)
        {
            echo '<pre> Now that we have set our $tmp_var, we will set our $i variable to equal $j. So';
            echo ', now $i equals'. $comp_val2 .'</pre>';
        }else if($which_desc==4){
            echo '<pre> We are ready to read through the while loop line. If our value of $i is greater';
            echo 'than 0 and our array index of $i - 1 is  greater than our $tmp_val variable, then we will';
            echo 'Enter the loop.';
            if($comp_val>0 && ($comp_val2>$comp_val3)){
                echo'Because our $i value of '.$comp_val.' is greater than 0, and '.$comp_val2.' is greater than ';
                echo ' '.$comp_val3.', we will now enter the while-loop.</pre>';
            }else{
                echo 'Our values did not fit the requirements for the while-looop so we do not enter it.</pre>';
            }
        }else if($which_desc==5){
            echo '<pre> This step means we passed the criteria to enter the while-loop, so we will now make our ';
            echo 'Array index at $i equal the $i-1 index which is'.$comp_val.'</pre>';
        }else if($which_desc==6){
            echo '<pre> Now that we have moved this index over to the left, we will decrement $i by one down to '.$comp_val.' and then go back to the top';
            echo ' of the while-loop.</pre>';
        }else if($which_desc==7){
            echo '<pre> At this point we have shifted the array as far left as we can while keeping the indexes in order, we now make ';
            echo 'The last index value of $i in our array equal our $tmp_val variable of '.$comp_val.'. Now we go back to the for-loop and try it all again.</pre>';
        }
        echo '</div>';
        
            
    }
    
    //parameters are the 1.)array being changed,
    function stretch_array($array_original)
    {
  
        
        $count = count($array_original);
        //insertion sort logic
        show_cur_array($array_original);
        $j=1;
        show_algorithm($j,$count,0,1);
        for($j; $j < $count; $j++)
        {
            
            
            $tmp_val = $array_original[$j];
            show_algorithm($tmp_val,0,0,2);
            
            $i = $j;
            show_algorithm($i,$j,0,3);
            $comp_val = $array_original[$i-1];
            
            //written_section($comp_val, $tmp_val, 1);
            
            //HEREvisual_array($array_original, $i, $i-1,1);
            
            show_algorithm($i,$comp_val,$tmp_val,4);
            while(($i >= 0) && ($array_original[$i-1] > $tmp_val))
            {
                //visual_array($array_original, $i, $j);
                $text_val = $array_original[$i];
                $text_val2 = $array_original[$i-1];
                
                //written_section($text_val, $text_val2, 2);
                
                //inserting 200 into the parameters because we only want to show new array

                //HEREvisual_array($array_original, $i, $i-1,2);
                $param1 = $array_original[$i-1];
    
                show_algorithm($param1,0,0,5);
                $array_original[$i] = $array_original[$i-1];
                //visual_array($array_original, $i, $i-1,2);
                show_algorithm($i-1,0,0,6);
                $i--;
            }
            //set comp_val variable for written description
            $comp_val2 = $array_original[$i];
            
            //written_section($comp_val2,$tmp_val,3);
            
            show_algorithm($tmp_val,0,0,7);
            $array_original[$i] = $tmp_val;
            
            show_cur_array($array_original);
        }

        return $array_original;
    
       
    }


?>