<?php
session_start();
// Noneed to include database.php because databaseFunction.php is extended from database.php
 include_once('databaseFunction.php');
 if(isset($_POST) & !empty($_POST)){
	 $fname = $db->escapeString($_POST['fname']);
	 $lname = $db->escapeString($_POST['lname']);
	 $email = $db->escapeString($_POST['email']);
	 $gender = $_POST['gender'];
	 $age = $_POST['age'];


	 
	// For images saving
	// To give valid image extensions
   $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');


	// $imageName= $_FILES['user_image']['name'];
	// give random name to file
	$imageName= "_madhu_".rand(1000,1000000)."--" .$_FILES['user_image']['name'];
    $fileLocation = $_FILES['user_image']['tmp_name'];
	// $imgSize = $_FILES['user_image']['size'];
	$folder="uploadImage/";
	    
  	//  if(file_exists("uploadImage/".$imageName))
	//  {
	// 	//  $store=$_FILES['user_image']['name'];
	// 	 $_SESSION['status']="Image Alredy Exist'.$imageName.'";
	// 	 //remain in the same page
	// 	 header('Location:add.php');
	//  }

	 $result = $db->create($fname, $lname, $email, $gender, $age, $imageName);
	 if($result){
		 
		move_uploaded_file($fileLocation, $folder.$imageName);
			echo "Successfully inserted data";
		 $_SESSION['success'] ="Successfully inserted data";
		 // return to main view page index.php
		// header('Location:index.php');
	 }else{
		// echo "Failed to insert data";
		 $_SESSION['failure'] ="Failed to insert data";
		 
	 }
	 // If result success or failure doesn't matter return to index page
header('location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>CRUD APP with Image in OOP PHP</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
</head>
<body>
<div class="container">
	<div class="row">
		<form method="post" class="form-horizontal col-md-6 col-md-offset-3" enctype="multipart/form-data">
			<h2>CRUD APP with Image in OOP PHP</h2>
			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">First Name</label>
			    <div class="col-sm-10">
			      <input type="text" name="fname"  class="form-control" id="input1" placeholder="First Name"  required/>
			    </div>
			</div>

			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Last Name</label>
			    <div class="col-sm-10">
			      <input type="text" name="lname"  class="form-control" id="input1" placeholder="Last Name" required />
			    </div>
			</div>

			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">E-Mail</label>
			    <div class="col-sm-10">
			      <input type="email" name="email"  class="form-control" id="input1" placeholder="E-Mail" required/>
			    </div>
			</div>

			<div class="form-group" class="radio">
			<label for="input1" class="col-sm-2 control-label">Gender</label>
			<div class="col-sm-10">
			  <label>
			    <input type="radio" name="gender" id="optionsRadios1" value="male" checked> Male
			  </label>
			  	  <label>
			    <input type="radio" name="gender" id="optionsRadios1" value="female"> Female
			  </label>
			</div>
			</div>

			<div class="form-group">
			<label for="input1" class="col-sm-2 control-label">Age</label>
			<div class="col-sm-10">
				<select name="age" class="form-control">
				<!-- Start of for loop for the age between 16 to 80 -->
				<?php 
				 for ($i=16; $i<=80; $i++)
				 {
					?>
					<!--  -->
					<option
					 value= " <?php echo $i ?>"> 
					 <?php echo $i ?>
					  </option>


				<?php } ?> 

				<!-- End of for loop -->
				</select>
			</div>
			</div>

			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Profile Image</label>
			    <div class="col-sm-10">
				<!-- To accept all image -->
			      <!-- <input type="file" name="user_image" accept="image/*"   class="form-control" id="image1" /> -->

				  <input type="file" name="user_image" accept=".png, .jpg, .jpeg"   class="form-control" id="image1" />
				  
			    </div>
			</div>
			<input type="submit" class="btn btn-primary col-md-2 col-md-offset-10" value="Submit" />
			
		</form>
	</div>
</div>
</body>
</html>