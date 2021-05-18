<?php require_once('extras/sessions.php'); ?>
<?php $_SESSION['title']='course'; ?>
<?php require_once('extras/header.php'); ?>
<?php require_once('extras/connections.php');?>

<?php
	
	$myQuery = "SELECT * FROM course";
	$result = $connection->query($myQuery);

?>




<div class="container"> 

		<?php if(isset($_SESSION['soperation'])): ?>
		  <div class="alert alert-success " style="margin-top:10px;">
		    You successfully <?php echo $_SESSION['soperation']; ?> a course!
		  </div>
		  <?php unset($_SESSION['soperation']); ?>
		<?php endif; ?>


			<!-- Trigger the modal with a button -->
		<button style="float:right; margin:15px;" type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addCourseModal">New Course</button>

		<!-- Modal -->
		<div id="addCourseModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title" id="courseModalTitle">New Course</h4>
		      </div>
		      <div class="modal-body">
		        <form class="form" method="post" id="mainForm" action="add/aCourse.php">
		        	<input id="id" type="hidden" name="id" />
		        	<input id="name" class="form-control" type="text" name="name" placeholder="Name of Course" />
		        	<input id="level" class="form-control" type="text" name="level" placeholder="Level of Difficulty"/>
		        	<input id="description" class="form-control" type="text" name="description" placeholder="Description">
		        	<input class="form-control btn" type="submit" id="mainSubmit">
		        </form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>

		  </div>
		</div>


		<div id="deleteCourseModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      
		      <div class="modal-body">
		      	Are you sure you want to delete this course?
		      </div>
		      <div class="modal-footer">
		      	<form method="post" action="delete/dCourse.php">
			      	<input type="hidden" id="deleteId" name="deleteId" value="something">
			        <input type="submit" class="btn btn-danger" value="Yes, Delete"/>
			        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
			    </form>
		      </div>
		    </div>

		  </div>
		</div>





	<table class="table table-responsive table-bordered table-striped">
		<thead>
			<tr>
				<td>ID</td>
				<td>Name</td>
				<td>Level</td>
				<td>Description</td>
				<td colspan="2" >Actions</td>
			</tr>
		</thead>
		<tbody>
			<?php if($result->num_rows > 0): ?>
				<?php while($row = $result->fetch_assoc()): ?>
					<tr>
						<td><?php echo $row['course_id']; ?></td>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['level']; ?></td>
						<td><?php echo $row['description']; ?></td>
						<td><button id="<?php echo $row['course_id']; ?>" type="delete" class="btn btn-warning">Delete</td>
						<td><button id="<?php echo $row['course_id']; ?>" type="edit" class="btn btn-primary">Edit</td>
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

		var url = 'edit/eCourse.php';
		$("#mainForm").attr('action', url);
		$("#courseModalTitle").text('Edit Course'); 


		$.ajax({
			url: 'read/oneCourse.php',
			method: 'POST',
			dataType: 'json',
			data: {id: id},
			success: function(data){	
				$("input#name").val(data.name);
				$("input#level").val(data.level);
				$("input#description").val(data.description);
				$("input#id").val(data.course_id);
				$("input#mainSubmit").val("Edit Course");


				$("#addCourseModal").modal("show");
			},
			error: function(a,b,c){
				alert(a[0]);
				alert(b);
				alert(c);
			}




		});



		
	}else if(type == 'delete'){
		$("#deleteId").val(id);
		$("#deleteCourseModal").modal("show");
	}
});



</script>