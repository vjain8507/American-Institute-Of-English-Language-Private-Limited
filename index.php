<?php include("include/connect.php"); ?>
<html>
    <head>
        <?php include("include/header.php"); ?>
    </head>
    <body>
        <?php
            include("include/nav.php");
            if(isset($_GET['course']))
            {
                include("include/course.php");
            }
            else if(isset($_GET['centers']))
            {
                include("include/centers.php");
            }
            else if(isset($_GET['gallery']))
            {
                include("include/gallery.php");
            }
            else if(isset($_GET['director']))
            {
                include("include/director.php");
            }
            else if(isset($_GET['contact']))
            {
                include("include/contact.php");
            }
            else if(isset($_GET['register']))
            {
                include("include/register.php");
            }
            else
            {
                include("include/slider.php");
                include("include/about.php");
                include("include/events.php");
            }
            include("include/footer.php");
        ?>
    </body>
</html>