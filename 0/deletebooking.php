<?php
include('inc/connect.php');


if (isset($_POST['delete'])){

$id=$_POST['selector'];

$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysql_query("DELETE FROM bookings where id='$id[$i]'");
}
header("location: bookings.php");

}
?>