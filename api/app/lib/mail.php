<?php
namespace App\Lib;

use PHPMailer\PHPMailer\PHPMailer,
    PHPMailer\PHPMailer\Exception;

class Mail
{
    public function sendMail($to,$cc,$bcc, $subject,$message){
      $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
      try {
          //Server settings
          //$mail->SMTPDebug = 0;
          //$mail->Debugoutput = 'html';
          // Activo condificacción utf-8
          $mail->CharSet = 'UTF-8';                                 // Enable verbose debug output
          $mail->isSMTP();                                      // Set mailer to use SMTP
          $mail->Host = 'mail.duwestcolombia.com';  // Specify main and backup SMTP servers
          $mail->SMTPAuth = true;                               // Enable SMTP authentication
          $mail->Username = 'dufly@duwestcolombia.com';                 // SMTP username
          $mail->Password = '1qazxsw2*';                           // SMTP password
          $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
          $mail->Port = 465;                                    // TCP port to connect to

          //Recipients
          $mail->setFrom('dufly@duwestcolombia.com', 'Dufly');
          $mail->addAddress($to);     // Add a recipient
          if ($cc != '') {
            $mail->addCC($cc);
          }
          if ($bcc != '') {
            $mail->addBCC($bcc);
          }

          //$mail->addAddress('ellen@example.com');               // Name is optional
          /*$mail->addReplyTo('info@example.com', 'Information');
          $mail->addCC('cc@example.com');
          $mail->addBCC('bcc@example.com');*/

          //Attachments
          /*$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
          $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); */   // Optional name
          //$message2 = file_get_contents('app/lib/plantilla_mail.html');
          //$body = str_replace('<div id="body"></div>',$message2,'<div id="body"></div>');
          //Content
          $mail->isHTML(true);                                  // Set email format to HTML
          $mail->Subject = $subject;
          $mail->Body    = $message;

          $mail->AltBody = $message;//This is the body in plain text for non-HTML mail clients';

          $mail->send();
          // Clear all addresses and attachments for next loop
          $mail->clearAddresses();
          return true;
      } catch (Exception $e) {
          return "Error al enviar el correo ".$mail->ErrorInfo;
      }

    }
}
