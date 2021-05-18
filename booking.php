<?php require_once('extras/sessions.php'); ?>
<?php $_SESSION['title']='booking'; ?>
<?php require_once('extras/header.php'); ?>
<?php require_once('extras/connections.php');?>

<?php	
	$myQuery = "SELECT booking.id, payment.isPaid, hostel.name as 'hostel name', booking.number_of_guests, booking.dateBooked, customer.firstName, customer.lastName, course.name, course.description FROM booking JOIN courseschedule ON booking.scheduled_course_id=courseschedule.courseScheduleId JOIN customer ON booking.bookedBy=customer.id JOIN course ON courseschedule.courseId=course.course_id JOIN hostel ON courseschedule.hostelId=hostel.id JOIN payment ON booking.id=payment.booking_id";
	$result = $connection->query($myQuery);
?>




<div class="container"> 
		
		<div  class="card bg-secondary text-white" style="margin-top:20px; ">
		    <div class="card-body" >List of all bookings so far!</div>
		</div>

		<?php if(isset($_SESSION['soperation'])): ?>
		  <div class="alert alert-success " style="margin-top:10px;">
		    You successfully <?php echo $_SESSION['soperation']; ?> a booking!
		  </div>
		  <?php unset($_SESSION['soperation']); ?>
		  <?php elseif(isset($_SESSION['foperation'])): ?>
		  <div class="alert alert-success " style="margin-top:10px;">
		    <?php echo $_SESSION['foperation']; ?> 
		  </div>
		  <?php unset($_SESSION['foperation']); ?>
		
		<?php endif; ?>


		<!-- Modal -->
		<div id="addBookingModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Edit Booking</h4>
		      </div>
		      <div class="modal-body">
		        <form class="form" method="post" id="mainForm" action="add/aBooking.php">
		        	<input id="id" type="hidden" name="id" />
		        	<input type="number" name="nog" id="nog" class="form-control" />
		        	<input class="form-control btn" value="Submit change!" type="submit" id="mainSubmit">
		        </form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>

		  </div>
		</div>


		<div id="deleteBookingModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      
		      <div class="modal-body">
		      	Are you sure you want to delete this Booking?
		      </div>
		      <div class="modal-footer">
		      	<form method="post" action="delete/dBooking.php">
			      	<input type="hidden" id="deleteId" name="deleteId" value="something">
			        <input type="submit" class="btn btn-danger" value="Yes, Delete"/>
			        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
			    </form>
		      </div>
		    </div>

		  </div>
		</div>





	<table class="table table-responsive table-striped table-bordered" style="margin-top:60px;">
		<thead>
			<tr>
				<td>Booking ID</td>
				<td>Course</td>
				<td>Hostel</td>
				<td>Booking Description</td>
				<td>Booked By:</td>
				<td>Number of Guests</td>
				<td>Date of Booking</td>
				<td>Paid or Not</>
				<td colspan="2" >Actions</td>
			</tr>
		</thead>
		<tbody> 
				<?php while($row = $result->fetch_assoc()): ?>
					<tr>
						
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row["name"]; ?></td>
						<td><?php echo $row["hostel name"]; ?>
						<td><?php echo $row["description"]; ?></td>
						<td><?php echo $row['firstName'].' '.$row['lastName']; ?></td>
						<td><?php echo $row['number_of_guests']; ?></td>
						<td><?php echo $row['dateBooked']; ?></td>
						<?php if($row['isPaid'] == 1): ?>
							<td style="background-color:rgb(12,200,12)">Yes</td>
						<?php else: ?>
							<td style="background-color:red">No</td>
						<?php endif; ?>
						<td><button id="<?php echo $row['id']; ?>" type="delete" class="btn btn-warning">Delete</td>
						<td><button id="<?php echo $row['id']; ?>" type="edit" class="btn btn-primary">Change Number of Guests</td>
					</tr>
				<?php endwhile; ?>
			
		</tbody>
	</table>
</div>


</body>


</html>

<script>
$("button").click(function(){
	var id = $(this).attr("id");
	var type = $(this).attr("type");
	if(type == 'edit'){

		var url = 'edit/eBooking.php';
		$("#mainForm").attr('action', url);


		$.ajax({
			url: 'read/oneBooking.php',
			method: 'POST',
			dataType: 'json',
			data: {id: id},
			success: function(data){	
				$("input#id").val(id);
				$("input#nog").val(data.number_of_guests);


				$("#addBookingModal").modal("show");
			},
			error: function(a,b,c){
				alert(a[0]);
				alert(b);
				alert(c);
			}




		});



		
	}else if(type == 'delete'){
		$("#deleteId").val(id);
		$("#deleteBookingModal").modal("show");
	}
});



</script>