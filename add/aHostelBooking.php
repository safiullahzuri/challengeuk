<?php 

	require_once('../extras/connections.php'); 
	require_once('../extras/sessions.php');

	$hostelId = $_POST['hostelId'];
	$bookedBy = $_POST['bookedBy'];
	$number_of_guests = $_POST['number_of_guests'];
	$isPaid = $_POST['isPaid'];
	$creditan = $_POST['creditan'];




	// $date = date('Y-m-d');

	
		$myQuery = "INSERT INTO hostel_bookings(hostel_id, number_of_guests, booked_by, dateBooked) VALUES ($hostelId, $number_of_guests, $bookedBy, '$date')";
		if($connection->query($myQuery) === TRUE){
			$bookingId = $connection->insert_id;
			if($isPaid == 1){				
				$paymentQuery = "INSERT INTO payment(creditDebitAuthorisationNo, isPaid, booking_id) VALUES ($creditan, $isPaid, $bookingId )";
			}else{
				$paymentQuery = "INSERT INTO payment(creditDebitAuthorisationNo, isPaid, booking_id) VALUES (NULL, $isPaid, $bookingId )";
			}
			$connection->query($paymentQuery);				
			$url = '../hostel.php';
			unset($_SESSION['soperation']);
			$_SESSION['soperation'] = 'added';
			header('location:'.$url);
		}else{
		echo $connection->error;
		}

?>


