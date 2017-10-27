<?php
if(isset($_COOKIE['uname']))
{
	$username = $_COOKIE['uname'];
	$right = $_COOKIE['privilage'];
?>
<html>
	<head>
		<title>User Added</title>
		<style type="text/css">
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
				background-color:yellow;
			}
			h3,h2{
				color: darkblue;
			}
		</style>
	</head>
	<body>
		<div id="content">
			<?php
				$dbuser = "npantin"; 
				$dbpass = "Mlniss#23"; 
				$db = "SSID"; 
				$connect = OCILogon($dbuser, $dbpass, $db);

				if (!$connect) {
					echo "An error occurred connecting to the database";
					exit;
				}
			
				$sql="INSERT INTO userlogin (staff_id,email,surname,givenname,address,username,privilage,password) values ($staffID,'$email','$surname','$givenname','$address','$user','$privilege','$password')";
				echo ("<h2>Successfully inserted</h2>");
				echo ("<a href=addNewUser.php>Go Back</a>");

				// check the sql statement for errors and if errors report them
				$stmt = ociparse($connect, $sql);

				if(!$stmt) {
					echo "An error occurred in parsing the sql string.\n";
					exit;
				}
				ociexecute($stmt);
			?> 
		</div>
		
		<div id="navMenu">
			<button onclick='window.history.back() '> Go Back </button>
			<h3>You are now logged in to the  <b><?echo $right;?></b> privilege account<h3></br>
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
		</div>
	</body>
</html>
<?php
}
else
{
	echo "invalid";
}
?>