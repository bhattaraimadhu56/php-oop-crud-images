<?php
session_start();
 require_once('databaseFunction.php');
 $id = $_GET['id'];
 //Can delete normal way by base on id
 // To delete image from file we have to select the particular image base on the particcular id to be deleted
 // then unlink it

 // To select the data we have made read function 
 //$result = $db->read();


 // Read Based on id we need this based on id
 $result = $db->read($id);
 // we have only one data based on id so do mysqli_fetch_assoc or array
  $r=mysqli_fetch_array($result);
  $imagefromDB=$r['profileimage'];
 // Or get get particular image from database usig while loop but no need to do
//  while( $r=mysqli_fetch_array($result))
//  {
// 	$imagefromDB=$r['profileimage'];
//  }
//  $imagefromDB=$r['profileimage'];
 // unlink to delete from folder this doesn't work
 //unlink("uploadImage/'.$imagefromDB.'");
 //unlink("uploadImage/.$imagefromDB.");

 // Or simply do this works 
 unlink("uploadImage/$imagefromDB");
 // For other just do normal delete
 $result = $db->delete($id);
 if($result){
	//echo "Data Deleted Successfully";
 	$_SESSION['success']="Data Deleted Successfully";
 }else{
	// echo "Failed to Delete Record";
	 $_SESSION['failure']="Failed to Delete Record";
 }
// If result success or failure doesn't matter return to index page
header('location: index.php');
?>