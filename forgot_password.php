<?php
	
	include 'connect.php';
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>

<!DOCTYPE html>
<html>
<head>
	<title>LAP/TALK</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="initial-scale=1.0 , minimum-scale=1.0 , maximum-scale=1.0" />
</head>
<body>

	<div id="change_password_body">
		<i onclick="window.location.assign('index.html');" style="position: absolute;top: 6px;left: 7px;color: white;float: left;cursor: pointer;font-size: 30px;z-index: 5;padding-right: 15px;" class="fa fa-arrow-left" aria-hidden="true"></i>
	
		<form method="POST" enctype="multipart/form-data">
		<br>
		<label>Username :</label>	<input id="boxes" type="text" name="username" required><br>
		<label>Current Password :</label>	<input id="boxes" type="password" name="current" required><br>
		<label>New Password :</label>	<input id="boxes" type="password" name="newpass" required><br>
		<label>Confirm Password :</label>	<input id="boxes" type="password" name="con_newpass" required><br>
			<button id="submit" type="submit" name="submit" value="submit">SUBMIT</button>
		</form>
		
	</div>

</body>
</html>

<?php
	
	
	if(isset($_POST['submit']))
	{
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$current = mysqli_real_escape_string($conn, $_POST['current']);
		$newpass = mysqli_real_escape_string($conn, $_POST['newpass']);
		$con_newpass = mysqli_real_escape_string($conn, $_POST['con_newpass']);

		if($newpass==$con_newpass)
		{
			if(strlen($newpass)>7 && strlen($con_newpass)>7)
			{
				if($current!=$newpass)
				{
					$stmt = "SELECT password FROM signup WHERE username='$username'";
					$stmt_res = mysqli_query($conn,$stmt);

					if(mysqli_num_rows($stmt_res)>0)
					{
						while ($check_pass=mysqli_fetch_assoc($stmt_res))
						{
							if($check_pass['password']==$current)
							{
								$update_status = "UPDATE signup SET password='$newpass' WHERE username='$username' ";
								$status_result = mysqli_query($conn,$update_status);
								?>
								<script type="text/javascript">
									alert("Your password has been changed successfuly!..");
									window.location.assign("index.html");
								</script>

								<?php
							}
							else
							{
								?>
								<script type="text/javascript">
									alert("Username/Password is incorrect!. ");
								</script>
								<?php
							}
						}
					}
					else
					{
						?>
						<script type="text/javascript">
							alert("Username/Password is incorrect!. ");
						</script>

						<?php
					}
				}
				else
				{
					?>
					<script type="text/javascript">
						alert("You cannot use the same password again!..");
					</script>
					<?php

				}
			}
			else
			{
				?>
				<script type="text/javascript">
					alert("Password must have minimum 8 characters!..");
				</script>
				<?php
			}
		}
		else
		{
			?>
			<script type="text/javascript">
				alert("Passwords do not match!..");
			</script>
			<?php
		}


	}

?>

<style type="text/css">
	
	body
	{
		background-image: linear-gradient(to right,#000428,#004e92); 
	}

	#change_password_body
	{
		position: absolute;
		top: 0px;
        bottom: 0px;
        left: 0px;
        right: 0px;
        margin: auto;
		height: 7.9cm;
		width: 11.5cm;
		border-radius: 20px;
		box-shadow: 5px 10px 10px teal;            
        background: rgba(0, 0, 0, 0.7);
	}

	label
	{
	   position: relative;
	   text-align: right;
       float: left;
       clear: left;
       margin-top: 25px;
       width: 50%;
       font-size: 19px;
       color: white;
       font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        
	}

	#boxes{
       position: relative;
       float: right;
       clear: right;
       border: none;
       margin-top: 20px;
       margin-right: 15px;
       padding-left: 7px;
       width: 40%;
       font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
       font-size: 18px;
    }

    #submit
    {
    	position: absolute;
    	bottom: 10%;
    	left: 30%;
    	height: 40px;
        width: 150px;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        font-size: 23px;
        cursor: pointer;
        letter-spacing: 2px;
        padding-left: 20px;
        padding-right: 20px;
        background: none;
        border:  2px solid teal;
        color: whitesmoke;
    }

    @media only screen and (max-width: 488px) 
    {
    	#change_password_body
    	{
			width: 80%;
    	}

    	label
    	{
    		font-size: 4vw;
    	}

    	#submit
    	{
    		position: absolute;
    		width: 80%;
        	margin-left: 10%;
        	margin-right: 10%;
        	left: 0%;
        	font-size: 5vw;
        	bottom: 5vh;

    	}

    }

     @media only screen and (max-width: 411px)
    {

    	label
    	{
    		font-size: 4.5vw;
    	}

    	#submit
    	{
    		position: absolute;
    		width: 80%;
        	margin-left: 10%;
        	margin-right: 10%;
        	left: 0%;
        	bottom: 5vh;

    	}

     }


</style>

