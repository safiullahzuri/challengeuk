<?php require_once('extras/sessions.php'); ?>
<?php $_SESSION['title']='hostel'; ?>
<?php require_once('extras/header.php'); ?>
<?php require_once('extras/connections.php');?>

<?php
	
	$myQuery = "SELECT * FROM hostel";
	$result = $connection->query($myQuery);


	//$hostels = $connection->query("SELECT id, name FROM hostel");
	$customers = $connection->query("SELECT id, firstName, lastName FROM customer");

?>




<div class="container"> 

		<?php if(isset($_SESSION['soperation'])): ?>
		  <div class="alert alert-success " style="margin-top:10px;">
		    You successfully <?php echo $_SESSION['soperation']; ?> a hostel!
		  </div>
		  <?php unset($_SESSION['soperation']); ?>
		<?php endif; ?>


			<!-- Trigger the modal with a button -->
		<button style="float:right; margin:15px; " type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addHostelModal">New Hostel</button>

		<!-- Modal -->
		<div id="addHostelModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">New Hostel</h4>
		      </div>
		      <div class="modal-body">
		        <form class="form" method="post" id="mainForm" action="add/aHostel.php">
		        	<input id="id" type="hidden" name="id" />
		        	<input id="name" class="form-control" type="text" name="name" placeholder="Name of Hostel" />
		        	<input id="capacity" class="form-control" type="number" name="maxCapacity" placeholder="Hostel Capacity" />
		        	<input id="location" class="form-control" type="text" name="location" placeholder="Hostel Location" />
		        	<input class="form-control btn" type="submit" id="mainSubmit">
		        </form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>

		  </div>
		</div>


		<div id="deleteHostelModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      
		      <div class="modal-body">
		      	Are you sure you want to delete this hostel?
		      </div>
		      <div class="modal-footer">
		      	<form method="post" action="delete/dHostel.php">
			      	<input type="hidden" id="deleteId" name="deleteId" value="something">
			        <input type="submit" class="btn btn-danger" value="Yes, Delete"/>
			        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
			    </form>
		      </div>
		    </div>

		  </div>
		</div>




	<div id="bookModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      
		      <div class="modal-body">
		      	<form method="post" action="add/aHostelBooking.php">
		      		<input type="hidden" name="hostelId" id="hostelId" />
		      		<div class="form-group">
		      			<h4>Booked By:</h4>
		      			<select class="form-control" name="bookedBy" id="bookedBy">
		      				<?php foreach($customers as $customer): ?>
		      					<option value="<?php echo $customer["id"]; ?>"><?php echo $customer["firstName"].' '.$customer["lastName"]; ?></option>
		      				<?php endforeach; ?>
		      			</select>
		      		</div>
		      		<div class="form-group">
		      			<h4>Number of Guests:</h4>
		      			<input type="number" name="number_of_guests" class="form-control" id="maxHostelNumberInput" />
		      			<h4>Pay now:</h4>
		      			<select name="isPaid" id="isPaid" class="form-control">
		      			<option value="0">No</option>
		      			<option value="1">Yes</option>

		      			<input type="text" name="creditan" id="creditan" class="form-control" placeholder="Credit Card Authorization Number" />
		      		</select>
		      		</div>
		      		
		      		<input type="submit" class="btn btn-sucess" value="Complete Booking">
			    </form>
		      </div>
		
		    </div>

		  </div>
		</div>






	<table class="table table-responsive table-striped table-bordered">
		<thead>
			<tr>
				<td>ID</td>
				<td>Name</td>
				<td>Capacity</td>
				<td>Location</td>
				<td colspan="3" >Actions</td>
			</tr>
		</thead>
		<tbody>
			<?php if($result->num_rows > 0): ?>
				<?php while($row = $result->fetch_assoc()): ?>
					<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['maxCapacity']; ?></td>
						<td><?php echo $row['location']; ?></td>
						<td><button id="<?php echo $row['id']; ?>" type="book" class="btn btn-default">Book Now</td>
						<td><button id="<?php echo $row['id']; ?>" type="delete" class="btn btn-warning">Delete</td>
						<td><button id="<?php echo $row['id']; ?>" type="edit" class="btn btn-primary">Edit</td>
					</tr>
				<?php endwhile; ?>
			<?php endif; ?>
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

		var url = 'edit/eHostel.php';
		$("#mainForm").attr('action', url);


		$.ajax({
			url: 'read/oneHostel.php',
			method: 'POST',
			dataType: 'json',
			data: {id: id},
			success: function(data){	
				$("input#name").val(data.name);
				$("input#capacity").val(data.maxCapacity);
				$("input#location").val(data.location);
				$("input#id").val(data.id);
				$("input#mainSubmit").val("Edit Hostel");


				$("#addHostelModal").modal("show");
			},
			error: function(a,b,c){
				alert(a[0]);
				alert(b);
				alert(c);
			}




		});



		
	}else if(type == 'delete'){
		$("#deleteId").val(id);
		$("#deleteHostelModal").modal("show");
	}else if(type == 'book'){
		$("#hostelId").val(id);
		$("#creditan").hide();
		$.ajax({
			method: 'POST',
			dataType: 'json',
			url: 'extras/remainingHostels.php',
			data: {id: id},
			success: function(data){

				$("#maxHostelNumberInput").attr('max', data);
			},
			error: function(a,b,c){
				alert(a);	
			}
		});

		$("#bookModal").modal("show");
	}
});


$("#isPaid").change(function(){
	if($(this).val() == 1){
		$("#creditan").show();
	}else {
		$("#creditan").hide();
	}
});



</script>