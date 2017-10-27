<!DOCTYPE html>
<html>
	<head>
		<style type="text/css">
		body{
			background-color: yellowgreen;
			height: 100vh;
			width: 100vh;
			position: fixed;
		}
		#title{
			color: #314fcf;
			top: 0%;
			left: 45%;
			position: fixed;
		}
		#loginTable{
			background-color: lightgray;
			height: auto;
			width: 30%;
			top: 15%;
			position: fixed;
			border: double;
			border-block-start-style: solid;
	
		}
		#content{
			top:15%;
			height: 100vh;
			left:32%;
			width: 68%;
			position: fixed;
		}
		
		h2 {
    color: #856387;
}
		</style>
	</head>
	<body>
		<div id="title">
			<h1>Hello User,WELCOME!</h1>
			
		</div>
		<div id="loginTable">
			<h2 align="center">Enter your Login details:</h2>
			<form name="formLogin" method="post" action="testData.php">
				<table>
					<tr>
						<td>Username:</td>
						<td><input type="text" name="username" value="admin"></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type="password" name="password" value="admin"></td>
					</tr>
					<tr>
						<td colspan="2" align="right">
							<img src="insertCaptcha.php">
						</td>
					</tr>
					<tr>
						<td align="left">
						Type the text:
						</td>
							<td><input name="captchaValue" type="text" autocomplete="off" required>
						</td>
					</tr>
					<tr>
						<td></td>
						<td><input name="Login" type="submit" value="Login"></td>
					</tr>
				</table>
			</form>
		</div>
		<div id="content">
			<h1>ACCESS LIMITED!!</h1>
			<br>
			<i>This function is available for authorized users only.</i><br>
			<i>You must</i> <b>login</b> <i>to continue.</i>
		</div>
	</body>
</html>