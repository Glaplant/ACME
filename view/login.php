
   <?php include $_SERVER['DOCUMENT_ROOT'].'../acme/common/header.php'?>
           <nav class="bg_red"><?php echo $navigation; ?></nav>
            <main>

            <?php 
        if(isset($message)){
            echo $message;
        }
        ?>
<form method="post" action="/acme/accounts/" id="login" >
    <fieldset>
        <legend>Log In</legend>
       
             <!--their email address-->
                 <label class="block">Email:</label>
                 <input type="email" class="block" name="clientEmail" title="Enter Your Email"  placeholder="Enter a valid email address" required>
            
             
              <!--their password-->
                 <label class="block">Password</label>
                 <span> Password must be at least 8 characters and has at least 1 uppercase character, 1 number and 1 special character.</span>   
                  <input type="password" class="block" name="clientPassword" title=" Enter Your Password" pattern='(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$' required>
           
                 <input class="block button" type="submit"  value="Login">
                 <input type="hidden" name="action" value="Login">
                
    </fieldset>
</form>
<form action="/acme/accounts/?action=registration" id="registration" method="POST">
    <input class="block button" type="submit" value="Create an Account" >

</form>


            
                    
            </main>
            <hr class="footer">
  
       
                <?php include $_SERVER['DOCUMENT_ROOT'].'../acme/common/footer.php'?>