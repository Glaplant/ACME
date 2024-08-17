<!DOCTYPE html>
         <html lang="en" class="bg">
             <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
                <title><?php if(isset($pageTitle)) { echo $pageTitle; }?> | Acme, Inc</title>
                <link rel="stylesheet" type="text/css" href="/acme/css/homeStyle.css">
             </head>
              <body class="bg_color">
                <header>
                    <div class="flex_horizontal"> 
                         <img class="logo" src= "/acme/images/site/logo.gif" alt="Acme Site Logo">
                        <div class="flex_horizontal ">

                        <?php if(isset($cookieFirstname)){
                            echo"<span class='text_red bold' ><a href='/acme/accounts/?action=admin&clientId=".$_SESSION['clientData']['clientId']."' title='Welcome Meassage'>Welcome $cookieFirstname</a></span>";
                            } ?>
                            
                            <?php if(isset($_SESSION['loggedin'])){
                            echo "<p class='padding'><a href = '/acme/accounts/?action=Logout' title='Log Out'> Log Out </a> </p>";}
                            else{echo "<img class='icon' src='/acme/images/site/account.gif' alt='Account Button'>";
                            echo "<p class='padding'><a href = '/acme/accounts/?action=login' title='My Account'> My Account </a> </p>";}
                          
                            ?>
                    

                        </div>
                       
                    </div> 
             </header>
            
            
             
            