<?php
include('../classes/functions.php');
$user = new User();
//$user -> adminLoginStatus();
include('../includes/header.php');
?>
<div class="table-responsive">		
		<div><span style="font-size:20px;">Admin Details:</span><div class="pull-right"></div>
		<table class="table table-boredered">		
			<tr>
				<th>Name</th>
				<td><?php echo $userDetail['fname']." ".$userDetail['lname']; ?></td>
			</tr>
			<tr>
				<th>Email</th>
				<td><?php echo $userDetail['email']; ?></td>
			</tr>
			<tr>
				<th>Password</th>
				<td>**********</td>
			</tr>
			<tr>
				<th>Phone Number</th>
				<td><?php echo $userDetail['phone']; ?></td>
			</tr>
			<tr>
				<th>Role</th>
				<td><?php echo $userDetail['utype']; ?></td>
			</tr>
			<tr>
				<th>Date Registered</th>
				<td><?php echo $userDetail['date_created']; ?></td>
			</tr>
					
		</table>
	</div>
</div>	
<?php
include('../includes/footer.php');
?>

