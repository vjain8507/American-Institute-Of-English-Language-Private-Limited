<?php
    include("connect.php");
    if(isset($_GET['ev']))
    {
        $edit_id = $_GET['ev'];
        $get_event = "select * from events where sno='$edit_id'";
        $run_event = mysqli_query($con,$get_event);
        while($row_event = mysqli_fetch_array($run_event))
        {
            $event_sno = $row_event['sno'];
            $event_date = $row_event['date'];
            $event_time = $row_event['time'];
            $event_title = $row_event['title'];
            $event_detail = $row_event['detail'];
        }
    }
?>
<form action="./home.php?edit_event&ev=<?php echo $edit_id; ?>" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>
                <span>Date - </span>
            </td>
            <td>
                <div class="mdl-textfield mdl-js-textfield">
                    <input name="date" value="<?php echo date("Y-m-d", strtotime($event_date)); ?>" class="mdl-textfield__input" type="date" id="t1">
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
                    <input name="time" value="<?php echo date("H:i", strtotime($event_time)); ?>" class="mdl-textfield__input" type="time" id="t2">
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
                    <textarea name="title" class="mdl-textfield__input" rows="2" type="text" id="t3" ><?php echo $event_title; ?></textarea>
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
                    <textarea name="detail" class="mdl-textfield__input" rows="2" type="text" id="t4" ><?php echo $event_detail; ?></textarea>
                    <label class="mdl-textfield__label" for="t4"></label>
                </div>
            </td>
        </tr>
        <tr colspan="2" style="text-align:center;">
            <td><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" name="save_event">Save Event</button></td>
        </tr>
    </table>
</form>
<?php
	if(isset($_POST['save_event']))
	{
        $edit_id = $_GET['ev'];
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
			$insert_event = "update events set date='$date', time='$time', title='$title', detail='$detail' where sno=$edit_id";
			$run_event = mysqli_query($con,$insert_event);
			echo "<script>alert('Event Has Been Edited Successfully')</script>";
			echo "<script>window.open('./home.php?events','_self')</script>";
		}
	}
?>