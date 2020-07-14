<?php
session_start();
 require_once('databaseFunction.php');
 $id = $_GET['id'];
 $result = $db->read($id);
 $r = mysqli_fetch_assoc($result);
 if(isset($_POST) & !empty($_POST)){
	 $fname = $db->escapeString($_POST['fname']);
	 $lname = $db->escapeString($_POST['lname']);
	 $email = $db->escapeString($_POST['email']);
	 $gender = $_POST['gender'];
	 $age = $_POST['age'];

	 // For images saving and updating Purpose
	 $newImage= $_FILES['user_image_new']['name'];
	 // Check whether there is new image or not then set new or old image to $image as per requirement
	isset($newImage)?  $image=$newImage:$image=$r['profileimage'];
	$tmp_dir = $_FILES['user_image_new']['tmp_name']; 
	
if(!empty($newImage))
{ 
	// If not empty means coming with image
	$result = $db->updatewithImage($fname, $lname, $email, $gender, $age, $id, $image);
}
else{
	$result = $db->update($fname, $lname, $email, $gender, $age, $id);
}

	
	if($result){
	   move_uploaded_file($tmp_dir,"uploadImage/".$image);
	   //echo "Data Updated Successfully";
		$_SESSION['success'] ="Data Updated Successfully";
	}else{
		//echo "Fail to Update Data Try Again";
		$_SESSION['failure'] ="Fail to Update Data Try Again";
	}
	// After Successful or Failure of operation redirect to index page
	header('Location:index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Simple CRUD Application in PHP & MySQL - Update</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
</head>
<body>
<div class="container">
	<div class="row">
<form method="post" class="form-horizontal col-md-6 col-md-offset-3" enctype="multipart/form-data" >
	<h2>Update Operation in CRUD Application</h2>
	<div class="form-group">
	    <label for="input1" class="col-sm-2 control-label">First Name</label>
	    <div class="col-sm-10">
	      <input type="text" name="fname"  class="form-control" id="input1" value="<?php echo $r['firstname'] ?>" placeholder="First Name" />
	    </div>
	</div>

	<div class="form-group">
	    <label for="input1" class="col-sm-2 control-label">Last Name</label>
	    <div class="col-sm-10">
	      <input type="text" name="lname"  class="form-control" id="input1" value="<?php echo $r['lastname'] ?>" placeholder="Last Name" />
	    </div>
	</div>

	<div class="form-group">
	    <label for="input1" class="col-sm-2 control-label">E-Mail</label>
	    <div class="col-sm-10">
	      <input type="email" name="email"  class="form-control" id="input1" value="<?php echo $r['email'] ?>" placeholder="E-Mail" />
	    </div>
	</div>

	<div class="form-group" class="radio">
	<label for="input1" class="col-sm-2 control-label">Gender</label>
	<div class="col-sm-10">
	  <label>
	    <input type="radio" name="gender" id="optionsRadios1" value="male" <?php if($r['gender'] == 'male'){ echo "checked";} ?>> Male
	  </label>
	  	  <label>
	    <input type="radio" name="gender" id="optionsRadios1" value="female" <?php if($r['gender'] == 'female'){ echo "checked";} ?>> Female
	  </label>
	</div>
	</div>

	<div class="form-group">
	<label for="input1" class="col-sm-2 control-label">Age</label>
	<div class="col-sm-10">
		<select name="age" class="form-control">
			<option>Select Your Age</option>
			<option value="20" <?php if($r['age'] == '20'){ echo "selected";} ?>>20</option>
			<option value="21" <?php if($r['age'] == '21'){ echo "selected";} ?>>21</option>
			<option value="22" <?php if($r['age'] == '22'){ echo "selected";} ?>>22</option>
			<option value="23" <?php if($r['age'] == '23'){ echo "selected";} ?> >23</option>
			<option value="24" <?php if($r['age'] == '24'){ echo "selected";} ?>>24</option>
			<option value="25" <?php if($r['age'] == '25'){ echo "selected";} ?>>25</option>
		</select>
	</div>
	</div>

			<div class="form-group">
			<label for="input1" class="col-sm-2 control-label">Previous Image</label>
			<div class="col-sm-10">
			<?php echo' <img name="user_image_old" src="uploadImage/'.$r['profileimage'].'" height="100px" width="100px" class="img-circle"/>';?>
			</div>
			</div>

			<div class="form-group">
			<label for="input1" class="col-sm-2 control-label">Want New Image</label>
			<div class="col-sm-10">
			<input type="file" name="user_image_new" accept="image/*"   class="form-control" id="image1" />
			</div>
			</div>

				
	
	<input type="submit" class="btn btn-primary col-md-2 col-md-offset-10" value="Update" />
</form>
	</div>
</div>
</body>
</html>