<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 exit;
}
?><?php include $_SERVER['DOCUMENT_ROOT'].'../acme/common/header.php'?>
          <nav class="bg_red"><?php echo $navigation; ?></nav>
            <main>
                <h1 class="padding">Add Category</h1>
                <p> Add a new category of products below </p>

                <?php 
        if(isset($message)){
            echo $message;
        }
        ?>
                <form method="POST" action="/acme/products/index.php">
                    <!--New Category name-->
                    <label class="block">New Category
                    <input class="block" type="text" name="categoryName" id="categoryName" title="Category Name" <?php if(isset($categoryName)){echo "value='$categoryName'";}  ?>required>
                    </label>
                    <input class="block button" type="submit" value="Add Category">
                    <input  type="hidden" name="action" value="newCategory">


                </form>
            
                    
            </main>
            <hr class="footer">
  
       
                <?php include $_SERVER['DOCUMENT_ROOT'].'../acme/common/footer.php'?>