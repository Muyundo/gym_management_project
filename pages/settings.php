

<?php
//session_start();
include ('../includes/header.php');
include ('../includes/connect.php');




$users = mysqli_query($conn, "SELECT * FROM users");
//define variables and innitialize with empty values
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All user Account Settings</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Settings</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

   

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Available administrators</h3>
              </div>
              <!-- /.card-header -->

              <div class="card-body">
              <div class="col-md-2"  alignment= "right">
					<button type="button" name="add" id="addUser" class="btn btn-success btn-xs">Add user/admin</button>
				</div>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone number</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Date Created</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                 </table>
              </div>
              <div id="userModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="userForm">
    			<div class="modal-content">
    				<div class="modal-header">
    					<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Edit User</h4>
    				</div>
    				<div class="modal-body">
						<div class="form-group">
							<label for="firstname" class="control-label">First Name*</label>
							<input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" required>							
						</div>
						<div class="form-group">
							<label for="lastname" class="control-label">Last Name</label>							
							<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">							
						</div>	   	
						<div class="form-group">
							<label for="lastname" class="control-label">Email*</label>							
							<input type="text" class="form-control"  id="email" name="email" placeholder="Email" required>							
						</div>	 
						<div class="form-group" id="passwordSection">
							<label for="lastname" class="control-label">Password*</label>							
							<input type="password" class="form-control"  id="password" name="password" placeholder="Password" required>							
						</div>
						<div class="form-group">
							<label for="gender" class="control-label">Gender</label>							
							<label class="radio-inline">
								<input type="radio" name="gender" id="male" value="male" required>Male
							</label>;
							<label class="radio-inline">
								<input type="radio" name="gender" id="female" value="female" required>Female
							</label>							
						</div>	
						<div class="form-group">
							<label for="lastname" class="control-label">Mobile</label>							
							<input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile">							
						</div>	 
						<div class="form-group">
							<label for="lastname" class="control-label">Designation</label>							
							<input type="text" class="form-control" id="designation" name="designation" placeholder="designation">							
						</div>	
						<div class="form-group">
							<label for="gender" class="control-label">Status</label>							
							<label class="radio-inline">
								<input type="radio" name="status" id="active" value="active" required>Active
							</label>;
							<label class="radio-inline">
								<input type="radio" name="status" id="pending" value="pending" required>Pending
							</label>							
						</div>
						<div class="form-group">
							<label for="user_type" class="control-label">User Type</label>							
							<label class="radio-inline">
								<input type="radio" name="user_type" id="general" value="general" required>General
							</label>;
							<label class="radio-inline">
								<input type="radio" name="user_type" id="administrator" value="administrator" required>Administrator
							</label>							
						</div>	
    				</div>
    				<div class="modal-footer">
    					<input type="hidden" name="userid" id="userid" />
    					<input type="hidden" name="action" id="action" value="updateUser" />
    					<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
              <!-- /.card-body -->
            </div>

<div class="container">
   
  <div id="contact-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <a class="close" data-dismiss="modal">×</a>
          <h3>Contact Form</h3>
        </div>
<?php
        if(isset($_GET['edit'])){
          $user_id = $_GET['edit'];
$user = mysqli_query($conn, "select * from users where user_id = '$user_id' ");
while($u = mysqli_fetch_array($user)){


?>


        <form id="contactForm" name="contact" role="form">
       
        <input type="hidden" name="user_id" value="<?php echo $_GET['user_id']; ?>" class="form-control">
    <div class="row form-group">
      
    </div>
    <div class="row form-group">
      <div class="col-md-4">
        <label class="control-label">First Name</label>
        <input type="text" name="fname" class="form-control" value="<?php echo $u['fname']; ?>" required>
      </div>
      <div class="col-md-4">
        <label class="control-label">Last Name</label>
        <input type="text" name="lname" class="form-control" value="<?php echo $u['lname']; ?>" required>
      </div>
      <div class="col-md-4">
        <label class="control-label">Phone Number</label>
        <input type="text" name="phone" class="form-control" value="<?php echo $u['phone']; ?>" required>
      </div>
     
      <div class="col-md-4">
        <label class="control-label">User Type</label>
        <select name="utype" required="" class="custom-select" id="">
          <option <?php echo $U['utype'] && $utype == 'admin' ? 'selected' : '' ?>>Admin</option>
          <option <?php echo $u['utype'] && $utype == 'user' ? 'selected' : '' ?>>User</option>
        </select>
      </div>
    </div>

    
          <div class="modal-footer">          
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-success" id="submit">
          </div>
        </form>
        <?php 
        } 
      }
       ?>
      </div>
    </div>
  </div>      
  

            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <script>
$(document).ready(function(){ 
  $("#contactForm").submit(function(event){
    submitForm();
    return false;
  });
});
// function to handle form submit
function submitForm(){
   $.ajax({
    type: "GET",
    url: "settings.php",
    cache:false,
    data: $('form#contactForm').serialize(),
    success: function(response){
      $("#contact").html(response)
      $("#contact-modal").modal('hide');
    },
    error: function(){
      alert("Error");
    }
  });
}
</script>
<?php
include('../includes/footer.php');
?>