<?php
    require_once('includes/constants.php');
    require_once(PATH_TO_DBCON);
    require_once(PATH_TO_SESSION);
    require_once(PATH_TO_ACCESS);
    require_once(PATH_TO_HELPERS);
    
    if(isLoggedIn())
    {
        include('home.html');
        exit;
    }

    //redirect to Signup screen
    if(isset($_GET['signup']))
    {
        include('signup.php');
        exit;
    }

    //SignUp
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require('phpMailer/src/PHPMailer.php');
    require('phpMailer/src/SMTP.php');
    require('phpMailer/src/Exception.php');

    if(isset($_POST['action']) and $_POST['action']=='Sign Up')
    {
        addStaff($_POST['fname'],$_POST['sname'],$_POST['phone'],$_POST['dob'],$_POST['email'],$_POST['password']);
        $GLOBALS['message']='Thank You For Registering. Please check your E-Mail to Verify Account';
        include(PATH_TO_NOTIFY);
        
        //token
        $_SESSION['token'] = hash(algo:'sha256',data:uniqid());
        $token = $_SESSION['token'];

        //Send Email
        $mail = new PHPMailer();

        $mail->IsSMTP(); //Telling the class to use SMTP

        try
        {
         $mail->SMTPDebug = 1;
         $mail->Host = "mail.cenfied.com.ng";
         $mail->SMTPAuth = true;
         $mail->SMTPSecure ='ssl';
         $mail->Mailer = "smtp";
         $mail->Port = '465';
         $mail->Username ='reg@cenfied.com.ng';
         $mail->Password = "strongpass123#";
         $mail->addReplyTo('reg@cenfied.com.ng');
         $recipient = $_POST['email'];
         $fname = $_POST['fname'];
         $mail->addAddress($recipient,$_POST['fname']);
         $mail->setFrom('reg@cenfied.com.ng','CENFIED Admin');
         $mail->Subject = "New Account Confirmation";
         $mail->Body = "
         Welcome $fname to CENFIED (Nigeria's no. 1 online tech tutoring firm) \r\n
         Click this link to confirm your registration http://localhost/smartMS/confirm.php?email=$recipient&token=$token
         ";
 
         $mail->send();
 
        } 
        catch (Exception $e) 
        {
            //throw $th;
        }

        header('Location:?notify');
        exit;

    }

    if(isset($_GET['notify']))
    {
        include(PATH_TO_NOTIFY);
    }


    include 'login.php';
    
?>