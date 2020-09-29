<?php
	session_start();
	include 'connect.php';

	
?>


<!DOCTYPE html>
<html>
<head>
	<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="initial-scale=1.0 , minimum-scale=1.0 , maximum-scale=1.0" />
	<title>LAP/TALK</title>
</head>

<script type="text/javascript">
		
	$(document).ready(function()
	{
		setInterval(() =>
		{
			text_render();			
		}, 1000);


	
		function text_render()
		{
			$.ajax({
				method: "POST",
				url: "chat_refresh.php",
				dataType: "text",
				success: function (response) {
					$('#chat_display').html(response);
					
				}
			});
		}


		$('#send').click(function(e){
			e.preventDefault();			
			$.ajax({
				method: "POST",
				url: "process.php",
				data: $('#send_chat').serialize(),
				dataType: "text",
				success: function (response) { 
					$('#chat_display').html(response);
				}
			});
			updateScroll();
			$('#type_area').val("");
		});

		function updateScroll()
		{	
			var test = document.getElementById("chat_display").scrollHeight;
			$('#chat_display').animate({scrollTop: test},1500);
			return false;		
		}
	});	
		

</script>

<body onload="var test = document.getElementById('chat_display').scrollHeight;
			$('#chat_display').animate({scrollTop: test},1500);
			return false;">
	<div id="chatarea">


		<div id="chat_display">

			<?php
			
			if(isset($_GET['recent_click']))
			{
				$_SESSION["touname"] = mysqli_real_escape_string($conn, $_GET['recent_click']);
			}

			if($_SESSION['uname']=="")
			{
				?>
				<script type="text/javascript">
					alert("Please Login!..");
					window.location.assign('index.html');
				</script>

				<?php

			}

			$sender = $_SESSION['uname'];
			$receiver = $_SESSION['touname'];

			?>
			<script type="text/javascript">
				document.getElementById('test').style.background='violet';
			</script>

			<?php

			$update_status = "UPDATE messages SET status='seen' WHERE to_user='$sender' AND from_user='$receiver' ";
			$status_result = mysqli_query($conn,$update_status);
			
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

				
			?>
			
		</div>

	<form id="send_chat" method="POST" enctype="multipart/form-data" autocomplete="off">
		<textarea id="type_area" name="type_area" placeholder="Type to send message..." required></textarea>
		<input id="send" type="submit" name="send" value="SEND">
	</form>

	<h1 id="show_ajax"></h1>
	
</div>



<div id="user_select">

	<i onclick="window.location.assign('contacts.php');" style="position: absolute;top: 6px;left: 7px;color: white;float: left;cursor: pointer;font-size: 30px;z-index: 5;border-right: 3px solid white;padding-right: 15px;" class="fa fa-arrow-left" aria-hidden="true"></i>

	<span style="position: absolute;left: 75px;"><?php echo $_SESSION['touname'];?></span>

	<i style="float: right;margin-right: 15px;cursor: pointer;" class="fa fa-bars" aria-hidden="true"></i>

</div>


</body>
</html>

<style type="text/css">
	
	body
	{	
		background-image: linear-gradient(to right,#000428,#004e92); 
		transform: scale(0.9);
		
	}

	#chatarea
	{
		position: absolute;
		transform: translate(20vw,13vh);		
		height: 600px;
		width: 60%;
		display: block;
		background: rgba(0,0,0,0.8);
		border-radius: 20px;
		box-shadow: 10px 10px 10px rgba(0,0,0,0.7);
	}

	#type_area
	{
		position: absolute;
		top: 542px;
		height: 40px;
		width: 70%;
		margin-left: 18px;
		background: none;
		font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
		color: white;
		border: none;
		border-bottom: 3px solid white;
		padding-left: 15px;
		font-size: 21px;
		
	}

	#type_area:focus
	{
		background: white;
		border-radius: 20px;
		padding-top: 5px;
		font-weight: bold;
		color: black;
	}

	#send
	{
		position: relative;
		top: 68px;
		left: 78%;
		height: 45px;
		width: 20%;
		font-size: 16px;
		cursor: pointer;
	}

	#chat_display
	{
		position: relative;
		top: 50px;
		overflow-y: scroll;
		font-size: 19px;
		padding-left: 5px;
		left: 18px;
		height: 480px;
		width: 95%;
		display: inline-block;
		background: none;	
	}

	#sender_message_body
	{
		
		float: right;
		clear: right;
		margin-right: 10px;
		margin-bottom: 10px;		
		margin-top: 5px;
		max-width: 45%;
		display: block;		
		font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
		padding-top: 10px;
		padding-right: 10px;
		padding-left: 10px;		
		font-size: 20px;
		background-color: #4fe859;			
	}

	

	#sender_time_of_message
	{
		position: relative;	
		float: right;
		color: black;
	}

	#receiver_message_body
	{	
		float: left;
		clear: left;
		margin-bottom: 10px;
		margin-top: 5px;
		max-width:45%;
		font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
		padding-left: 10px;
		padding-top: 10px;
		padding-right: 10px;
		font-size: 20px;
		background-color: #F3F9A7;
	}

	#receiver_time_of_message
	{	
		position: relative;	
		float: left;
		color: black;
	}

	#user_select
	{
		position: absolute;
		top: 7vh;
		left: 20vw;		
		text-align: left;
		font-size: 27px;
		padding-top: 5px;
		padding-bottom: 5px;
		height: 30px;
		width: 60%;	
		color: white;	
		background:rgba(0,0,0,0.4);
		font-weight: bold;		
		letter-spacing: 5px;
	}

	

	#back
	{
		position: relative;
		float: left;
		text-align: center;
		margin-left: 20px;
		height: 30px;
		font-size: 18px;
		font-weight: bold;
		width: 70px;
	}


	@media only screen and (max-width: 878px)
	{
		#sender_message_body
		{
			margin-right: 10px;
			font-size: 2.4vw;
			
		}

		#receiver_message_body
		{
			font-size: 2.4vw;
			
		}

		#type_area
		{
			position: absolute;
			font-size: 3vw;
			width: 35vw;
		}

		#send
		{	
			
			width: 10vw;
		}
		
	}


	@media only screen and (max-width: 500px)
	{
		#chatarea
		{
			transform: translate(0vw,20vh);
			width: 100%;

		}

		#sender_message_body
		{
			 
			margin-right: 20px;
			font-size: 4.3vw;
			max-width: 50%;
			font-weight: bold;
		}

		#receiver_message_body
		{
			font-size: 4.3vw;
			max-width: 50%;
			font-weight: bold;
		}

		#type_area
		{
			position: absolute;
			font-size: 4.5vw;
			width: 55vw;
		}

		#send
		{	
			
			width: 15vw;
		}

		#user_select
		{
			transform: translate(-20vw,0vh);

			width: 100%;
		}


	}


</style>
