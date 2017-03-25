<?php include("connect.php"); ?>
<div style="text-align:center;"><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="location.href='./home.php?add_course';">Add Course</button></div><br>
<table>
    <col width="62px">
    <thead>
        <tr>
            <th>S. No.</th>
            <th>Title</th>
            <th>Image</th>
            <th>Content</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
            $get_course = "select * from course order by course_id desc";
            $run_course = mysqli_query($con,$get_course);
            $i=1;
            while($row_course = mysqli_fetch_array($run_course))
            {
                $course_id = $row_course['course_id'];
                $course_title = $row_course['course_title'];
                $course_image = $row_course['course_image'];
                $course_data = $row_course['course_data'];
                echo "<tr>
                <td>".$i++."</td>
                <td>$course_title</td>
                <td><img src='../../image/course/$course_image' height='100px' width='100px'></td>
                <td>$course_data</td>
                <td><a href='./home.php?edit_course&ev=$course_id'><i class='material-icons'>mode_edit</i></a></td>
                <td><a href='./home.php?delete_course&de=$course_id'><i class='material-icons'>delete_forever</i></a></td>
                </tr>";
            }
        ?>
    </tbody>
</table>