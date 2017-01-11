<?php
require 'PHPMailerAutoload.php';
include 'variables.php';


try{
    $bdd = new PDO('mysql:host=localhost;dbname=mailing;charset=utf8', 'root', '');
}catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}

if(isset($_GET['id'])){
  $cpt = $_GET['id'];
}else{
  $cpt=0;
}

$req = $bdd->query('SELECT COUNT(*) FROM users');
$nbMail = $req->fetch();
$req->closeCursor();
$envoi = $bdd->query('SELECT * FROM users LIMIT 10 OFFSET '.$cpt);

if($cpt==$nbMail[0]){
  exit();
}

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                  // Set mailer to use SMTP
$mail->Host = 'smtp.live.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = $usermail;                 // SMTP usernametyjgy
$mail->Password = $password;                           // SMTP password
$mail->SMTPSecure = 'tsl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
$mail->setFrom($usermail, 'Admin');

while($dest = $envoi->fetch()){
  if($dest['actif']) {
    $mail->addAddress($dest['email']);     // Add a recipient

    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    $mail->isHTML(true);                                  // Set email format to HTML (TRUE)

    $mail->Subject = 'Bonjour '.$dest['prenom'].' '.$dest['nom'];
    $mail->Body    = '<p>Voici mon envoi de mail personnel !</p><p>Et voici mon dépôt GIT : https://github.com/Crashleur/mailing</p><p>à cause d\'un problème avec mon Gmail,'.
    'je vous envoi ce mail depuis celui d\'une camarade.<p>Bien à vous</p><br><p><b>Quentin Picard</b></p>';
    if(!$mail->send()) {
      //Problème avec l'incrémentation de l'erreur !
        echo 'Le message ne peut pas être envoyé';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message envoyé';
    }
    sleep(1);
  }
  $cpt++;
}
