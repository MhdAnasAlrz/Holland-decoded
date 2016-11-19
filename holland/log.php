<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>welcome</title>
	<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="login_style.css">
</head>
<body>
<div class="our_logo">
<img src="logo.png" alt="logo" width="200" height="75">
<h3 class="logo_text">HOLLAND DECODED</h3>
</div>
<div class="login">
	<h2>Login</h2>
    <form action=" " method="post">
    	<input type="text" name="username1" placeholder="username" >
        <input type="password" name="password1" placeholder="password" >
        <button type="submit" name="login" class="btn btn-primary btn-block btn-large">login</button>
    </form>
	<br>
	<h2>register now !</h2>
	<form action=" " method="post">
    	<input type="text" name="username" placeholder="username" >
    	<input type="text" name="email" placeholder="email" >
    	<input type="password" name="password" placeholder="password" >
        <input type="password" name="confirm_password" placeholder="confirm Password" >
        <button type="submit" name="submit" class="btn btn-primary btn-block btn-large">register</button>
    </form>
</div>
</body>
</html>
<?php 
if(isset($_POST['login'])){

//get the value from form login 
$username=$_POST['username1'];
$password=$_POST['password1'];

//Connect to the database
$connection = mysqli_connect('localhost' , 'root' , 'root' , 'holland');
if(!$connection){
   die ("database connection has failed");
}

//to prevent mysql injection
$username = stripcslashes($username);
$password = stripcslashes($password);
$username = mysqli_real_escape_string($connection, $username);
$password = mysqli_real_escape_string($connection, $password);


//query the database for users
$query = "select * from users where username='$username' and password='$password'";
       $result=mysqli_query($connection , $query)
       or die("failed to query databases".mysql_error());
        
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
if($row['username']==$username && $row['password']==$password){

//to print the name in next page 
$_SESSION['username'] = $row['username'];
$_SESSION['id']= $row['id'];
header('location: index.php');
//echo $_SESSION['username'];
}else{
   echo "<script>alert ('Invalid username or password');</script>";
}
}

//get the value from form login 
if(isset($_POST['submit'])){
	$username=$_POST['username'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$confirm_password=$_POST['confirm_password'];

//Connect to the database
$connection = mysqli_connect('localhost' , 'root' , 'root' , 'holland');
if(!$connection){
	die ("database connection is faild");
}
else{
	// echo "you are connected";
}
//if the form without value
if ($email && $password && $username){
//	echo "$email" . "<br>";
//	echo "$password";
}
else {
	echo "<script>alert ('this field cannot be blank');</script>";
}
//check valid email
if($email){
	if(!strpos($email,'@')){
		echo "<script>alert ('invalid email');</script>" . "<br>";
	}
	else{ 
		//if the email exists 
		$check = "select * from users where email='$email' ";
        $result0=mysqli_query($connection , $check)or die("failed to query databases".mysql_error());
        $row = mysqli_fetch_array($result0, MYSQLI_ASSOC);
        if($row['email']== $email)
                    {
                        echo"<script>alert ('the email you inserted it does exist');</script>";
                        //header('location: index.php');
                    }
		//start inserting data if password biger than 6 and password = confirm password and name doesn't contant namber
        elseif(strlen($password) <6){
         echo	"<script>alert ('your password is too short');</script>";
        }
        elseif ($password != $confirm_password){
        	echo "<script>alert ('your password is wrong');</script>";
        }
        
        elseif(strpos($username, '1')) {
        	echo "<script>alert ('your username contain numbers');</script>";
        }
        elseif(strpos($username, '2')) {
        	echo "<script>alert ('your username contain numbers');</script>";
        }
        elseif(strpos($username, '3')) {
        	echo "<script>alert ('your username contain numbers');</script>";
        }
        elseif(strpos($username, '4')) {
        	echo "<script>alert ('your username contain numbers');</script>";
        }
        elseif(strpos($username, '5')) {
        	echo "<script>alert ('your username contain numbers');</script>";
        }
        elseif(strpos($username, '6')) {
        	echo "<script>alert ('your username contain numbers');</script>";
        }
        elseif(strpos($username, '7')) {
        	echo "<script>alert ('your username contain numbers');</script>";
        }
        elseif(strpos($username, '8')) {
        	echo "<script>alert ('your username contain numbers');</script>";
        }
        elseif(strpos($username, '9')) {
        	echo "<script>alert ('your username contain numbers');</script>";
        }
        elseif(strpos($username, '0')) {
        	echo "<script>alert ('your username contain numbers');</script>";
        }
        else {
        $connection = mysqli_connect('localhost' , 'root' , 'root' , 'holland');
		$query = "insert into users (username,email,password) values ('$username' ,'$email' ,'$password')";
		$result=mysqli_query($connection , $query);
			if(!$result){
				die ("query failded" . mysqli_errno());
			}else{
				$_SESSION['username'] = $_POST['username'];
				//echo "welcome " . $_POST['username'];
				header('location: index.php');
			}
	}
}
}
// pick up the id for next page 
$query = "select * from users where email='$email' and password='$password'";
       $result=mysqli_query($connection , $query)
       or die("failed to query databases".mysql_error());
        
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$_SESSION['id']=$row['id'];
}
?>

