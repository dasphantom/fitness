
<p>

<?php
//$ip = $_SERVER['REMOTE_ADDR'];
//echo $ip;
//$ip == 'your ip' or exit("no ip");

//connect database
$db = mysql_connect('host', 'username', 'password') or die ('Database Failure');
mysql_select_db('database', $db);

//show  last day

$sql = "SELECT * FROM helper";
$result = mysql_query($sql);
$data=mysql_fetch_array($result);
$time = $data['date'];
$x = date('l jS \of F Y h:i:s A',$time);


echo "Laatste keer was:" . $x;
echo "<p>";
echo "Current week:" . date ("W") ;
echo "<br>";
//zelfde week
if ((date("W", $time)) == date ("W"))
{
echo $data['times'] . "/3";
}
else
{	
//different week
echo "0/3";
}

//}
echo "<p>";

//haal week en dagnr op
$sql = "SELECT * FROM helper";
$result = mysql_query($sql);
$data=mysql_fetch_array($result);
$dag = $data['dag'];
$week = $data['week'];

echo "dag" . $dag;
echo "<br>";
echo "week" . $week;
echo "<br>";


//laat zien tabel, met oefening en gewicht en in het geval van week = 1 radiobutton for upgrade
?>
<form id="form1" name="form1" method="post" action="f2.php">
<table>



<?php 
//haal rijen op voor deze dag


$sql = "SELECT * FROM fitness WHERE dag ='$dag' ORDER BY id";
$result = mysql_query($sql);
while ($data=mysql_fetch_array($result))
{
$gewicht = $data['upgrades'] * 2.5;


		
	
	
	
echo "<tr>";
echo "<td>";
echo $data['naam'];
echo "<td>";
echo "</td>";
echo "<td>";
echo $gewicht;
echo "</td>";
echo "<td>";
echo '<input type="checkbox" name="vehicle" value="Bike" />';
echo "</td>";
echo "<td>";
echo '<input type="checkbox" name="vehicle" value="Bike" />';
echo "</td>";
echo "<td>";
echo '<input type="checkbox" name="vehicle" value="Bike" />';
echo "</td>";


if ($week == 1)
{
echo "<td>";
?>
<input type="radio" name="<?php echo $data['naam']?>" value="1" > Ja
<input type="radio" name="<?php echo $data['naam']?>" value="0" CHECKED> Nee
</td>
<?php
}

echo "</tr>";

}
?>

</table>
<br>
Cooling down
<br>
<input type="submit" name="submit" value="Done" action ="f2.php"/>
</form>
<br>
<br>


