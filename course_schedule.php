<?php require_once('extras/sessions.php'); ?>
<?php $_SESSION['title']='course_schedule'; ?>
<?php require_once('extras/header.php'); ?>
<?php require_once('extras/connections.php');?>
<?php require_once('extras/helperFunctions.php'); ?>

<?php
	$myQuery = "SELECT courseschedule.courseScheduleId as 'id', courseschedule.startDate, courseschedule.endDate, courseschedule.capacity, course.name as 'Course', hostel.name as 'Hostel' FROM courseschedule JOIN course on courseschedule.courseId=course.course_id JOIN hostel ON courseschedule.hostelId=hostel.id";
	$result = $connection->query($myQuery);	

	$courses = $connection->query("SELECT course_id, name FROM course");
	$hostels = $connection->query("SELECT id, name FROM hostel");
	$customers = $connection->query("SELECT id, firstName, lastName FROM customer");




?>




<div class="container"> 

		<?php if(isset($_SESSION['soperation'])): ?>
		  <div class="alert alert-success " style="margin-top:10px;">
		    You successfully <?php echo $_SESSION['soperation']; ?> a course schedule!
		  </div>
		  <?php unset($_SESSION['soperation']); ?>

		  <?php elseif(isset($_SESSION['foperation'])): ?>
		  <div class="alert alert-success " style="margin-top:10px;">
		    <?php echo $_SESSION['foperation']; ?> 
		  </div>
		  <?php unset($_SESSION['foperation']); ?>
		<?php endif; ?>


			<!-- Trigger the modal with a button -->
		<button style="float:right; margin:15px;" id="createCSbtn" type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addCourseScheduleModal">Create New Schedule For a Course</button>

		<!-- Modal -->
		<div id="addCourseScheduleModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">New Course Schedule</h4>
		      </div>
		      <div class="modal-body">
		        <form class="form" method="post" id="mainForm" action="add/aCourseSchedule.php">
		        	<input id="id" type="hidden" name="id" />

		        	<div class="form-group" id="coursegroup">
		        		<span class="badge badge-primary" id="coursespan"></span>
			        	<select name="courseId" class="form-control" id="courseId">
			        		<?php foreach($courses as $course): ?>
			        			<option value="<?php echo $course["course_id"]; ?>"><?php echo $course["name"]; ?></option>
			        		<?php endforeach; ?>
			        	</select>
			        </div>
		        	<div class="form-group" id="hostelgroup">
		        		<span class="badge badge-primary" id="hostelspan"></span>
			        	<select name="hostelId" class="form-control" id="hostelId">
			        		<?php foreach($hostels as $hostel): ?>
			        			<option value="<?php echo $hostel["id"]; ?>"><?php echo $hostel["name"]; ?></option>
			        		<?php endforeach; ?>
			        	</select>
		        	</div>
		        	<input type="date" class="form-control" id="startDate" name="startDate" />
		        	<input type="date" class="form-control" id="endDate" name="endDate" />
		        	<input type="number" class="form-control" placeholder="capacity" id="capacity" name="capacity">
		        	<input class="form-control btn" type="submit" id="mainSubmit">
		        </form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>

		  </div>
		</div>


		<div id="deleteCourseScheduleModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      
		      <div class="modal-body">
		      	Are you sure you want to delete this course schedule?
		      </div>
		      <div class="modal-footer">
		      	<form method="post" action="delete/dCourseSchedule.php">
			      	<input type="hidden" id="deleteId" name="deleteId" value="something">
			        <input type="submit" class="btn btn-danger" value="Yes, Delete"/>
			        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
			    </form>
		      </div>
		    </div>

		  </div>
		</div>

		<!-- Report Modal -->
		<div id="reportModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      
		      <div class="modal-body">
		      	<table class="table table-responsive">
		      		<thead>
		      		</thead>

		      		<tbody id="jbody">

		      		</tbody>

		      	</table>
		      </div>
		      <div class="modal-footer">
		     	
		      </div>
		    </div>

		  </div>
		</div>



		<div id="bookModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      
		      <div class="modal-body">
		      	<form method="post" action="add/aBooking.php">
		      		<input type="hidden" name="course_schedule_id" id="scheduleId" />
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
		      			<input type="number" name="number_of_guests" class="form-control" id="maxCourseNumberInput"  />
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
				<td>Course</td>
				<td>Hostel</td>
				<td>Start Date</td>
				<td>End Date</td>
				<td>Capacity</td>
				<td colspan="4" >Actions</td>
			</tr>
		</thead>
		<tbody>
			<?php if($result->num_rows > 0): ?>
				<?php while($row = $result->fetch_assoc()): ?>
					<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['Course']; ?></td>
						<td><?php echo $row['Hostel']; ?></td>
						<td><?php echo $row['startDate']; ?></td>
						<td><?php echo $row['endDate']; ?></td>
						<td><?php echo $row['capacity']; ?></td>
						<?php
							$id = $row['id'];
							$nquery = "SELECT SUM(number_of_guests) AS 'nog' FROM booking WHERE scheduled_course_id=$id";
							$nresult= $connection->query($nquery)->fetch_assoc();
							$nog = $nresult['nog'];
							$capacity = $row['capacity'];
						?>
						<?php if($capacity > $nog): ?>
							<td><button id="<?php echo $row['id']; ?>" type="book" class="btn btn-default">Book Now</td>
						<?php else: ?>
							<td><button id="<?php echo $row['id']; ?>" type="report" class="btn btn-default" disabled>Book Now</td>
						<?php endif; ?>
						<td><button id="<?php echo $row['id']; ?>" type="delete" class="btn btn-danger">Delete</td>
						<td><button id="<?php echo $row['id']; ?>" type="edit" class="btn btn-primary">Edit</td>
						<td><a href="report.php?bookingId=<?php echo $row['id']; ?>" class="btn btn-warning">View Report</a></td>
					</tr>
				<?php endwhile; ?>
			<?php endif; ?>
		</tbody>
	</table>
</div>


</body>


</html>

<script>

$("#creditan").hide();

$("#createCSbtn").click(function(){
	
				$("#coursespan").text();
				$("#hostelspan").text();

				$("input#startDate").val();
				$("input#endDate").val();
				$("input#capacity").val();

				$("input#id").val();

});


$("button").click(function(){
	var id = $(this).attr("id");
	var type = $(this).attr("type");
	if(type == 'edit'){

		var url = 'edit/eCourseSchedule.php';
		$("#mainForm").attr('action', url);


		$.ajax({
			url: 'read/oneCourseSchedule.php',
			method: 'POST',
			dataType: 'json',
			data: {id: id},
			success: function(data){	

				$("#coursespan").text(data.Course);
				$("#hostelspan").text(data.Hostel);

				$("input#startDate").val(data.startDate);
				$("input#endDate").val(data.endDate);
				$("input#capacity").val(data.capacity);

				$("input#id").val(data.id);

				$("#addCourseScheduleModal").modal("show");

			},
			error: function(a,b,c){
				alert(a[0]);
				alert(b);
				alert(c);
			}




		});



		
	}else if(type == 'delete'){
		$("#deleteId").val(id);
		$("#deleteCourseScheduleModal").modal("show");
	}else if(type == 'book'){
		$("#scheduleId").val(id);
		$.ajax({
			method: 'POST',
			dataType: 'json',
			url: 'extras/remainingPlacesOnCourse.php',
			data: {id: id},
			success: function(data){

				$("#maxCourseNumberInput").attr('max', data);
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