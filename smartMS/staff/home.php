<html>
    <head>
        <title>BIZ Hub - Staff</title>
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
                                        <input name="searchText" placeholder="Enter Staff name" class="form-input">                              
                                    
                                    <button class="button-sm stretch" name='start' value="search">Search</button>                       
                            </form>
                        </div>
                        
                </div>
            </div>

            <div id="content">
                <div class="search-group">
                        <div class="stretch">
                            <?php if(isset($line)):?>
                                 Update staff 
                                    <?php else:?>
                                    Add New Staff 
                                    <?php endIf;?>
                                        <form method="post" action=".">                                                
                                            <Label>First Name</Label>
                                            <br>
                                                <input name="firstname" placeholder="Enter First Name" class="form-input"
                                                <?php
                                                    if(isset($line))
                                                    {
                                                        echo "value = '". $line['firstname'] ."'";
                                                    } 
                                                ?>
                                                required> 
                                                <br>
                                            <Label>Surname</Label>
                                            <br>
                                                <input name="surname" placeholder="Enter Surname" class="form-input"
                                                <?php
                                                    if(isset($line))
                                                    {
                                                        echo "value = '".$line['surname'] ."'";
                                                    }

                                                ?>
                                                required>
                                                <br>
                                            <Label>E-mail</Label>
                                            <br>
                                                <input name="email" placeholder="Enter E-mail" class="form-input"
                                                <?php
                                                    if(isset($line))
                                                    {
                                                        echo "value = '". $line['email'] ."'";
                                                    }
                                                ?>
                                                required>
                                                <br>
                                            <Label>Password</Label>
                                            <br>
                                                <input name="password" placeholder="Enter Passsword" class="form-input"
                                                <?php
                                                    if(isset($line))
                                                    {
                                                        echo "value = '". $line['password'] ."'";
                                                    }
                                                ?>
                                                >
                                                <br>
                                            <Label>Phone</Label>
                                            <br>
                                                <input name="phone" placeholder="Enter Phone Number" class="form-input"
                                                <?php
                                                    if(isset($line))
                                                    {
                                                        echo "value = '". $line['phone'] ."'";
                                                    }
                                                ?>
                                                required>
                                                <br>
                                            <Label>DoB</Label>
                                            <br>
                                                <input name="dob" placeholder="Enter Date of birth" class="form-input"
                                                <?php
                                                    if(isset($line))
                                                    {
                                                        echo "value = '". $line['dob'] ."'";
                                                    }
                                                ?>
                                                required>
                                                <br>
                                                <div>
                                                    <?php if(isset($line)):?>
                                                    <button class="button-sm stretch" name='btnUpdate' value="Add">Update</button>
                                                    <input type="hidden" name="Id" value="<?php echo $line['id'];?>">
                                                    <?php else:?>
                                                    <button class="button-sm stretch" name='addStaff' value="Add">Add staff</button>
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
                                <th>Staff ID</th><th>Firstname</th><th>Surname</th><th>E-mail</th><th>Password</th><th>Phone</th><th>DoB</th>
                            </tr>
                            <?php 
                            $count=0;
                            foreach($searchResult as $item):?>
                            <tr>
                                <td><?php write($item['id']);?></td>
                                <td><?php write($item['firstname']);?></td>
                                <td><?php write($item['surname']);?></td>                                
                                <td><?php write($item['email']);?></td>
                                <td><?php write($item['password']);?></td>
                                <td><?php write($item['phone']);?></td>
                                <td><?php write($item['dob']);?></td>
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