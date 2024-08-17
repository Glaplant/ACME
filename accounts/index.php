<?php

//**ACCOUNTS CONTROLLER */

//Create or access a Session
session_start();

 
 //Get the database connection file from library
  require_once '../library/connections.php';

  //Get the acme model file
 require_once '../model/acme-model.php';

 //Get the accounts model
 require_once '../model/accounts-model.php';

 //Get the functions file from library
  require_once '../library/functions.php';


  require_once '../model/reviews-model.php';

   //Get the array of categories
   $categories = getCategories();
   $navigation = navigation($categories);
   



//var_dump($categories);
//exit;

// Build a navigation bar using the $categories array
//$navList = '<ul class="nav_flex flex_vertical">';
//$navList .= "<li><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
//foreach ($categories as $category) {
//$navList .= "<li><a href='/acme/index.php?action=".urlencode($category['categoryName'])."' 
//title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
//}
//$navList .= '</ul>';

//echo $navList;
//exit;

$loginPath = "href='/acme/view/login.php'";
$loginLink = "<a href='/acme/accounts/index.php?action= $loginPath> My Account </a>";


//Default Dynamic Title

$pageTitle= "Accounts";


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
      
}

if(isset($_COOKIE['firstname'])){
  $cookieFirstname = filter_input(INPUT_COOKIE,'firstname', FILTER_SANITIZE_STRING);
}



switch ($action){
  case 'login':
    $pageTitle= "Login";
 include '../view/login.php';
  break;

   case 'registration':
    $pageTitle= "New User Registration";
    include '../view/registration.php';
   break;

   case 'product-management':
    $pageTitle= "Product Management";
    include '../view/product-management.php';
   break;

   case 'client-update':
    $pageTitle= "User Update";
    include '../view/client-update.php';
   break;

   case 'admin':
  
   

   $clientId = filter_input(INPUT_GET,'clientId',FILTER_SANITIZE_NUMBER_INT);
  

    //$invId = filter_input(INPUT_GET,'invId',FILTER_SANITIZE_NUMBER_INT);

    $adminViewArray = getReviewsbyclientId($clientId);


  //var_dump($adminViewArray);
	//exit;
   // echo "$adminViewArray";
    //exit;

    $adminReviews = buildAdminreviews($adminViewArray);
    $_SESSION['adminReviews']=$adminReviews;

  //var_dump($_SESSION['adminReviews']);
  
  //exit;


  

    //$_SESSION['adminReviews']= $adminReviews;

    //var_dump( $_SESSION['adminReviews']);
	//exit;



    $pageTitle= "Admin";







    include '../view/admin.php';
   break;

   case 'register':
   //Filter and store data
   $clientFirstname = filter_input(INPUT_POST,'clientFirstname', FILTER_SANITIZE_STRING);
   $clientLastname = filter_input(INPUT_POST,'clientLastname', FILTER_SANITIZE_STRING);
   $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
   $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
   $clientEmail = checkEmail($clientEmail);
   $checkPassword = checkPassword($clientPassword);
   
   //Checking fo an existing Email Address
   $existingEmail = checkExistingEmail($clientEmail);


      //Check for missing data
      if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
        $message = '<p>Please provide information for all empty form fields.</p>';
        $pageTitle= "New User Registration";
       include '../view/registration.php';
       exit;
        }

   if($existingEmail){
     $message = '<p class = "notice">That email address already exists. Do you want to login instead?</p>';
     $pageTitle= "Login";
     include '../view/login.php';
     exit;
   }



  
//Hash the checked password
   $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

  //Send the data to the model
  $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

//Check and report the result
if($regOutcome === 1){
  setcookie('firstname', $clientFirstname, strtotime('+ 1 year'), '/');
$message = "<p> Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
$pageTitle= "Login";
include '../view/login.php';
exit;
} else {
  $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
  $pageTitle= "Login";
include '../view/registration.php';
exit;
 }
break;


