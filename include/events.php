<?php
    include("connect.php");
    $get_event = "select * from events order by sno DESC";
    $run_event = mysqli_query($con,$get_event);
    if(mysqli_num_rows($run_event) > 0)
    {
        echo"<section id='eventback'><div class='container container-fluid'><div class='main'><ul class='cbp_tmtimeline'>";
        while($row_event = mysqli_fetch_array($run_event))
        {
            $sno = $row_event['sno'];
            $date = $row_event['date'];
            $time = $row_event['time'];
            $title = $row_event['title'];
            $detail = $row_event['detail'];
            echo "<li><time class='cbp_tmtime' datetime='2013-04-10 18:30'><span>$date</span><span>$time</span></time><div class='cbp_tmlabel'><h2>$title</h2><p>$detail</p></div></li>";
        }
        echo "</ul></div></div></section>";
    }
?>