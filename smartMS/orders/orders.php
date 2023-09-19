<?php require_once('order.php');?>
<html>
    <head>
        <title>BIZ Hub - Orders</title>
        <link rel="stylesheet" href="../styles/style.css">        
    </head>
    <body>
        <div id="wrapper">
            <h2>SMART SALES</h2>
            <h4>Sales Management System</h4>
            <div id="navbar">
                <a href="..">Back to Home page</a>
                <a href="?product">Go-to Products</a>
                <a href="?staff">Go-to Staff</a>      
                <a href="?logOut" id='logOut'>Log Out</a>                             
            </div>
            <div id="content">
                
                
                <div class="search-group">
                    <div class="stretch">
                        <form method="post" action=".">                                                   
                                <label>Search:</label>
                                    <input name="searchOrders" placeholder="Enter Order Id or Invoice no." class="form-input">                              
                                
                                <button class="button-sm stretch">Search</button>                       
                        </form>
                    </div> 
                </div>
                <div style="float: left;">
                    <form method="post" action=".">
                        <button class="button-mid" name="btnNewOrder">Start New Order</button>
                    </form>
                </div>  
                              
            </div>
            <p></p>
            <?php if(isset($_SESSION['order'])):?>
                <div id="content">     
                    <div id="orderNum">
                        <label>INVOICE NO:</label>
                        <?php write(isset($_SESSION['invoice_num'])? $_SESSION['invoice_num']: "OrderID");?>
                        <label>TOTAL:</label>
                        <?php 
                           
                            write("NGN ".number_format($_SESSION['order']->getTotal(),2,".",","));
                        ?>
                    </div>           
                    <div class="group-inline">
                        <form method="post" action=".">                    
                            <label>Select Product:</label>
                            <select name="product" class="select-options">
                                <?php
                                    foreach($products as $product):
                                ?>
                                <option value="<?php write($product['id']);?>">
                                    <?php write($product['name']);?>
                                </option>
                                <?php endforeach;?>
                            </select>
                            <input name="qty" type="number"  placeholder="quantity" class="form-input" required>
                            <button name="btnAddProduct" class="button-sm">Add to Invoice</button>
                        </form>
                        <form style="float:right;" method="post" action=".">
                            <button class="button" name ="action" value="postOrder">POST ORDER</button>
                        </form>
                    </div>
                    
                    <?php if(count($_SESSION['order']->productList)>0):?>
                    <div class="salesTable">
                        <table>
                            <tr>
                                <th>SN</th><th>Item</th><th>Price</th><th>Quantity</th><th>Amount</th><th></th>
                            </tr>
                            <?php 
                            $count=0;
                            foreach($_SESSION['order']->productList as $item):?>
                            <tr>
                                <td><?php write(++$count);?></td>
                                <td><?php write($item['name']);?></td>
                                <td><?php write(number_format($item['price'],2,".",","));?></td>
                                <td><?php write($item['qty']);?></td>
                                <td><?php write(number_format(intval($item['price']) * intval($item['qty']),2,".",","));?></td>
                                <td>
                                    <form method="post" action=".">
                                        <button name="btnRemove">remove</button>
                                        <input  type="hidden" name="item" value="<?php echo($item['id']);?>">
                                    </form>
                                </td>
                                
                            </tr>
                            <?php endforeach;?>
                        </table> 
                    </div>    
                    <?php endif;?>
                            
                </div>
            <?php endif;?>  
        </div>
        
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/smartms/foot.html.php';?>
</html>