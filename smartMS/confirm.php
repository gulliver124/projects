<?php
require_once('includes/constants.php');
require_once(PATH_TO_DBCON);
require_once(PATH_TO_SESSION);
require_once(PATH_TO_ACCESS);

if(empty($_SESSION['token']))
{
    $GLOBALS['message']='Kindly register!';
    header('Location:.');
    exit;
}

if($_SESSION['token'] == $_GET['token'])
{
    try
    {
       $sql = "Update staff set verified=:verified where email=:email"; 
       $stmt= $GLOBALS['pdo']->prepare($sql);
       $stmt->bindValue(':verified','YES');
       $stmt->bindValue(':email',$_GET['email']);
       $stmt->execute();
    } 
    catch (PDOException $e) 
    {
        //throw $th;
    }
    echo "Congratulations, Your Account has been successfully verified!";
}



?>