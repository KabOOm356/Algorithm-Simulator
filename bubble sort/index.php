<html>
<head><title>Software Development II</title></head>
<body>

<div id= "menu">
    
<?php
    echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>\n";
    echo "<table>\n";
    echo "<tr>\n";
    echo "<td>Array Size:</td>\n";
    echo "<td>\n";
    echo "<input type=\"radio\" name=\"arraySize\" value=\"7\" /> 7 <input type=\"radio\" name=\"arraySize\" value=\"12\" />12<input type=\"radio\" name=\"arraySize\" value=\"17\" />17\n";
    echo "</td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "<td>\n";
    echo "<input type=\"radio\" name=\"arrayType\" value=\"random\"/>    Random numbers in this range: \n";
    echo "</td>\n";
    echo "<td>\n";
    if(isset($_POST['rangeLow'])&&isset($_POST['rangeHigh'])){
                 
        echo "<input type =\"text\" name=\"rangeLow\" id=\"rangeLow\" size=\"5\" maxlength =\"10\" value = \"".$_POST['rangeLow']."\"/> to <input type =\"text\" name=\"rangeHigh\" id=\"rangeHigh\" size=\"5\" maxlength =\"10\" value = \"".$_POST['rangeHigh']."\"/>\n";    
            
    }elseif(isset($_POST['rangeLow'])){
        echo "Set a high range!\n";
        echo "<input type =\"text\" name=\"rangeLow\" id=\"rangeLow\" size=\"5\" maxlength =\"10\" value = \"".$_POST['rangeLow']."\"/> to <input type =\"text\" name=\"rangeHigh\" id=\"rangeHigh\" size=\"5\" maxlength =\"10\"/>\n";
            
    }elseif(isset($_POST['rangeHigh'])){
        echo "Set a low range!\n";
        echo "<input type =\"text\" name=\"rangeLow\" id=\"rangeLow\" size=\"5\" maxlength =\"10\"/> to <input type =\"text\" name=\"rangeHigh\" id=\"rangeHigh\" size=\"5\" maxlength =\"10\" value = \"".$_POST['rangeHigh']."\"/>\n"; 
            
    }elseif(!isset($_POST['rangeLow'])&&!isset($_POST['rangeHigh'])){
        echo "Set both ranges!\n";
        echo "<input type =\"text\" name=\"rangeLow\" id=\"rangeLow\" size=\"5\" maxlength =\"10\"/> to <input type =\"text\" name=\"rangeHigh\" id=\"rangeHigh\" size=\"5\" maxlength =\"10\"/>\n";        
    }           
 
    echo "</td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "<td>\n";
    
    echo "<input type=\"radio\" name=\"arrayType\" value=\"userVals\" /> Indexes in Array (number followed by a space):\n";            

    echo "</td>\n";
    echo "<td>\n";
    if(isset($_POST['arrayIndexes'])){
        echo "<input type =\"text\" name=\"arrayIndexes\" id=\"arrayIndexes\" size=\"50\" maxlength =\"70\" value =\"".$_POST['arrayIndexes']."\"/>\n";            
    }else{
        echo "<input type =\"text\" name=\"arrayIndexes\" id=\"arrayIndexes\" size=\"50\" maxlength =\"70\"/>\n";
    }
    echo "</td>\n";
    echo "<td>\n";
    echo "Ex: \"1 13 14 15 87 99\"\n";
    echo "</td>\n";
    echo "<tr>\n";
    echo "<td>\n";
    echo "<br /><input type=\"submit\" name = \"submit\" value=\"Start\" id=\"button1\" />\n";
    echo "</td>\n";
    echo "</tr>\n";
    echo "</table>\n";
    echo "</form>\n";
    echo "ONLY USE THE RANDOM NUMBER RANGE SELCTION AS OF NOW, I NEED TO FIX THE USER MADE ARRAY PART!!";
        
            //logic to create array
    if(isset($_POST['arraySize']))
    {
        if(is_numeric($_POST['rangeLow'])&&is_numeric($_POST['rangeHigh']))
        {                
            $array1 = makeArray();
            go_to_start($array1);
        }else
        {
            echo "One of your ranges is not numeric!\n";
        }
    }elseif(isset($_POST['arraySize']))
    {
        if(isset($_POST['arrayIndexes']))
        {
            $array1 = makeArray();
            go_to_start($array1);
        }else
        {
            echo "If you wanted to create your own indexes they were not set!\n";
        }
    }
            
    function makeArray()
    {
        $var_name = $_POST['arrayType'];
        
        if($var_name=="random")
        {
            for($i = 0; $i < $_POST['arraySize']; $i++)
                $array[$i] = rand($_POST['rangeLow'], $_POST['rangeHigh']);
                               
                shuffle($array);
        }elseif($var_name=="userVals")
        {
            // Split the string array by spaces
            $array = explode(" ", $_POST['arrayIndexes']);
                                    
            for($i = 0; $i < count($array); $i++)
            $array[$i] = intval($array[$i]);
                                                
        }
                        
        return $array;
    }
    function go_to_start($array1)
    {
        $length = count($array1);
        echo "<form action='bubble_sort.php' method='POST'>\n";
	echo "<input type='hidden' name='array' value='" . serialize($array1) . "'>\n";
	echo "<input type='hidden' name='lineNum' value='0'>\n";
        echo "<input type='hidden' name='outerVal' value='0'>\n";
        echo "<input type='hidden' name='innerVal' value='0'>\n";
        //echo "<input type='hidden' name='tmpVal' value='0'>\n";
        echo "<input type='hidden' name='length' value='$length'>\n";
	echo "<input type='submit' value='Run Simulation'>\n";
	echo "</form>";
    }
            

?>