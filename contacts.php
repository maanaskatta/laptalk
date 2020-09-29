<?php
	session_start();

	include 'connect.php';
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
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
			recent_chat_render();		
		}, 1000);

		$('#find').click(function(e){
			e.preventDefault();			
			$.ajax({
				method: "POST",
				url: "searchuser.php",
				data: $('#search_form').serialize(),
				dataType: "text",
				success: function (response) { 
					$('#search_log').html(response);
				}
			});			
		});

		function recent_chat_render()
		{
			$.ajax({
				method: "POST",
				url: "notification.php",
				dataType: "text",
				success: function (response) {
					$('#render_recent').html(response);
					
				}
			});
		}	
	});	

	
		
</script>

<body>
	<p id="appname">LAP/TALK</p>

	<form action="logout.php">
		<input id="logout" type="submit" name="logout" value="LOGOUT">
	</form>

	<input id="logout" type="button" name="user_account" value= <?php echo $_SESSION["uname"];?>>
	

	
	<div id="contacts">

		<form id="search_form" method="POST" enctype="multipart/form-data" autocomplete="off">
		<i style="color: white;position: absolute;margin-left: 7px;font-size: 20px;margin-top: 30px;" class="fa fa-search" aria-hidden="true"></i><input id="search" type="text" name="target_user" placeholder="Mobile No./Username.." required>
			<input type="submit" id="find" name="find" value="FIND">
		</form>

		<div id="search_log">
			
		</div>

		<div id="recent_chats">

			<p style="color: white;font-size: 20px;text-align: center;">Recent chats</p>
			<hr style="position: relative;bottom: 20px;color: black">
			
			<div id="render_recent">

						
			</div>
			
		</div>
	</div>

	

	
</body>
</html>

<style type="text/css">
	
	body
	{	
		background-image: linear-gradient(to right,#000428,#004e92); 
		transform: scale(0.9);
		
	}

	#contacts
	{
		position: absolute;
        top: 16vh;
        left: 30vw;
		height: 80vh;
		width: 35vw;
		background: rgba(0,0,0,0.7);
		box-shadow: 10px 10px 10px rgba(0,0,0,0.7);
		border-radius: 20px;
		overflow-y: scroll;
	}

	#search
	{
		position: relative;
		margin-top: 25px;
		margin-left: 10%;
		width: 80%;
		height: 25px;
		font-size: 18px;
		padding-left: 10px;
		background: none;
		border: none;
		color : white;
		letter-spacing: 2px;
		border-bottom: 3px solid white;
	}

	#search:focus
	{
		background: white;
		border-radius: 20px;
		padding-top: 5px;
		font-weight: bold;
		color: black;
	}

	#user_blimp
	{
		position: relative;
		text-align: left;
		padding-left: 20px;
		margin-top: 30px;
		margin-left: 20px;
		height: 45px;
		font-size: 20px;
		background: #004e92;
		border: none;
		
		color: white;
		letter-spacing: 2px;
		font-weight: bold;
		width: 80%;
		cursor: pointer;
	}

	#user_blimp:hover
	{	
		background: black;
		color: 	#c9ab10;	
	}

	#find
	{
		position: relative;
		float: right;
		right: 20px;
		top: 10px;
		cursor: pointer;
		width: 65px;
		font-weight: bold;
		letter-spacing: 2px;
	}

	#search_log
	{
		color: white;
	}

	#recent_chats
	{	
		position: relative;
		margin-top: 50px;
		
	}

	#search_error
	{	
		position: relative;
		top: 20px;
		padding-left: 15px;
		font-size: 20px;
		color: white;
	}

	#no_recent
	{
		position: relative;
		font-size: 20px;
		width: 100%;
		margin-left: 25%;
		color: white;
		font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
		
	}

	#logout
	{
		position: relative;
		float: right;
		font-size: 18px;
		height: 40px;
		font-weight: bold;
		cursor: pointer;
		margin-right: 20px;
		bottom: 100px;
	}

	#account
	{
		position: relative;
		float: right;
		font-size: 18px;
		height: 40px;
		font-weight: bold;
		cursor: pointer;
		margin-right: 20px;
		bottom: 100px;
	}
	
	
	#found_user{
		position: relative;
		margin-top: 30px;
		margin-left: 20px;
		height: 45px;
		font-size: 20px;
		background: teal;
		border: 2px solid white;
		color: white;
		letter-spacing: 2px;
		font-weight: bold;
		width: 90%;
		border-radius: 0px;
		cursor: pointer;
	}

	#appname
	{
		position: relative;
		bottom: 40px;
		font-size: 1.5cm;
		text-align: center;
		font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
		font-weight: bold;
		letter-spacing: 30px;
		color: white;
	}

	

	@media only screen and (max-width: 1168px)
	{	
		
		
		#contacts
		{

			height: 72vh;
			width:82vw;		
			transform: translate(-25vw, 0vh);	
		}

		#user_blimp
		{	
			left: 4vw;
			width: 80%;
		}

		#appname
		{
			font-size: 10vw;
			margin-top: 10vh;
			letter-spacing: 5vw;
			margin-bottom: 10vh;
		}

		#logout
		{
			height: 4vh;
			font-size: 2vh;
		}

		#no_recent
		{
			font-size: 18px;
		}
	}
	
</style>
