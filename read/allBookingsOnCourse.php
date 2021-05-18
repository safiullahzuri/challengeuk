<?php

	require_once('../extras/connections.php');

	$id = $_POST['id'];;

	$sql = "SELECT booking.number_of_guests, booking.dateBooked, customer.firstName, customer.lastName FROM booking JOIN customer ON booking.bookedBy=customer.id WHERE booking.scheduled_course_id=$id";

	$result = $connection->query($sql);
	$data = $result->fetch_assoc();

	echo json_encode($data);

?>