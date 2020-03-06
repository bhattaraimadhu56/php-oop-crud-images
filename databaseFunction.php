<?php 
include_once('database.php');

class DatabaseFunction extends Database{

	public function create($fname,$lname,$email,$gender,$age, $image){
		$query = "INSERT INTO `crud` (firstname, lastname, email, gender, age, profileimage) VALUES ('$fname', '$lname', '$email', '$gender', '$age', '$image')";
		$result = mysqli_query($this->con, $query);
		if($result){
	 		return true;
		}else{
			return false;
		}
	}

	public function read($id=null){
		$query = "SELECT * FROM `crud`";
		if($id){ $query .= " WHERE id=$id";}
 		$result = mysqli_query($this->con, $query);
 		return $result;
	}
// Update with Image
	public function updatewithImage($fname,$lname,$email,$gender,$age, $id, $image){
		$query = "UPDATE `crud` SET firstname='$fname', lastname='$lname', email='$email', gender='$gender', age='$age', profileimage='$image' WHERE id=$id";
		$result = mysqli_query($this->con, $query);
		if($result){
			return true;
		}else{
			return false;
		}
	}

// Normal Update without Image
	public function update($fname,$lname,$email,$gender,$age, $id){
		$query = "UPDATE `crud` SET firstname='$fname', lastname='$lname', email='$email', gender='$gender', age='$age' WHERE id=$id";
		$result = mysqli_query($this->con, $query);
		if($result){
			return true;
		}else{
			return false;
		}
	}


	public function delete($id){
		$query = "DELETE FROM `crud` WHERE id=$id";
 		$result = mysqli_query($this->con, $query);
 		if($result){
 			return true;
 		}else{
 			return false;
 		}
	}

	public function escapeString($var){
		$return = mysqli_real_escape_string($this->con, $var);
		return $return;
	}
}

$db = new DatabaseFunction();
?>