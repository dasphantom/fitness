<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);

//$ip= $_SERVER['REMOTE_ADDR'];
//$ip == 'your ip' or exit();
if ($_POST['submit'] == "") 
{ exit("nope");
}


//connect to database
$db = mysql_connect('host', 'username', 'pw') or die ('Database Failure');
mysql_select_db('database', $db);




//update times field

$sql = "SELECT * FROM helper";
$result = mysql_query($sql);
$data=mysql_fetch_array($result);
$time = $data['date'];


if (date("W") == date("W",$time))
{
//current week is same as stored weeknumber
$sql = "UPDATE helper SET times = times +1";
mysql_query($sql);
}
else
{
//current week is different than stored weeknumber
$sql = "UPDATE helper SET times = 1";
mysql_query($sql);
}

//insert time stamp
$date = time();

$sql = "UPDATE helper SET date = $date";
mysql_query($sql);


//haal week en dagnr op
$sql = "SELECT * FROM helper";
$result = mysql_query($sql);
$data=mysql_fetch_array($result);
$dag = $data['dag'];
$week = $data['week'];

//haal indien week 1 upgrade values op van form en set deze value in database

	if ($week == 1)
	{

	$sql = "SELECT * FROM fitness WHERE dag ='$dag'";
	$result = mysql_query($sql);
	
	while ($data=mysql_fetch_array($result))
		{
		
		$naam = $data['naam'];
		$upgrade = $_POST[$naam];

		$sql = "UPDATE fitness SET upgrade = '$upgrade' WHERE naam = '$naam'";
		mysql_query($sql);

		}
	}

	//update day and week
	//dag = 1
	if ($dag == 1)
	{
	$sql = "UPDATE helper SET dag = '2'";
	mysql_query($sql);
	}
	//dag = 2
	elseif ($dag == 2)
	{
	$sql = "UPDATE helper SET dag = '3'";
	mysql_query($sql);
	}

	//geen dag of dag 2 maar het was dag3, dus week veranderen
	elseif ($week == 1)
	{
	$sql = "UPDATE helper SET dag = '1', week ='2'";
	mysql_query($sql);
	}
	elseif ($week == 2)
	{
	$sql = "UPDATE helper SET dag = '1', week ='3'";
	mysql_query($sql);
	}
	elseif ($week == 3)
	{
	$sql = "UPDATE helper SET dag = '1', week ='4'";
	mysql_query($sql);
	}
	//week 4, dag 3, gewicht omhoog indien upgrade  = 1
	else
		{
		//bekijk eerst welke geupgrade moeten worden
		$sql = "SELECT * FROM fitness WHERE upgrade = 1";
		$result = mysql_query($sql);
		while ($data=mysql_fetch_array($result))
			{
			//bepaal nu upgrade gewicht adv formule
			$upgrades = $data['upgrades'];
			$upgrades++;
			
	
			$naam = $data['naam'];
	
			
			mysql_query($sql);	
	
		
		
			//set upgrades +1
			$sql = "UPDATE fitness SET upgrades = upgrades + 1 WHERE naam = '$naam'";
			mysql_query($sql);
	
			$sql = "UPDATE fitness SET upgrade = 0 WHERE naam = '$naam'";
			mysql_query($sql);
			}

		$sql = "UPDATE helper SET dag = '1', week ='1'";
		mysql_query($sql);

		$sql = "SELECT * FROM fitness";
		$result = mysql_query($sql);
		while ($data=mysql_fetch_array($result))
			{
			echo $data['naam'];
			echo " ";
			echo $data['gewicht'];
			echo " ";
			echo $data['upgrade'];
			echo " ";
			echo $data['upgrades'];
			echo "<br>";
			}
		}
	


?>
<a href="domain/f.php">Klaar en terugkeren</a>



