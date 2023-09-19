<html>
    <head>
        <title>BIZ HUB - Register</title>
        <link rel="stylesheet" href="styles/style.css">
    </head>
    <body>
        <div id="wrapper">
            <h2>SMART SALES</h2>
            <h4>Sales Management System</h4>
            <div id="content">
                <h4 style="font-family:cursive;font-weight:lighter">Welcome Back</h4>            
                <div class="panel panel-default">                    
                    <div class="form-group">
                        <form action="." method="post">                           
                            <label>Email:<input class="form-control" name="email"></label>
                            <label>Password:<input class="form-control" name="password"></label>
                            <input type="submit" name="action" value="Log In" class="button" id="subbtn">
                            <div> Not Registered? <a href='?signup'>Sign Up</a></div>
                        </form>
                    </div>
                </div> 
                
            </div>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/smartms/foot.html.php';?>  
    </body>
</html>