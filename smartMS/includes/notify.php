<?php
    include_once('helpers.php');
?>
<html>    
    <head>
        <link rel="stylesheet" href="../styles/style.css">
    </head>    
    <body>
        <div id="wrapper">            
            <div id="content">
                <div id='message' style="font-size:12px;font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">        
                    <p style="float: right; font-size:12px;">
                        <?php
                            if(substr($GLOBALS['message'],0,6)=='Access'):
                        ?>
                            <label><a href="..">Back to homepage</a></label>
                        <?php
                            else:                        
                        ?>
                            <label><a href=".">X</a></label>
                        
                        <?php
                            endif;                        
                        ?>
                    </p>
                    <?php write(isset($GLOBALS['message'])? $GLOBALS['message'] : "This is a notification");?>
                    
                </div>
                
            </div>
            
        </div>  
       
    </body>
    
</html>