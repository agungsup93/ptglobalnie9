<?php 
include "../../koneksi.php";
require '../vendor/autoload.php';
if(isset($_POST["reset_pass"])){
    $emailTo = $_POST["email"]; 								//email kamu atau email penerima link reset
    $code = uniqid(true); 										//Untuk kode atau parameter acak
    $query = mysqli_query($koneksi, "INSERT INTO reset_password VALUES ('','$emailTo','$code')");
    if($query){
		$mail = new PHPMailer\PHPMailer\PHPMailer();                            // Passing `true` enables exceptions

        //Server settings
        $mail->isSMTP();                                      				// Set mailer to use SMTP
        $mail->Host 		= 'smtp.gmail.com';								// Specify main and backup SMTP servers
        $mail->SMTPAuth 	= true;                               			// Enable SMTP authentication
        $mail->Username 	= "globalnine.ind@gmail.com";     				// SMTP username
        $mail->Password 	= 'global95a';                         			// SMTP password
        $mail->SMTPSecure 	= 'tls';                            			// Enable TLS encryption, `ssl` also accepted
        $mail->Port 		= 587;                                    		// TCP port to connect to
		
        //Recipients
        $mail->setFrom("globalnine.ind@gmail.com", "System Info"); 		//email pengirim
        $mail->addAddress($emailTo); // Email penerima
        $mail->addReplyTo("no-reply@gmail.com");
        //Content
        $url = "http://" . $_SERVER["HTTP_HOST"] .dirname($_SERVER["PHP_SELF"]). "/reset.php?reset_pass=$code";
        $mail->isHTML(true);                                  			// Set email format to HTML
        $mail->Subject = "Link reset password";
        $mail->Body    = "<h1>Permintaan reset password</h1><p> Klik <a href='$url'>link ini</a> untuk mereset password</p>" ;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        if(!$mail->Send()) 
	     {
	        echo "Mailer Error: " . $mail->ErrorInfo;
	     } else {
	        echo "<script language = 'javascript'> alert ('Succes Silahkan Cek Email Anda'); window.location='../../index'</script> ";
	     }
			}else{
		echo "<script language = 'javascript'> alert ('Ups.. Ada Kesalahan...'); window.location='../../index'</script> ";
		 }
		 }
?>