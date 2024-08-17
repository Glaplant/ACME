<?php include $_SERVER['DOCUMENT_ROOT'].'../acme/common/header.php'?>
          <nav class="bg_red"><?php echo $navigation; ?></nav>
            <main>
            <h1 class="padding "><?php echo $_SESSION['products']['invName']; ?> Product</h1>
                <?php if(isset($message)){
                echo $message; } 
                ?> 

<!--Code for Final-->
<div>
                <p class="body_text padding_sides">Product reviews are available at the bottom of the page</p>

                <?php if(isset($_SESSION['invDisplay'])){ 
                echo $_SESSION['invDisplay']; 
                } ?>

                <hr>
                  <?php if(isset($thumbnail)){ 
                echo $thumbnail; 
                } ?>
<hr>
                <!--Begin customer reviews-->

                <h2 class="padding_sides">Customer Reviews</h2>

                <p class="body_text padding_sides">Review the <?php echo $_SESSION['products']['invName'];?> </p>

                <?php if(isset($_SESSION['message2'])){
                echo $_SESSION['message2']; } 
                ?>

                <?php if(isset($reviewForm)){
                echo $reviewForm; } 
                ?>

<?php if(isset($loginLink)){echo $loginLink;} ?>
                </div>

               
<hr>

<!--Display reviews-->
<!--needs a for each loop to display each review using a clientId-->
<?php if(isset($invReviews)){
                echo $invReviews; } 
                ?>

              <!--END of Reviews-->
            
                    
            </main>
            <hr class="footer_hr">
  
       
                <?php include $_SERVER['DOCUMENT_ROOT'].'../acme/common/footer.php'?>
  