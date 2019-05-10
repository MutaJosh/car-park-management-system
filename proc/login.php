 <?php 
 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
		
}

if (isset($_POST['Submit'])) {
	
	$phone=$_POST['username'];
	$password=$_POST['password'];

	// To protect MySQL injection for Security purpose
	$phone = stripslashes($phone);
	$password = stripslashes($password);

	/*$phone = mysqli_real_escape_string($phone);
	$password = mysqli_real_escape_string($password);*/

	$connection = mysqli_connect("localhost", "root", "");
	// Selecting Database
	$db = mysqli_select_db($connection, "cpms" );
	// SQL query to fetch information of registerd users and finds user match.
	$query = mysqli_query($connection, "select * from users where password='$password' AND phone='$phone'" );
	$rows = mysqli_num_rows($query);
	//echo $rows;
	$row=mysqli_fetch_array($query);
	if ($rows == 1) {
		$_SESSION['phone']=$phone; // Initializing Session
		$_SESSION['password']=$password; // Initializing Session
		$_SESSION['access']=$row['access'];
	if ($row['access']==2){
		header("Location: ../index.php");
	}
	if ($row['access']==0){
		header("Location: ../0/index.php");
	}
	if ($row['access']==1){
		header("Location: ../0/index.php");
	}
	}
	
	
	
}
?>