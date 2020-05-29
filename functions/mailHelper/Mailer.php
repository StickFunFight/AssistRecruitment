<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require '../functions/mailHelper/Exception.php';
require '../functions/mailHelper/PHPMailer.php';
require '../functions/mailHelper/SMTP.php';

class Mailer
{
    /* Mailer functionality makes use of PHPMailer https://github.com/PHPMailer/PHPMailer
    All information about how it works can be found with the link */

    //function sets up email parameters --DONT TOUCH IF YOU DONT KNOW WHAT YOU ARE DOING--
    function forgotPassword($email, $token)
    {
        $mail = $this->mailSetup();

        $emailBody = 'Er is een wachtwoord reset aangevraagd voor jou account.<br/>'
            . 'Als jij dit niet zelf hebt gedaan dan kun je deze mail negeren.<br/><br/>'
            . '<p><a href=http://localhost/AssistRecruitment/view/passwordReset.php?token=' . $token . '>Klik hier om naar de website te gaan en een nieuw wachtwoord te kiezen !</a></p>';

        //Set email information
        try {
            $mail->setFrom('Assist@gmail.com');
            $mail->addAddress($email);
            $mail->Subject = 'Wachtwoord vergeten';
            $mail->msgHTML($emailBody);

            $mail->send();
        } catch (Exception $e) {
            echo $e->errorMessage();
        }
    }

    //email functionality must always call to mailSetup() function or they wont work!

    function mailSetup()
    {
        $mail = new PHPMailer(TRUE);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'noreplyQuestlog@gmail.com';
        $mail->Password = 'questlogadmin69';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        return $mail;
    }

    function ScanInBulk($email)
    {
        $mail = $this->mailSetup();

        $emailBody = 'U bent toegevoegd aan een Scan, Klik hier om deze te maken.';

        //Set email information
        try {
            $mail->setFrom('Assist@gmail.com');
            $mail->addAddress($email);
            $mail->Subject = 'Toegevoegd aan scan';
            $mail->msgHTML($emailBody);

            $mail->send();
        } catch (Exception $e) {
            echo $e->errorMessage();
        }
    }
}