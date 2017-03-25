<form action="./home.php?add_event" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>
                <span>Date - </span>
            </td>
            <td>
                <div class="mdl-textfield mdl-js-textfield">
                    <input name="date" class="mdl-textfield__input" type="date" min="<?php echo date("Y-m-d", strtotime('tomorrow')); ?>" id="t1">
                    <label class="mdl-textfield__label" for="t1"></label>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <span>Time - </span>
            </td>
            <td>
                <div class="mdl-textfield mdl-js-textfield">
                    <input name="time" class="mdl-textfield__input" type="time" id="t2">
                    <label class="mdl-textfield__label" for="t2"></label>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <span>Title - </span>
            </td>
            <td>
                <div class="mdl-textfield mdl-js-textfield">
                    <textarea name="title" class="mdl-textfield__input" rows="2" type="text" id="t3" ></textarea>
                    <label class="mdl-textfield__label" for="t3"></label>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <span>Detail - </span>
            </td>
            <td>
                <div class="mdl-textfield mdl-js-textfield">
                    <textarea name="detail" class="mdl-textfield__input" rows="2" type="text" id="t4" ></textarea>
                    <label class="mdl-textfield__label" for="t4"></label>
                </div>
            </td>
        </tr>
        <tr colspan="2" style="text-align:center;">
            <td><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" name="add_event">Add Event</button></td>
        </tr>
    </table>
</form>
<?php
    include("connect.php");
	if(isset($_POST['add_event']))
	{
		$date = (string)date('d-m-Y', strtotime($_POST['date']));
		$time = (string)date('h:i A', strtotime($_POST['time']));
		$title = $_POST['title'];
		$detail = $_POST['detail'];
		if($date=='' OR $time=='' OR $title=='' OR $detail=='')
		{
			echo "<script>alert('Please Fill All The Fields')</script>";
			exit();
		}
		else
		{
			$insert_event = "insert into events (date, time, title, detail) values ('$date','$time','$title','$detail')";
			$run_event = mysqli_query($con,$insert_event);
			echo "<script>alert('Event Has Been Added Successfully')</script>";
			echo "<script>window.open('./home.php?events','_self')</script>";
		}
	}
?>