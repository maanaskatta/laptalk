<?php
session_start();
include 'connect.php';

	if($conn)
	{
		
		if(!($_SESSION['uname']==""))
		{
			$to_user = mysqli_real_escape_string($conn, $_POST['target_user']);

			if((preg_match('/^[0-9]{10}$/', $to_user)))
			{
				$stmt = "SELECT username FROM signup WHERE mobile='$to_user'";
			}
			else
			{
				$stmt = "SELECT username FROM signup WHERE username='$to_user'";				
			}

			$result = mysqli_query($conn,$stmt);

			if(mysqli_num_rows($result)>0)
			{	
				while($temp_res=mysqli_fetch_assoc($result))
				{
					$_SESSION['touname'] = $temp_res['username'];								
				}
				?>
				
				<form action="userchat.php" enctype="multipart/form-data">
					<button type="submit" id="found_user"><?php echo $_SESSION['touname']; ?></button>
				</form>
				<?php						
			}
			else
			{	
				?>
				<p id="search_error">This username doesn't exists..</p>

				<?php
			}
		}
		else
		{
			?>

			<script type="text/javascript">
				alert("Please Login!..");
				window.location.assign('index.html');
			</script>


			<?php
		}

		
		
		
	}

?>