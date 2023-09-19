<!DOCTYPE html>
<?php

    if(isset($_POST['action']) and $_POST['action']== 'Log In')
    {
        include 'new.php';
        exit;
    }

    require_once('errand.php');
    if(isset($_POST['postErrand']))
    {
        $item = $_POST['item'];
        $destination = $_POST['destination'];
        $rName = $_POST['rName'];
        $rPhone = $_POST['rPhone'];
    
        $delivery= new Errand("user_email",$item,$destination,$rName,$rPhone);
    
        $_SESSION['errand'] = $delivery;
    
       include "errand2.php";
       exit;
    
    
    }
    include 'login.php';
    exit;

    require_once('contact-form.php');
    if(isset($_POST['back']))
    {
        include 'new.php';
        exit;
        
    }


    
    

?>
</html>