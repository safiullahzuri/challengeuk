<?php
	
	require_once('../extras/connections.php');
	require_once('../extras/sessions.php');

	$id = $_POST['id'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$account_customer = $_POST['account_customer'];

	$updateQuery = "UPDATE customer SET firstName='$firstname', lastName='$lastname', account_customer=$account_customer WHERE id=$id";
	$result = $connection->query($updateQuery);

	if($result){
		$url = '../customer.php';
		$_SESSION['soperation'] = 'updated';
		header('location:'.$url);
	}else {
		echo $connection->error;
	}





?>