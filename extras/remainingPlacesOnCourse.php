<?php
	
	require_once("connections.php");
	
	$course_id = $_POST["id"];

	$capacityOfCourse = "SELECT capacity FROM courseschedule WHERE courseScheduleId=$course_id";
	$cResult = $connection->query($capacityOfCourse)->fetch_assoc();
	$capacity = $cResult["capacity"];

	$currentPlacesInCourse = "SELECT SUM(booking.number_of_guests) as 'cp' FROM booking WHERE booking.scheduled_course_id=$course_id";
	$cpResult = $connection->query($currentPlacesInCourse)->fetch_assoc();
	$currentPlaces = $cpResult["cp"];

	$remaining = $capacity-$currentPlaces;

	echo json_encode($remaining);



?>