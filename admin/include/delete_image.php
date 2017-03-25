<?php
    include("connect.php");
	if(isset($_GET['de']))
	{
		$delete_id = $_GET['de'];
        $row_file = mysqli_fetch_array(mysqli_query($con,"select image_name from gallery where image_id=$delete_id"));
        $image = $row_file['image_name'];
        unlink("../../image/gallery/$image");
		$delete_a = "delete from gallery where image_id='$delete_id'";
		$run_delete = mysqli_query($con,$delete_a);
		echo "<script>alert('Image Has Been Deleted')</script>";
		echo "<script>window.open('./home.php?gallery','_self')</script>";
	}
?>