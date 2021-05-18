<?php

	require_once('../extras/connections.php');

	$id = $_POST['id'];;

	$sql = "SELECT courseschedule.courseScheduleId as 'id', courseschedule.startDate, courseschedule.endDate, courseschedule.capacity, course.name as 'Course', hostel.name as 'Hostel' FROM courseschedule JOIN course on courseschedule.courseId=course.course_id JOIN hostel ON courseschedule.hostelId=hostel.id WHERE courseScheduleId=$id";

	$result = $connection->query($sql);
	$data = $result->fetch_assoc();

	echo json_encode($data);

?>