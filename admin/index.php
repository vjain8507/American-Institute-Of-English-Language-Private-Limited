<?php
    include("include/connect.php");
	session_start();
	if(isset($_SESSION['uname']))
	{  
		header("Location: include/home.php");
	}
?>
<!doctype html>
<html lang="en">
    <head>
        <?php include("include/bheader.php"); ?>
    </head>
<body>
    <form method="post" action="./">
        <h3 style="color:#f44336;"><b>WELCOME</b></h3>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" id="name" name="uname" autocomplete="off" required>
            <label class="mdl-textfield__label mdl-button--accent" for="name">Name</label>
        </div><br>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="password" id="password" name="pass" autocomplete="off" required>
            <label class="mdl-textfield__label mdl-button--accent" for="password">Password</label>
        </div><br>
        <button name="login" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Login</button>
    </form>
</body>
</html>
<?php
	if(isset($_POST['login']))
	{
		$uname=$_POST['uname'];
		$pass=$_POST['pass'];
		$check_user="select * from admin WHERE user='$uname' AND pwd='$pass'";
		$run=mysqli_query($con,$check_user);
		if(mysqli_num_rows($run))
		{
			echo "<script>window.open('include/home.php','_self')</script>";
			$_SESSION['uname']=$uname;
		}
		else
		{
			echo "<script>alert('Username or password is incorrect!')</script>";
		}
	}
?>