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
				if(isset($_COOKIE['uname']) && $_COOKIE['privilage']=="admin")
				{
					$username = $_COOKIE['uname'];
					$right = $_COOKIE['privilage'];
					$pass = $_COOKIE['passwd'];
					
					if( $staffID == "" || $email == "" || $surname == "" || $givenname == "" || $address == ""){
						echo ("<h3>Data incomplete</h3>");
						echo ("<button onclick='window.history.back() '> Go Back </button>");
					}
					else{
						$source = "staffDetails.xml";
						$file = fopen($source,"rb");
						$data = fread($file, filesize($source));
						$cod = new DOMDocument();
						$cod->formatOutput = true;
						$cod->preserveWhiteSpace = false;
						$cod->loadXML($data);
						
						$sourceXml = $cod->documentElement;
						
						$vari = 0;
						$xml1 = simplexml_load_file($source);
						foreach ($xml1->children() as $staffs=>$info){
							$vari++;
						}
						
						$origin = $sourceXml->childNodes->item($vari);
						
						$staffid = $cod->createElement("staff_id");
						$staffidData = $cod->createTextNode($staffID);
						$staffid->setAttribute("email_id",$email);
						$staffid->appendChild($staffidData);
						
						$lastName = $cod->createElement("surname");
						$surname = strtolower($surname);
						$lastNameData = $cod->createTextNode($surname);
						$lastName->appendChild($lastNameData);
						
						$firstName = $cod->createElement("givenname");
						$givenname = strtolower($givenname);
						$firstNameData = $cod->createTextNode($givenname);
						$firstName->appendChild($firstNameData);
						
						$addre = $cod->createElement("address");
						$addreData = $cod->createTextNode($address);
						$addre->appendChild($addreData);
						
						$staff = $cod->createElement("staff");
						$staff->appendChild($staffid);
						$staff->appendChild($lastName);
						$staff->appendChild($firstName);
						$staff->appendChild($addre);
						
						$sourceXml->insertBefore($staff,$origin);
						$cod->save("staffDetails.xml")
		?>
		<h2>Congratulations! Record Successfully added</h2>	
		<a href="addNewStaff.php">Go Back</a>
		<?
					}
				}
			?>
		</div>
		<div id="navMenu">
			<button onclick='window.history.back() '> Go Back </button>
			<h3>You are now logged in to the :<b><?echo $right;?></b> privilege account <h3></br>
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