<?php require_once('extras/sessions.php'); ?>
<?php $_SESSION['title']='customer'; ?>
<?php require_once('extras/header.php'); ?>
<?php require_once('extras/connections.php');?>

<?php
	
	$myQuery = "SELECT * FROM customer";
	$result = $connection->query($myQuery);

?>




<div class="container"> 

		<?php if(isset($_SESSION['soperation'])): ?>
		  <div class="alert alert-success " style="margin-top:10px;">
		    You successfully <?php echo $_SESSION['soperation']; ?> a Customer!
		  </div>
		  <?php unset($_SESSION['soperation']); ?>
		<?php endif; ?>


			<!-- Trigger the modal with a button -->
		<button style="float:right; margin:15px;" type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addCustomerModal">New customer</button>

		<!-- Modal -->
		<div id="addCustomerModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">New customer</h4>
		      </div>
		      <div class="modal-body">
		        <form class="form" method="post" id="mainForm" action="add/aCustomer.php">
		        	<input id="id" type="hidden" name="id" />
		        	<input id="firstname" class="form-control" type="text" name="firstname" placeholder="First Name" />
		        	<input id="lastname" class="form-control" type="text" name="lastname" placeholder="Last Name" />
		        	<select class="form-control" name="account_customer">
		        		<option value="1">Yes</option>
		        		<option value="0">No</option>
		        	</select>
		        	<input class="form-control btn" type="submit" id="mainSubmit">
		        </form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>

		  </div>
		</div>


		<div id="deleteCustomerModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      
		      <div class="modal-body">
		      	Are you sure you want to delete this Customer?
		      </div>
		      <div class="modal-footer">
		      	<form method="post" action="delete/dCustomer.php">
			      	<input type="hidden" id="deleteId" name="deleteId" value="something">
			        <input type="submit" class="btn btn-danger" value="Yes, Delete"/>
			        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
			    </form>
		      </div>
		    </div>

		  </div>
		</div>





	<table class="table table-responsive table-striped table-bordered">
		<thead>
			<tr>
				<td>ID</td>
				<td>First Name</td>
				<td>Last Name</td>
				<td>Account Customer (y/n)</td>
				<td colspan="2" >Actions</td>
			</tr>
		</thead>
		<tbody>
			<?php if($result->num_rows > 0): ?>
				<?php while($row = $result->fetch_assoc()): ?>
					<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['firstName']; ?></td>
						<td><?php echo $row['lastName']; ?></td>
						<td><?php if($row['account_customer']==1){echo 'Yes';}else{echo 'No';} ?></td>
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

		var url = 'edit/eCustomer.php';
		$("#mainForm").attr('action', url);


		$.ajax({
			url: 'read/oneCustomer.php',
			method: 'POST',
			dataType: 'json',
			data: {id: id},
			success: function(data){	
				$("input#firstname").val(data.firstName);
				$("input#lastname").val(data.lastName);
				$("input#account_customer").val(data.account_customer);
				$("input#id").val(data.id);
				$("input#mainSubmit").val("Edit Customer");


				$("#addCustomerModal").modal("show");
			},
			error: function(a,b,c){
				alert(a[0]);
				alert(b);
				alert(c);
			}




		});



		
	}else if(type == 'delete'){
		$("#deleteId").val(id);
		$("#deleteCustomerModal").modal("show");
	}
});



</script>