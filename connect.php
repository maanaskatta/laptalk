<?php

	//$conn = mysqli_connect("fdb26.atspace.me","3398639_users","laptalk123","3398639_users");
	$conn = mysqli_connect("localhost","root","","users");

	if(!($conn))
	{
		?>

		<script type="text/javascript">
			alert("Database connectivity failed!...Please contact the developer");
		</script>


		<?php
	}

?>
