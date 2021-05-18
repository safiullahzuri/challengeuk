<?php
	
	require_once('../extras/connections.php');
	require_once('../extras/sessions.php');

	$id = $_POST['id'];
	$nog = $_POST['nog'];

	$updateQuery = "UPDATE booking SET number_of_guests=$nog WHERE id=$id";
	$result = $connection->query($updateQuery);

	if($result){
		$url = '../booking.php';
		$_SESSION['soperation'] = 'updated';
		header('location:'.$url);
	}else {
		echo $connection->error;
	}





?>