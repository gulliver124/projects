<?php
require_once('../includes/constants.php');
require_once('order.php'); //This must come before the session starts
require_once(PATH_TO_SESSION);
require_once(PATH_TO_DBCON);
require_once(PATH_TO_ACCESS);

//Select All Customers
if(isLoggedIn())
{
   
    //Fetch all Orders
    try 
    {
        $sql = "SELECT id,invoice_num,order_date FROM orders order by id DESC";
        // $result = $pdo->query($sql);
        $result = $GLOBALS['pdo']->query($sql);

        foreach($result as $row)
        {
            $orders[] = array(
                'id'=>$row['id'],
                'invoice_num'=>$row['invoice_num'],
                'order_date'=>$row['order_date'],
            
            );
        }
    } 
    catch (PDOException $e)
    {
        //throw $e;
    }

    //Fetch all products
    try 
    {
        $sql = "SELECT id,name,description,price FROM product order by id DESC";
        $result = $GLOBALS['pdo']->query($sql);
        // foreach($result as $row)
        // {
        //     $products[] = array(
        //         'id'=>$row['id'],
        //         'name'=>$row['name'],
        //         'desc'=>$row['description'],
        //         'price'=>$row['price'],
        //         'qty'=>''
        //     );
        // }
        // while($row= $result->fetch(PDO::FETCH_ASSOC))
        // {
        //     $products[] = array(
        //                 'id'=>$row['id'],
        //                 'name'=>$row['name'],
        //                 'desc'=>$row['description'],
        //                 'price'=>$row['price'],
        //                 'qty'=>''
        //             );
        // }
        $prods= $result->fetchAll(PDO::FETCH_ASSOC); //Fetches all the rows from the Product table

        foreach($prods as $row)
        {
            $products[] = array(
                        'id'=>$row['id'],
                        'name'=>$row['name'],
                        'desc'=>$row['description'],
                        'price'=>$row['price'],
                        'qty'=>''
                    );
        }
    } 
    catch (PDOException $e)
    {
        //throw $th;
    }

    
    //When User Clicks new Order Button
    if(isset($_POST['btnNewOrder']))
    {
        //generate orderId using user's email and random number
        $word = substr($_SESSION['email'],0,strpos($_SESSION['email'],'@'));
        $num=random_int(3049,1000000);
        $_SESSION['invoice_num']=str_shuffle($word.$num);
        $myProducts=[]; //Empty Product list
        
        $order1 = new Order($_SESSION['invoice_num'],$myProducts); //Order Object
        $_SESSION['order'] = $order1;
        header('Location:.');
        exit;
    }

    ///Add new Product to Order Invoice
    if(isset($_POST['btnAddProduct']))
    {
        foreach($products as $prd)
        {
            if($prd['id']==$_POST['product'])
            {
                $prd['qty'] = htmlOut($_POST['qty']); //Set Quantity
                $_SESSION['order']->addProduct($prd);
            }
        }
        
        header('Location:.');
        exit;
    }
    ///Add new Product to Order Invoice
    if(isset($_POST['btnRemove']))
    {
        foreach($products as $product)
        {
            if($product['id']==$_POST['item'])
            {
                $_SESSION['order']->removeProduct($product);
                break;
            }
            
        }        
        header('Location:.');
        exit;
    }

    ///Post Order to DB
    if(isset($_POST['action']) and $_POST['action']=='postOrder')
    {
        $currentOrder = $_SESSION['order'];
        try
        {
            #step1
           $GLOBALS['pdo']->beginTransaction();

           #step1
           //Check if this Order already exists
           $orderExist = false;
           $sql0 = "Select Count(*) from orders where invoice_num=:invNum";
           $stmt = $GLOBALS['pdo']->prepare($sql0);
           $stmt->bindParam(':invNum',$currentOrder->invoiceNum);
           $stmt->execute();
           $row=$stmt->fetch();
           if($row[0]>0)
           {
            $orderExist = true;
           }

           //Insert into Orders table
           if($orderExist==false)
           {
                $sql1 =  "INSERT into orders set invoice_num=:invNum";
                $stmt = $GLOBALS['pdo']->prepare($sql1);
                $stmt->bindParam(':invNum',$currentOrder->invoiceNum);
                $stmt->execute();
                //
                #step2
                //Insert each item into Sales table
                foreach($currentOrder->productList as $item)
                {
                    $sql2 = "Insert into sales set invoice_num =:invNum, product_id=:productId,price=:price,quantity=:qty";
                    $stmt = $GLOBALS['pdo']->prepare($sql2);
                    $stmt->bindParam(':invNum',$currentOrder->invoiceNum);
                    $stmt->bindParam(':productId',$item['id']);
                    $stmt->bindParam(':price',$item['price']);
                    $stmt->bindParam(':qty',$item['qty']);
                    $stmt->execute();
                }
    
                //
                
                //If all goes well
                # step3 commit
                $GLOBALS['pdo']->commit();
           }
           else{
            $message="This Order has already been Posted.";
            include(PATH_TO_NOTIFY);
           }
           
        } 
        catch (PDOException $e) {
            $GLOBALS['pdo']->rollBack();
            $message = $e->getMessage();
            include(PATH_TO_NOTIFY);
            exit;
        }
        unset($_SESSION['order']);
        $message = "Success!";
        include(PATH_TO_NOTIFY);
    }


    include 'orders.php';
    exit;
}

$GLOBALS['message']="Access Denied.\n Please Login!";
include(PATH_TO_NOTIFY);
exit;

?>