<html>
    <head>
        <link rel="stylesheet" href="styles/contact.css">
        <title>Contact Form</title>
    </head>
    <body>
        <h3>Contact us</h3>
        <form id="fcf-form-id" class="fcf-form-class" method="post" action="new.php">
                <label for="Name" class="fcf-label">Your name</label>
                <div class="fcf-input-group">
                    <input type="text" id="Name" name="Name" class="fcf-form-control" >
                </div>
            <div class="fcf-form-group">
                <label for="Email" class="fcf-label">Your email address</label>
                <div class="fcf-input-group">
                    <input type="email" id="Email" name="Email" class="fcf-form-control" >
                </div>
            </div>
            <br>
            <div class="fcf-form-group">
                <label for="Message" class="fcf-label">Your message</label>
                <div class="fcf-input-group">
                    <textarea id="Message" name="Message" class="fcf-form-control" rows="6" maxlength="3000" ></textarea>
                </div>
            </div>
            <br>
            <label for="contact reason">Contact Reason</label>
            <select id="contact reason" name="contact reason">
                <option value="sales">Sales</option>
                <option value="help">Help</option>
                <option value="billing">Billing</option>
            </select>
            <br>
            <div class="fcf-form-group">
                <button name="send" type="submit" id="fcf-button" class="fcf-btn fcf-btn-primary fcf-btn-lg fcf-btn-block">Send</button>
            </div>
            <br>
            <div class="nav-button">
                <button><a name="back" value="back">Back</a></button> 
            </div>
        </form>
    </body>
</html>