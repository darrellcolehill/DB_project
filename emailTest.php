<?php
    
    $to = "darrellcolehill@gmail.com";
    $subject = "This is from local host";
    $message = "I can't believe this is working!";
    $header = "From: dbprojectfall21@gmail.com\r\nReply-To: dbprojectfall21@gmail.com";
    $mail_sent = mail($to, $subject, $message, $header);

    if($mail_sent==true)
    {
        echo "PRAISE THE LORD!!!!!!!!!!!!!!!!";
    }
    else
    {
        echo "Mail has failed to send!!!!!!!!!!!!!!!!";
    }
?>