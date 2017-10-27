<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<title>Address View</title>
		

		<script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=AIzaSyCfP81M8orABu8JpF4SLpeOCKhSp8-EDjk" type="text/javascript"></script>
		<script type="text/javascript">
			var mapAddress = null;
			var locate = null;
			
			function beginning(){
				mapAddress = new GMap2(document.getElementById("map_area"));
				locate = new GClientGeocoder();
				var staffAddress = "<? echo $address;?>";
				if (locate){
					locate.getLatLng(
						staffAddress,
						function(pointer){
							if(!pointer){
								alert(staffAddress + "not found");
							}
							else{
								mapAddress.setCenter(pointer,13);
								var pointing = new GMarker(pointer);
								mapAddress.addOverlay(pointing);
								pointing.openInfoWindowHtml(staffAddress);
							}
						}
					);
				}
			}
			

			function displayLocation(staffAddress){
				if (locate){
					locate.getLatLng(
						staffAddress,
						function(pointer){
							if(!pointer){
								alert(staffAddress + "not found");
							}
							else{
								mapAddress.setCenter(pointer,13);
								var pointing = new GMarker(pointer);
								mapAddress.addOverlay(pointing);
								pointing.openInfoWindowHtml(staffAddress);
							}
						}
					);
				}
			}
		</script>
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
	if(!isset($_COOKIE['uname']))
	{
		echo("<h1>Your access is prohibited!</h1></br></br>");
		echo("<h1>Login for this feature</h1></br></br>");
		echo("<a href=index.php>Login</a>");
	}
	else
	{
		$username = $_COOKIE['uname'];
		$right = $_COOKIE['privilage'];
?>
	<body onload="beginning()" onunload="GUnload()">
		<div id="navMenu">
			<button onclick='window.history.back() '> Go Back </button>
			<h3>You are now logged in to the: <b><?echo $right;?></b> privilege account<h3></br>
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
		<div id="content">
			<h3>Google Map of the address </h3>
			<table>
				<tr>
					<td>
						<div id="map_area" style="position: fixed; width: 690px; height: 550px; "></div>
					</td>
				</tr>
				<tr>
					<td>
						<button onclick='window.history.back() '> Go Back </button>
					</td>
				</tr>
			</table>
		</div>
	</body>
	<?  } ?>
</html>