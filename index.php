<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Algorithm Simulator</title>
</head>
<body bgcolor="gray">
<table border='1' cellpadding='20' align='center'>
	<tr>
		<td align='center'>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<h1>Algorithm Simulator</h1>
				<p>
					Pleases select which algorithm you would like to run:
					<select name="algorithm">
						<option value="BinSim">Binary Search Simulator</option>
						<option value="HashSim">Hashing Simulator</option>
						<option value="SelSort">Selection Sort Simulator</option>
					</select>
					<br/>
					<input type="submit" name="Submit">
				</p>
			</form>
		</td>
	</tr>
</table>
<?php
if(isset($_POST['Submit']))
{
	switch($_POST['algorithm'])
	{
		case "BinSim":
			header("Location: Binary Search Algorithm");
		break;
		case "HashSim":
			header("Location: Hashing Algorithm");
		break;
		case "SelSort":
			header("Location: Selection Sort Algorithm");
		break;
	}
}
?>
</body>
</html>