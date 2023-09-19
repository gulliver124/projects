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
        $sql = "SELECT id,name,description,price from product order by id ASC";
        $result = $GLOBALS['pdo']->query($sql);    
        foreach($result as $row)
        {
            $products[] = array('id'=>$row['id'],
                                'name'=>$row['name'],
                                'desc'=>$row['description'],
                                'price'=>$row['price']
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
    //Search for Product
    if(isset($_POST['action']) and $_POST['action']=='search')
    {
        ///Search our product table
        try
        {
            $searchTxt = htmlOut($_POST['searchText']);
            $sql = "SELECT id,name,description,price FROM product where name LIKE :search";
            $stmt = $GLOBALS['pdo']->prepare($sql);
            $searchTxt = '%'.$searchTxt.'%';
            $stmt->bindValue(':search',$searchTxt);
            $stmt->execute();
            $result = $stmt->fetchAll();

            foreach($result as $row)
            {
                $searchResult[] = array('id'=>$row['id'],
                                    'name'=>$row['name'],
                                    'desc'=>$row['description'],
                                    'price'=>$row['price']
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
      
    if(isset($_POST['addProd']))
    {
        ///insert new product
        addProduct(($_POST['prodName']), ($_POST['prodDesc']), ($_POST['prodPrice']));
        include "home.php";
        exit;
    }

    if(isset($_POST['btnRemove']))
    {
        ///delete product
        removeProduct();
        include "home.php";
        exit;
    }

    if(isset($_POST['btnEdit']))
    {
        $productId = $_POST['btnId'];
        $sql = "SELECT id, name,description,price FROM product order by id DESC";
        $result = $GLOBALS['pdo']->query($sql);
        $products = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach($products as $item)
        {
            if($productId==$item['id'])
            {
                $thing = $item;
            }
        }
    }

    if(isset($_POST['btnUpdate']))
    {
        try
        {
            $sql = "UPDATE product SET name=:pName, description=:pDesc, price=:pPrice WHERE id=:Id";
            $stmt = $GLOBALS['pdo']->prepare($sql);
            $stmt->bindValue(':Id',htmlOut($_POST['Id']));
            $stmt->bindValue(':pName',htmlOut($_POST['prodName']));
            $stmt->bindValue(':pDesc',htmlOut($_POST['prodDesc']));
            $stmt->bindValue(':pPrice',htmlOut($_POST['prodPrice']));
            $stmt->execute();
        }
        catch(PDOException $e)
        {
            echo $e->getmessage();
        }
        $GLOBALS['message'] = "Updated Successfully";

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