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
			Fill in the fields below to add a new <i>User</i>
			</h3></br></br>
			<form name="formAddUser" method="post" action="userAddSuccess.php">
				<table cellspacing="2" cellpadding="5">
					<tr>
						<td>Staff ID</td>
						<td><input type="text" name="staffID" required autocomplete="off" ></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input type="text" name="email" autocomplete="off" ></td>
					</tr>
					<tr>
						<td>Surname</td>
						<td><input type="text" name="surname" autocomplete="off" ></td>
					</tr>
					<tr>
						<td>Given name</td>
						<td><input type="text" name="givenname" autocomplete="off" ></td>
					</tr>
					<tr>
						<td>Address</td>
						<td><input type="text" name="address" autocomplete="off" ></td>
					</tr>
					<tr>
						<td>Username</td>
						<td><input type="text" name="user" autocomplete="off" required></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="password" name="password" autocomplete="off" required></td>
					</tr>
					<tr>
						<td>Privilege</td>
						<td>
							<select name="privilege">
								<option value="admin">Administrator</option>
								<option value="normal">Normal</option>
							</select>
						</td>
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
			<h3>You are now logged in to <b><?echo $right;?></b> privelege account<h3></br>
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