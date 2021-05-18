<?php

	require_once('../extras/connections.php');
	require_once('../extras/sessions.php');

	$id = $_POST['deleteId'];
	$url = '../course_schedule.php';

	
	
	$deleteQuery = "DELETE FROM courseschedule WHERE courseScheduleId=$id";
	if($connection->query($deleteQuery) === TRUE){
		unset($_SESSION['soperation']);
		$_SESSION['soperation'] = 'deleted';
		header('location:'.$url);
	}




?>