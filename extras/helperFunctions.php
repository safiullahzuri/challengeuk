<?php
	
	
	
	function getAllCourses(){
		$query = "SELECT course_id, name FROM course";
		$result = $connection->query($query);
		return $result->fetch_assoc();
	}


	function getCourse($courseId){
		$conn = new mysqli("localhost", "root", "", "challengeuk");
		$query = "SELECT course_id as 'cid', name as 'cname' from course WHERE course_id=$courseId";
		$result = $conn->query($query);
		return $result->fetch_assoc();
	}

	function getNumberOfGuestsInHostel($hostel_id){
		$conn = new mysqli("localhost", "root", "", "challengeuk");
		$hostelBookingTableQuery = "SELECT SUM(hostel_bookings.number_of_guests) as 'nhb' FROM hostel_bookings WHERE hostel_bookings.hostel_id=$hostel_id";
		$hostelBookings = $conn->query($hostelBookingTableQuery)->fetch_assoc();
		$nhb = $hostelBookings["nhb"];

		$bookingQuery = "SELECT SUM(booking.number_of_guests) as 'ncb' FROM booking WHERE booking.scheduled_course_id IN (SELECT courseschedule.courseId FROM courseschedule WHERE courseschedule.hostelId=$hostel_id)";
		$bookings = $conn->query($bookingQuery)->fetch_assoc();
		$ncb = $bookings["ncb"];

		return $nhb+$ncb;
	}




?>