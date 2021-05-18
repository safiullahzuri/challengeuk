<?php 

	require_once('../extras/connections.php'); 
	require_once('../extras/sessions.php');

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$account_customer = $_POST['account_customer'];


	$myQuery = "INSERT INTO customer(firstname, lastname, account_customer) VALUES ('$firstname', '$lastname', $account_customer)";
	if($connection->query($myQuery) === TRUE){
		$url = '../customer.php';
		unset($_SESSION['soperation']);
		$_SESSION['soperation'] = 'added';
		header('location:'.$url);
	}else{
		echo $connection->error;
	}









?>


