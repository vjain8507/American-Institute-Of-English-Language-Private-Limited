<?php include("connect.php"); ?>
<div style="text-align:center;"><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="location.href='./home.php?add_event';">Add Event</button></div><br>
<table>
    <col width="62px">
    <thead>
        <tr>
            <th>S. No.</th>
            <th>Date</th>
            <th>Time</th>
            <th>Title</th>
            <th>Detail</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
            $get_event = "select * from events order by sno DESC";
            $run_event = mysqli_query($con,$get_event);
            $i=1;
            while($row_event = mysqli_fetch_array($run_event))
            {
                $sno = $row_event['sno'];
                $date = $row_event['date'];
                $time = $row_event['time'];
                $title = $row_event['title'];
                $detail = $row_event['detail'];
                echo "<tr><td>".$i++."</td><td>$date</td><td>$time</td><td>$title</td><td>$detail</td><td><a href='./home.php?edit_event&ev=$sno'><i class='material-icons'>mode_edit</i></a></td><td><a href='./home.php?delete_event&de=$sno'><i class='material-icons'>delete_forever</i></a></td></tr>";
            }
        ?>
    </tbody>
</table>