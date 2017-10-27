<?php
if(isset($_COOKIE['uname']))
{
	$username = $_COOKIE['uname'];
	$right = $_COOKIE['privilage'];
?>
<html>
	<head>
		<title>New User</title>
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
				background-color: yellow;
			}
			h3,h2{
				color: darkblue;
			}
		</style>
	</head>
	<body>
		<div id="content">
			<h1>WELCOME <i><?echo $username;?></i></h1></br>
			<h3>You are a <?echo $right;?> user.</br>
				Please complete data below to add new STAFF.
			</h3></br></br>
			<form name="formAddStaff" method="post" action="staffAddSuccess.php">
				<table cellpadding="5">
					<tr>
						<td>Staff ID</td>
						<td><input type="text" name="staffID" required autocomplete="off" required></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input type="text" name="email" autocomplete="off" required></td>
					</tr>
					<tr>
						<td>Surname</td>
						<td><input type="text" name="surname" autocomplete="off" required></td>
					</tr>
					<tr>
						<td>Given name</td>
						<td><input type="text" name="givenname" autocomplete="off" required></td>
					</tr>
					<tr>
						<td>Address</td>
						<td><input type="text" name="address" autocomplete="off" required></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="submit" value="Submit"></td>
					</tr>
				</table>
			</form>
		</div>
	
		<div id="navMenu">
			<button onclick='window.history.back() '> Go Back </button>
			<h3>You are now logged in to <b><?echo $right;?></b> account privilege<h3></br>
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