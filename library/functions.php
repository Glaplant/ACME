

<?php

function checkEmail($clientEmail){
    $validEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $validEmail;

}

//Check the password for a minumun 8 charecters
// at least one capital letter, at least 1 number and
// at least 1 special character

function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
    
}



//Create a Dynamic Nav Bar

function navigation($categories){
    $navList = '<ul class="nav_flex flex_vertical">';
    $navList .= "<li><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
    foreach ($categories as $category) {
    $navList .= "<li><a href='/acme/products/?action=category&categoryName="
    .urlencode($category['categoryName']).
    "' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
    }
    $navList .= '</ul>';
    return $navigation = $navList;
}

// Build the categories select list 
function buildCategoryList($categories){ 
    $catList = '<select name="categoryId" id="categoryList">'; 
    $catList .= "<option>Choose a Category</option>"; 
    foreach ($categories as $category) { 
     $catList .= "<option value='$category[categoryId]'>$category[categoryName]</option>"; 
    } 
    $catList .= '</select>'; 
    return $catList; 
   }

   //* Builds a display of products within an unordered list

   function buildProductsDisplay($products){
    $pd = '<ul id="prod-display" class="clean_li">';
    foreach ($products as $product) {
     $pd .= '<li>';
     $pd .= "<a href='/acme/products/?action=description&invId=" .  ($product['invId']) . "'><img src='$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'></a>";
     $pd .= '<hr>';
     $pd .= "<a href='/acme/products/?action=description&invId=" .  ($product['invId'])."'>";
     $pd .= "<h2>$product[invName]</h2>";
     $pd .= '</a>';
     $pd .= "<span>$product[invPrice]</span>";
     $pd .= '</li>';
    }
    $pd .= '</ul>';
    return $pd;
   }

   function buildInventoryDisplay($products){
        $id = '<div class="product_flex">';
        
        $id .= "<img class='image_sizing' src='$products[invImage]' alt='Image of $products[invName] on Acme.com'>";
       
        $id .= '<div class="product">';
        $id .= "<h2>$products[invName]</h2>";
        $id .= "<p class='body_text'>$products[invDescription]</p>";
        $id .= "<p class='bold_products'>In Stock: <span class='body_text'>$products[invStock]</span></p>";
        $id .= "<p class='bold_products'>Shipping Size: <span class='body_text'>$products[invSize] inches (W x H x L)</span></p>";
        $id .= "<p class='bold_products'>Product Weight: <span class='body_text'>$products[invWeight] lbs</span> </p>";
        $id .= "<p class='bold_products'>Ships From: <span class='body_text'>$products[invLocation]</span></p>";
        $id .= "<p class='bold_products'>Vendor: <span class='body_text'>$products[invVendor]</span></p>";
        $id .= "<p class='bold_products'> Primary Material: <span class='body_text'>$products[invStyle]</span></p>";
        $id .= '<hr >';
        $id .= "<p class='bold_products'> Price:  <span class='bold text_red'>$ $products[invPrice]</span></p>";
        $id .='</div>';
        $id .='</div>';
    return $id;
   }

   /* * ********************************
*  Functions for working with images
* ********************************* */

// Adds "-tn" designation to file name
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
   }

   // Build images display for image management view
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
     $id .= '<li>';
     $id .= "<img src='$image[imgPath]' title='$image[invName] image on Acme.com' alt='$image[invName] image on Acme.com'>";
     $id .= "<p><a href='/acme/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
     $id .= '</li>';
    }
    $id .= '</ul>';
    return $id;
   }

   // Build the products select list
function buildProductsSelect($products) {
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Product</option>";
    foreach ($products as $product) {
     $prodList .= "<option value='$product[invId]'>$product[invName]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
   }

   // Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
     // Gets the actual file name
     $filename = $_FILES[$name]['name'];
     if (empty($filename)) {
      return;
     }
    // Get the file from the temp folder on the server
    $source = $_FILES[$name]['tmp_name'];
    // Sets the new path - images folder in this directory
    $target = $image_dir_path . '/' . $filename;
    // Moves the file to the target folder
    move_uploaded_file($source, $target);
    // Send file for further processing
    processImage($image_dir_path, $filename);
    // Sets the path for the image for Database storage
    $filepath = $image_dir . '/' . $filename;
    // Returns the path where the file is stored
    return $filepath;
    }
   }

   // Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
    // Set up the variables
    $dir = $dir . '/';
   
    // Set up the image path
    $image_path = $dir . $filename;
   
    // Set up the thumbnail image path
    $image_path_tn = $dir.makeThumbnailName($filename);
   
    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);
   
    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
   }

   // Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
     
    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];
   
    // Set up the function names
    switch ($image_type) {
    case IMAGETYPE_JPEG:
     $image_from_file = 'imagecreatefromjpeg';
     $image_to_file = 'imagejpeg';
    break;
    case IMAGETYPE_GIF:
     $image_from_file = 'imagecreatefromgif';
     $image_to_file = 'imagegif';
    break;
    case IMAGETYPE_PNG:
     $image_from_file = 'imagecreatefrompng';
     $image_to_file = 'imagepng';
    break;
    default:
     return;
   } // ends the resizeImage function
   
    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);
   
    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;
   
    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {
   
     // Calculate height and width for the new image
     $ratio = max($width_ratio, $height_ratio);
     $new_height = round($old_height / $ratio);
     $new_width = round($old_width / $ratio);
   
     // Create the new image
     $new_image = imagecreatetruecolor($new_width, $new_height);
   
     // Set transparency according to image type
     if ($image_type == IMAGETYPE_GIF) {
      $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
      imagecolortransparent($new_image, $alpha);
     }
   
     if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
      imagealphablending($new_image, false);
      imagesavealpha($new_image, true);
     }
   
     // Copy old image to new image - this resizes the image
     $new_x = 0;
     $new_y = 0;
     $old_x = 0;
     $old_y = 0;
     imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
   
     // Write the new image to a new file
     $image_to_file($new_image, $new_image_path);
     // Free any memory associated with the new image
     imagedestroy($new_image);
     } else {
     // Write the old image to a new file
     $image_to_file($old_image, $new_image_path);
     }
     // Free any memory associated with the old image
     imagedestroy($old_image);
   } // ends the if - else began on line 36



      // Build images display for image management view
