<?php
    include("connect.php");
	if(isset($_GET['de']))
	{
		$delete_id = $_GET['de'];
        $row_file = mysqli_fetch_array(mysqli_query($con,"select course_image from course where course_id=$delete_id"));
        $course_image = $row_file['course_image'];
        unlink("../../image/course/$course_image");
		$delete_a = "delete from course where course_id='$delete_id'";
		$run_delete = mysqli_query($con,$delete_a);
		echo "<script>alert('Course Has Been Deleted')</script>";
		echo "<script>window.open('./home.php?course','_self')</script>";
	}
?>