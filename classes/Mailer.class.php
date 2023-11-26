<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "./PHPMailer/src/Exception.php";
require "./PHPMailer/src/PHPMailer.php";
require "./PHPMailer/src/SMTP.php";

class Mailer
{
    // SMTP server details
    private $smtpHost;
    private $smtpPort;
    private $smtpUsername;
    private $smtpPassword;

    // Email details
    private $from;
    private $to;
    private $subject;
    private $replyTo;
    private $body;
    public function __construct(
        $smtpHost = "smtp.gmail.com",
        $smtpPort = 587,
        $smtpUsername = "trios9371@gmail.com",
        $smtpPassword = "trios201523"
    ) {
        $this->smtpHost = $smtpHost;
        $this->smtpPort = $smtpPort;
        $this->smtpUsername = $smtpUsername;
        $this->smtpPassword = $smtpPassword;
    }

    public function setFrom($from = "trios9371@gmail.com")
    {
        $this->from = $from;
    }

    public function setTo($to)
    {
        $this->to = $to;
    }

    public function setSubject($subject = "Subject content")
    {
        $this->subject = $subject;
    }

    public function setBody($body = "Body content")
    {
        $this->body = $body;
    }
    public function setReplyTo($replyTo = "trios9371@gmail.com")
    {

        $this->replyTo = $replyTo;
    }

    public function send()
    {
        try {
            // Create a new PHPMailer instance
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->SMTPDebug  = 2;
            // Set up the SMTP connection

            $mail->CharSet = 'UTF-8';
            $mail->isHTML();
            $mail->Host = $this->smtpHost;
            $mail->Port = $this->smtpPort;
            $mail->SMTPAuth = true;
            $mail->Username = $this->smtpUsername;
            $mail->Password = $this->smtpPassword;
            $mail->SMTPSecure = "tls";

            // Set the email details
            $mail->setFrom($this->from);
            $mail->addAddress($this->to);
            $mail->addReplyTo($this->replyTo);
            $mail->Subject = $this->subject;
            $mail->Body = $this->body;

            // Send the email
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
