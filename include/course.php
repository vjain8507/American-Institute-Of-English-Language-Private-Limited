<?php
    include("connect.php");
    $get_course = "select * from course order by course_id asc";
    $run_course = mysqli_query($con,$get_course);
    echo "<section id='section4'><div class='container who'><h1>COURSE</h1><div class='row ralign list-group'>";
    while($row_course = mysqli_fetch_array($run_course))
    {
        $course_id = $row_course['course_id'];
        $course_title = $row_course['course_title'];
        $course_image = $row_course['course_image'];
        $course_data = $row_course['course_data'];
        echo "<div class='item col-md-6'><div class='thumbnail'><img class='group list-group-image' src='image/course/$course_image'/><div class='caption'><h4 class='group inner list-group-item-heading'>$course_title</h4><p class='group inner list-group-item-text'>$course_data</p><a class='btn btn-success' style='width:100%;' href='./?register&c=$course_id'>To Register Contact Us</a></div></div></div>";
    }
    echo "</div></div></section>";
?>