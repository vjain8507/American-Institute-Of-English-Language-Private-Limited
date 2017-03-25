<?php include("connect.php"); ?>
<div style="text-align:center;"><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="location.href='./home.php?add_image';">Add Photo</button></div><br>
<table>
    <col width="62px">
    <thead>
        <tr>
            <th>S. No.</th>
            <th>Image</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
            $get_image = "select * from gallery order by image_id desc";
            $run_image = mysqli_query($con,$get_image);
            $i=1;
            while($row_image = mysqli_fetch_array($run_image))
            {
                $image_id = $row_image['image_id'];
                $image_name = $row_image['image_name'];
                echo "<tr>
                <td>".$i++."</td>
                <td><img src='../../image/gallery/$image_name' width='200px'></td>
                <td><a href='./home.php?delete_image&de=$image_id'><i class='material-icons'>delete_forever</i></a></td>
                </tr>";
            }
        ?>
    </tbody>
</table>