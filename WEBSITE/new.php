<html>
    <body>
        <head>
            <link rel="stylesheet" href="styles/new.css">
        </head>
        <title>Errand</title>
        <form method="post" action=".">       
            <div class="wrapper">
            <h3>DELIVA ERRAND SERVICE</h3>
                
                <div>
                    <label>Enter Receiver name:<input type="text" name="rName"></label>
                </div>
                <div>
                    <label>Enter Receiver Phone:<input type="text" name="rPhone"></label>
                </div>
                <div>
                    <label>Package:<input type="text" name="item"></label>
                </div>
                <div>
                    <label>Destination:</label>
                    <select name="destination" class='destination'>
                        <option value="Jos">Jos</option>
                        <option value="Kaduna">Kaduna</option>
                        <option value="Lafiya">Lafiya</option>
                        <option value="Abuja">Abuja</option>
                    </select>            
                </div>
                
                <div>
                    <button name="postErrand">Post</button>
                </div>
            </div>   
            
            <label id="main-menu">
                <p><?php echo 'YOUR NUMBER ONE DELIVERY SYSTEM' ?></p>
            </label>


            <input type="checkbox" id="hamburger-input" class="burger-shower">
            <label id="hamburger-menu" for="hamburger-input">
                <nav id="sidebar-menu">
                    <h3>Menu</h3>
                    <ul>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="signup.php">Signup</a></li>
                        <li><a href="contact-form.php">Contact Us</a></li>
                    </ul>
                </nav>
            </label>

            <div class="overlay"></div>
        </form>
    
    </body>
    
</html>