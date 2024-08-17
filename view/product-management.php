<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 exit;
}
 if (isset($_SESSION['message'])) {
     $message = $_SESSION['message'];
}
?><?php include $_SERVER['DOCUMENT_ROOT'].'../acme/common/header.php'?>
          
          <nav class="bg_red"><?php echo $navigation; ?></nav>
            <main>
            <?php
if (isset($message)) { 
 echo $message; 
} 
if (isset($categoryList)) { 
 echo '<h2>Products By Category</h2>'; 
 echo '<p>Choose a category to see those products</p>'; 
 echo $categoryList; 
}
?>
<noscript>
<p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
</noscript>

<table id="productsDisplay"></table>

                <h1 class="padding">Product Management</h1>
            <p> Welcome to the product management page. Please choose an option below:</p>
            <ul>
                <li><a href="/acme/products/?action=add-category">Add a New Category</a> </li>
                <li><a href="/acme/products/?action=add-product"> Add a New Product </a> </li>

            </ul>
                    
            </main>
            <hr class="footer">
  
       
                <?php include $_SERVER['DOCUMENT_ROOT'].'../acme/common/footer.php'?>
                <?php unset($_SESSION['message']); ?>