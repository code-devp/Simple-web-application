<?php
if(isset($_COOKIE['uname']))
{
	$username = $_COOKIE['uname'];
	$right = $_COOKIE['privilage'];
?>
<html>
	<head>
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
	<?php
		$source = simplexml_load_file("staffDetails.xml");
		$flag = 0;
		
		foreach($source->children() as $staffs=>$info){
			$lastName = $info->surname;
			$firstName = $info->givenname;
			$searchGivenName = strtolower($searchGivenName);
			$searchSurname = strtolower($searchSurname);
			if($searchSurname=="" && $searchGivenName=="")
			{
				$flag = 2;
			}
			if($lastName==$searchSurname || $firstName==$searchGivenName)
			{
				$flag = 1;
			}
		}
	?>
	<body>
		<div id="content">
		<?
			if($flag==0)
			{
				echo ("<h2>No records found</h2></br>");
			}
			else if($flag==2)
			{
				echo ("<h2>Enter search value</h2></br>");
			}
			else{
		?>
			<h2>Results Matching</h2>
			<table>
				<tr>
					<th bgcolor="lightblue">STAFF_ID</th>
					<th bgcolor="lightblue">SURNAME</th>
					<th bgcolor="lightblue">GIVEN NAME</th>
					<th bgcolor="lightblue">ADDRESS</th>
				</tr>
				<?
					foreach($source->children() as $staffs=>$info){
						$staff_ID=$info->staff_id;
						$mail_ID=$info->staff_id[email_id];
						$lastName=$info->surname;
						$firstName=$info->givenname;
						$addr=$info->address;
						$searchGivenName = strtolower($searchGivenName);
						$searchSurname = strtolower($searchSurname);
						if($lastName==$searchSurname || $firstName==$searchGivenName){
				?>
				<tr style='background-color:lightgray'>
					<td><?echo "$staff_ID(<a href='mailto:$staff_ID'>$mail_ID</a>)";?></td>
					<td><?echo $lastName;?></td>
					<td><?echo $firstName;?></td>
					<td><?echo "<a href='onMap.php?address=$addr' title='Google Map View'>$addr</a>";?></td>
				</tr>
				<?
						}
					}
		}
				?>
				<tr colspan="4" align="left">
					<td><button onclick='window.history.back() '> Go Back </button></td>
				</tr>
			</table>
		</div>
		<div id="navMenu">
			<button onclick='window.history.back() '> Go Back </button>
			<h3>You are now logged in under <b><?echo $right;?></b> privilage<h3></br>
			<a href="index.php">LOGOUT</a></br></br>
			<h3>You have following options</h3></br>
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
?>