<!DOCTYPE html>
<html>
<head>
    <title>LAP/TALK</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="initial-scale=1.0 , minimum-scale=1.0 , maximum-scale=1.0" />
</head>
<body>

    <div id="signupbody" >
        <i onclick="window.location.assign('index.html');" style="position: absolute;top: 6px;left: 7px;color: white;float: left;cursor: pointer;font-size: 30px;z-index: 5;padding-right: 15px;" class="fa fa-arrow-left" aria-hidden="true"></i>
        <br>
        <form method="POST" enctype="multipart/form-data" action="signup.php">
            
            <input id="box" type="text" name="firstname" placeholder="First Name" >
            <input id="box" type="text" name="lastname"  placeholder="Last Name"><br>
            <input id="box" type="text" name="phnnumber" placeholder="Mobile Number"><br>
            <input id="box" type="text" name="username" placeholder="Username">
            
            <input id="box" type="password" name="password" placeholder="Enter Password"><br>
            <input id="box" type="password" name="conpassword" placeholder="Confirm Password"><br>
            <input id="signup" type="submit" name="signup" value="Sign Up">
            
        </form>

    </div>

</body>
</html>

<style>

    body{
        
        background-image: linear-gradient(to right,#000428,#004e92); 

    }

    #signupbody{

        position: absolute;
        top: 0px;
        bottom: 0px;
        left: 0px;
        right: 0px;
        margin: auto;
        height: 11.5cm;
        width: 10.5cm;
        border-radius: 20px;
        background: rgba(0, 0, 0, 0.7);
        display: block;
        

    }

    #box{
        position: relative;
        height: 25px;
        margin-top: 45px;
        margin-left: 30px;
        padding-left: 10px;
    }

    #signup{
        position: relative;
        top: 45px;
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

    @media only screen and (max-width: 541px) 
    {

      #signupbody
      {
        position: absolute;
        top: -10%;
        height: 450px;
        margin-left: 5%;
        margin-right: 5%;
        width: 90%;
      }

      #box
      { 
        font-size : 3vw;
        margin-right: 0%;
        width: 30vw;
      }

      #signup
      {
        width: 80%;
        margin-left: 10%;
        margin-right: 10%;
        left: 0%;
      }
    } 

    @media only screen and (max-width: 311px)
    {
        #signupbody
        {
            height:550px;
        }

        #box
        { 
            position: relative;
            margin-top: 15%;
            margin-right:30%;
            width:60vw;
        }
    }

</style>



<?php 

	include 'connect.php';

	if($conn)
	{
		if(isset($_POST['signup']))
		{
			$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
			$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
			$phnnumber = mysqli_real_escape_string($conn, $_POST['phnnumber']);
			$username = mysqli_real_escape_string($conn, $_POST['username']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);
			$conpassword = mysqli_real_escape_string($conn, $_POST['conpassword']);
			
			if( empty($firstname) || empty($lastname) || empty($phnnumber) || empty($username) || empty($password) || empty($conpassword) )
			{
				?>
				<script type="text/javascript">
					alert("Please fill the Sign Up fields!!");
				</script>
				<?php
				
			}
			else
			{
				$check_username = "SELECT username FROM signup WHERE username='$username'";
				$res_check_username = mysqli_query($conn,$check_username);

                $check_number = "SELECT mobile FROM signup WHERE mobile='$phnnumber'";
                $res_check_number = mysqli_query($conn,$check_number);

				if(mysqli_num_rows($res_check_username)>0)
				{
					?>
					<script type="text/javascript">
						alert("Username already exists!!");
					</script>
					<?php
				}
                elseif(mysqli_num_rows($res_check_number)>0)
                {   
                    ?>
                    <script type="text/javascript">
                        alert("Phone number already exists!..");
                    </script>
                    <?php
                }
				elseif ($password !== $conpassword) 
				{
					?>
					<script type="text/javascript">
						alert("Passwords doesn't match!...Please check again.");
						
					</script>
					<?php
                }
                elseif(!(preg_match('/^[0-9]{10}$/', $phnnumber)))
                {
                    ?>
					<script type="text/javascript">
						alert("Please enter a valid phone number..");
						
					</script>
					<?php
                }
                elseif(strlen($username)<6)
                {
                    ?>
					<script type="text/javascript">
						alert("Username must be atleast 6 characters long..!");
						
					</script>
					<?php  
                }
                elseif (strlen($password)<6) 
                {   
                    ?>
					<script type="text/javascript">
						alert("Password must be atleast 7 characters long..!");
						
					</script>
					<?php                     
                }
				else
				{
					$stmt = "INSERT INTO signup VALUES('$firstname','$lastname','$phnnumber','$username','$password')";

					if(mysqli_query($conn,$stmt))
					{
						?>
						<script type="text/javascript">
							alert("You have successfully created your account!");
							window.location.assign("index.html");
						</script>
						<?php
					}
				}

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