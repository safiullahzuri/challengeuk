<?php require_once('extras/sessions.php'); ?>
<?php $_SESSION['title']='report'; ?>
<?php require_once('extras/header.php'); ?>
<?php require_once('extras/connections.php');?>

<?php
	
	$id = $_GET['bookingId'];
	$myQuery = "SELECT booking.id, booking.number_of_guests, booking.dateBooked, customer.firstName, customer.lastName FROM booking JOIN customer ON booking.bookedBy=customer.id WHERE booking.scheduled_course_id=$id";
	$result = $connection->query($myQuery);

?>




<div class="container"> 

		<?php if(isset($_SESSION['soperation'])): ?>
		  <div class="alert alert-success " style="margin-top:10px;">
		    You successfully <?php echo $_SESSION['soperation']; ?> a course!
		  </div>
		  <?php unset($_SESSION['soperation']); ?>
		<?php endif; ?>

 





	<table class="table table-responsive table-bordered table-striped" style="margin-top:50px;">
		<thead>
			<tr>
				<td>ID</td>
				<td>Number of Guests</td>
				<td>Date Booked</td>
				<td>Booked By: </td> 
			</tr>
		</thead>
		<tbody>
			<?php if($result->num_rows > 0): ?>
				<?php while($row = $result->fetch_assoc()): ?>
					<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['number_of_guests']; ?></td>
						<td><?php echo $row['dateBooked']; ?></td>
						<td><?php echo $row['firstName'].' '.$row['lastName']; ; ?></td>
					</tr>
				<?php endwhile; ?>
			<?php endif; ?>
		</tbody>
	</table>
</div>


</body>


</html>
 



</script>