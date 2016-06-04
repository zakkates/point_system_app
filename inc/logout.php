<?php
	session_start();
	if ($_GET["logout"]==1) { 
		session_destroy();
		$loggedout = "test";
		header("Location:index.php");
	}
	
	?>