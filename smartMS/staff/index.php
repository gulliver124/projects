<?php
    require_once('../includes/constants.php');
    require_once('../includes/confile.php'); //Established connection to Database
    include_once('../includes/helpers.php');
    require_once(PATH_TO_SESSION);
    require_once(PATH_TO_DBCON);
    require_once(PATH_TO_ACCESS);

    if(isLoggedIn())
{

    //Fetch all Products from the DB
    try
    {
        $sql = "SELECT id,firstname,surname,email,password,address,phone,dob from staff order by id ASC";
        $result = $GLOBALS['pdo']->query($sql);    
        foreach($result as $row)
        {
            $staffs[] = array('id'=>$row['id'],
                                'firstname'=>$row['firstname'],
                                'surname'=>$row['surname'],
                                'email'=>$row['email'],
                                'password'=>$row['password'],
                                'address'=>$row['address'],
                                'phone'=>$row['phone'],
                                'dob'=>$row['dob'] 
                            );
        }
    } 
    catch (PDOException $e)
    {
        $message= "Something went wrong!";
        include('../includes/notify.php');
        exit;
    }
    ///
    //Search for Staff
    if(isset($_POST['start']) and $_POST['start']=='search')
    {
        ///Search our start table
        try
        {
            $searchTxt = htmlOut($_POST['searchText']);
            $sql = "SELECT id,firstname,surname,email,password,address,phone,dob FROM staff where firstname LIKE :search";
            $stmt = $GLOBALS['pdo']->prepare($sql);
            $searchTxt = '%'.$searchTxt.'%';
            $stmt->bindValue(':search',$searchTxt);
            $stmt->execute();
            $result = $stmt->fetchAll();

            foreach($result as $row)
            {
                $searchResult[] =  array('id'=>$row['id'],
                                'firstname'=>$row['firstname'],
                                'surname'=>$row['surname'],
                                'email'=>$row['email'],
                                'password'=>$row['password'],
                                'address'=>$row['address'],
                                'phone'=>$row['phone'],
                                'dob'=>$row['dob'] 
                            );
                                    
                                    
                                    
                                
            }
        } 
        catch (PDOException $e)
        {
            //throw $th;
        }

        include 'home.php'; //Landing Page
        exit;
    }
      
    if(isset($_POST['addStaff']))
    {
        ///insert new staff
        addStaff(($_POST['firstname']), ($_POST['surname']), ($_POST['phone']), ($_POST['dob']), ($_POST['email']), ($_POST['password']));
        include "home.php";
        exit;
    }

    if(isset($_POST['btnRemove']))
    {
        ///delete staff
        removeStaff();
        include "home.php";
        exit;
    }

    if(isset($_POST['btnEdit']))
    {
        $staffId = $_POST['btnId'];
        $sql =  "SELECT id,firstname,surname,email,password,address,phone,dob from staff order by id DESC";
        $result = $GLOBALS['pdo']->query($sql);
        $staffs = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach($staffs as $item)
        {
            if($staffId==$item['id'])
            {
                $line = $item;
            }
        }
    }

    if(isset($_POST['btnUpdate']))
    {
        try
        {
            $sql = "UPDATE staff SET firstname=:fName, surname=:sName, email=:eMail, phone=:pPhone, dob=:dDob WHERE id=:Id";
            $stmt = $GLOBALS['pdo']->prepare($sql);
            $stmt->bindValue(':Id',htmlOut($_POST['Id']));
            $stmt->bindValue(':fName',htmlOut($_POST['firstname']));
            $stmt->bindValue(':sName',htmlOut($_POST['surname']));
            $stmt->bindValue(':eMail',htmlOut($_POST['email']));
            $stmt->bindValue(':pPhone',htmlOut($_POST['phone']));
            $stmt->bindValue(':dDob',htmlOut($_POST['dob']));
            $stmt->execute();
        }
        catch(PDOException $e)
        {
            echo $e->getmessage();
        }
        $GLOBALS['message'] = "Updated Staff Successfully";

        include("../includes/notify.php");

    }


    include 'home.php'; //Landing Page
    exit;
    
}
else
{
$GLOBALS['message']="Access Denied.\n Please Login!";
include(PATH_TO_NOTIFY);
exit;
}



?>