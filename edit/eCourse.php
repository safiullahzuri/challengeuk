<?php
	
	require_once('../extras/connections.php');
	require_once('../extras/sessions.php');

	$id = $_POST['id'];
	$name = $_POST['name'];
	$level = $_POST['level'];
	$description = $_POST['description'];

	$updateQuery = "UPDATE course SET name='$name', level='$level', description='$description' WHERE course_id=$id";
	$result = $connection->query($updateQuery);

	if($result){
		$url = '../course.php';
		$_SESSION['soperation'] = 'updated';
		header('location:'.$url);
	}else {
		echo $connection->error;
	}





?>