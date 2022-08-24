<?php

	//Cerramos la sesión y volvemos al index de la intranet
	unset($_SESSION['user']);
	unset($_SESSION['pass']);
	unset($_SESSION['conn']);
	if(isset($_SESSION['info_proyecto'])) unset($_SESSION['info_proyecto']);
	session_destroy();
	header('Location:index.php');
?>