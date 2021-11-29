<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    if (isset($_POST['name']) && isset($_POST['email'])) {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $body = $_POST['body'];

        require "php/PHPMailer.php";
        require "php/SMTP.php";
        require "php/Exception.php";
        
        //Create a new PHPMailer instance
        $mail = new PHPMailer();

        //Tell PHPMailer to use SMTP
        $mail->isSMTP();

        //Enable SMTP debugging
        //SMTP::DEBUG_OFF = off (for production use)
        //SMTP::DEBUG_CLIENT = client messages
        //SMTP::DEBUG_SERVER = client and server messages
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;

        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';

        //Set the SMTP port number:
        // - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
        // - 587 for SMTP+STARTTLS
        $mail->Port = 465;

        //Set the encryption mechanism to use:
        // - SMTPS (implicit TLS on port 465) or
        // - STARTTLS (explicit TLS on port 587)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;

        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = 'kalamaresbravos@gmail.com';

        //Password to use for SMTP authentication
        $mail->Password = 'wasabi150303';


        //EMAIL SETTINGS

        //Set who the message is to be sent from
        //Note that with gmail you can only use your account address (same as `Username`)
        //or predefined aliases that you have configured within your account.
        //Do not use user-submitted addresses in here
        $mail->setFrom($email, $name);

        //Set an alternative reply-to address
        //This is a good place to put user-submitted addresses
        $mail->addReplyTo($email, $name);

        //Set who the message is to be sent to
        $mail->addAddress('kalamaresbravos@gmail.com', 'Alex Cendoya');

        //Set the subject line
        $mail->Subject = $subject;

        //Set the message
        $mail->Body = $body;

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //$mail->msgHTML(file_get_contents('contents.html'), __DIR__);

        //Replace the plain text body with one created manually
        //$mail->AltBody = 'This is a plain-text message body';

        //Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');

        //send the message, check for errors
        if (!$mail->send()) {
            echo json_encode( 'Mailer Error: ' . $mail->ErrorInfo );
        } else {
            echo json_encode('Message sent!');
            //Section 2: IMAP
            //Uncomment these to save your message in the 'Sent Mail' folder.
            #if (save_mail($mail)) {
            #    echo "Message saved!";
            #}
        }

    }
?>