<?php

//**ACME CONTROLLER */


//Create or access a Session
session_start();

  //Get the database connection file
require_once 'library/connections.php';
  //Get the acme model for use as needed
require_once 'model/acme-model.php';

//Get the database connection file
  require_once 'library/functions.php';

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

//Default Page Title
$pageTitle='Home';



$action = filter_input(INPUT_POST, 'action');
  if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
  }

if(isset($_COOKIE['firstname'])){
  $cookieFirstname = filter_input(INPUT_COOKIE,'firstname', FILTER_SANITIZE_STRING);
}

switch ($action){
    case 'something':
    break;
    

    default:
    include 'view/home.php';
  }


  






