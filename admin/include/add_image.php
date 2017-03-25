<form action="./home.php?add_image" method="post" enctype="multipart/form-data">
    <table>
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
        <tr colspan="2" style="text-align:center;">
            <td><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" name="add_image">Add</button></td>
        </tr>
    </table>
</form>
<?php
	if(isset($_POST['add_image']))
	{
        include("connect.php");
        $image = $_FILES['image']['name'];
		$image_tmp = $_FILES['image']['tmp_name'];
		if($image=='')
		{
			echo "<script>alert('Please Fill All The Fields')</script>";
			exit();
		}
		else
		{
            move_uploaded_file($image_tmp,"../../image/gallery/$image");
			$insert_image = "insert into gallery (image_name) values ('$image')";
			$run_image = mysqli_query($con,$insert_image);
			echo "<script>alert('Image Has Been Added Successfully')</script>";
			echo "<script>window.open('./home.php?gallery','_self')</script>";
		}
	}
?>