<?php

		require_once('helperFunctions.php');
		
		$hostel_id = $_POST["id"];

		$conn = new mysqli("localhost", "root", "", "challengeuk");

		$capacityQuery = "SELECT maxCapacity FROM hostel WHERE id=$hostel_id";
		$result= $conn->query($capacityQuery)->fetch_assoc();
		$capacity = $result["maxCapacity"];
		$currentGuestsNumber = getNumberOfGuestsInHostel($hostel_id);

		$r= $capacity-$currentGuestsNumber;
		echo json_encode($r);



?>