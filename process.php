<?php
	
	session_start();

	include 'connect.php';

	if($conn)
	{
			
		date_default_timezone_set('Asia/Kolkata'); 

		$temp_message = mysqli_real_escape_string($conn, $_POST['type_area']);
		$from_user = mysqli_real_escape_string($conn, $_SESSION['uname']);
		$to_user = mysqli_real_escape_string($conn, $_SESSION['touname']);
		$time = date("h:i a");
		$date = date("Y-m-d");
		$id = 0;
		//$message = addcslashes($temp_message,"'");

		/*if($to_user=="")
		{
			?>
			<script type="text/javascript">
				alert('Please select your friend!..');
				window.location.assign("chatarea.php");
			</script>

			<?php
		}
		else*/

		if($temp_message=="")
		{	
			?>
			<script type="text/javascript">
				alert('Enter any message...');
			</script>

			<?php
		}
		else
		{
			$send_message = "INSERT INTO messages VALUES(0,'$temp_message','$from_user','$to_user','$time','$date','unseen')";

			if(mysqli_query($conn,$send_message))
			{
				
				if(isset($_GET['recent_click']))
				{
					$_SESSION["touname"] = mysqli_real_escape_string($conn, $_GET['recent_click']);
				}
				


				$sender = mysqli_real_escape_string($conn, $_SESSION['uname']);
				$receiver = mysqli_real_escape_string($conn, $_SESSION['touname']);
				
				$display_chat ="SELECT * FROM `messages` WHERE from_user='$sender' AND to_user='$receiver' OR to_user='$sender' AND from_user='$receiver' ORDER BY id ";

				$chat_result = mysqli_query($conn,$display_chat);
				$chat_count = mysqli_num_rows($chat_result);

				while ($chat_rows=mysqli_fetch_assoc($chat_result))
				{
					
					if($chat_rows['from_user'] == $_SESSION['uname'])
					{
						?>
						<br>
						<div id="sender_message_body">

							<div id="message_of_sender">

								<?php echo $chat_rows['message'];  ?>
								
							</div>

							<div id="sender_time_of_message">

								<?php echo $chat_rows['time']  ?>

							</div>
						</div>
						<br>
						
						<?php
					}
					else
					{
						?>
						<br>
						<div id="receiver_message_body">

							<div id="message_of_user">

								<?php echo $chat_rows['message'];  ?>
								
							</div>

							<div id="receiver_time_of_message">

								<?php echo $chat_rows['time']  ?>

							</div>
						</div>
						<br>
						
						<?php
					}
				}
				
				
			}
			else
			{

			echo "Message sending error";
			
			}
		}
		mysqli_close($conn);
		
	}
	else
	{

		echo "Database connectivity error!..";
	}


?>

