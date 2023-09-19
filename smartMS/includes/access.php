<?php
    require_once('constants.php');
    require_once(PATH_TO_HELPERS);

    function isLoggedIn()
    {
        if(isset($_POST['action']) and $_POST['action']== 'Log In')
        {
            if(empty(trim($_POST['email'])) or trim(empty($_POST['password'])))
            {
                return false;
            }
            else
            {
                $email = htmlOut($_POST['email']);
                $password = encPassword(htmlOut($_POST['password']));
                
                if(!staffExistInDatabase($email,$password))
                {
                    if(!isset($_SESSION))
                    {
                        session_start();
                    }               
                    unset($_SESSION['email']);
                    unset($_SESSION['password']);
                    unset($_SESSION['loggedIn']);
                         
                    $GLOBALS['message'] = "User credentials for '{$email}' does not exist in the System";
                    include(PATH_TO_NOTIFY);
                    return false;
                    
                }
                else{
                    if(!isset($_SESSION))
                    {
                        session_start();
                    } 
                    $_SESSION['email']=$email;
                    $_SESSION['password']=$password;
                    $_SESSION['loggedIn']=TRUE; 
                    return TRUE;                
                    
                }
            }
            
        }
        if(isset($_SESSION['loggedIn']))
        {
            return staffExistInDatabase($_SESSION['email'],$_SESSION['password']);
        }
    }

        

    //Log Out
    if((isset($_POST['action']) and $_POST['action']=='Sign Out') or isset($_GET['logOut']))
    {
        if(!isset($_SESSION))
        {
            session_start();
        }
        unset($_SESSION['email']);
        unset($_SESSION['password']);
        unset($_SESSION['loggedIn']);
        unset($_SESSION['order']);
        unset($_SESSION['orderId']);
        // unset($_SESSION['userid']);
        header('Location:.');
        exit;
    }

    
?>