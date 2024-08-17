<?php include $_SERVER['DOCUMENT_ROOT'].'../acme/common/header.php'?>
    <nav class="bg_red"><?php echo $navigation; ?></nav>
    <main>
        <?php 
        if(isset($message)){
            echo $message;
        }
        ?>
        <form method="POST" action="/acme/accounts/index.php?action" id="register" >
         <fieldset>
             <legend>Registration</legend>
  
                        <!--their first name address-->
                    <label class="block">First Name:</label>
                    <input type="text" class="block" name="clientFirstname" id="clientFirstname" required 
                    <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?>
                    >
                 
                         <!--their last name-->
                    <label class="block">Last Name:</label>
                    <input type="text" class="block" name="clientLastname" id="clientLastname" required
                    <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?>
                    >
                
                    <label class="block">Email:</label>
                    <input type="email" class="block" name="clientEmail" id="clientEmail" required  placeholder="Enter a valid email address"
                    <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?>
                    >
                
                    <label class="block">New Password:</label>
                    <span> Password must be at least 8 characters and has at least 1 uppercase character, 1 number and 1 special character.</span>   
                    <input type="password" class="block " name="clientPassword" title=" Enter Your Password"  required 
                    pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
            
                    <input class="block button" type="submit" name="submit" value="Register">
                   <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="register">
        </fieldset>
</form>
            
                    
            </main>
            <hr class="footer">
  
       
                <?php include $_SERVER['DOCUMENT_ROOT'].'../acme/common/footer.php'?>