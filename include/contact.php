<section id="section8">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="contact_area">
                    <h1><u>GET IN TOUCH</u></h1>
                    <p>Feel Free To Ask Any Questions Via The Contact Form Below.</p>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="contact_left wow fadeInLeft">
                                <h1>Contact</h1>
                                <div class="media contact_media">
                                    <i class="fa fa-user"></i>
                                    <div class="media-body contact_media_body">
                                        <h4>Dheeraj Ameta (Director)</h4>
                                    </div>
                                </div>
                                <div class="media contact_media">
                                    <i class="fa fa-phone"></i>
                                    <div class="media-body contact_media_body">
                                        <h4><a href="tel:+919352665262">+91 93526 65262</a></h4>
                                    </div>
                                </div>
                                <div class="media contact_media">
                                    <i class="fa fa-envelope"></i>
                                    <div class="media-body contact_media_body">
                                        <h4><a href="mailto:psy.ametadheeraj@gmail.com">dheeraj@aieludaipur.in</a></h4>
                                    </div>
                                </div>
                                <div class="media contact_media">
                                    <i class="fa fa-map-marker"></i>
                                    <div class="media-body contact_media_body">
                                        <h4>Udaipur, Rajasthan, India</h4>
                                    </div>
                                </div>
                                <div class="contact_social">
                                    <h1>Social</h1>
                                    <a class="fb" href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
                                    <a class="twitter" href="https://twitter.com/"><i class="fa fa-twitter"></i></a>
                                    <a class="gplus" href="https://plus.google.com/"><i class="fa fa-google-plus"></i></a>
                                    <a class="pinterest" href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="contact_right wow fadeInRight">
                                <div id="form-messages"></div>
                                <form class="footer_form" method="post" action="./?contact" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-grooup">
                                                <input type="text" class="form-control" placeholder="Name" name="name" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <input type="email" class="form-control" placeholder="Email" name="email" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <textarea class="form-control" cols="30" rows="8" placeholder="Message" name="message" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input class="contact_sendbtn" type="submit" name="submit" value="Send">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    include("include/mail.php");
    if(isset($_POST['submit']))
	{
		$name=$_POST['name'];
		$email=$_POST['email'];
        $message=$_POST['message'];
        if($name=='' OR $email=='' OR $message=='')
		{
			echo "<script>alert('Please Fill All The Fields')</script>";
			exit();
		}
		else
		{
			$insert_reg = "insert into contact (contact_name,contact_email,contact_message) values ('$name','$email','$message')";
			$run_reg = mysqli_query($con,$insert_reg);
            send_to_contact($name,$email,$message);
            echo "<script>alert('Thank You, We Will Contact You Soon.')</script>";
			echo "<script>window.open('./?contact','_self')</script>";
        }
    }
?>