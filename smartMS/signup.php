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
            <h4>Create Staff Account</h4>
                <div class="panel panel-default">
                    
                    <div class="form-group">
                        <form action="." method="post">
                            <label>Firstname:<input class="form-control" name="fname" required></label>
                            <label>Surname:<input class="form-control" name="sname" required></label>
                            <label>Phone no.:<input class="form-control" name="phone" required></label>
                            <label>D.O.B:<input class="form-control" type="date" name="dob" required></label>
                            <label>Email:<input class="form-control" name="email" required></label>
                            <label>Password:<input class="form-control" name="password" required></label>
                            <label>Re-Password:<input class="form-control" required></label>
                            <input type="submit" name="action" value="Sign Up" class="button" id="subbtn">
                            <div>Already have an account? <a href='login.php'>Login</a></div>
                        </form>
                    </div>
                </div> 
                
            </div>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/smartms/foot.html.php';?>  
    </body>
</html>