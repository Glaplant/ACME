<?php if(!$_SESSION['loggedin']){ header('location: acme/index.php');}?>
<?php include $_SERVER['DOCUMENT_ROOT'].'../acme/common/header.php'?>
          <nav class="bg_red"><?php echo $navigation; ?></nav>
                <?php 
        if(isset($message)){
            echo $message;
        }
        ?>
          <main>
          <h1 class="padding"><?php echo $_SESSION['clientData']['clientFirstname'];?></h1>
          <form method="POST" action="/acme/accounts/index.php?action" id="updateUser" >
         <fieldset>
             <legend>Update Client</legend>
  
                        <!--their first name address-->
                    <label class="block">First Name:</label>
                    <input type="text" class="block" name="clientFirstname" id="clientFirstname" required 
                    <?php if(isset($clientFirstname)){ echo "value='$clientFirstname'"; } 
                        elseif(isset($_SESSION['clientData']['clientFirstname'])) {
                        echo "value=' ".$_SESSION['clientData']['clientFirstname']."'"; }?>>
                 
                         <!--their last name-->
                    <label class="block">Last Name:</label>
                    <input type="text" class="block" name="clientLastname" id="clientLastname" required
                    <?php if(isset($clientLastname)){ echo "value='$clientLastname'"; } 
                        elseif(isset($_SESSION['clientData']['clientLastname'])) {
                        echo "value=' ".$_SESSION['clientData']['clientLastname']."'"; }?>>
                    
                
                    <label class="block">Email:</label>
                    <input type="email" class="block" name="clientEmail" id="clientEmail" required  placeholder="Enter a valid email address"
                    <?php if(isset($clientEmail)){ echo "value='$clientEmail'"; } 
                        elseif(isset($_SESSION['clientData']['clientEmail'])) {
                        echo "value=' ".$_SESSION['clientData']['clientEmail']."'"; }?>>
                    
                
            
            
                    <input class="block button" type="submit" name="submit" value="Update Client">
                   <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="updateUser">
                    <input type="hidden" name="clientId" 
                        value="<?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId'];} 
                        elseif(isset($clientId)){ echo $clientId; } ?>">
        </fieldset>
</form>

<form method="POST" action="/acme/accounts/index.php?action" id="updatePassword" >
         <fieldset>
             <legend>Update Password</legend>
                   
                
                    <label class="block">New Password:</label>
                    <span> Password must be at least 8 characters and has at least 1 uppercase character, 1 number and 1 special character.</span>   
                    <input type="password" class="block " name="clientPassword" title=" Enter Your Password"  required 
                    pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
            
                    <input class="block button" type="submit" name="submit" value="Update Password">
                   <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="updatePassword">
                    <input type="hidden" name="clientId" 
                        value="<?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId'];} 
                        elseif(isset($clientId)){ echo $clientId; } ?>">
        </fieldset>
</form>
          </main>
          <hr class="footer"><hr>
  
       
                <?php include $_SERVER['DOCUMENT_ROOT'].'../acme/common/footer.php'?>
  