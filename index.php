<?php
session_start();
require_once('databaseFunction.php');
$result = $db->read();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Simple CRUD Application in PHP & MySQL - Read</title>
		<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
</head>
<body>
<div class="container" style="margin-top:50px;">
<div>
<?php 

	if(isset($_SESSION['success']))
	{
		echo" <h3 class='bg-success text-white '>".$_SESSION['success']."</h3>";
		unset($_SESSION['success']);
	}
	elseif(isset($_SESSION['failure']))
	{
		echo" <h3 class='bg-dnger text-white '>".$_SESSION['failure']."</h3>";
		unset($_SESSION['failure']);
	}
	
	?>
</div>

	<div class="row">
	<a href="add.php" class="btn btn-primary "> Add </a>

			<table class="table">
			<tr>
				<th>#</th>
				<th>ProfileImage</th>
				<th>Full Name</th>
				<th>E-Mail</th>
				<th>Gender</th>
				<th>Age</th>
				<th>Extras</th>
			</tr>
			<?php 
			$row = mysqli_num_rows($result);
			if($row>0){
				// If number of row in the table is greater than 1 perform following operation 
				$i=1;
			while($r = mysqli_fetch_assoc($result)){
				
			?>
			<tr>
				<td><?php echo $i++; ?></td>	
				
		
				<!-- <td> <img src="profileimage/'.$r['profileimage'].'" height="50px" width="50px"></td> -->

				<td> <?php echo' <img src="uploadImage/'.$r['profileimage'].'" height="100px" width="100px" class="img-circle"/>';?></td>
				<td><?php echo $r['firstname'] . " " . $r['lastname']; ?></td>
				<td><?php echo $r['email']; ?></td>
				<td><?php echo $r['gender']; ?></td>
				<td><?php echo $r['age']; ?></td>
				<td><a href="update.php?id=<?php echo $r['id']; ?>">Edit</a> <a href="delete.php?id=<?php echo $r['id']; ?>">Delete</a></td>
			</tr>
			<?php 
			} // End of While Loop
			}
			else{
				// If there is no row of data in the table 
				// Show No Record Found
				echo"<tr> <td colspan='6'> No Record Found <a href='add.php'>Add more data </td> </tr>";
			}

			 ?>
		</table>
	</div>
</div>
</body>
</html>