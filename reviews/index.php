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

 //Get the products model
 require_once '../model/products-model.php';


  //Get the reviews model
  require_once '../model/reviews-model.php';

 //Get the functions file from library
  require_once '../library/functions.php';

   //Get the array of categories
   $categories = getCategories();
   $navigation = navigation($categories);



//var_dump($categories);
//exit;



//Default Dynamic Title

$pageTitle= "";


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
      
}

if(isset($_COOKIE['firstname'])){
  $cookieFirstname = filter_input(INPUT_COOKIE,'firstname', FILTER_SANITIZE_STRING);
}


/*The needed processes are:
1. Add a new review
2. Deliver a view to edit a review.
3. Handle the review update.
4. Deliver a view to confirm deletion of a review.
5. Handle the review deletion.

*/


switch ($action){

case 'addReview':

    
    $reviewText = filter_input(INPUT_POST, 'reviewText' , FILTER_SANITIZE_STRING);
    $invId = filter_input(INPUT_POST, 'invId' , FILTER_SANITIZE_NUMBER_INT);
    $clientId = filter_input(INPUT_POST, 'clientId' , FILTER_SANITIZE_NUMBER_INT);
    $screenName= createScreenName($_SESSION['clientData']['clientFirstname'],$_SESSION['clientData']['clientLastname']);

    if (isset($_SESSION['loggedin'])){
    
    $reviewForm = buildReviewform($screenName,$invId);
    }
  //Echos error message if inputs are empty

  if (empty($reviewText)){
  $message2 = "<p class= 'padding body_text'> Please provide a new review. </p>";
  $_SESSION['message2']=$message2;
  header("location: /acme/products/?action=description&invId=$invId");
  exit;
  }

  $newReview = addReview($reviewText, $invId, $clientId);
  
      
    if (!$newReview){
        $message2 = "<p class= 'padding body_text'> Sorry, review wasn't added.";
        $_SESSION['message2']=$message2;
        header("location: /acme/products/?action=description&invId=$invId");
        exit;
 }else {
     $message2 = "<p class= 'padding body_text'>Thankyou for  leaving a review.";
     $_SESSION['message2']=$message2;
    header("location: /acme/products/?action=description&invId=$invId");
     exit;
 }

 

break;


// Deliver update review with editable review text//

case 'update_reviews':

  //$invId =filter_input(INPUT_POST, 'invId' , FILTER_SANITIZE_NUMBER_INT);
  $reviewId = filter_input(INPUT_GET, 'reviewId' , FILTER_SANITIZE_NUMBER_INT);
 


  //reviewText is echoed to update form in update-reviews.php
  $reviewArray = getReviewId($reviewId);

  //$reviewId = filter_input(INPUT_POST, 'reviewId' , FILTER_SANITIZE_NUMBER_INT);
  
  $message= '<p class= "padding body_text">Please edit the text to update your review</p>';



 //if($success){
 //$message= '<p>Thank you for updating your review</p>';
 //header('"location:/acme/accounts/admin&clientId='.$_SESSION['clientData']['clientId'].'"');
 //}else{
 //$message= "<p>Sorry, the review didn't update</p>";
 //}
  
 //var_dump($reviewArray[0]);
  //exit;
//header('"location:/acme/accounts/admin&clientId='.$_SESSION['clientData']['clientId'].'"');

  //var_dump($reviewArray);
  //exit;
//case 'admin':

//$clientId= $_SESSION['clientData']['clientId'];
//$reviewsClient = getReviewsbyclientId($clientId);

//if($reviewsClient){
  //$clientReviews = buildAdminReviewDisplay($reviewsClient);
  
 // }


  

  include '../view/update-reviews.php';
exit;

break;

case 'update':

  //**Review Update */

 $reviewId = filter_input(INPUT_POST,'reviewId', FILTER_SANITIZE_NUMBER_INT);
  $clientId = filter_input(INPUT_POST,'clientId', FILTER_SANITIZE_NUMBER_INT);
  $updateText = filter_input(INPUT_POST,'updateText', FILTER_SANITIZE_STRING);
 $reviewText = $updateText;

//var_dump($reviewText);
//exit;

  if(empty($updateText)){
  $message='<p class= "padding body_text">Please add review to the text box to update the review</p>';
  header( "location:/acme/reviews/?action=update_reviews&reviewId=$reviewId");
  //include  '../view/update-reviews.php';
 // var_dump($updateText);
  exit;
}

//$checkExistingReview = checkExistingReview($reviewText);

  
  //var_dump($success);
  //exit;

if($updateText){ 
  $success = updateReview($reviewText,$reviewId);
 $message= '<p class= "padding body_text">Thank you for updating your review</p>';
 $pageTitle= "Admin";
 header( "location:/acme/accounts/?action=admin&clientId=$clientId");
 exit;
}else{
 $message= "<p class= 'padding body_text'>Sorry, the review didn't update</p>";
 $pageTitle= "Review Update";
 header( "location:/acme/reviews/?action=update_reviews&reviewId=$reviewId");
 exit;
}
  
 //var_dump($reviewArray[0]);
  //exit;
//header('"location:/acme/accounts/admin&clientId='.$_SESSION['clientData']['clientId'].'"');
  //var_dump($updateText);
  //exit;

  //header('"location:/acme/accounts/admin&clientId='.$_SESSION['clientData']['clientId'].'"');
 // header('"location:/acme/accounts/admin&clientId='.$_SESSION['clientData']['clientId'].'"');
break;

case 'deleteview':

   //$invId =filter_input(INPUT_POST, 'invId' , FILTER_SANITIZE_NUMBER_INT);
   $reviewId = filter_input(INPUT_GET, 'reviewId' , FILTER_SANITIZE_NUMBER_INT);
   $clientId = filter_input(INPUT_POST,'clientId', FILTER_SANITIZE_NUMBER_INT);
 


   //reviewText is echoed to update form in update-reviews.php
   $reviewArray = getReviewId($reviewId);
 
   //$reviewId = filter_input(INPUT_POST, 'reviewId' , FILTER_SANITIZE_NUMBER_INT);
   
   $message= '<p>You are about to DELETE a review. <strong> THIS CAN NOT BE UNDONE </strong></p>';

   include '../view/delete-review.php';

break;
   
   case 'Delete':

   $clientId = filter_input(INPUT_POST,'clientId', FILTER_SANITIZE_NUMBER_INT);
   $reviewId = filter_input(INPUT_POST, 'reviewId' , FILTER_SANITIZE_NUMBER_INT);

  

   if ($clientId) {
   
    $delete= deleteReview($reviewId);
    $message = "<p class='notice'>Congratulations, the review was successfully deleted.</p>";
    
   // echo $clientId;
    header("location: /acme/accounts/?action=admin&clientId=$clientId");
    //exit;
   } else {
    $message = "<p class='notice'>Error: the review was not deleted.</p>";
   
    header("location: /acme/reviews/?action=delete&reviewId=$reviewId");
    exit;
   }


  include '../view/delete-review.php';
break;
   
//6. A default that will deliver the "admin" view if the client is logged in or the
//acme home view if not.
default: 

if(!$success){
  header('"location:/acme/accounts/admin&clientId='.$_SESSION['clientData']['clientId'].'"');

}
else{
  include '../acme/index.php';
}

}