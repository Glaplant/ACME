<?php include $_SERVER['DOCUMENT_ROOT'].'../acme/common/header.php'?>
          <nav class="bg_red"><?php echo $navigation; ?></nav>
          <?php if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];}
             ?>

            <main class="padding">
            
  <h2>Add New Product Image</h2>
<?php
 if (isset($message)) {
  echo $message;
 } ?>

<form action="/acme/uploads/" method="post" enctype="multipart/form-data">
 <label for="invItem" >Product</label><br>
 <?php echo $prodSelect; ?><br>
 <label>Upload Image:</label><br>
 <input type="file" name="file1" id="invItem"><br>
 <input type="submit" class="regbtn" value="Upload">
 <input type="hidden" name="action" value="upload">
</form>


<hr>

<h2>Existing Images</h2>
<p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
<?php
 if (isset($imageDisplay)) {
  echo $imageDisplay;
 } ?>         
            
                    
            </main>
            <hr class="footer">

            <?php include $_SERVER['DOCUMENT_ROOT'].'../acme/common/footer.php'?>
            <?php unset($_SESSION['message']); ?>

  
       
  
  