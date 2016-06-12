<?php
	session_start();
	if ($_GET["logout"]==1) { 
		session_destroy();
		setcookie("id",null,-1);
		unset($_COOKIE['id']);
		header("Location:index.php");
	}
	
	?>