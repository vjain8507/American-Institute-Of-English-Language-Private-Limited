<?php include("tinymce.php"); ?>
<form action="./home.php?add_course" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>
                <span>Title - </span>
            </td>
            <td>
                <div class="mdl-textfield mdl-js-textfield">
                    <textarea name="title" class="mdl-textfield__input" rows="2" type="text" id="title" ></textarea>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <span>Image - </span>
            </td>
            <td>
                <div class="mdl-textfield mdl-js-textfield">
                    <input name="image" class="mdl-textfield__input" type="file" id="image">
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <span>Content - </span>
            </td>
            <td>
                <textarea name="content" rows="2" type="text" id="content"></textarea>
            </td>
        </tr>
        <tr colspan="2" style="text-align:center;">
            <td><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" name="add_course">Add</button></td>
        </tr>
    </table>
</form>
<?php
	if(isset($_POST['add_course']))
	{
        include("connect.php");
        $course_title = $_POST['title'];
        $course_image = $_FILES['image']['name'];
		$course_image_tmp = $_FILES['image']['tmp_name'];
        $course_data = $_POST['content'];
		if($course_title=='' OR $course_image==''OR $course_data=='')
		{
			echo "<script>alert('Please Fill All The Fields')</script>";
			exit();
		}
		else
		{
            move_uploaded_file($course_image_tmp,"../../image/course/$course_image");
			$insert_course = "insert into course (course_title,course_image,course_data) values ('$course_title','$course_image','$course_data')";
			$run_course = mysqli_query($con,$insert_course);
			echo "<script>alert('Course Has Been Added Successfully')</script>";
			echo "<script>window.open('./home.php?course','_self')</script>";
		}
	}
?>