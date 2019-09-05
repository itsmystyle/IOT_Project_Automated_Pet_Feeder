<?php
	
echo '<form method="post" action="http://s103062161.web.2y.idv.tw/InternetOfThing_Priend/login.php">
		<table align="center" border="0">
			<tr>
				<td><input type="text" name="user_name" placeholder="Username" required>
					<span style="color:red;">* <sup>required</sup><span>
				</input></td>
			</tr>
			<tr>
				<td><input type="password" name="user_pass" placeholder="Password" required>
					<span style="color:red;">*<span>
				</input></td>
			</tr>
			<tr>
				<td><button type="submit" name="submit">Sign Up</button></td>
			</tr>
		</table>
	</form>';

?>