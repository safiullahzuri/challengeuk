<?php
	
	require_once('../extras/connections.php');
	require_once('../extras/sessions.php');

	$id = $_POST['id'];
	$name = $_POST['name'];
	$capacity = $_POST['maxCapacity'];
	$location = $_POST['location'];

	$updateQuery = "UPDATE hostel SET name='$name', maxCapacity=$capacity, location='$location' WHERE id=$id";
	$result = $connection->query($updateQuery);

	if($result){
		$url = '../hostel.php';
		$_SESSION['soperation'] = 'updated';
		header('location:'.$url);
	}else {
		echo $connection->error;
	}





?>