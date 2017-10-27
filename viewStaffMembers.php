<?php
if(isset($_COOKIE['uname']))
{
	$username = $_COOKIE['uname'];
	$right = $_COOKIE['privilage'];
?>
<html>
	<head>
		<title>View Staff Members</title>
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
			<h3>You are a <?echo $right;?> user.</h3></br>
			<h3>STAFF DETAILS</h3>
			<table cellpadding="5" border="2" width="95%">
				<tr>
					<th bgcolor="lightblue">STAFF_ID</th>
					<th bgcolor="lightblue">SURNAME</th>
					<th bgcolor="lightblue">GIVEN NAME</th>
					<th bgcolor="lightblue">ADDRESS</th>
				</tr>
				<?
					$xmlFile = simplexml_load_file("staffDetails.xml");
					foreach($xmlFile->children() as $staff => $info){
						$staffid = $info->staff_id;
						$mailid = $info->staff_id['email_id'];
						$lastname = $info->surname;
						$firstname = $info->givenname;
						$address = $info->address;
				?>
				<tr>
					<td bgcolor="lightgray"><? echo "$staffid(<a href='mailto:$mailid'>$mailid</a>)";?></td> 
					<td bgcolor="lightgray"><? echo $lastname?></td>
					<td bgcolor="lightgray"><? echo $firstname?></td>
					<td bgcolor="lightgray"><? echo "<a href='onMap.php?address=$address' title='Google Map View'>$address</a>"?></td>
				</tr>
				<?	} ?>
			</table>
		</div>
		<div id="navMenu">
			<button onclick='window.history.back() '> Go Back </button>
			<h3>You are now logged into the : <b><?echo $right;?></b> privilege account<h3></br>
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