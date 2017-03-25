<?php
    include("connect.php");
    $get_image = "select * from gallery order by image_id desc";
    $run_image = mysqli_query($con,$get_image);
    echo "<section id='section2'><div class='container'><div class='who'><h1>GALLERY</h1></div><div class='row gal-container'>";
    if(mysqli_num_rows($run_image) > 0)
    {
        while($row_image = mysqli_fetch_array($run_image))
        {
            $image_id = $row_image['image_id'];
            $image_name = $row_image['image_name'];
            echo "<div class='col-md-4 col-sm-6 co-xs-12 gal-item'><div class='box'><a style='cursor:pointer;' data-toggle='modal' data-target='#$image_id'><img class='img-responsive' src='image/gallery/$image_name'></a><div class='modal fade' id='$image_id' tabindex='-1' role='dialog'><div class='modal-dialog' role='document'><div class='modal-content'><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='modal-body'><img class='img-responsive' src='image/gallery/$image_name'></div></div></div></div></div></div>";
        }
    }
    else
    {
        echo "<p style='text-align:center;font-size:25px;'>No Image To Display Yet.</p>";
    }
    echo "</div></div></section>";
?>