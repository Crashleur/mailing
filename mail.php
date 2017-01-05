<?php
require 'PHPMailerAutoload.php';
include 'variables.php';


try{
    $bdd = new PDO('mysql:host=localhost;dbname=mailing;charset=utf8', 'root', '');
}catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}

$req = $bdd->prepare('SELECT * FROM usermail');
$req->execute();
while($dest = $req->fetch()){

    var_dump(strstr($dest['email'],'gmail') != false);
    /*
    $mail = new PHPMailer;

    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                  // Set mailer to use SMTP
    $mail->Host = 'smtp.live.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'clara.bouyer45@live.fr';                 // SMTP usernametyjgy
    $mail->Password = '';                           // SMTP password
    $mail->SMTPSecure = 'tsl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('clara.bouyer45@live.fr', 'Admin');
    $mail->addAddress('clara.bouyer45@live.fr', 'Picard');     // Add a recipient
    $mail->addReplyTo('clara.bouyer45@live.fr', 'Information');

    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    $mail->isHTML(true);                                  // Set email format to HTML (TRUE)

    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
  */
}
