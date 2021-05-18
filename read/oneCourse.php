<?php

	require_once('../extras/connections.php');

	$id = $_POST['id'];;

	$sql = "SELECT * FROM course WHERE course_id=$id";

	$result = $connection->query($sql);
	$data = $result->fetch_assoc();

	echo json_encode($data);

?>