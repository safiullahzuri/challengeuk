<?php 

	require_once('../extras/connections.php'); 
	require_once('../extras/sessions.php');

	$name = $_POST['name'];
	$level = $_POST['level'];
	$description = $_POST['description'];


	$myQuery = "INSERT INTO course(name, level, description) VALUES ('$name', '$level', '$description')";
	if($connection->query($myQuery) === TRUE){
		$url = '../course.php';
		unset($_SESSION['soperation']);
		$_SESSION['soperation'] = 'added';
		header('location:'.$url);
	}else{
		echo $connection->error;
	}









?>


