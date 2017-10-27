<?php
$captchaValue=$_POST['captchaValue'];
if($captchaValue==substr($_COOKIE['captchaText'],0,6))
{
	$dbuser = "npantin";
	$dbpass = "Mlniss#23";
	$db = SSID;
	$connect = OCILogon($dbuser, $dbpass, $db);
	if(!$connect)
	{
		echo "An error occured while connecting to database";
		exit;
	}
	
	$sql = "SELECT * FROM userlogin WHERE username= :variable1 and password= :variable2";
	$stmt = OCIParse($connect, $sql);
	if(!$stmt)
	{
		echo "An error occured in parsing sql string";
		exit;
	}
	
	OCIBindByName($stmt, ':variable1', $username);
	OCIBindByName($stmt, ':variable2', $password);
	OCIExecute($stmt);
	
	$flag = false;
	while(OCIFetch($stmt))
	{
		setcookie('uname', $username, time()+3600);
		setcookie('passwd', $password, time()+3600);
		$flag = true;
		$right = OCIResult($stmt, "PRIVILAGE");
		setcookie('privilage',$right,time()+3600);
?>
<html>
	<head>
		<title>Welcome</title>
		<style = "text/css">
			body{
				background-color: lightgreen;
				height: 100vh;
				width: 100vh;
				position: fixed;
			}
			#content{
				height: 100vh;
				left:32%;
				width: 68%;
				position: fixed;
			}
			#navMenu{
				background-color: pink;
				height: 100vh;
				width:30%;
				position: fixed;
				top: 0%:
			}
			#searchTable{
				background-color: yellow;
			}
			h3,h2{
				color: darkblue;
			}
		</style>
	</head>
	<body>
		<div id="content">
			<h1>Welcome <i><?echo $username;?></i></h1></br>
			<h3>You are a <?echo $right;?> user</h3></br>
			<h3>You can perform the actions displayed in the menu bar</h3>
		</div>
		<div id="navMenu">
			<h3>You are now logged in to the:  <b><?echo $right;?></b> privilege account<h3></br>
			<a href="index.php">LOGOUT</a></br></br>
			<h3>MENU</h3></br>
			<a href="viewStaffMembers.php">View Staff Members</a></br></br>
			<?php
				if( $right == admin)
				{
					echo ("<a href=addNewStaff.php>Add New Staff</a></br></br>");
					echo ("<a href=addNewUser.php>Add New User to Database</a></br></br>");
					echo ("<a href=displayUser.php>Display Users from Database</a></br></br>");
					echo ("<a href=deleteUser.php>Delete User from Database</a></br></br>");
				}
				if ( $right == normal)
				{
				echo ("<a href=Accessdenied.html>Add New User to Database</a></br></br>");
				}
			?>
			
			<div id="searchTable">
				<form name="formSearch" method="post" action="searchResult.php">
					<h2>Search Staff</h2>
					<table>
						<tr>
							<td>Surname:</td>
							<td><input type="text" name="searchSurname" autocomplete="off"></td>
						</tr>
						<tr>
							<td>Given Name:</td>
							<td><input type="text" name="searchGivenName" autocomplete="off"></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" name="search" value="Search"></td>
						</tr>
					</table>
				</form>
			</div>
	<?php
	}
	if($flag != true)
	{
		echo ("<h2>Invalid User!</h2></br>");
		echo ("<h2>Try Again</h2></br>");
		echo ("<a href=index.php>Login</a>");
	}
	?>
		</div>
	</body>
</html>
<?php	
	
}
else
{
	echo "<h2>captcha incorrect</h2>";
	echo "</br><a href=index.php>Login</a>";
}
?>