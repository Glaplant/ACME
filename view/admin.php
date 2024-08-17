
<?php if(!$_SESSION['loggedin']){ header('location: acme/index.php');}?>
<?php include $_SERVER['DOCUMENT_ROOT'].'../acme/common/header.php'?>
          <nav class="bg_red"><?php echo $navigation; ?></nav>

            <main>

            <?php 
        if(isset($message)){
            echo $message;
        }
        ?>
                <h1 class="padding"><?php echo $_SESSION['clientData']['clientFirstname'].", you are logged in.";?></h1>
                <ul>
                    <li>First Name: <?php echo $_SESSION['clientData']['clientFirstname'];?></li>
                    <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname'];?></li>
                    <li>Email: <?php echo $_SESSION['clientData']['clientEmail'];?></li>
                   <!--<li>Client Level: //*?php echo $_SESSION['clientData']['clientLevel'];?></li>-->
                </ul>


                <!--Show only in admin view-->
                 <?php if(isset($_SESSION['loggedin'])){
                            echo "<p class='padding_sides body_text'><a href = '/acme/accounts/?action=client-update' title='Update Account'>Update Account Information </a></p> ";}
                          ?>

              
                 
<hr>


                <?php if($_SESSION['clientData']['clientLevel'] > 1){
                echo "
                <h2 class='padding_sides'>Administrative Functions</h2>
                <p class='padding_sides body_text'>Use the link below to manage products.</p>
                <p class='padding_sides body_text'><a href='/acme/products/?action=product-management'>Products</a></p>";
                }?>

                <hr>
            
                    <h3 class="padding">Manage your product reviews</h3>
                    <ul>
                        <?php echo $_SESSION['adminReviews'];?>
                        
                        
                   
                    </ul>
            </main>
            <hr class="footer">
  
       
                <?php include $_SERVER['DOCUMENT_ROOT'].'../acme/common/footer.php'?>
  