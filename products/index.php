<?php

//**Products CONTROLLER */

//Create or access a Session
session_start();



  //Get the database connection file
  require_once '../library/connections.php';
  //Get the acme model for use as needed
 require_once '../model/acme-model.php';

 require_once '../model/accounts-model.php';

 //Get the products model
 require_once '../model/products-model.php';

 //Get the functions file from library
   require_once '../library/functions.php';

   require_once '../model/uploads-model.php';

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


// Build a dynamic drop-down list
$productList = "<select name='categoryId'>";
$productList .= "<option value ='' >Product Category </option>";
foreach ($categories as $category) {
$productList .= "<option value =". $category['categoryId'] . ">" . $category['categoryName'] . "</option>";
}
$productList .= '</select>';


$pageTitle= "Products";


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
      
}

if(isset($_COOKIE['firstname'])){
  $cookieFirstname = filter_input(INPUT_COOKIE,'firstname', FILTER_SANITIZE_STRING);
}



switch ($action){
 
//Access Add Product Page
   case 'add-product':
    $pageTitle= "Add New Products";
    include '../view/add-product.php';
   break;


   // Access Add Category Page

   case 'add-category':
    $pageTitle= "Add New Category";
    include '../view/add-category.php';
   break;

   // Action newCategory 
   case 'newCategory':

   $categoryName = filter_input(INPUT_POST,'categoryName', FILTER_SANITIZE_STRING);


  if(empty($categoryName)){
  $message = '<p> Please provide information for all empty form fields. </p>';
  include '../view/add-category.php';
   exit;
   }

     //storing add product variables in product Outcome variable
     $categoryOutcome = addCategory($categoryName);
  
     if ($categoryOutcome === 1) {
      header('location: /acme/products');
      exit;
      } else {
        $message = "<p>Sorry, $categoryName wasn't added.</p>";
      include '../view/add-category.php';
      exit;
  
     }
  

// Add Product Switch Case
// Retrieving Users input from New Product Form

   case 'newProduct':
  
    $invName = filter_input(INPUT_POST,'invName', FILTER_SANITIZE_STRING);
    $invDescription = filter_input(INPUT_POST,'invDescription', FILTER_SANITIZE_STRING);
    $invImage = filter_input(INPUT_POST,'invImage');
    $invThumbnail = filter_input(INPUT_POST,'invThumbnail');
    $invPrice = filter_input(INPUT_POST,'invPrice',FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $invStock = filter_input(INPUT_POST,'invStock',FILTER_SANITIZE_NUMBER_FLOAT);
    $invSize = filter_input(INPUT_POST,'invSize',FILTER_SANITIZE_NUMBER_FLOAT);
    $invWeight = filter_input(INPUT_POST,'invWeight',FILTER_SANITIZE_NUMBER_FLOAT);
    $invLocation = filter_input(INPUT_POST,'invLocation', FILTER_SANITIZE_STRING);
    $categoryId = filter_input(INPUT_POST,'categoryId',FILTER_SANITIZE_NUMBER_FLOAT);
    $invVendor = filter_input(INPUT_POST,'invVendor', FILTER_SANITIZE_STRING);
    $invStyle = filter_input(INPUT_POST,'invStyle', FILTER_SANITIZE_STRING);

    //Echos error message if inputs are empty

    if (empty($invName) || empty($invDescription) || empty($invImage) || 
    empty($invThumbnail) || empty($invPrice) || empty($invStock) || 
    empty($invSize) || empty($invWeight) || empty($invLocation) || empty($categoryId)
     || empty($invVendor) || empty($invStyle)){
    $message = '<p> Please provide information for all empty form fields. </p>';
    include '../view/add-product.php';
    exit;
   }
  

   //storing add product variables in product Outcome variable
   $productOutcome = addProduct($invName, $invDescription, $invImage,
   $invThumbnail, $invPrice, $invStock, $invSize, $invWeight,
   $invLocation, $categoryId,
   $invVendor, $invStyle);

   if ($productOutcome === 1) {
    $message = "<p> Thanks for adding $invName to the product database.</p>";
    include '../view/product-management.php';
    exit;
    } else {
      $message = "<p>Sorry, $invName wasn't added. Something went wrong</p>";
    include '../view/add-product.php';
    exit;

   }
 

   /* * ********************************** 
* Get Inventory Items by categoryId 
* Used for starting Update & delete process 
* ********************************** */ 
case 'getInventoryItems': 
  // Get the categoryId 
  $categoryId = filter_input(INPUT_GET, 'categoryId', FILTER_SANITIZE_NUMBER_INT); 
  // Fetch the products by categoryId from the DB 
  $productsArray = getProductsByCategory($categoryId); 
  // Convert the array to a JSON object and send it back 
  echo json_encode($productsArray); 
  break;






  case 'mod';
  $invId= filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
  $prodInfo = getProductInfo($invId);
  if(count($prodInfo)<1){
    $message = 'Sorry, no product info could be found.';
  }
  $pageTitle = '<?php if(isset($prodInfo[invName])){ echo "Modify $prodInfo[invName] ";} elseif(isset($invName)) { echo $invName; }?>' ;
  include '../view/prod-update.php';
  exit;
break;



case 'updateProduct':

  $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
  $invName = filter_input(INPUT_POST,'invName', FILTER_SANITIZE_STRING);
  $invDescription = filter_input(INPUT_POST,'invDescription', FILTER_SANITIZE_STRING);
  $invImage = filter_input(INPUT_POST,'invImage');
  $invThumbnail = filter_input(INPUT_POST,'invThumbnail');
  $invPrice = filter_input(INPUT_POST,'invPrice',FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
  $invStock = filter_input(INPUT_POST,'invStock',FILTER_SANITIZE_NUMBER_FLOAT);
  $invSize = filter_input(INPUT_POST,'invSize',FILTER_SANITIZE_NUMBER_FLOAT);
  $invWeight = filter_input(INPUT_POST,'invWeight',FILTER_SANITIZE_NUMBER_FLOAT);
  $invLocation = filter_input(INPUT_POST,'invLocation', FILTER_SANITIZE_STRING);
  $categoryId = filter_input(INPUT_POST,'categoryId',FILTER_SANITIZE_NUMBER_FLOAT);
  $invVendor = filter_input(INPUT_POST,'invVendor', FILTER_SANITIZE_STRING);
  $invStyle = filter_input(INPUT_POST,'invStyle', FILTER_SANITIZE_STRING);

    //Echos error message if inputs are empty

    if (empty($invName) || empty($invDescription) || empty($invImage) || 
    empty($invThumbnail) || empty($invPrice) || empty($invStock) || 
    empty($invSize) || empty($invWeight) || empty($invLocation) || empty($categoryId)
     || empty($invVendor) || empty($invStyle)){
    $message = '<p> Please provide information for all empty form fields. </p>';
    include '../view/prod-update.php';
    exit;
   }
   $updateResult = updateProduct( $invId, $invName, $invDescription, $invImage,
   $invThumbnail, $invPrice, $invStock, $invSize, $invWeight,
   $invLocation, $categoryId,
   $invVendor, $invStyle);

 if ($updateResult) {
$message = "<p class='notify'>Congratulations, $invName was successfully updated.</p>";
$_SESSION['message'] = $message;
header('location: /acme/products/');
exit;
} else {$message = "<p>Sorry, $invName wasn't updated. Something went wrong</p>";
    include '../view/prod-update.php';
    exit;

   }

break;

case 'del':
  $invId= filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
  $prodInfo = getProductInfo($invId);
  if(count($prodInfo)<1){
    $message = 'Sorry, no product info could be found.';
  }
  $pageTitle = ' Delete Products' ;
  include '../view/prod-delete.php';
  exit;

break;

case 'deleteProduct':

  $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
  $invName = filter_input(INPUT_POST,'invName', FILTER_SANITIZE_STRING);
 
  
   $deleteResult = deleteProduct( $invId);

   if ($deleteResult) {
    $message = "<p class='notice'>Congratulations, $invName was successfully deleted.</p>";
    $_SESSION['message'] = $message;
    header('location: /acme/products/');
    exit;
   } else {
    $message = "<p class='notice'>Error: $invName was not deleted.</p>";
    $_SESSION['message'] = $message;
    header('location: /acme/products/');
    exit;
   }
   break;


   case 'category':
    
    $categoryName = filter_input(INPUT_GET, 'categoryName', FILTER_SANITIZE_STRING);
    $pageTitle = "$categoryName " . " Products";
    $products = getProductsByCategoryName($categoryName);
    if(!count($products)){
     $message = "<p class='notice'>Sorry, no $categoryName products could be found.</p>";
    } else {
     $prodDisplay = buildProductsDisplay($products);
    }
 //* echo $prodDisplay;
 //* exit;
 include '../view/category.php';
  break;

  case 'description':
    $clientId = filter_input(INPUT_GET, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
    $products = getInventoryByinvId($invId);
    $thumbnails = getThumbnailImages($invId);
    $_SESSION['products'] = $products;
    $reviewsInv = getReviewsbyId($invId);

    $reviewsClient = getReviewsbyclientId($clientId);
    //$clientId = getClientId($clientId);
  


     if(!count($products)){
    $message = "<p class='notice'>Sorry, no product could be found.</p>";
   } else {
    $invDisplay = buildInventoryDisplay($products);
    $_SESSION['invDisplay'] = $invDisplay;
   
    }

    if ($thumbnails){
      $thumbnail = buildThumbnailDisplay($thumbnails);

}


 if (isset($_SESSION['loggedin'])){
  $screenName= createScreenName($_SESSION['clientData']['clientFirstname'],$_SESSION['clientData']['clientLastname']);
  $_SESSION['screenName']= $screenName;
  $_SESSION['reviewsInv']= $reviewsInv;
  $reviewForm = buildReviewform($screenName,$invId);
}else{
  $reviewForm = '<p class="body_text padding_sides"><a href="/acme/accounts/?action=login">Login</a> to add a review</p>';

}

if($reviewsInv){
$invReviews = buildProductReviewDisplay($reviewsInv);
}

//if($reviewsClient){
  //$clientReviews = buildAdminReviewDisplay($reviewsClient);
  
  //}


  //echo $products ['invName'];
// exit;
 include '../view/product-detail.php';
  break;

//update review//

  //case 'updateReview':

    /*$invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
    $invName = filter_input(INPUT_POST,'invName', FILTER_SANITIZE_STRING);
    $invDescription = filter_input(INPUT_POST,'invDescription', FILTER_SANITIZE_STRING);
    $invImage = filter_input(INPUT_POST,'invImage');
    $invThumbnail = filter_input(INPUT_POST,'invThumbnail');
    $invPrice = filter_input(INPUT_POST,'invPrice',FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $invStock = filter_input(INPUT_POST,'invStock',FILTER_SANITIZE_NUMBER_FLOAT);
    $invSize = filter_input(INPUT_POST,'invSize',FILTER_SANITIZE_NUMBER_FLOAT);
    $invWeight = filter_input(INPUT_POST,'invWeight',FILTER_SANITIZE_NUMBER_FLOAT);
    $invLocation = filter_input(INPUT_POST,'invLocation', FILTER_SANITIZE_STRING);
    $categoryId = filter_input(INPUT_POST,'categoryId',FILTER_SANITIZE_NUMBER_FLOAT);
    $invVendor = filter_input(INPUT_POST,'invVendor', FILTER_SANITIZE_STRING);
    $invStyle = filter_input(INPUT_POST,'invStyle', FILTER_SANITIZE_STRING);
  
      //Echos error message if inputs are empty
  
      if (empty($invName) || empty($invDescription) || empty($invImage) || 
      empty($invThumbnail) || empty($invPrice) || empty($invStock) || 
      empty($invSize) || empty($invWeight) || empty($invLocation) || empty($categoryId)
       || empty($invVendor) || empty($invStyle)){
      $message = '<p> Please provide information for all empty form fields. </p>';
      include '../view/prod-update.php';
      exit;
     }
     $updateResult = updateProduct( $invId, $invName, $invDescription, $invImage,
     $invThumbnail, $invPrice, $invStock, $invSize, $invWeight,
     $invLocation, $categoryId,
     $invVendor, $invStyle);
  
   if ($updateResult) {
  $message = "<p class='notify'>Congratulations, $invName was successfully updated.</p>";
  $_SESSION['message'] = $message;
  header('location: /acme/products/');
  exit;
  } else {$message = "<p>Sorry, $invName wasn't updated. Something went wrong</p>";
      include '../view/prod-update.php';
      exit;
  
     }
  
  break;*/



 default:

 $categoryList = buildCategoryList($categories);

 include '../view/product-management.php';
break;

  }






