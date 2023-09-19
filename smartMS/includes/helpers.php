<?php


/**
 
 * Inserts new Staff to Database
 *
 * @param mixed fname
 * @param mixed sname
 * @param mixed phone
 * @param mixed dob
 * @param mixed email
 * @param mixed password
 *
 * @return void
 */
function addStaff($fname,$sname,$phone,$dob,$email,$password)
{
    $pass = encPassword($password);
    try {
        $sql = "Insert into staff set firstname=:firstname,surname=:surname,phone=:phone,dob=:dob,email=:email,password=:password";
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':firstname',htmlOut($fname));
        $stmt->bindValue(':surname',htmlOut($sname));
        $stmt->bindValue(':phone',htmlOut($phone));
        $stmt->bindValue(':dob',htmlOut($dob));
        $stmt->bindValue(':email',strtolower(trim(htmlOut($email)))); //Convert special characters to plain text -> Remove White Spaces -> change to lower case
        $stmt->bindParam(':password',$pass); //Using bindParam() function
        $stmt->execute();

        $num_rows = $stmt->rowCount(); //Outputs the number of rows inserted
        return $GLOBALS['pdo']->lastInsertId(); //Returns the new Staff Id;
    } 
    catch (PDOException $e)
    {
        
    } 
    

    // try
    // {
    //   //Begin Transaction
    //   $GLOBALS['pdo']->beginTransaction();
      
    //   //PDO statements to execute


    //   //If everything goes well...

    //   //Commit transaction
    //   $GLOBALS['pdo']->commit();

    // } 
    // catch (PDOException $e) {
    //     //If there's a problem
    //     //Rollback transaction
    //     $GLOBALS['pdo']->rollBack();
    //     //throw $e;
    // }
    
}


/**
 * Checks if Staff is Registered
 *
 * @param mixed email
 * @param mixed password
 *
 * @return bool
 */
function staffExistInDatabase($email,$password)
{    
    try
    {
        $sql="SELECT COUNT(*) FROM staff where email=:email and password=:password";
        $s=$GLOBALS['pdo']->prepare($sql);
        $s->bindValue(':email',$email);
        $s->bindValue(':password',$password);
        $s->execute();
    }
    catch(PDOException $e)
    {
        $errors[]=$e->getMessage();
    }
    $row=$s->fetch();
    if($row[0]>0)
    {
        return TRUE;                
    }
    else
    {
        return FALSE;
    }
}

function htmlOut($txt)
{
    return htmlspecialchars($txt,ENT_QUOTES,'UTF-8');
}



function encPassword($password)
{
    $salt = "qwerty2022";
    $hash = hash_hmac('md5',trim($password),$salt); //Hashing
    return $hash;
}

function write($msg){
    echo htmlOut($msg);
}

if(isset($_GET['home']))
{
    header('Location:..');    
    exit;
}

function addProduct($addName, $addDesc, $addPrice)
{
    try 
        {
        $sql = "INSERT into product set name=:addName, description=:addDesc, price=addPrice";
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':pName',htmlOut($_POST['prodName']));
        $stmt->bindValue(':pDesc',htmlOut($_POST['prodDesc']));
        $stmt->bindValue(':pPrice',htmlOut($_POST['prodPrice']));
        $stmt->execute();
        }
        catch (PDOException $e)
        {
            //throw $th;
        }
        $GLOBALS['message'] = "Added Product Successfully";
        include("../includes/notify.php"); 

}

function removeProduct()
{
    try
    {
        $sql = "DELETE from product where id=Id";
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':Id',htmlOut($_POST['btnId']));
        $stmt->execute();
    }
    catch(PDOException)
    {

    }
    $GLOBALS['message'] = "Deleted Product Successfully";
    include("../includes/notify.php");
}

function updateProduct()
{
    try
    {
        $sql = "UPDATE product SET name=:pName, description=:pDesc, price=:pPrice WHERE id=:Id";
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':pName',htmlOut($_POST['prodName']));
        $stmt->bindValue(':pDesc',htmlOut($_POST['prodDesc']));
        $stmt->bindValue(':pPrice',htmlOut($_POST['prodPrice']));
        $stmt->execute();
    }
    catch(PDOException $e)
    {
        $GLOBALS['message'] = "Could Not Update Product";
        include("../includes/notify.php");
    }
    $GLOBALS['message'] = "Updated  Successfully";
    include("../includes/notify.php");
}



function removeStaff()
{
    try
    {
        $sql = "DELETE from staff where id=:Id";
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':Id',htmlOut($_POST['btnId']));
        $stmt->execute();
    }
    catch(PDOException)
    {
        echo $e->getmessage();
    }
    $GLOBALS['message'] = "Deleted Staff Successfully";
    include("../includes/notify.php");
}


function updateStaff()
{
    try
    {
        $sql = "UPDATE staff SET firstName=:fName, surname=:sName, email=:eMail, phone=:pPhone, dob=:dDob WHERE id=:Id";
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':fName',htmlOut($_POST['firstName']));
        $stmt->bindValue(':sName',htmlOut($_POST['surname']));
        $stmt->bindValue(':eMail',htmlOut($_POST['email']));
        $stmt->bindValue(':pPhone',htmlOut($_POST['phone']));
        $stmt->bindValue(':dDob',htmlOut($_POST['dob']));
        $stmt->execute();
    }
    catch(PDOException $e)
    {
        $GLOBALS['message'] = "Could Not Update Staff";
        include("../includes/notify.php");
    }
    $GLOBALS['message'] = "Updated Staff Successfully";
    include("../includes/notify.php");
}



?>