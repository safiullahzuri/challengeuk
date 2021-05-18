<?php 

	require_once('../extras/connections.php'); 
	require_once('../extras/sessions.php');

	$courseId = $_POST['courseId'];
	$hostelId = $_POST['hostelId'];
	$startDate = $_POST['startDate'];
	$endDate = $_POST['endDate'];
	$capacity = $_POST['capacity'];


	$myQuery = "INSERT INTO courseschedule(startDate, endDate, capacity, courseId, hostelId) VALUES ('$startDate', '$endDate', $capacity, $courseId, $hostelId)";
	if($connection->query($myQuery) === TRUE){
		$url = '../course_schedule.php';
		unset($_SESSION['soperation']);
		$_SESSION['soperation'] = 'added';
		header('location:'.$url);
	}else{
		echo $connection->error;
	}









?>


