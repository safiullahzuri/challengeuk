<?php

	require_once('../extras/connections.php');

	$id = $_POST['id'];;

	$sql = "SELECT * FROM booking WHERE id=$id";

	$result = $connection->query($sql);
	$data = $result->fetch_assoc();

	echo json_encode($data);

?>