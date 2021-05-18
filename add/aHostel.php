<?php 

	require_once('../extras/connections.php'); 
	require_once('../extras/sessions.php');

	$name = $_POST['name'];
	$location = $_POST['location'];
	$capacity = $_POST['maxCapacity'];


	$myQuery = "INSERT INTO hostel(name, maxCapacity, location) VALUES ('$name', $capacity, '$location')";
	if($connection->query($myQuery) === TRUE){
		$url = '../hostel.php';
		unset($_SESSION['soperation']);
		$_SESSION['soperation'] = 'added';
		header('location:'.$url);
	}else{
		echo $connection->error;
	}









?>


