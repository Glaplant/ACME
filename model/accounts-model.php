<?php 

/*Accounts Model*/


/*Function for Site Registration*/

function regClient($clientFirstname,$clientLastname,$clientEmail,$clientPassword){
// Create a connection object using the acme connection function
$db = acmeConnect();
// The SQL statement
$sql = 'INSERT INTO clients (clientFirstname, clientLastname,clientEmail, clientPassword)
    VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
// Create the prepared statement using the acme connection
$stmt = $db->prepare($sql);
// The next four lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
$stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
$stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
$stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
$stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
// Insert the data
$stmt->execute();
// Ask how many rows changed as a result of our insert
$rowsChanged = $stmt->rowCount();
// Close the database interaction
$stmt->closeCursor();
// Return the indication of success (rows changed)
return $rowsChanged;
}


// New Function For Checking Existing Email Addresses

function checkExistingEmail($clientEmail){

    $db = acmeConnect();

    $sql= 'SELECT clientEmail FROM clients Where clientEmail = :email';

    $stmt = $db->prepare($sql);

    $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
        
    $stmt->execute();

    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    
    $stmt->closeCursor();

   if(empty($matchEmail)){
       return 0;
    }else{
       return 1;
    }
}

   //if(empty($matchEmail)){
    //   echo 'Nothing Found';
     //  exit;
  // } else {
     //  echo ' Match found';
     //  exit;
  // }
  //  }
//Get client data based on an email address
function getClient($clientEmail)
{
  $db = acmeConnect();
  $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, 
          clientLevel, clientPassword FROM clients WHERE clientEmail = :email';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
  $stmt->execute();
  $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $clientData;
}

function getClientId($clientId)
{
  $db = acmeConnect();
  $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, 
          clientLevel, clientPassword FROM clients WHERE clientId = :clientId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);
  $stmt->execute();
  $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $clientData;
}

function getClientbyId($clientId)
{
  $db = acmeConnect();
  $sql = 'SELECT * FROM clients WHERE clientId = :clientId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);
  $stmt->execute();
  $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $clientData;
}





//**Update Client */

function updateClient($clientId, $clientFirstname, $clientLastname, $clientEmail){
   // Create a connection object using the acme connection function
   $db = acmeConnect();
   // The SQL statement
   $sql = 'UPDATE clients SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientEmail = :clientEmail
   WHERE clientId = :clientId';
   
   // Create the prepared statement using the acme connection
   $stmt = $db->prepare($sql);
   // The next four lines replace the placeholders in the SQL
   // statement with the actual values in the variables
   // and tells the database the type of data it is
   $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT); 
   $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
   $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
   $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
   

   // Insert the data
   $stmt->execute();
   // Ask how many rows changed as a result of our insert
   $rowsChanged = $stmt->rowCount();
   // Close the database interaction
   $stmt->closeCursor();
   // Return the indication of success (rows changed)
   return $rowsChanged;
   }

   //* Update Password

   function updatePassword($clientId,$clientPassword){
      // Create a connection object using the acme connection function
      $db = acmeConnect();
      // The SQL statement
      $sql = 'UPDATE clients SET clientPassword = :clientPassword
          WHERE clientId = :clientId';
      // Create the prepared statement using the acme connection
      $stmt = $db->prepare($sql);
      // The next four lines replace the placeholders in the SQL
      // statement with the actual values in the variables
      // and tells the database the type of data it is
      $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT); 
      $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
      // Insert the data
      $stmt->execute();
      // Ask how many rows changed as a result of our insert
      $rowsChanged = $stmt->rowCount();
      // Close the database interaction
      $stmt->closeCursor();
      // Return the indication of success (rows changed)
      return $rowsChanged;
      }

    

