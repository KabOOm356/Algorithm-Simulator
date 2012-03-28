<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Hashing Algorithm Simulator</title>
</head>
<body bgcolor="gray">
<table border='1' cellpadding='20' align='center'>
<tr>
<td align='center'>
<h1><font color='yellow'>This is still a work in progress!</font></h1>
<h1>Introduction to the Hashing Algorithm Simulator</h1>
<?php

echo '<p>This file was last updated: ' . date ('F d Y H:i:s.', getlastmod()) . "</p>";

if(!isset($_POST['submit']))
{
	echo "<form method=\"POST\" action=\"" . $_SERVER['PHP_SELF'] . "\">";
	echo "Indicate your initial Array Size:  <input type=\"radio\" name=\"Size\" value=\"7\" checked />";
	echo "7  ";
	echo "<input type=\"radio\" name=\"Size\" value=\"12\" /> 12 <input type=\"radio\" name=\"Size\" value=\"15\" /> 15<br /><br />";
	echo "Input Range: <input name=\"range1\" value=\"$range1\" size=\"3\" maxlength=\"3\" /> to <input name=\"range2\" value=\"$range2\" size=\"3\" maxlength=\"3\" />";
	echo "<br /><br />";
	echo "<input type=\"submit\" name=\"Send\" value=\"Run Simulator\" /> <input type=\"reset\" value=\"Reset\">";
	echo "</form>";
}
?>
</td>
</tr>
</table>
</body>
</html>