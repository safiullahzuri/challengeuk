<?php

	require_once('../extras/connections.php');
	require_once('../extras/sessions.php');

	$id = $_POST['deleteId'];
	$url = '../booking.php';
	
	$deleteQuery = "DELETE FROM booking WHERE id=$id";

	//firstly delete the payment for this booking from payment table
	$deletePayment = "DELETE FROM payment WHERE booking_id=$id";
	if($connection->query($deletePayment) === TRUE){
		if($connection->query($deleteQuery) === TRUE){
		unset($_SESSION['soperation']);
		$_SESSION['soperation'] = 'deleted';
		header('location:'.$url);
	}
	}else {
		die($connection->error);
	}


	



?>