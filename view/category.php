<?php include $_SERVER['DOCUMENT_ROOT'].'../acme/common/header.php'?>
          <nav class="bg_red"><?php echo $navigation; ?></nav>
            <main>
                <h1 class="padding "><?php echo $categoryName; ?> Products</h1>
                <?php if(isset($message)){
                echo $message; } 
                ?> 
                <?php if(isset($prodDisplay)){ 
                echo $prodDisplay; 
                } ?>           
                    
            </main>
            
  
       
                <?php include $_SERVER['DOCUMENT_ROOT'].'../acme/common/footer.php'?>