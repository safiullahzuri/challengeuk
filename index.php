<?php require_once('extras/sessions.php'); ?>
<?php require_once('extras/connections.php'); ?>
<?php $_SESSION['title']='home'; ?>
<?php require_once('extras/header.php'); ?>
<?php require_once('extras/helperFunctions.php'); ?>

<?php
	
	$query = "SELECT booking.scheduled_course_id, SUM(booking.number_of_guests) as 'nog', courseschedule.capacity-SUM(booking.number_of_guests) as 'places left', course.name, course.level, course.description, hostel.name as 'hname', hostel.location, courseschedule.capacity FROM booking JOIN courseschedule ON booking.scheduled_course_id=courseschedule.courseScheduleId JOIN course ON courseschedule.courseId=course.course_id JOIN hostel ON courseschedule.hostelId=hostel.id GROUP BY booking.scheduled_course_id";

	$placesResult = $connection->query($query);


	$hostelQuery = "SELECT SUM(courseschedule.capacity) as 'total_course', hostel.id as 'hid', hostel.maxCapacity, hostel.name, hostel.location FROM courseschedule JOIN hostel ON courseschedule.hostelId=hostel.id JOIN booking ON courseschedule.courseId=booking.scheduled_course_id GROUP BY courseschedule.hostelId";

	$hostelResult = $connection->query($hostelQuery);


?>


<div class="container" style="margin-top:30px;">

    <div class="jumbotron">
      <h1>Welcome to ChallengeUK! Online System!</h1>
      <p>You can browse our hostels, courses etc.</p>
    </div>

    <h3>Course Availability</h3>
    <table class="col-md-8 table table-bordered table-responsive table-striped">
 		<thead>
 			<tr>
 				<td>Course ID</td><td>Course's Name</td><td>Course Level</td><td>Description</td><td>Hostel Name</td><td>Location</td>
        <td>Number of Guests on Course</td><td>Capacity</td><td>Places Left</td><td>Availability</td>
 		</thead>
 		<tbody>
 		<?php while($row=$placesResult->fetch_assoc()): ?>
 			<tr>

 				<td><?php echo $row['scheduled_course_id']; ?></td>
 				<td><?php echo $row['name']; ?></td>
 				<td><?php echo $row['level']; ?></td>
 				<td><?php echo $row['description']; ?></td>
 				<td><?php echo $row['hname']; ?></td>	
        <td><?php echo $row['location']; ?></td>
        <td><?php echo $row['nog']; ?></td>
        <td><?php echo $row['capacity']; ?></td>
 				<td><?php echo $row['places left']; ?></td>
 				<?php if($row['places left'] > 0): ?>
 					<td style="background-color:green;">Available</td>
 				<?php else: ?>
 					<td style="background-color:red;">Not Available</td>
 				<?php endif; ?>
 			</tr>
 		<?php endwhile; ?>

 		</tbody>

 	</table>


 		<h3>Hostel Availability</h3>
 		<!--  -->
 	   <table class="col-md-8 table table-bordered table-responsive table-striped">
 		<thead>
 			<tr>
 				<td>Hostel Name</td><td>Hostel Location</td><td>Capacity</td><td>Places Occupied</td><td>Places Left</td><td>Availability</td>
 		</thead>
 		<tbody>
 		<?php while($row=$hostelResult->fetch_assoc()): ?>
   			<tr>
        <?php $currentGuests = getNumberOfGuestsInHostel($row['hid']); ?>
        <?php $capacity = $row['maxCapacity']; ?>
        <?php $placesLeft= $capacity-$currentGuests; ?>
 				<td><?php echo $row['name']; ?></td>
 				<td><?php echo $row['location']; ?></td>
 				<td><?php echo $capacity; ?></td>
 				<td><?php echo $currentGuests; ?></td>
        <td><?php echo $placesLeft; ?></td>	
 				<?php if($placesLeft > 0): ?>
 					<td style="background-color:green;">Available</td>
 				<?php else: ?>
 					<td style="background-color:red;">Not Available</td>
 				<?php endif; ?>
 			</tr>
 		<?php endwhile; ?>

 		</tbody>

 	</table>

</div>

</body>


</html>