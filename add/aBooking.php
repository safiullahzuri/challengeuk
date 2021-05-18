<?php 

	require_once('../extras/connections.php'); 
	require_once('../extras/sessions.php');

	$scheduleId = $_POST['course_schedule_id'];
	$bookedBy = $_POST['bookedBy'];
	$number_of_guests = $_POST['number_of_guests'];
	$isPaid = $_POST['isPaid'];
	$creditan = $_POST['creditan'];




	$date = date('Y-m-d');

	$sumQuery = "SELECT SUM(number_of_guests) as 'nog' FROM booking WHERE id=$scheduleId";
	$sumResult = $connection->query($sumQuery)->fetch_assoc();
	$guests = $sumResult['nog'];


	$capacityQuery = "SELECT capacity FROM courseschedule WHERE courseScheduleId=$scheduleId";
	$capacityResult = $connection->query($capacityQuery)->fetch_assoc();
	$capacity = $capacityResult["capacity"];



	$allGuests = $guests + $number_of_guests;

	if($allGuests > $capacity){
		$url = '../course_schedule.php';
		unset($_SESSION['soperation']);
		$_SESSION['foperation'] = 'Unfortuantely you could not book this course because your number of guests succeeds the remaining seats left in this course!';
		header('location:'.$url);
	}else if($capacity > $allGuests){
		$myQuery = "INSERT INTO booking(scheduled_course_id, number_of_guests, bookedBy, dateBooked) VALUES ($scheduleId, $number_of_guests, $bookedBy, '$date')";
		if($connection->query($myQuery) === TRUE){
			$bookingId = $connection->insert_id;
			if($isPaid == 1){				
				$paymentQuery = "INSERT INTO payment(creditDebitAuthorisationNo, isPaid, booking_id) VALUES ($creditan, $isPaid, $bookingId )";
			}else{
				$paymentQuery = "INSERT INTO payment(creditDebitAuthorisationNo, isPaid, booking_id) VALUES (NULL, $isPaid, $bookingId )";
			}
			$connection->query($paymentQuery);

				
			$url = '../booking.php';
			unset($_SESSION['soperation']);
			$_SESSION['soperation'] = 'added';
			header('location:'.$url);
	}else{
		echo $connection->error;
	}

	}













?>


