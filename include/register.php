<?php
    if(isset($_GET['c']))
    {
        $get_id = $_GET['c'];
        $select_course = "select course_title from course where course_id='$get_id'";
        $run_query = mysqli_query($con,$select_course);
        while($row_course = mysqli_fetch_array($run_query))
        {
            $course_title = $row_course['course_title'];
        }
    }
?>
<section id="secregister">
    <div class="container">
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="form-group panel-title" style="text-align:center;">
                        <h1>REGISTRATION</h1>
                    </div>
                </div>
                <div class="panel-body" style="padding-top:10px;">
                    <form action="./?register&c=<?php echo $get_id; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="control-label">COURSE TO REGISTER</label>
                            <input name="course" type="text" readonly class="form-control" value="<?php echo $course_title; ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">NAME</label>
                            <input name="name" type="text" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="control-label">EMAIL ADDRESS</label>
                            <input type="email" name="email" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="control-label">MOBILE NUMBER</label>
                            <input type="tel" name="mobile" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="control-label">ADDRESS</label>
                            <input type="text" name="address" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="control-label">CITY</label>
                            <input type="text" name="city" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="control-label">STATE</label>
                            <input type="text" name="state" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="control-label">ZIP CODE</label>
                            <input type="text" name="zip" required class="form-control">
                        </div>
                        <div class="form-group">
                            <button name="submit" type="submit" class="btn btn-info btn-block">REGISTER NOW</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    include("include/mail.php");
	if(isset($_POST['submit']))
	{
		$course=$_POST['course'];
		$name=$_POST['name'];
        $email=$_POST['email'];
		$mobile=$_POST['mobile'];
        $address=$_POST['address'];
		$city=$_POST['city'];
        $state=$_POST['state'];
		$zip=$_POST['zip'];
        if($course=='' OR $name=='' OR $email=='' OR $mobile=='' OR $address=='' OR $city=='' OR $state=='' OR $zip=='')
		{
			echo "<script>alert('Please Fill All The Fields')</script>";
			exit();
		}
		else
		{
			$insert_reg = "insert into register (reg_course,reg_name,reg_email,reg_mobile,reg_address,reg_city,reg_state,reg_zip) values ('$course','$name','$email','$mobile','$address','$city','$state','$zip')";
			$run_reg = mysqli_query($con,$insert_reg);
            send_to_register($course,$name,$email);
            send_to_admin($course,$name,$email,$mobile,$address,$city,$state,$zip);
            echo "<script>alert('Registration Complete! Check Your E-Mail!')</script>";
			echo "<script>window.open('./?course','_self')</script>";
        }
    }
?>