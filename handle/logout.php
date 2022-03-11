<?php

	require ("../config.php");

	if (!isset($_SESSION["info"])) {
		header("Location: " . ROOT_URL);
		return;
	};

	session_destroy();
	session_unset();
	
	header("Location: " . INDEX_URL);

?>