function buildThumbnailDisplay($thumbnails) {
    $thumbnail ="<div class='thumbnails'>";
    foreach ($thumbnails as $image) {
    $thumbnail .="<img class='padding' src='$image[imgPath]' title='$image[imgName] image on Acme.com' alt='$image[imgName] image on Acme.com'>";
    }
    $thumbnail .="</div>";
    return $thumbnail;
   }

   function createScreenName($firstName,$lastName){

    //$firstName = $_SESSION['clientData']['clientFirstname'];
    //$lastName = $_SESSION['clientData']['clientLastname'];
    $firstInitial = substr($firstName, 0, 1);
    $screenName = $firstInitial.trim($lastName);

    return $screenName;
   
}



 // Add New Review Form//
  function buildReviewform($screenName,$invId){
      $reviewForm='<form  action="/acme/reviews/index.php"  method="POST">';
      $reviewForm.='<fieldset>';
      $reviewForm.='<label>Screen Name:';
      $reviewForm.='<input id="screenName" name="screenName" value= "'.$screenName.'"';
      $reviewForm.= ' disabled></input>';
      $reviewForm.='</label>';
      $reviewForm.=' <label>';
      $reviewForm.='<textarea class="block" name="reviewText" id="reviewText" title="Review Text Box" required></textarea>';
      $reviewForm.='</label>';
      $reviewForm.='<input class="block button" type="submit" name="submit"  value="Submit Review" ></input>';
      $reviewForm.='<input type="hidden" name="action" value="addReview">';
      $reviewForm.='<input type="hidden" name="clientId" value="'.$_SESSION['clientData']['clientId'].'">';
      $reviewForm.='<input type="hidden" name="invId" value="'.$invId.'">';
      $reviewForm.='</fieldset>';
      $reviewForm.='</form>';

  
  return $reviewForm;
} 

//** Update Review Form */
//**function buildUpdateReviewform($invId){
   // $reviewForm='<form  action="/acme/reviews/index.php"  method="POST">';
    //$reviewForm.='<fieldset>';
    //$reviewForm.=' <label>';
    //$reviewForm.='<textarea class="block" name="updateText" id="updateText" title="Review Text Box" required></textarea>';
    //$reviewForm.='</label>';
    //$reviewForm.='<input class="block button" type="submit" name="submit"  value="Update Review" ></input>';
    //$reviewForm.='<input type="hidden" name="action" value="Update Review">';
    //$reviewForm.='<input type="hidden" name="clientId" value="'.$_SESSION['clientData']['clientId'].'">';
    //$reviewForm.='<input type="hidden" name="invId" value="'.$invId.'">';
    //$reviewForm.='</fieldset>';
    //$reviewForm.='</form>';


//return $reviewForm;
//} **//


 //*Build Review Display
function buildProductReviewDisplay($reviewsInv){ 
   $prodReview ='';
foreach($reviewsInv as $review){
    $prodReview .='<div class="reviews">';
    $prodReview .='<p class="bold_products">'.createScreenName($review['clientFirstname'],$review['clientLastname'])."    ";
    $prodReview .= date("d M,Y",strtotime($review['reviewDate'])).'</p>';
    $prodReview .='<p class="reviewText body_text">'.$review['reviewText'].'</p>';
    $prodReview .='</div>';
}

return $prodReview;
}

 //*Build Review Display
 function buildAdminreviews($adminViewArray){
    $prodReview ='';
 foreach($adminViewArray as $review){
    $prodReview .='<li class="padding bg_"><strong>'.$review['invName']."</strong>    ";
     $prodReview .=date("d M,Y",strtotime($review['reviewDate']))."   ";
     $prodReview .=$review['reviewText']."   ". '<a href="/acme/reviews/?action=update_reviews&reviewId='.$review['reviewId'].'">Edit</a> | <a href="/acme/reviews/?action=deleteview&reviewId='.$review['reviewId'].'">Delete</a>';
     $prodReview .='</li>';
 }
 
 return $prodReview;
 }
  