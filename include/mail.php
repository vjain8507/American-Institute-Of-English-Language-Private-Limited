<?php
    require 'PHPMailer/PHPMailerAutoload.php';
    function send_to_register($course,$name,$email)
    {
        $mail1 = new PHPMailer;
        $mail1->isSMTP();
        $mail1->Host = 'cp-in-15.webhostbox.net';
        $mail1->SMTPAuth = true;
        $mail1->Username = 'info@aieludaipur.in';
        $mail1->Password = 'admininfoaiel';
        $mail1->SMTPSecure = 'tls';
        $mail1->Port = 587;
        $mail1->setFrom('info@aieludaipur.in', 'American Institute Of English Language Private Limited, Udaipur');
        $mail1->addAddress($email,$name);
        $mail1->addReplyTo('info@aieludaipur.in', 'American Institute Of English Language Private Limited, Udaipur');
        $mail1->isHTML(true);
        $mail1->Subject = 'AIEL Udaipur Welcomes You';
        $mail1->Body    = "Hi <b>$name</b>,<br><br>We are pleased to inform you that your details regarding <b>$course</b> reached us. We will contact you ASAP.<br><br>Thank you for trusting us.";
        $mail1->send();
    }
    function send_to_admin($course,$name,$email,$mobile,$address,$city,$state,$zip)
    {
        $mail2 = new PHPMailer;
        $mail2->isSMTP();
        $mail2->Host = 'cp-in-15.webhostbox.net';
        $mail2->SMTPAuth = true;
        $mail2->Username = 'info@aieludaipur.in';
        $mail2->Password = 'admininfoaiel';
        $mail2->SMTPSecure = 'tls';
        $mail2->Port = 587;
        $mail2->setFrom('info@aieludaipur.in', 'American Institute Of English Language Private Limited, Udaipur');
        $mail2->addAddress('dheeraj@aieludaipur.in', 'Dheeraj Ameta');
        $mail2->addReplyTo($email,$name);
        $mail2->isHTML(true);
        $mail2->Subject = 'New Registration @ aieludaipur.in';
        $mail2->Body    = "<b><u>Registration Details</u></b><br><br><br>Course To Register: - $course<br>Name: - $name<br>Email: - $email<br>Mobile Number: - $mobile<br>Address: - $address<br>City: - $city<br>State: - $state<br>Zip Code: - $zip";
        $mail2->send();
    }
    function send_to_contact($name,$email,$message)
    {
        $mail3 = new PHPMailer;
        $mail3->isSMTP();
        $mail3->Host = 'cp-in-15.webhostbox.net';
        $mail3->SMTPAuth = true;
        $mail3->Username = 'info@aieludaipur.in';
        $mail3->Password = 'admininfoaiel';
        $mail3->SMTPSecure = 'tls';
        $mail3->Port = 587;
        $mail3->setFrom('info@aieludaipur.in', 'American Institute Of English Language Private Limited, Udaipur');
        $mail3->addAddress('dheeraj@aieludaipur.in', 'Dheeraj Ameta');
        $mail3->addReplyTo($email,$name);
        $mail3->isHTML(true);
        $mail3->Subject = 'Contact Form @ aieludaipur.in';
        $mail3->Body    = "<b><u>Contact Form Details</u></b><br><br><br>Name: - $name<br>Email: - $email<br>Message: - $message";
        $mail3->send();
    }
?>