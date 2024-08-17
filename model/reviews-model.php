
<?php
/*need functions to:
o

Insert a review

/*Function for addingProduct*/

function addReview($reviewText, $invId, $clientId)
{
// Create a connection object using the acme connection function
$db = acmeConnect();
// The SQL statement
$sql = 'INSERT INTO reviews (reviewText, invId, clientId)
    VALUES (:reviewText, :invId, :clientId)';


$stmt = $db->prepare($sql);
// The nextlines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
$stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
$stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
$stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
// Insert the data
$stmt->execute();
// Ask how many rows changed as a result of our insert
$rowsChanged = $stmt->rowCount();
// Close the database interaction
$stmt->closeCursor();
// Return the indication of success (rows changed)
return $rowsChanged;
}


// Get reviews for a specific inventory item
// Get reviews written by a specific client
// Get a specific review


//**function checkExistingReview($reviewText){

  // $db = acmeConnect();

  // $sql= 'SELECT reviewText FROM reviews WHERE reviewText = :reviewText';

  //  $stmt = $db->prepare($sql);
//
  //  $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
        
  //  $stmt->execute();

  //  $matchReview = $stmt->fetch(PDO::FETCH_NUM);
    
   //$stmt->closeCursor();

  // if(empty($matchReview)){
  //     return 0;
  // }else{
   //   return 1;
   // }


//}



// Update a specific review

function updateReview($reviewText,$reviewId)
{
    // Create a connection object using the acme connection function
    $db = acmeConnect();
    // The SQL statement
    $sql = 'UPDATE reviews SET reviewText = :reviewText
    WHERE  reviewId = :reviewId';
    
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR); 
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    
 
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
    }



    //* GEt REviews by there invId
    function getReviewsbyId($invId){
        $db = acmeConnect();
        $sql = 'SELECT * FROM reviews JOIN clients ON reviews.clientId= clients.clientId WHERE invId = :invId ORDER BY reviewDate DESC';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $reviewInfo = $stmt ->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
    return $reviewInfo;
    }



    //*Get Reviews by their client Id
    function getReviewsbyclientId($clientId){
        $db = acmeConnect();
        $sql = 'SELECT inventory.invName, reviewText, reviewDate ,reviewId, clientId, reviews.invId FROM reviews JOIN inventory ON reviews.invId = inventory.invId  WHERE clientId = :clientId ORDER BY reviewDate DESC'; 
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
        $stmt->execute();
        $reviewArray = $stmt ->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
    return $reviewArray;
    }


    function getReviewId($reviewId){
        $db = acmeConnect();
        $sql = 'SELECT * FROM reviews WHERE reviewId = :reviewId'; 
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
        $stmt->execute();
        $reviewArray = $stmt ->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
    return $reviewArray;
    }

    

//Delete a specific review*/


   // Delete review information from the reviews table
   function deleteReview($reviewId) {
    $db = acmeConnect();
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->rowCount();
    $stmt->closeCursor();
    return $result;
   }



?>