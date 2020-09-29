<?php 
	
	session_start();

	include 'connect.php';
	
	if($conn)
	{
		if(isset($_POST['login']))
		{
			$uname = mysqli_real_escape_string($conn, $_POST['uname']);
			$pass = mysqli_real_escape_string($conn, $_POST['pass']);

			$check_uname = "SELECT username,password FROM signup WHERE username='$uname' ";
			$res_check_uname = mysqli_query($conn,$check_uname);
			
			if(mysqli_num_rows($res_check_uname)>0)
			{
				while ($check_user=mysqli_fetch_assoc($res_check_uname))
				{

					if($check_user['username']==$uname && $check_user['password']==$pass)
					{
						$_SESSION["uname"] = $uname;
						$_SESSION["touname"] = '';
						
						header("Location:contacts.php");
					}
					else
					{
						?>
						<script type="text/javascript">
							alert("Login credentials are invalid!");
							window.location.assign("index.html");
						</script>
						<?php

					}					
				}			
			}
			else
			{
				?>
				<script type="text/javascript">
					alert("Login credentials are invalid!");
					window.location.assign("index.html");
				</script>
				<?php

			}

					
		}
		mysqli_close($conn);
	}
	else
	{
		?>
			<script type="text/javascript">
				alert("Database connectivity failure!...Please contact the developer!");
				window.location.assign("index.html");
			</script>
		<?php

	}


 ?>