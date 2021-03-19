<?php

session_start();

$mysqli = new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));
$id =0;
$update = false;
$name = '';
$location = '';
$mobile = '';
//insert data
if (isset($_POST['save'])) {
	$name = $_POST['name'];
	$location = $_POST['location'];
	$mobile = $_POST['mobile'];

	$mysqli->query("insert into data (name,location,mobile) values ('$name','$location','$mobile')") or
	die($mysqli->error);

     $_SESSION['message'] = "Record has been saved!";
     $_SESSION['msg_type'] = "success";

     header("location: index.php");

}
//delete data
if (isset($_GET['delete'])) {
	$id = $_GET['delete'];
	$mysqli->query("delete from data where id=$id") or die($mysqli->error());

	 $_SESSION['message'] = "Record has been delete!";
     $_SESSION['msg_type'] = "danger";

     header("location: index.php");

}
//Edit data
if (isset($_GET['edit'])) {
	$id = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("select * from data where id=$id") or die($mysqli->error());
	if($result){
		$row = $result->fetch_array();
		$name = $row['name'];
		$location = $row['location'];
		$mobile = $row['mobile'];
	}
}
//update data
if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$location =$_POST['location'];
	$mobile =$_POST['mobile'];

	$mysqli->query("update data set name='$name',location='$location',mobile='$mobile' where id=$id") or die($mysqli->error);

	$_SESSION['message'] = "Record has been updated!";
     $_SESSION['msg_type'] = "warning";

     header('location: index.php');
}
/*if (isset($_GET['edit'])) {
	$id = $_GET['edit'];
	$result = $mysqli->query("select * from data where id=$id") or die($mysqli->error());
	if (count($result)==true){
		$row = $result->fetch_array();
		$name = $row['name'];
		$location = $row['location'];
	}
}*/

?>