case 'Login':
     //Filter and store data
     //$clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
     //$clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
     //$clientEmail = checkEmail($clientEmail);
     //$checkPassword = checkPassword($clientPassword);
     //Check for missing data
     //if(empty($clientEmail) || empty($checkPassword)){
     //$message = '<p>Please provide information for all empty form fields.</p>';
    //include '../view/login.php';
    //exit;
    // }
    
     $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
     $clientEmail = checkEmail($clientEmail);
     $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
     $passwordCheck = checkPassword($clientPassword);
     
         
     // Run basic checks, return if errors
     if (empty($clientEmail) || empty($passwordCheck)) {
      $message = '<p class="notice">Please provide a valid email address and password.</p>';
      $pageTitle = 'Login';
      include '../view/login.php';
      exit; 
     }
    
     // A valid password exists, proceed with the login process
     // Query the client data based on the email address
     $clientData = getClient($clientEmail);
     $clientId = $clientData['clientId'];
     // Compare the password just submitted against
     // the hashed password for the matching client
     $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
     // If the hashes don't match create an error
     // and return to the login view
     if (!$hashCheck) {
      $message = '<p class="notice padding body_text">Please check your password and try again.</p>';
      $pageTitle = 'Login';
      include '../view/login.php';
      exit; 
     }
    
     // A valid user exists, log them in
     $_SESSION['loggedin'] = TRUE;
     // Remove the password from the array
     // the array_pop function removes the last
     // element from an array
     array_pop($clientData);
     // Store the array into the session
     $_SESSION['clientData'] = $clientData;


     $clientFirstname = $_SESSION['clientData']['clientFirstname'];
  
    

     if($clientData){
      setcookie('firstname', $clientFirstname, strtotime(' 1 year'), '/');
     setcookie('firstname', $clientFirstname, strtotime('+ 1 year'), '/');
     }

     //Send them to the admin view
    $pageTitle = 'Admin View';
     include '../view/admin.php';
     header("location:/acme/accounts/?action=admin&clientId=$clientId");
     exit;
    
     
   
   

     

  
     case 'Logout':
      setcookie('firstname', $clientFirstname, strtotime('- 1 year'), '/');
      session_destroy();
      

      header('location:/acme/');
     exit;




   
//** Admin User Update */

     case 'updateUser':
      //Filter and store data
      $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
      $clientFirstname = filter_input(INPUT_POST,'clientFirstname', FILTER_SANITIZE_STRING);
      $clientLastname = filter_input(INPUT_POST,'clientLastname', FILTER_SANITIZE_STRING);
      $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
      $clientEmail = checkEmail($clientEmail);



          //Check for missing data
          if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            $pageTitle= "User Update";
           include '../view/client-update.php';
           exit;
            }

            
      //Checking fo an existing Email Address
    $existingEmail = checkExistingEmail($clientEmail);

    if($existingEmail){
      $message = '<p class = "notice">That email address already exists.</p>';
      $pageTitle= "Accounts";
      header('Location: /acme/accounts');
      exit;
    }
   
   
  

      

      $_SESSION['loggedin'] = TRUE;
      array_pop($clientData);

      
   
     //Send the data to the model
     $updateOutcome = updateClient($clientId, $clientFirstname, $clientLastname, $clientEmail);
   
   //Check and report the result
   if($updateOutcome === 1){
    $clientData = getClientId($clientId);
    $_SESSION['clientData'] = $clientData;
   $message= "<p> Thanks for updating $clientFirstname.</p>";
   $pageTitle= "Admin";
   header('Location: /acme/accounts');
   exit;
   } else {
     $message = "<p>Sorry $clientFirstname, but the updating failed. Please try again.</p>";
     $pageTitle= "User Update";
     include '../view/client-update.php';
   exit;
   }
 


//**PASSWORD UPDATE */


case 'updatePassword':
    //Filter and store data
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
    $clientFirstname = filter_input(INPUT_POST,'clientFirstname', FILTER_SANITIZE_STRING);
    $checkPassword = checkPassword($clientPassword);
    
 
 
    //Check for missing data
    if( empty($checkPassword)){
    $message = '<p>Please provide information for all empty form fields.</p>';
    $pageTitle= "User Update";
   include '../view/client-update.php';
   exit;
    }
   
 //Hash the checked password
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
 
   //Send the data to the model
   $passwordOutcome = updatePassword($clientId, $hashedPassword);
 
 //Check and report the result
 if($passwordOutcome){
  setcookie('firstname', $clientFirstname, strtotime('+ 1 year'), '/');
 $message = "<p> Thanks for Updating your Password $clientFirstname.</p>";
 $pageTitle= "Admin";
 include '../view/admin.php';
 exit;
 } else {
   $message = "<p>Sorry $clientFirstname, but the password update failed. Please try again.</p>";
   $pageTitle= "User Update";
 include '../view/client-update.php';
 exit;
  }
 break;
 
   
     
default: 
include '.../view/admin.php';


}






