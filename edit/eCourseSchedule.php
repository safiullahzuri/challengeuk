<?php
	
	require_once('../extras/connections.php');
	require_once('../extras/sessions.php');

	$id = $_POST['id'];
	print($id);
	$startDate = $_POST['startDate'];
	$endDate = $_POST['endDate'];
	$courseId = $_POST['courseId'];
	$hostelId = $_POST['hostelId'];
	$capacity = $_POST['capacity'];

	$updateQuery = "UPDATE courseschedule SET startDate='$startDate', endDate='$endDate', hostelId=$hostelId, courseId=$courseId, capacity=$capacity WHERE courseScheduleId=$id";
	$result = $connection->query($updateQuery);

	if($result){
		$url = '../course_schedule.php';
		$_SESSION['soperation'] = 'updated';
		header('location:'.$url);
	}else {
		echo $connection->error;
	}





?>