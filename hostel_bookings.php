<?php require_once('extras/sessions.php'); ?>
<?php $_SESSION['title']='hostel_bookings'; ?>
<?php require_once('extras/header.php'); ?>
<?php require_once('extras/connections.php');?>

<?php	
	$myQuery = "SELECT * FROM `hostel_bookings` JOIN customer ON hostel_bookings.booked_by=customer.id JOIN hostel ON hostel_bookings.hostel_id=hostel.id JOIN payment ON hostel_bookings.id=payment.booking_id";
	$result = $connection->query($myQuery);
?>




<div class="container"> 
		
		<div  class="card bg-secondary text-white" style="margin-top:20px; ">
		    <div class="card-body" >List of all bookings so far!</div>
		</div>

		<?php if(isset($_SESSION['soperation'])): ?>
		  <div class="alert alert-success " style="margin-top:10px;">
		    You successfully <?php echo $_SESSION['soperation']; ?> a booking on a hostel!
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
				<td>Hostel Booking ID</td>
				<td>Hostel</td>
				<td>Number of Guests</td>
				<td>Booked By:</td>
				<td>Date of Booking</td>
				<td>Paid or Not</>
			</tr>
		</thead>
		<tbody> 
				<?php while($row = $result->fetch_assoc()): ?>
					<tr>
						
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row["name"]; ?></td>
						<td><?php echo $row["number_of_guests"]; ?>
						<td><?php echo $row['firstName'].' '.$row['lastName']; ?></td>
						<td><?php echo $row['dateBooked']; ?></td>
						<?php if($row['isPaid'] == 1): ?>
							<td style="background-color:rgb(12,200,12)">Yes</td>
						<?php else: ?>
							<td style="background-color:red">No</td>
						<?php endif; ?>
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