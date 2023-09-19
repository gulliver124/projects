<html>
    <title>ERRAND DETAILS</title>
    <body background='images/new.jpg'>
        <head>
            <link rel="stylesheet" href="styles/new.css">
        </head>
        <div class="wrap2">
            <h4>ERRAND DETAILS</h4>
                <?php if(isset($_SESSION['errand'])):?>
                        <label class="details">Errand Date:</label> <?php echo $_SESSION['errand']->errandDate;?>
                        <p><label class="details">Destination:</label> <?php echo $_SESSION['errand']->destination;?></p>
                        <p><label class="details">Status:</label> <?php echo $_SESSION['errand']->status;?></p>
                        
                    <?php endif;?>
        </div>
        
        <?php include $_SERVER['DOCUMENT_ROOT'].'/oop/website/foot.html.php';?> 
                    
    </body>

</html>