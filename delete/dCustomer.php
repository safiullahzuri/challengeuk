<?php

	require_once('../extras/connections.php');
	require_once('../extras/sessions.php');

	$id = $_POST['deleteId'];
	$url = '../customer.php';
	
	$deleteQuery = "DELETE FROM customer WHERE id=$id";
	if($connection->query($deleteQuery) === TRUE){
		unset($_SESSION['soperation']);
		$_SESSION['soperation'] = 'deleted';
		header('location:'.$url);
	}




?>