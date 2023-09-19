<html>
    <head>
        <title>BIZ Hub - Products</title>
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
                                        <input name="searchText" placeholder="Enter Product name" class="form-input">                              
                                    
                                    <button class="button-sm stretch" name='action' value="search">Search</button>                       
                            </form>
                        </div>
                        
                </div>
            </div>

            <div id="content">
                <div class="search-group">
                        <div class="stretch">
                            <?php if(isset($thing)):?>
                                 Update product
                                    <?php else:?>
                                    Add New Product
                                    <?php endIf;?>
                                        <form method="post" action=".">                                                
                                            <Label>Name</Label>
                                                <input name="prodName" placeholder="Enter Name" class="form-input"
                                                <?php
                                                    if(isset($thing))
                                                    {
                                                        echo "value = '". $thing['name'] ."'";
                                                    } 
                                                ?>
                                                required> 
                                                <br>
                                            <Label>Description</Label>
                                                <input name="prodDesc" placeholder="Enter Description" class="form-input"
                                                <?php
                                                    if(isset($thing))
                                                    {
                                                        echo "value = '".$thing['description'] ."'";
                                                    }

                                                ?>
                                                required>
                                                <br>
                                            <Label>Price</Label>
                                                <input name="prodPrice" placeholder="Enter Price" class="form-input"
                                                <?php
                                                    if(isset($thing))
                                                    {
                                                        echo "value = '". $thing['price'] ."'";
                                                    }
                                                ?>
                                                required>
                                                <br>
                                                <div>
                                                    <?php if(isset($thing)):?>
                                                    <button class="button-sm stretch" name='btnUpdate' value="Add">Update</button>
                                                    <input type="hidden" name="Id" value="<?php echo $thing['id'];?>">
                                                    <?php else:?>
                                                    <button class="button-sm stretch" name='addProd' value="Add">Add product</button>
                                                    <?php endIf;?>
                                                </div>

                                        </form>
                                                    
                                                                                         
                            
                        </div>
                        
                </div>
            </div>

            <?php if(isset($searchResult)):?>
                <div id="content">
                    <?php if(count($searchResult)>0):?>
                    <div class="salesTable">
                        <table>
                            <tr>
                                <th>SN</th><th>Item</th><th>Description</th><th>Price</th><th></th>
                            </tr>
                            <?php 
                            $count=0;
                            foreach($searchResult as $item):?>
                            <tr>
                                <td><?php write(++$count);?></td>
                                <td><?php write($item['id']);?></td>
                                <td><?php write($item['name']);?></td>
                                <td><?php write($item['desc']);?></td>                                
                                <td><?php write($item['price']);?></td>
                                <td>
                                    <form method="post" action=".">
                                        <button name="btnEdit">Edit</button>
                                        <button name="btnRemove">Remove</button>
                                        <input  type="hidden" name="btnId" value="<?php echo($item['id']);?>">
                                    </form>
                                </td>
                                
                            </tr>
                            <?php endforeach;?>
                        </table> 
                    </div> 
                    
                    <?php endif;?>  
                </div> 
                <?php else:?>
                <?php echo "Search Returned Empty";?> 
            <?php endif;?>
        </div>
    </body>
</html>