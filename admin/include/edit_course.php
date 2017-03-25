<?php
    include("connect.php");
    if(isset($_GET['ev']))
    {
        $edit_id = $_GET['ev'];
        $get_course = "select * from course where course_id='$edit_id'";
        $run_course = mysqli_query($con,$get_course);
        while($row_course = mysqli_fetch_array($run_course))
        {
            $course_id = $row_course['course_id'];
            $course_title = $row_course['course_title'];
            $course_image = $row_course['course_image'];
            $course_data = $row_course['course_data'];
        }
    }
?>
<?php include("tinymce.php"); ?>
<form action="./home.php?edit_course&ev=<?php echo $course_id; ?>" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>
                <span>Title - </span>
            </td>
            <td>
                <div class="mdl-textfield mdl-js-textfield">
                    <textarea name="title" class="mdl-textfield__input" rows="2" type="text" id="title"><?php echo $course_title; ?></textarea>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <span>Image - </span>
            </td>
            <td>
                <div class="mdl-textfield mdl-js-textfield">
                    <input name="image" class="mdl-textfield__input" type="file" id="image"><img src="../../image/course/<?php echo $course_image; ?>" width="60" height="60" />
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <span>Content - </span>
            </td>
            <td>
                <textarea name="content" rows="2" type="text" id="content"><?php echo $course_data; ?></textarea>
            </td>
        </tr>
        <tr colspan="2" style="text-align:center;">
            <td><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" name="edit_course">Add</button></td>
        </tr>
    </table>
</form>
<?php
	if(isset($_POST['edit_course']))
	{
        $edit_id = $_GET['ev'];
        $course_title = $_POST['title'];
        $course_image = $_FILES['image']['name'];
		$course_image_tmp = $_FILES['image']['tmp_name'];
        $course_data = $_POST['content'];
		if($course_title=='' OR $course_data=='')
		{
			echo "<script>alert('Please Fill All The Fields')</script>";
			exit();
		}
		else
		{
            if($course_image=='')
                $insert_course = "update course set course_title='$course_title', course_data='$course_data' where course_id='$edit_id'";
            else
            {
                move_uploaded_file($course_image_tmp,"../../image/course/$course_image");
                $insert_course = "update course set course_title='$course_title', course_image='$course_image', course_data='$course_data' where course_id='$edit_id'";
            }
            $run_course = mysqli_query($con,$insert_course);
			echo "<script>alert('Course Has Been Updated Successfully')</script>";
			echo "<script>window.open('./home.php?course','_self')</script>";
		}
	}
?>