 <?php 
 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
	$connection = mysqli_connect("localhost", "root", "");
	$db = mysqli_select_db($connection, "cpms");
	$phone=$_SESSION['phone'];
	$query = mysqli_query($connection, "select * from users where pl_booked='YES' AND phone='$phone'");
	$rows = mysqli_num_rows($query);
	//echo $rows;
	$row=mysqli_fetch_array($query);
	//if ($rows == 1) {
	mysqli_connect("localhost", "root", "") or die(mysqli_error());
    mysqli_select_db($connection, "cpms") or die(mysql_error());
	$sql = "UPDATE users SET pl_booked = 'NO' WHERE phone = '$phone'";
	mysqli_query($connection, $sql);
	$sql = "UPDATE zones SET status = 'UNBOOKED' WHERE phone = '$phone'";
	mysqli_query($connection, $sql);
	 header("Location: ../success_unbook.php");
	//}
		
}