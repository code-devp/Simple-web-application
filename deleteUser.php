<?php
if(isset($_COOKIE['uname']))
{
	$username = $_COOKIE['uname'];
	$right = $_COOKIE['privilage'];
?>
<html>
	<head>
		<title>View Users</title>
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
			<h3>You are a <?echo $right;?> user</h3></br>
			<h3>Select a USER to delete from database</h3>
			<form name="formDeleteUser" method="post" action="userDeleteSuccess.php">
				<table border="2" width="95%">
					<tr>
						<th bgcolor="lightblue"></th>
						<th bgcolor="lightblue">STAFF_ID</th>
						<th bgcolor="lightblue">EMAIL</th>
						<th bgcolor="lightblue">SURNAME</th>
						<th bgcolor="lightblue">GIVEN NAME</th>
						<th bgcolor="lightblue">ADDRESS</th>
						<th bgcolor="lightblue">USERNAME</th>
						<th bgcolor="lightblue">PASSWORD</th>
						<th bgcolor="lightblue">PRIVILEGE</th>
					</tr>
					<?php
						$dbuser = "npantin"; 
						$dbpass = "Mlniss#23"; 
						$db = "SSID"; 
						$connect = ocilogon($dbuser, $dbpass, $db);

						if (!$connect) {
							echo "An error occurred connecting to the database";
							exit;
						}
					
						$sql1 = "SELECT * FROM userlogin";
						$stmt1 = OCIParse($connect, $sql1);
					
						if(!$stmt1)
						{
							echo "An error occured in parsing the sql string. \n";
							exit;
						}
						OCIExecute($stmt1);
					
						while(OCIFetch($stmt1)){
							echo("<tr style='background-color:lightgray'>");
						
							$col1 = OCIResult($stmt1,1);
							echo("<td>");
							echo("<input type='radio'  name='delete' value=$col1 required>");
							echo("</td>");
						
							echo("<td>");
							echo($col1);
							echo("</td>");
						
							$col2 = OCIResult($stmt1,2);
							echo("<td>");
							echo("<a href='mailto:$col2'>$col2</a>");
							echo("</td>");
						
							$col3 = OCIResult($stmt1,3);
							echo("<td>");
							echo($col3);
							echo("</td>");
						
							$col4 = OCIResult($stmt1,4);
							echo("<td>");
							echo($col4);
							echo("</td>");
						
							$col5 = OCIResult($stmt1,5);
							echo("<td>");
							echo("<a href='onMap.php?address=$col5' title='Google Map View'>$col5</a>");
							echo("</td>");
						
							$col6 = OCIResult($stmt1,6);
							echo("<td>");
							echo($col6);
							echo("</td>");
						
							$col7 = OCIResult($stmt1,8);
							echo("<td>");
							echo($col7);
							echo("</td>");
						
							$col8 = OCIResult($stmt1,7);
							echo("<td>");
							echo($col8);
							echo("</td>");
						}
					?>
					<tr>
						<td colspan="9" align="right">
							<input type="submit" value="Delete User" name="deleteUser">
						</td>
					</tr>
				</table>
			</form>
		</div>
		<div id="navMenu">
			<button onclick='window.history.back() '> Go Back </button>
			<h3>You are now logged in to : <b><?echo $right;?></b> account privilege<h3></br>
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