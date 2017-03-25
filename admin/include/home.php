<?php
	session_start();
	if(!$_SESSION['uname'])
	{
		header("Location: ../");
	}
?>
<!doctype html>
<html lang="en">
    <head>
        <?php include("rheader.php"); ?>
    </head>
    <body>
        <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
            <header class="demo-header mdl-layout__header mdl-color--grey-100 ">
                <div class="mdl-layout__header-row">
                    <span class="mdl-layout-title mdl-color-text--grey-800"><b>
                        <?php
                            if(isset($_GET['events']))
                                echo "EVENTS";
                            else if(isset($_GET['add_event']))
                                echo "ADD EVENT";
                            else if(isset($_GET['edit_event']))
                                echo "EDIT EVENT";
                            else if(isset($_GET['course']))
                                echo "COURSE";
                            else if(isset($_GET['add_course']))
                                echo "ADD COURSE";
                            else if(isset($_GET['edit_course']))
                                echo "EDIT COURSE";
                            else if(isset($_GET['gallery']))
                                echo "GALLERY";
                            else if(isset($_GET['add_image']))
                                echo "ADD IMAGE";
                            else if(isset($_GET['add_member']))
                                echo "ADD MEMBER";
                            else
                                echo "HOME";
                        ?>
                    </b></span>
                </div>
            </header>
            <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
                <header class="demo-drawer-header">
                    <img src="../images/user.jpg" class="demo-avatar">
                    <h4><?php echo $_SESSION['uname']; ?></h4>
                </header>
                <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
                    <a class="mdl-navigation__link" href="home.php"><i class="material-icons">home</i>Home</a>
                    <a class="mdl-navigation__link" href="home.php?events"><i class="material-icons">event</i>Events</a>
                    <a class="mdl-navigation__link" href="home.php?course"><i class="material-icons">assignment</i>Course</a>
                    <a class="mdl-navigation__link" href="home.php?gallery"><i class="material-icons">add_a_photo</i>Gallery</a>
                    <a class="mdl-navigation__link" href="home.php?logout"><i class="material-icons">exit_to_app</i>Logout</a>
                    <div class="mdl-layout-spacer"></div>
                    <div style="text-align:center;">
                        <p style="margin-bottom:0px;user-select:none;">Developed By <a style="color:inherit;text-decoration:inherit;font-weight:normal;" href="http://zhash.tech/">zhash.tech</a></p>
                        <span style="color:gray;user-select:none;cursor:default;">v1.0</span>
                    </div>
                </nav>
            </div>
            <main class="mdl-layout__content">
                <div class="mdl-grid">
                    <div class="mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
                    <div class="demo-content mdl-color--blue-grey-100 mdl-shadow--8dp content mdl-color-text--grey-800">
                        <?php
                            if(isset($_GET['logout']))
                                include("logout.php");
                            else if(isset($_GET['events']))
                                include("events.php");
                            else if(isset($_GET['add_event']))
                                include("add_event.php");
                            else if(isset($_GET['edit_event']))
                                include("edit_event.php");
                            else if(isset($_GET['delete_event']))
                                include("delete_event.php");
                            else if(isset($_GET['course']))
                                include("course.php");
                            else if(isset($_GET['add_course']))
                                include("add_course.php");
                            else if(isset($_GET['edit_course']))
                                include("edit_course.php");
                            else if(isset($_GET['delete_course']))
                                include("delete_course.php");
                            else if(isset($_GET['gallery']))
                                include("gallery.php");
                            else if(isset($_GET['add_image']))
                                include("add_image.php");
                            else if(isset($_GET['delete_image']))
                                include("delete_image.php");
                            else if(isset($_GET['add_member']))
                                include("add_member.php");
                            else
                                echo"<h1>Welcome</h1>";
                        ?>
                    </div>
                </div>
            </main>
        </div>
        <div class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--fab mdl-button--mini-fab mdl-button--primary" id="float_button" onclick="window.location.href='./home.php?add_member'"><i class="material-icons">add</i></div>
        <div class="mdl-tooltip mdl-tooltip--large mdl-tooltip--left" for="float_button">ADD MEMBER</div>
        <?php include("js.php"); ?>
    </body>
</html>