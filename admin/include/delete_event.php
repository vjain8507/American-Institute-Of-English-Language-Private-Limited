<?php
    include("connect.php");
	if(isset($_GET['de']))
	{
		$delete_id = $_GET['de'];
		$delete_a = "delete from events where sno='$delete_id'";
		$run_delete = mysqli_query($con,$delete_a);
		echo "<script>alert('Event Has Been Deleted')</script>";
		echo "<script>window.open('./home.php?events','_self')</script>";
	}
?>